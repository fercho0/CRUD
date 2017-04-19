<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Persona.index');
    }

    public function lista()
    {
        $persona=Persona::all();
        return view('Persona.lista')
        ->with('persona',$persona);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if($request->ajax())
        {
           $resultado= Persona::create([
            'PER_nombre' => $request['nombre'],
            'PER_apellido_p' => $request['apellido_p'],
            'PER_apellido_m' =>$request['apellido_m'],
            ]);

            if($resultado){
            return response()->json([
                'success'=>'true'
                ]);
            }
            else
            {
            return response()->json([
                'success'=>'false'
                ]);
            }
        }
        
         
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);

        return response()->json(
            $persona->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax())
        {
            $persona=Persona::find($id);

            $persona->PER_nombre=$request['nombre'];
            $persona->PER_apellido_p=$request['apellido_p'];
            $persona->PER_apellido_m=$request['apellido_m'];
            $persona->update();

            if($persona)
            {
                return response()->json(
                ['success'=>'true']
                );
            }  
            else
            {
                return response()->json(
                ['success'=>'false']
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona=Persona::find($id);
        $persona->delete();

        if ($persona) {
            return response()->json(
                ['success'=>'true']
            );
        }
        else
        {
            return response()->json(
                ['success'=>'false']
            );
        }
    }
}
