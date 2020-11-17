<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller{

    /**
     * Create a new controller instance.
     * @return void
    */
    public function __construct(){
        $this->user     = new User();
        $this->middleware('auth');
    }

    /**
     * Endpoint para listagem de informações de usuário utilizados na view
    */
    public function index(){   
        $usuarios = $this->user->get_all();
        return view('user/index', ['usuarios' =>$usuarios] );
    }

    /**
     * endpoint para edição de informações utilizados na view
    */
    public function edit($user_id){
        $usuario = $this->user->get_user_by_id($user_id);
        return view('user/edit', ['usuario' =>$usuario] );
    }

    /**
     * Endpoint para atualização de usuário utilizados na view
     */
    public function update(Request $request){   
        $user_id                = $request->input('user_id');
        if(!empty($user_id)){
            $dados              = array(
                'id'            => $user_id,
                'password'      => (!empty($request->input('password'))) ? Hash::make($request->input('password')) : false,
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'address'       => $request->input('address'),
                'city'          => $request->input('city'),
                'zip_code'      => $request->input('zip_code'),
            );
            $this->user->save_from_data($dados);
            return redirect()->action([UserController::class, 'edit'],$user_id);
        }else{
            return redirect()->action([UserController::class, 'index']);
        }
    }

    /**
     * Endpoint para remoção de registros utilizados na view
     */
    public function delete($user_id){   
        $this->user->delete_data($user_id);
        return redirect()->action([UserController::class, 'index']);
    }
}
