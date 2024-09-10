<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipos;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipos::where('status', 1)->orderBY('id','desc')->get();
        return response()->json($equipos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $json = json_decode(file_get_contents('php://input'), true);
       if(!is_array($json)){
        $array = array(
            'response'=> array(
                'estado'=>'Bad request',
                'mensaje'=>'La petición HTTP no trae datos para procesar',
            )
        );
        return response()->json($array, 400);
       }

       $save = new Equipos;
       $save->nombre = $request->nombre;
       $save->campeonatos = $request->campeonatos;
       $save->status = 1;
       $save->save();

       $array = array(
        'response'=> array(
            'estado'=> 'Ok',
            'mensaje'=>'Se creó el registro correctamente'
        )
       );
       return response()->json($array, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipo = Equipos::where(['status'=>1, 'id'=>$id])->get();
        return response()->json($equipo, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $json = json_decode(file_get_contents('php://input'), true);
        if(!is_array($json)){
            $array = array(
                'response'=>array(
                    'estado'=>'Bad request',
                    'mensaje'=>'La petición HTTP no trae datos para procesar'
                )
            );
            return response()->json($array, 400);
        }
        $equipo = Equipos::where(['id'=>$id])->first();
        if(!$equipo){
            $array = array(
                'response'=> array(
                    'estado'=>'Not Fount',
                    'mensaje'=>'Equipo no encontrado'
                )
            );
            return response()->json($array, 404);
        }

        $equipo->nombre = $request->nombre;
        $equipo->campeonatos = $request->campeonatos;
        $equipo->status = $request->status;
        $equipo->save();
        
        $array = array(
            'response'=>array(
                'estado'=>'Ok',
                'mensaje'=>'Se modificó el registro exitosamente',
            )
        );

        return response()->json($array, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipo = Equipos::where(['id'=>$id, 'status'=>1])->first();
        if(!$equipo){
            $array = array(
                'response'=> array(
                    'estado'=>'Not Fount',
                    'mensaje'=>'Equipo no encontrado'
                )
            );
            return response()->json($array, 404);
        }

        $equipo->status = 2;
        $equipo->save();
        
        $array = array(
            'response'=>array(
                'estado'=>'Ok',
                'mensaje'=>'Se eliminó el registro exitosamente',
            )
        );

        return response()->json($array, 200);
    }
}
