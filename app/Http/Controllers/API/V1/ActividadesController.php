<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Voluntario;
use App\Models\Actividades;
use Illuminate\Http\Request;

class ActividadesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $actividades = '';

    public function __construct(Actividades $actividades,Voluntario $voluntario)
    {
        $this->middleware('auth:api');
        $this->actividades = $actividades;
        $this->voluntario = $voluntario;
    }
    public function index()
    {
           $actividad = $this->actividades->latest()->paginate(10);
           return $this->sendResponse($actividad, 'Lista de Actividades');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->imagen){
            $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos
            ($request->imagen, ';')))[1])[1];
           \Image::make($request->imagen)->save(public_path('images/Actividades/').$name);
           $request->merge(['imagen' => $name]);
        }
        $tag = $this->actividades->create([
            'nombre' => $request->get('nombre'),
            'fecha' => $request->get('fecha'),
            'hora' => $request->get('hora'),
            'descripcion' => $request->get('descripcion'),
            'cantParticipantes' => $request->get('cantParticipantes'),
            'imagen' => $request->get('imagen'),
            'listaParticipantes' => $request->get('listaParticipantes'),
            'idvoluntarios' => $request->get('idvoluntarios'),
            
        ]);
        return $this->sendResponse($tag, 'Actividades creado');
    }
    
    public function obtenerVoluntarios(){
        $voluntarios = Voluntario::get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function show(Actividades $actividades)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $tag = $this->actividades->findOrFail($id);
        $currentFoto = $tag->imagen;
        if($request->imagen != $currentFoto){
         $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos
         ($request->imagen, ';')))[1])[1];
 
         \Image::make($request->imagen)->save(public_path('images/Actividades/').$name);
          $request->merge(['imagen' => $name]);
 
          $actividadFoto = public_path('images/Actividades/').$currentFoto;
          if(file_exists($actividadFoto)){
              @unlink($actividadFoto);
          }
        }
        $tag->update($request->all());
        return $this->sendResponse($tag, 'Actividad Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $actividades = Actividades::FindOrFail($id);
        if(file_exists('images/Actividades/'.$actividades->imagen) AND !empty($actividades->imagen)){
            unlink('images/Actividades/'.$actividades->imagen);
        }try{
            $actividades->delete();
            $bug = 0;
        }catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }if($bug==0){
            echo "success";
        }else{
            echo 'error';
        }
    }
}
