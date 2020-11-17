<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Medico extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = "medico";
    protected $fillable = [
        'nome',
    ];
    
    /**
     * obtém dados do médico por ID
     */
    public function get_medico_by_id($medico_id){
        $medico = $this->stdClass_to_Array(
            DB::table('medico')
                ->select('*')
                ->where('medico.id', '=', $medico_id)
                ->get()->toArray());
        $medico = !empty($medico[0]) ? $medico[0] : $medico;
        return $medico;
    }

    /**
     * obtém coleção de dados dos médico cadastrados
     */
    public function get_medicos(){
        $medicos = $this->stdClass_to_Array(
                DB::table('medico')
                    ->select('*')
                    ->get()->toArray());
        return $medicos;
    }

    /**
     * Converte um array stdclass para um array associativo
     */
    public function stdClass_to_Array($array){
        $array = array_map(function($result){
            return (array) $result;
        }, $array);
        return $array;
    }

    /**
     * Persistência de dados
     */
    public function save_from_data($data){
        $medico                   = $this->find($data['id']);
        if(!empty($data['id'])){
            $medico->nome               = $data['nome'];
            $medico->sexo               = $data['sexo'];
            $medico->data_nascimento    = $data['data_nascimento'];
            $medico->especialidades     = $data['especialidades'];
            $medico->celular            = $data['celular'];
            $medico->cpf_cnpj           = $data['cpf_cnpj'];
            $medico->crm                = $data['crm'];
            $medico->endereco           = $data['endereco'];
            $medico->cidade             = $data['cidade'];
            $medico->cep                = $data['cep'];
            $medico->save();
            $id                         = $data['id'];
        }else{
            //var_dump($data['data_nascimento']);die;
            $medico_id = DB::table('medico')->insertGetId(array(
                'nome'               => $data['nome'],
                'sexo'               => $data['sexo'],
                'data_nascimento'    => $data['data_nascimento'],
                'especialidades'     => $data['especialidades'],
                'celular'            => $data['celular'],
                'cpf_cnpj'           => $data['cpf_cnpj'],
                'crm'                => $data['crm'],
                'endereco'           => $data['endereco'],
                'cidade'             => $data['cidade'],
                'cep'                => $data['cep'],
            ));
            $id                      = $medico_id;
        }
        return $id;
    }

    /**
     * delete registro do BD
     */
    public function delete_data($medico_id){
        $medico = $this->find($medico_id);
        if(!empty($medico->id)){
            $medico->delete();
        }
    }

    /**
     * Obtém toda a coleção de dados do BD
     */
    public function get_all(){
        $medicos = $this->get()->toArray();
        return $medicos;
    }
}
