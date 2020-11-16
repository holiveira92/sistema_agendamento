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

class AgendamentosController extends Controller{

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
        $agendamentos = $this->agendamento->get_all();
        return view('agendamentos/index', ['agendamentos' =>$agendamentos] );
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function create(){
        $agendamento_id         = $request->input('agendamento_id');
        if(!empty($agendamento_id)){
            $dados              = array(
                'id'            => $user_id,
                'password'      => (!empty($request->input('password'))) ? Hash::make($request->input('password')) : false,
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'address'       => $request->input('address'),
                'city'          => $request->input('city'),
                'zip_code'      => $request->input('zip_code'),
            );
            $this->agendamento->save_from_data($dados);
            return redirect()->action([AgendamentosController::class, 'edit'],$agendamento_id);
        }else{
            return redirect()->action([AgendamentosController::class, 'index']);
        }
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function edit($agendamento_id){
        $medicos            = $this->medico->get_medicos();
        $pacientes          = $this->paciente->get_pacientes();
        $agendamento        = $this->agendamento->get_agendamento_by_id($agendamento_id);
        $agendamento        = array(
            'id'            => empty($agendamento['id']) ? 0 : $agendamento['id'], 
            'id_medico'     => empty($agendamento['id_medico']) ? '' : $agendamento['id_medico'],
            'id_paciente'   => empty($agendamento['id_paciente']) ? '' : $agendamento['id_paciente'],
            'horario_inicio'=> empty($agendamento['horario']) ? '' : $agendamento['horario_inicio'],
            'horario_fim'   => empty($agendamento['horario_fim']) ? '' : $agendamento['horario_fim'],
            'horario'       => empty($agendamento['horario']) ? '' : $agendamento['horario'],
        );
        return view('agendamentos/edit', ['agendamento' =>$agendamento, 'medicos' => $medicos, 'pacientes' => $pacientes] );
    }

    /**
     * Update a new user instance after a valid registration.
     * @param  array  $data
     * @return \App\Models\User
     */
    public function update(Request $request){   
        $id_medico              = $request->input('medico');
        $horario                = explode(' - ',request('horario'));
        $horario_inicio         = !empty($horario[0]) ? trim($horario[0]) : "";
        $horario_fim            = !empty($horario[1]) ? trim($horario[1]) : "";
        if(!empty($id_medico)){
            $dados              = array(
                'id'            => empty(request('agendamento_id')) ? '' : request('agendamento_id'),
                'id_medico'     => empty(request('medico')) ? '' : request('medico'),
                'id_paciente'   => empty(request('paciente')) ? '' : request('paciente'),
                'horario_inicio'=> $horario_inicio,
                'horario_fim'   => $horario_fim,
            );
            $agendamento_id = $this->agendamento->save_from_data($dados);
            return redirect()->action([AgendamentosController::class, 'edit'],$agendamento_id);
        }else{
            return redirect()->action([AgendamentosController::class, 'index']);
        }
    }

    /**
     * Delete a user instance after a valid registration.
     * @param  array  $data
     * @return \App\Models\User
     */
    public function delete($agendamento_id){   
        $this->agendamento->delete_data($agendamento_id);
        return redirect()->action([AgendamentosController::class, 'index']);
    }
}
