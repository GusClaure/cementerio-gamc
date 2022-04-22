<?php

namespace App\Http\Controllers\Mantenimiento;
use App\Models\Mantenimiento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class MantenimientoController extends Controller
{
    public function index(){
        $mant= Mantenimiento::select('mantenimiento_nicho.*',  DB::raw('CONCAT(responsable.nombres , \' \',responsable.primer_apellido, \' \', responsable.segundo_apellido ) AS nombre'))
                ->leftJoin('responsable', 'responsable.id', '=', 'mantenimiento_nicho.responsable_id')
                ->orderBy('id', 'DESC')
                 ->get();

                

        return view('mantenimiento/index', compact('mant'));
    }

    public function createPay(){

        $headers =  ['Content-Type' => 'application/json'];
        $client = new Client();
       
        $response = $client->get(env('URL_MULTISERVICE').'/api/v1/cementerio/generate-servicios-nicho/525', [
        'json' => [
            ],
            'headers' => $headers,
        ]);
        $data = json_decode((string) $response->getBody(), true);
          
       
       if($data['status']==true){
            $precio = $data['response'][0]['monto1'];
            $cuenta = $data['response'][0]['cuenta'];
            $descrip = $data['response'][0]['descripcion'];
        }else{
            $precio =0;
        }
        

        return view('mantenimiento/nuevoPago', ['precio' =>$precio, 'cuenta' =>$cuenta, 'descrip' =>$descrip]);
    }
}
