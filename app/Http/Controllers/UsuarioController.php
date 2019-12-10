<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsuarioController extends Controller
{


    public function listaUsuarios()
    {
        $response = array('error_code' => 400, 'error_msg' => 'Error');
        $usuario = User::all(['id', 'name', 'email', 'password']);
        if (!empty($usuario)) {
            return $usuario;
        } else {
            $response = array('error_code' => 404, 'error_msg' => 'Not found');
        }
        return response()->json($response);
    }
    public function postUsuarios(Request $request)
    {
        $response = array('error_code' => 400, 'error_msg' => 'Error');
        $usuario = new User;
        if (!$request->name || !$request->email || !$request->password || !$request->api_token)
            $response = array('error_msg' => "Tiene que rellenar todos los campos");
        else {
            try {
                $usuario->name = $request->name;
                $usuario->email = $request->email;
                $usuario->password = $request->password;
                $usuario->api_token = $request->api_token;
                $usuario->api_token = hash('sha256', $request->api_token);
                $usuario->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
            } catch (\Exception $e) {
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }

        return response()->json($response);
    }



    public function putUsuarios(Request $request)
    {
        if (!empty($usuario)) {
            $response = array('error_code' => 404, 'error_msg' => 'Usuario no encontrado');
            $usuario = User::find($request->id);
            if (!isset($usuario->id)) {
                $response = array('error_code' => 404, 'error_msg' => 'Usuario no encontrado, el id no existe');
            } else {
                try {
                    $usuario->name = $request->name;
                    $usuario->email = $request->email;
                    $usuario->password = $request->password;
                    $usuario->save();
                    $response = array('error_code' => 200, 'error_msg' => 'OK');
                } catch (\Exception $e) {
                    $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
                }
            }
        } else {
            $response = array('error_code' => 404, 'error_msg' => 'Usuario no encontrado');
        }

        return response()->json($response);
    }
    public function deleteUsuarios(Request $request)
    {
        $response = array('error_code' => 404, 'error_msg' => 'Usuario no encontrado');
        $usuario = User::find($request->id);
        if (empty($usuario)) {
            $response = array('error_code' => 404, 'error_msg' => 'Not found');
        } else {
            $usuario->delete();
            $response = array('error_code' => 200, 'error_msg' => 'OK');
        }
        return response()->json($response);
    }
}
