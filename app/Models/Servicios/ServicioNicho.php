<?php

namespace App\Models\Servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ServicioNicho extends Model
{
    use HasFactory;


    protected $table = 'servicio_nicho';
     
    protected $fillable = [
        'codigo_nicho',
        'fecha_registro',
        'tipo_servicio_id',
        'servicio_id',
        'servicio',
        'responsable_difunto_id',
        'fur',
        'gestion_pagada',
        'fecha_pago',
        'id_usuario_caja',
        'estado_pago',
        'user_id',
        'estado',
        'created_at'
    ];

    protected $hiden = [
        'id',
        'updated_at'
    ];
   
   
    public function GenerarFur($ci, $nombre, $primer_apellido,
    $ap_materno, $direccion, $nombre_difunto, $codigo,
     $bloque, $nicho, $fila, $servicios_cementery )
      {
        
  //dd( $servicios_cementery);
          $headers =  ['Content-Type' => 'application/json'];
          $client = new Client();
          $response = $client->post(env('URL_MULTISERVICE') . '/api/v1/cementerio/generate-fur-cementery', [
              'json' => [
                  'ci' => $ci,
                  'nombre' => $nombre,
                  'primer_apellido' => $primer_apellido,
                  'ap_materno' => $ap_materno,
                  'direccion' => $direccion,
                 // 'telefono' => $telefono,
                  'nombre_difunto' => $nombre_difunto,
                  'codigo' => $codigo,
                  'bloque' => $bloque,
                  'fila' => $fila,
                  'nicho' => $nicho,
                  'servicios_cementery' => $servicios_cementery  
              ],
              'headers' => $headers,
          ]);
          $fur_response = json_decode((string) $response->getBody(), true);
        
          return $fur_response;
      }


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

   

}
