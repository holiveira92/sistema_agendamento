<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'address',
        'city',
        'zip_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function get_user_by_id($user_id){
        $usuario = $this->stdClass_to_Array(DB::select("SELECT * FROM users WHERE id = $user_id"));
        //$usuario = User::select('*')->where('id','=',$user_id)->get()->toArray();
        $usuario = !empty($usuario[0]) ? $usuario[0] : $usuario;
        return $usuario;
    }

    public function get_user_by_email($user_email){
        $usuario = $this->stdClass_to_Array(DB::select("SELECT * FROM users WHERE email = '$user_email'"));
        $usuario = !empty($usuario[0]) ? $usuario[0] : $usuario;
        return $usuario;
    }

    /**
     * Converte um array stdclass para um array associativo
     * @param  array  $data
     * @return \App\Models\User
     */
    public function stdClass_to_Array($array){
        $array = array_map(function($result){
            return (array) $result;
        }, $array);
        return $array;
    }

    public function save_from_data($data){
        $user                   = $this->find($data['id']);
        if(!empty($user->name)){
            if(!empty($data['password'])){
                $user->password     =  $data['password'];
            }
            $user->name             =  $data['name'];
            $user->email            =  $data['email'];
            $user->address          =  $data['address'];
            $user->city             =  $data['city'];
            $user->zip_code         =  $data['zip_code'];
            $user->save();
        }
    }

    public function delete_data($user_id){
        $user = $this->find($user_id);
        if(!empty($user->id)){
            $user->delete();
        }
    }

    public function get_all(){
        $usuarios = $this->get()->toArray();
        return $usuarios;
    }
}
