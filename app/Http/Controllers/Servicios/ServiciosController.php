<?php

namespace App\Http\Controllers\Servicios;

use App\Models\Servicios;
use App\Models\Nicho;
use App\Models\Cuartel;
use App\Models\Bloque;

use App\Models\Difunto;
use App\Models\Responsable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Servicios\ServicioNicho;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ServiciosController extends Controller{

    public function __construct()
    {
        $this->middleware('api', ['except' => ['updatePay']]);
    }


    public function index(){
        
        $servicio =DB::table('responsable_difunto')
                 ->select('responsable_difunto.*', 
                  'responsable.nombres as nombre_resp', 'responsable.primer_apellido as primerap_resp', 
                  'responsable.segundo_apellido as segap_resp',  
                  'difunto.nombres as nombre_dif', 'difunto.primer_apellido as primerap_dif', 'difunto.segundo_apellido as segap_dif',
                  'nicho.codigo',
                  'servicio_nicho.codigo_nicho', 'servicio_nicho.tipo_servicio', 'servicio_nicho.fur' )                
                 ->join('responsable' , 'responsable.id','=', 'responsable_difunto.responsable_id')
                 ->join('difunto' , 'difunto.id','=', 'responsable_difunto.difunto_id')
                 ->join('nicho' , 'nicho.codigo','=', 'responsable_difunto.codigo_nicho')
                 ->join('servicio_nicho' , 'servicio_nicho.responsable_difunto_id','=', 'responsable_difunto.id')
                 ->distinct('servicio_nicho.fur')->get();
            
                     return view('servicios/index',['servicio' =>$servicio]);
    }

    public function cargarForm(){
        
        $headers = [
            'Content-Type' => 'application/json'
        ];
        try {
            $client = new Client();
            $response = $client->get('https://multiservdev.cochabamba.bo/api/v1/cementerio/get-services', [
                'json' => [],
                'headers' => $headers
            ]);
        } catch (RequestException $re) {
            // return response([
            //     'status' => false,
            //     'message' => 'Error al procesar su solicitud'
            // ], 200);
        }

        $tipo_service = json_decode((string) $response->getBody(), true);
    
        return view('servicios/formRegistro', ['tipo_service' => $tipo_service['response']]);
    }

    public function buscar_nicho(Request $request){
       
        $sql =DB::table('responsable_difunto')
        ->select('responsable_difunto.*', 
                'responsable.segundo_apellido as segap_resp',   'responsable.fecha_nacimiento as nacimiento_resp', 
                'responsable.telefono as tel_resp', 
                'responsable.celular as cel_resp', 
                'responsable.estado_civil as ecivil_resp', 
                'responsable.genero as genero_resp', 
                'responsable.email as email_resp', 
                'responsable.domicilio as domicilio_resp', 
                'difunto.ci as ci_dif',
                'difunto.nombres as nombre_dif', 'difunto.primer_apellido as primerap_dif', 'difunto.segundo_apellido as segap_dif',                 
                'difunto.segundo_apellido as segap_dif',
                'difunto.fecha_nacimiento as fecha_nac_dif',
                'difunto.fecha_defuncion as fecha_def_dif',
                'difunto.causa as causa_dif',
                'difunto.tipo as tipo_dif',
                'difunto.genero as genero_dif',
                'difunto.certificado_file',
                'servicio_nicho.fur',
                'nicho.codigo','bloque.codigo','cuartel.codigo','nicho.nro_nicho')   
                ->join('servicio_nicho', 'servicio_nicho.codigo_nicho','=', 'responsable_difunto.codigo_nicho')           
        ->leftJoin('responsable' , 'responsable.id','=', 'responsable_difunto.responsable_id')
        ->leftJoin('difunto' , 'difunto.id','=', 'responsable_difunto.difunto_id')
        ->join('nicho' , 'nicho.codigo','=', 'responsable_difunto.codigo_nicho')
        ->leftJoin('cuartel' , 'cuartel.id','=', 'nicho.cuartel_id')
        ->leftJoin('bloque' , 'bloque.id','=', 'nicho.bloque_id')
        ->where('bloque.codigo','=', $request->bloque )
        ->where('nicho.nro_nicho','=', $request->nro_nicho )
        ->where('nicho.fila','=', $request->fila ) 
        ->distinct('servicio_nicho.fur')->get();
//    dd($sql);
            if($sql){
                    return response([
                        'status'=> true,
                        'response'=> $sql
                    ],200);
                }else{
                    return response([
                        'status'=> false,
                        'message'=> 'Error, codigo existente, duplicado!)'
                    ],400);
                }

            
        // return response()->json($resp);
    }



    public function generateFur(Request $request){

        $this->validate($request, [
            'ci' => 'required',
            'nombre' => 'required',
            'primer_apellido' => 'required',
            'ap_materno' => 'max:30',
            'direccion' => 'max:200',
            'telefono' => 'max:10',
            'nombre_difunto' => 'required|max:50',
            'codigo' => 'required',
            'bloque' => 'required',
            'nicho' => 'required',
            'fila' => 'required',
            'servicios_cementery' => 'required'
        ]);

        $headers =  ['Content-Type' => 'application/json'];
        $client = new Client();
        $response = $client->post(env('URL_MULTISERVICE') . '/api/v1/cementerio/generate-fur-cementery', [
            'json' => [
                'ci' => $request->ci,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'ap_materno' => $request->ap_materno,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'nombre_difunto' => $request->nombre_difunto,
                'codigo' => $request->codigo,
                'bloque' => $request->bloque,
                'fila' => $request->fila,
                'nicho' => $request->nicho,
                'servicios_cementery' => $request->servicios_cementery
            ],
            'headers' => $headers,
        ]);
        $fur_response = json_decode((string) $response->getBody(), true);
      
        return $fur_response;
    }

    //service update pay from sinot
    public function updatePay(Request $request){
          
        if($request->isJson()){
            $this->validate($request,[
                "fur"=> 'required',
                "id_usuario_caja" => 'required'
            ]);

            $servicio = ServicioNicho::select('id', 'fur')
            ->where(['fur' => trim($request->fur), 'estado_pago' => false, 'estado' => 'ACTIVO'])
            ->first();

            if($servicio){
                NichoServicioModel::where('fur', trim($request->fur))
                ->update([      
                   'estado_pago' => true,
                   'id_usuario_caja' => $request->id_usuario_caja,
                   'fecha_pago'=> date('Y-m-d h:i:s')
                ]);
                return response([
                    'status'=> true
                   // 'message'=> 'El nro fur  no existe o ya fue pagado por favor recargue la pagina'
                 ],200);

            }else{
                return response([
                    'status'=> false,
                    'message'=> 'El nro fur  no existe o ya fue pagado por favor recargue la pagina'
                 ],200);
            }
        }else{
            return response([
                'status'=> false,
                'message'=> 'No autorizado'
             ],401); 
        }
        
    }

   
    
    public function createNewServicios(Request $request){
        
        dd($request);
        if($request->isJson()){            
            $this->validate($request, [
                'nro_nicho'=> 'required',
                'bloque'=> 'required',
                'cuartel'=> 'required',
                'fila'=> 'required',
                'tipo'=> 'required',
                'columna'=> 'required',
                'ci_dif'=> 'required',
                'nombres_dif'=> 'required',
                'paterno_dif'=> 'required',
                'tipo_dif'=> 'required',
                'genero_dif'=> 'required',
                'ci_resp'=> 'required',
                'nombres_resp'=> 'required',
                'paterno_resp'=> 'required',
                'celular'=> 'required',
                'ecivil'=> 'required',
                'email'=> 'required',
                'domicilio'=> 'required',
                'genero_resp'=> 'required',
//pedir a gus gus
                'tipo_serv'=> 'required|array',
                'serv'=> 'required|array',
                'servname'=> 'required|array',  
                // 'cantidad' => 'required',
                // 'unidad' => 'required',
                // 'precio_unitario' => 'required',
                // 'monto' => 'required',
                // 'ultimopago'=>'required',
                // 'hserv'=>'required',
                // 'servicio'=>'required',
                // 'cuenta'=>'required',
                // 'tipo_serv'=>'required'

                
            ], [
                'cantidad.required'  => 'El campo cantidad es obligatorio!',
                'unidad.required' => 'El campo Codigo cuartel es obligatorio!',
                'cuenta.required' => 'Debe asignar al menos un servicio!.'
            ]);

            //step1: nicho buscar si existe registrado el nicho recuperar el id  sino existe registrarlo
            $codigo_n=$request->cuartel.".".$request->bloque.".".$request->nro_nicho.".".$request->fila;
            $existeNicho= Nicho::where('codigo', $codigo_n)->first();
                      
            if($existeNicho!=null){
                $id_nicho=$existeNicho->id;
            }
            else{

                // buscar cuartel si existe recuperar id sino insertar
                  $existeCuartel= Cuartel::where('codigo', $request->cuartel)->first();
                    if($existeCuartel!=null){
                        $id_cuartel=$existeCuartel->id;
                    }else{
                        $cuart = new Cuartel;
                        $cuart->codigo = trim($request->cuartel);
                        $cuart->nombre = trim($request->cuartel);
                        $cuart->estado = 'ACTIVO';
                        $cuart->user_id = auth()->id();
                        $cuart->save();
                        $cuart->id;
                        $id_cuartel=$cuart->id;
                    }

                //buscar bloque si existe recuperar id sino insertar
                $existeBloque= Bloque::where('codigo', $request->bloque)->first();
                        if($existeBloque!=null){
                            $id_bloque=$existeBloque->id;
                        }else{
                            $bloq = new Cuartel;
                            $bloq->cuartel_id = $cuart->id;
                            $bloq->codigo = trim($request->bloque);
                            $bloq->nombre = trim($request->bloque);
                            $bloq->estado = 'ACTIVO';
                            $bloq->user_id = auth()->id();
                            $bloq->save();
                            $bloq->id;
                            $id_bloque=$bloq->id;
                        }

                         // insertar nicho
                        $nicho = new Nicho;
                        $nicho->cuartel_id = $id_cuartel;
                        $nicho->bloque_id = $id_bloque;
                        $nicho->nro_nicho = $request->nro_nicho;
                        $nicho->fila = $request->fila;
                        $nicho->codigo = $request->cuartel.".".$request->bloque.".".$request->nro_nicho.".".$request->fila; 
                        $nicho->codigo_anterior = $request->anterior;  
                        $nicho->user_id = auth()->id();
                        $nicho->save();
                        $nicho->id;
                        $id_nicho= $nicho->id;
            }
            // end nicho

                 // step2: register difunto --- si id_difunto id_difunto es null insertar difunto insertar responsable
                    if($request->id_difunto==""){
                        //insertar difunto
                         $difuntoid=$this->insertDifunto($request);
                    }else{
                        $difuntoid=$request->difunto_id;
                        $this->updateDifunto($request, $difuntoid);
                        
                    }
                    // end difunto
                    // step4: register responsable -- si el responsable     
                            if($request->id_responsable==""){
                                //insertar difunto
                                 $resp=$this->insertReponsables($request);
                            }else{
                                $resp=$request->difunto_id;
                                $this->updateResponsable($request, $difuntoid);
                                
                            }
                    //end responsable
              
                    //insert services 
              

                if (!empty($request->servicios) && is_array($request->servicios)) {
                    $count = count($request->servicios);
                    $codigo_nicho=$request->cuartel.".".$request->bloque.".".$request->nicho.".".$request->fila;

                    
                    /** generar fur */
                    $nombre_difunto=$request->nombres_dif." ".$request->primerap_dif." ".$request->segap_dif;
                    // $response = $this->GenerarFur($request->search_resp, $request->nombres_resp, $request->primerap_resp,
                    // $request->segapresp, $request->domicilio, $request->telefono, $nombre_difunto, $codigo_nicho,
                    // $request->bloque, $request->nro_nicho, $request->fila, $request->servicio );
                   
                    // if($response['status']==true){
                    //     $fur = $response['response'];
                       
                    // }
                    $fur="165235";
                   
                    //   
                    
                }


           
              
              
            }
    }

    public function insertDifunto($request){

        $dif = new Difunto;
        $dif->ci = $request->search_dif;
        $dif->nombres = $request->nombres_dif;
        $dif->primer_apellido = $request->paterno_dif;
        $dif->segundo_apellido = $request->materno_dif;
        $dif->fecha_nacimiento = $request->fechanac_dif;
        $dif->fecha_defuncion = $request->fechadef_dif;
        $dif->certificado_defuncion = $request->sereci;
        $dif->causa = $request->causa;
        $dif->tipo = $request->tipo; 
        $dif->genero = $request->genero;  
        $dif->certificado_file=$request->adjunto;               
        $dif->tiempo = $request->tiempo;  
        $dif->estado = 'ACTIVO';  
        $dif->user_id = auth()->id();
        $dif->save();
        $dif->id;
        return  $dif->id;

    }

    public function updateDifunto($request, $difuntoid){
        $difunto= Difunto::where('id', $difuntoid)->first();
        $difunto->ci = $request->search_dif;
        $difunto->nombres = $request->nombres_dif;
        $difunto->primer_apellido = $request->paterno_dif;
        $difunto->segundo_apellido = $request->materno_dif;
        $difunto->fecha_nacimiento = $request->fechanac_dif;
        $difunto->fecha_defuncion = $request->fechadef_dif;
        $difunto->certificado_defuncion = $request->sereci;
        $difunto->causa = $request->causa;
        $difunto->tipo = $request->tipo; 
        $difunto->genero = $request->genero;  
        $difunto->certificado_file=$request->adjunto;       
        $difunto->tiempo = $request->tiempo;  
        $difunto->estado = 'ACTIVO';  
        $difunto->user_id = auth()->id();
        $difunto->save();
        return $difunto->id;
    }

    public function insertResponsable($request){

        $responsable = new Responsable;
        $responsable->ci = $request->search_resp;
        $responsable->nombres = $request->nombres_resp;
        $responsable->primer_apellido = $request->paterno_resp;
        $responsable->segundo_apellido = $request->materno_resp;
        $responsable->fecha_nacimiento = $request->fechanac_resp;
        $responsable->genero = $request->genero_resp;  
        $responsable->telefono = $request->telefono;  
        $responsable->celular = $request->celular;  
        $responsable->ecivil = $request->ecivil;  
        $responsable->domicilio = $request->domicilio;  
        $responsable->estado = 'ACTIVO';  
        $responsable->user_id = auth()->id();
        $responsable->save();
        $responsable->id;
        return  $responsable->id;

    }

    public function updateResponsable($request, $difuntoid){
        $responsable= Responsable::where('id', $difuntoid)->first();
        $responsable->ci = $request->search_resp;
        $responsable->nombres = $request->nombres_resp;
        $responsable->primer_apellido = $request->paterno_resp;
        $responsable->segundo_apellido = $request->materno_resp;
        $responsable->fecha_nacimiento = $request->fechanac_resp;
        $responsable->genero = $request->genero_resp;  
        $responsable->telefono = $request->telefono;  
        $responsable->celular = $request->celular;  
        $responsable->ecivil = $request->ecivil;  
        $responsable->domicilio = $request->domicilio;  
        $responsable->estado = 'ACTIVO';  
        $responsable->user_id = auth()->id();
        $responsable->save();
        return $responsable->id;
    }

    
    public function cargarMantenimiento(){
        
        $headers = [
            'Content-Type' => 'application/json'
        ];
        try {
            $client = new Client();
            $response = $client->get('https://multiservdev.cochabamba.bo/api/v1/cementerio/get-services', [
                'json' => [],
                'headers' => $headers
            ]);
        } catch (RequestException $re) {
            // return response([
            //     'status' => false,
            //     'message' => 'Error al procesar su solicitud'
            // ], 200);
        }
        dd($response);
        $tipo_service = json_decode((string) $response->getBody(), true);

       

        return view('servicios/formRegistro', ['tipo_service' => $tipo_service['response']]);
    }


}
