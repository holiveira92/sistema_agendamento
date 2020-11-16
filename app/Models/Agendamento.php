<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Agendamento extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "agendamentos";
    public $timestamps = false;

    public function get_agendamento_by_id($id_medico){
        $agendamento = $this->stdClass_to_Array(DB::select("SELECT * FROM agendamentos WHERE id_medico = $id_medico"));
        $agendamento = !empty($agendamento[0]) ? $agendamento[0] : $agendamento;
        return $agendamento;
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
        $agendamento                    = $this->find($data['id']);
        $horario_inicio                 = date('Y-m-d H:i',strtotime(str_replace("/", "-", $data["horario_inicio"])));
        $horario_fim                    = date('Y-m-d H:i',strtotime(str_replace("/", "-", $data["horario_fim"])));
        if(!empty($data['id'])){
            $agendamento->id_medico     = $data['id_medico'];
            $agendamento->id_paciente   = $data['id_paciente'];
            $agendamento->horario_inicio= $horario_inicio;
            $agendamento->horario_fim   = $horario_fim;
            $id                         = $data['id'];
            $agendamento->save();
        }else{
            $id = DB::table('agendamentos')->insertGetId(array(
                'id_medico'             => $data['id_medico'],
                'id_paciente'           => $data['id_paciente'],
                'horario_inicio'        => $horario_inicio,
                'horario_fim'           => $horario_fim,
            ));
        }
        return $id;
    }

    public function delete_data($agendamento_id){
        $agendamento = $this->find($agendamento_id);
        if(!empty($agendamento->id)){
            $agendamento->delete();
        }
    }

    public function get_all(){
        $agendamentos = DB::table('agendamentos')
            ->leftJoin('medico', 'agendamentos.id_medico', '=', 'medico.id')
            ->leftJoin('paciente', 'agendamentos.id_paciente', '=', 'paciente.id')
            ->select('agendamentos.*', 'medico.nome as nome_medico', 'paciente.nome as nome_paciente')
            ->get()->toArray();
        $agendamentos = $this->stdClass_to_Array($agendamentos);
        return $agendamentos;
    }

    public function get_qtde_agendamentos_medico($id_medico){
        $qtde = $this->stdClass_to_Array(DB::select("SELECT count(*) as qtde FROM agendamentos WHERE id_medico = $id_medico"));
        $qtde = !empty($qtde[0]['qtde']) ? $qtde[0]['qtde'] : $qtde;
        return $qtde;
    }

    public function get_qtde_pacientes_medico($id_medico){
        $qtde = $this->stdClass_to_Array(DB::select("SELECT count(DISTINCT id_paciente) as qtde FROM agendamentos WHERE id_medico = $id_medico GROUP BY id_paciente"));
        $qtde = !empty($qtde[0]['qtde']) ? $qtde[0]['qtde'] : $qtde;
        return $qtde;
    }

    public function get_qtde_agendamentos_paciente($id_paciente){
        $qtde = $this->stdClass_to_Array(DB::select("SELECT count(DISTINCT id_medico) as qtde FROM agendamentos WHERE id_paciente = $id_paciente"));
        $qtde = !empty($qtde[0]['qtde']) ? $qtde[0]['qtde'] : $qtde;
        return $qtde;
    }

    public function get_qtde_medico_pacientes($id_paciente){
        $qtde = $this->stdClass_to_Array(DB::select("SELECT count(DISTINCT id_medico) as qtde FROM agendamentos WHERE id_paciente = $id_paciente GROUP BY id_medico"));
        $qtde = !empty($qtde[0]['qtde']) ? $qtde[0]['qtde'] : $qtde;
        return $qtde;
    }
}
