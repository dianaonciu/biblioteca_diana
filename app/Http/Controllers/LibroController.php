<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Libro;

class LibroController extends Controller
{
    public function listaLibros()
    {
        $response = array('error_code' => 400, 'error_msg' => 'Error');
        $libro = Libro::all(['id', 'titulo', 'sinopsis', 'genero', 'autor', 'prestado']);
        if (empty($libro)) {
            $response = array('error_code' => 404, 'error_msg' => 'Not found');
        } else {
            return $libro;
        }
        return response()->json($response);
    }

    public function filtroLibros(Request $request)
    {
        $genero = $request->genero;
        $autor = $request->autor;

        if ($genero != null && $autor != null) {
            $libro = Libro::where('genero', '=', $genero)
                ->where(function ($query) use ($autor) {
                    $query->where('autor', '=', $autor);
                })->get();
        } elseif ($genero == null) {
            $libro = Libro::where('autor', '=', $autor)->get();
        } elseif ($autor == null) {
            $libro = Libro::where('genero', '=', $genero)->get();
        }

        if (empty($libro)) {
            $response = array('error_code' => 404, 'error_msg' => 'Not found');
            return response()->json($response);
        } else {
            return $libro;
        }
        return response()->json($response);
    }



    public function postLibros(Request $request)
    {
        $response = array('error_code' => 400, 'error_msg' => 'Error inserting info');
        $libro = new Libro;
        if (!$request->titulo || !$request->sinopsis || !$request->genero || !$request->autor)
            $response = array('error_msg' => "Tiene que rellenar todos los campos");
        else {
            try {
                $libro->titulo = $request->titulo;
                $libro->sinopsis = $request->sinopsis;
                $libro->genero = $request->genero;
                $libro->autor = $request->autor;
                $libro->prestado = $request->prestado;
                $libro->save();
                $response = array('error_code' => 200, 'error_msg' => 'OK');
            } catch (\Exception $e) {
                $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
            }
        }

        return response()->json($response);
    }



    public function putLibros(Request $request)
    {
        if (!empty($libro)) {
            $response = array('error_code' => 404, 'error_msg' => 'Libro no encontrado');
            $libro = Libro::find($request->id);
            if (!isset($libro->id)) {
                $response = array('error_code' => 404, 'error_msg' => 'Libro no encontrado, el id no existe');
            } else {
                try {
                    $libro->titulo = $request->titulo;
                    $libro->sinopsis = $request->sinopsis;
                    $libro->genero = $request->genero;
                    $libro->autor = $request->autor;
                    $libro->prestado = $request->prestado;
                    $libro->save();
                    $response = array('error_code' => 200, 'error_msg' => 'OK');
                } catch (\Exception $e) {
                    $response = array('error_code' => 500, 'error_msg' => $e->getMessage());
                }
            }
        } else {
            $response = array('error_code' => 404, 'error_msg' => 'Libro no encontrado');
        }

        return response()->json($response);
    }
    public function deleteLibros(Request $request)
    {
        $response = array('error_code' => 404, 'error_msg' => 'Libro no encontrado');
        $libro = Libro::find($request->id);
        if (empty($libro)) {
            $response = array('error_code' => 404, 'error_msg' => 'Not found');
        } else {
            $libro->delete();
            $response = array('error_code' => 200, 'error_msg' => 'OK');
        }
        return response()->json($response);
    }
}
