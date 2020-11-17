<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Paciente extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table = "paciente";
    protected $fillable = [
        'nome',
    ];

    /**
     * obtém dados do paciente por ID
     */
    public function get_paciente_by_id($paciente_id){
        $paciente = $this->stdClass_to_Array(
            DB::table('paciente')
                ->select('*')
                ->where('paciente.id', '=', $paciente_id)
                ->get()->toArray());
        $paciente = !empty($paciente[0]) ? $paciente[0] : $paciente;
        return $paciente;
    }

    /**
     * obtém coleção de dados dos pacientes cadastrados
     */
    public function get_pacientes(){
        $pacientes = $this->stdClass_to_Array(
                DB::table('paciente')
                    ->select('*')
                    ->get()->toArray());
        return $pacientes;
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
            $medico->celular            = $data['celular'];
            $medico->cpf_cnpj           = $data['cpf_cnpj'];
            $medico->endereco           = $data['endereco'];
            $medico->cidade             = $data['cidade'];
            $medico->cep                = $data['cep'];
            $medico->save();
            $id                         = $data['id'];
        }else{
            $medico_id = DB::table('paciente')->insertGetId(array(
                'nome'               => $data['nome'],
                'sexo'               => $data['sexo'],
                'data_nascimento'    => $data['data_nascimento'],
                'celular'            => $data['celular'],
                'cpf_cnpj'           => $data['cpf_cnpj'],
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
        $paciente = $this->find($medico_id);
        if(!empty($paciente->id)){
            $paciente->delete();
        }
    }

    /**
     * Obtém toda a coleção de dados do BD
     */
    public function get_all(){
        $pacientes = $this->get()->toArray();
        return $pacientes;
    }
}
