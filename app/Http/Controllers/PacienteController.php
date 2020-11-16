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

class PacienteController extends Controller{

    /**
     * Create a new controller instance.
     * @return void
    */
    public function __construct(){
        $this->user     = new User();
        $this->agendamento     = new Agendamento();
        $this->medico     = new Medico();
        $this->paciente     = new Paciente();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index(){   
        $pacientes = $this->paciente->get_all();
        return view('paciente/index', ['pacientes' =>$pacientes] );
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function edit($paciente_id){
        $paciente               = $this->paciente->get_paciente_by_id($paciente_id);
        $count_consultas        = $this->agendamento->get_qtde_agendamentos_paciente($paciente_id);
        $qtde_medicos           = $this->agendamento->get_qtde_medico_pacientes($paciente_id);
        $paciente               = array(
            'id'                => empty($paciente['id']) ? 0 : $paciente['id'], 
            'nome'              => empty($paciente['nome']) ? '' : $paciente['nome'],
            'sexo'              => empty($paciente['sexo']) ? '' : $paciente['sexo'],
            'data_nascimento'   => empty($paciente['data_nascimento']) ? '' : $paciente['data_nascimento'],
            'especialidades'    => empty($paciente['especialidades']) ? '' : $paciente['especialidades'],
            'celular'           => empty($paciente['celular']) ? '' : $paciente['celular'],
            'cpf_cnpj'          => empty($paciente['cpf_cnpj']) ? '' : $paciente['cpf_cnpj'],
            'crm'               => empty($paciente['crm']) ? '' : $paciente['crm'],
            'endereco'          => empty($paciente['endereco']) ? '' : $paciente['endereco'],
            'cidade'            => empty($paciente['cidade']) ? '' : $paciente['cidade'],
            'cep'               => empty($paciente['cep']) ? '' : $paciente['cep'],
            'qtde_consultas'    => $count_consultas,
            'qtde_medicos'      => $qtde_medicos,
        );
        return view('paciente/edit', ['paciente' =>$paciente] );
    }

    /**
     * Update a new user instance after a valid registration.
     * @param  array  $data
     * @return \App\Models\User
     */
    public function update($id){  
        $nome                       = request('nome');
        if(!empty($nome)){
            $dados                  = array(
                'id'                => empty(request('id_paciente')) ? '' : request('id_paciente'),
                'nome'              => empty(request('nome')) ? '' : request('nome'),
                'sexo'              => empty(request('sexo')) ? '' : request('sexo'),
                'data_nascimento'   => empty(request('data_nascimento')) ? '' : request('data_nascimento'),
                'celular'           => empty(request('celular')) ? '' : request('celular'),
                'cpf_cnpj'          => empty(request('cpf_cnpj')) ? '' : request('cpf_cnpj'),
                'endereco'          => empty(request('endereco')) ? '' : request('endereco'),
                'cidade'            => empty(request('cidade')) ? '' : request('cidade'),
                'cep'               => empty(request('cep')) ? '' : request('cep'),
            );
            $id = $this->paciente->save_from_data($dados);
            return redirect()->action([PacienteController::class, 'edit'],$id);
        }else{
            return redirect()->action([PacienteController::class, 'index']);
        }
    }

    /**
     * Delete a user instance after a valid registration.
     * @param  array  $data
     * @return \App\Models\User
     */
    public function delete($paciente_id){   
        $this->paciente->delete_data($paciente_id);
        return redirect()->action([PacienteController::class, 'index']);
    }
}
