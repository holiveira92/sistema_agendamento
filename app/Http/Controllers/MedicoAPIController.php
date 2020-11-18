<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Medico;

class MedicoAPIController extends Controller{
    
    /**
     * Create a new controller instance.
     * @return void
    */
    public function __construct(){
        //Instâncias de classes necessárias
        $this->medico = new Medico();
    }

    /**
     * Endpoint para listagem de informações de agendamentos utilizados na API
    */
    public function index(){
        $medico = $this->medico->get_all();
        return response()->json($medico, 201);
    }

    /**
     * Endpoint para listagem de informações especificas de um médico na API
    */
    public function show($id){
        $medico = $this->medico->get_medico_by_id($id);
        return response()->json($medico, 201);
    }

    /**
     * Endpoint para inserção de informações de um médico na API
    */
    public function insert(Request $request){
        $dados                  = array(
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
        return response()->json($dados, 200);
    }

    /**
     * Endpoint para atualização de informações de um médico na API
    */
    public function update(Request $request, $id){
        $dados                  = array(
            'id'                => empty($id) ? '' : $id,
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
        return response()->json($dados, 200);
    }

    /**
     * Endpoint para removação de um médico na API
    */
    public function delete($id){
        $this->medico->delete_data($id);
        return response()->json(null, 204);
    }
}