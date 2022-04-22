<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;
   
    protected $table = 'mantenimiento_nicho';
    protected $fillable = [
        'id',
        'date_in', // fecha ingreso al nicho
        'gestion',
        'pagado',
        'fecha_pago',
        'fur',
        'responsable_id',
        'created_at'
    ];

    protected $hiden = [
        'id',
        'updated_at'
    ];
  

    public function updatePay(Request $request){
          
        if($request->isJson()){
            $this->validate($request,[
                "fur"=> 'required',
                "id_usuario_caja" => 'required'
            ]);

            $pago = Mantenimiento::select('id', 'fur')
            ->where(['fur' => trim($request->fur), 'pagado' => false, 'estado' => 'ACTIVO'])
            ->first();

            if($pago){
                Mantenimiento::where('fur', trim($request->fur))
                ->update([      
                   'pagado' => true,
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
