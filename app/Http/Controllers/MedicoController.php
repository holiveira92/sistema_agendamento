<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Agendamento;
use App\Models\Medico;
use App\Models\Paciente;

class MedicoController extends Controller{

    /**
     * Create a new controller instance.
     * @return void
    */
    public function __construct(){
        //Instâncias de classes necessárias
        $this->user             = new User();
        $this->agendamento      = new Agendamento();
        $this->medico           = new Medico();
        $this->paciente         = new Paciente();
        $this->middleware('auth');
    }

    /**
     * Endpoint para listagem de informações de médicos utilizados na view
    */
    public function index(){   
        $medicos = $this->medico->get_all();
        return view('medico/index', ['medicos' =>$medicos] );
    }

    /**
     * endpoint para edição de informações utilizados na view
    */
    public function edit($medico_id){
        $medico                 = $this->medico->get_medico_by_id($medico_id);
        $count_consultas        = $this->agendamento->get_qtde_agendamentos_medico($medico_id);
        $count_pacientes        = $this->agendamento->get_qtde_pacientes_medico($medico_id);
        $medico                 = array(
            'id'                => empty($medico['id']) ? 0 : $medico['id'], 
            'nome'              => empty($medico['nome']) ? '' : $medico['nome'],
            'sexo'              => empty($medico['sexo']) ? '' : $medico['sexo'],
            'data_nascimento'   => empty($medico['data_nascimento']) ? '' : $medico['data_nascimento'],
            'especialidades'    => empty($medico['especialidades']) ? '' : $medico['especialidades'],
            'celular'           => empty($medico['celular']) ? '' : $medico['celular'],
            'cpf_cnpj'          => empty($medico['cpf_cnpj']) ? '' : $medico['cpf_cnpj'],
            'crm'               => empty($medico['crm']) ? '' : $medico['crm'],
            'endereco'          => empty($medico['endereco']) ? '' : $medico['endereco'],
            'cidade'            => empty($medico['cidade']) ? '' : $medico['cidade'],
            'cep'               => empty($medico['cep']) ? '' : $medico['cep'],
            'qtde_consultas'    => $count_consultas,
            'qtde_pacientes'    => $count_pacientes,
        );
        return view('medico/edit', ['medico' =>$medico] );
    }

    /**
     * Endpoint para atualização de médico utilizados na view
     */
    public function update($id){  
        $nome                       = request('nome');
        if(!empty($nome)){
            $dados                  = array(
                'id'                => empty(request('id_medico')) ? '' : request('id_medico'),
                'nome'              => empty(request('nome')) ? '' : request('nome'),
                'sexo'              => empty(request('sexo')) ? '' : request('sexo'),
                'data_nascimento'   => empty(request('data_nascimento')) ? '' : request('data_nascimento'),
                'especialidades'    => empty(request('especialidades')) ? '' : request('especialidades'),
                'celular'           => empty(request('celular')) ? '' : request('celular'),
                'cpf_cnpj'          => empty(request('cpf_cnpj')) ? '' : request('cpf_cnpj'),
                'crm'               => empty(request('crm')) ? '' : request('crm'),
                'endereco'          => empty(request('endereco')) ? '' : request('endereco'),
                'cidade'            => empty(request('cidade')) ? '' : request('cidade'),
                'cep'               => empty(request('cep')) ? '' : request('cep'),
            );
            $id = $this->medico->save_from_data($dados);
            return redirect()->action([MedicoController::class, 'edit'],$id);
        }else{
            return redirect()->action([MedicoController::class, 'index']);
        }
    }

    /**
     * Endpoint para remoção de registros utilizados na view
     */
    public function delete($medico_id){   
        $this->medico->delete_data($medico_id);
        return redirect()->action([MedicoController::class, 'index']);
    }
}
