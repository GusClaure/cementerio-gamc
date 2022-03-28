<?php

namespace App\Http\Controllers\Nicho;

use App\Models\Nicho;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NichoController extends Controller
{
    public function index(){
        $cuartel=DB::table('cuartel')
                 ->select('cuartel.id', 'cuartel.codigo')
                 ->where('estado', '=', 'ACTIVO')
                 ->get();

                 $bloque=DB::table('bloque')
                 ->select('bloque.id', 'bloque.codigo')
                 ->where('estado', '=', 'ACTIVO')
                 ->get();


        $nicho =DB::table('nicho')
                 ->select('nicho.*', 'cuartel.codigo as cuartel_cod', 'bloque.codigo as bloque_id')
                 ->join('cuartel' , 'cuartel.id','=', 'nicho.cuartel_id')
                 ->join('bloque' , 'bloque.id','=', 'nicho.bloque_id')
                // ->where('bloque.estado', '=', 'ACTIVO')
                 ->get();

        return view('nicho/index', ['bloque' =>$bloque , 'cuartel' => $cuartel , 'nicho' => $nicho]);
    }

    public function createNewNicho(Request $request){

        if($request->isJson()){
            
            $this->validate($request, [
                'bloque' => 'required',
                'codigo' => 'required|unique:nicho',
                'cuartel' => 'required',
                'tipo' => 'required',
                'fila' => 'required',
                'columna' => 'required',
                'nro' => 'required',
                'cantidad' => 'required',

                'estado' => 'required'
            ], [
                'bloque.required'  => 'El campo bloque  es obligatorio!',
                'cuartel.required' => 'El campo  cuartel es obligatorio!',
                'nro.required' => 'El campo Nro  es obligatorio!',
                'fila.required' => 'El campo fila  es obligatorio!',
                'columna.required' => 'El campo columna  es obligatorio!',
                'cantidad.required' => 'El campo cantidad de cuerpos  es obligatorio!',
                'tipo.required' => 'El campo tipo nicho  es obligatorio!',
                'codigo.unique' => 'El código '.$request->codigo.' ya se encuentra en uso!.'
            ]);
           // dd($request);

           $new_nicho =  Nicho::create([
            'codigo' => trim($request->codigo),
            'bloque_id' => trim($request->bloque),
            'cuartel_id' => trim($request->cuartel),
            'nro_nicho' => trim($request->nro),
            'fila' => trim($request->fila),
            'columna' => trim($request->columna),
            'codigo' => trim($request->codigo),
            'codigo_anterior' => trim($request->codigo_anterior),
            'cantidad_cuerpos' => trim($request->cantidad),
            'tipo' => trim($request->tipo),
            //'estado_nicho' => trim($request->estado_nicho),
            'estado' => trim($request->estado),

            'user_id' => auth()->id(),
            'estado' => 'ACTIVO',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
           ]);


            return response([
                'status'=> true,
                'response'=> $new_nicho
             ],201);

        }else{

            return response([
                'status'=> false,
                'message'=> 'Error 401 (Unauthorized)'
             ],401);
        }
    }

    public function getNicho($id){ 

        $nicho =  Nicho::where('id', $id)->first();

               return response([
                'status'=> true,
                'response'=> $nicho
             ],200);
    }


    public function updateNicho(Request $request){

        $this->validate($request, [
            'bloque' => 'required',
            'cuartel' => 'required',
            'codigo' => 'required',
            'fila' => 'required',
            'columna' => 'required',
            'cantidad' => 'required', 
            'tipo' => 'required',           

            'estado' => 'required',
            'id' => 'required'
        ], [
            'bloque.required'  => 'El campo bloque es obligatorio!',
            'codigo.required'  => 'El campo codigo de nicho es obligatorio!',
            'cuartel.required'  => 'El campo cuartel de bloque es obligatorio!',
            'fila.required'  => 'El campo fila es obligatorio!',
            'nro.required'  => 'El campo nro nicho es obligatorio!',    
            'columna.required'  => 'El campo columna es obligatorio!',
            'cantidad.required'  => 'El campo cuartel de bloque es obligatorio!',
            'tipo.required'  => 'El campo tipo de bloque es obligatorio!',

            'estado.required'  => 'El campo cuartel de bloque es obligatorio!'
        ]);
       $rep= $this->repetido( $request->id,$request->codigo);
      

      if($rep=="no"){
        $nicho =  Nicho::where('id', $request->id)
        ->update([
            'bloque_id' => $request->bloque,
            'cuartel_id' => $request->cuartel,
            'nro_nicho' => $request->nro,
            'fila' => $request->fila,
            'columna' => $request->columna,
            'cantidad_cuerpos' => $request->cantidad,
            'codigo_anterior' => $request->anterior,
            'codigo' => $request->codigo,
            'tipo' => $request->tipo,

            'estado' => $request->estado,
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        return response([
            'status'=> true,
            'response'=> 'done'
         ],200);
      }else{
        return response([
            'status'=> false,
            'message'=> 'Error, codigo existente, duplicado!)'
         ],400);
      }

      


    }
    public function repetido($id, $codigo){
        $repetido =  DB::table('nicho')
                    ->where('id', '!=', $id)
                    ->where('codigo', '=', ''.$codigo.'')
                    ->first();
            if($repetido==null){
                return $resp="no";
            }
            else{
               return $resp="si";
            }      

    }
    
    public function getBloqueid(Request $request){ 

        $bloque=DB::table('bloque')
        ->select('bloque.id', 'bloque.codigo')
        ->where('estado', '=', 'ACTIVO')
        ->where('cuartel_id', '=', $request->cuartel)
        ->get();
      //  dd($bloque);
               return response([
                'status'=> true,
                'response'=> $bloque
             ],200);
    }

   
}
