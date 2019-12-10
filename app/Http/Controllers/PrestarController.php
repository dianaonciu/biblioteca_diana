<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Prestamo;

use App\Libro;

class PrestarController extends Controller
{

    public function prestarLibro(Request $request)
    {
        if ($request->libro_id && $request->usuario_id) {
            $libro = Libro::find($request->libro_id);
            if (empty($libro))  return array('code' => 404, 'error_msg' => ['Not found']);
            if ($libro->prestado === 0) {
                try {
                    $prestamo = new Prestamo();
                    $prestamo->usuario_id = $request->usuario_id;
                    $prestamo->libro_id = $request->libro_id;
                    $prestamo->fecha_prestamo = date("Y-m-d H:i:s");
                    $libro->prestado = 1;
                    $prestamo->save();
                    $libro->save();
                    $response = array('code' => 200, 'msg' => ['OK']);
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            } else {
                $response = array('code' => 404, 'error_msg' => ['Ya está prestado']);
            }
        }
        return $response;
    }

    public function devolverLibro(Request $request)
    {
        if (isset($request->prestamo_id)) {
            $prestamo = Prestamo::find($request->prestamo_id);
            if (empty($prestamo)) {
                $response = array('code' => 404, 'error_msg' => ['Not found']);
            } elseif (isset($request->fecha_prestamo) && isset($request->fecha_devolucion) && $request->fecha_prestamo >= $request->fecha_devolucion)
                $response['error_msg'] = 'La fecha de devolución no puede ser anterior a la de préstamo';

            else {
                try {
                    $libro = $prestamo->libro;
                    $libro->prestado = 0;
                    $prestamo->fecha_devolucion = date("Y-m-d H:i:s");
                    $prestamo->save();
                    $libro->save();
                    $response = array('code' => 200, 'msg' => ['OK']);
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            }
        }
        return response()->json($response);
    }
}
