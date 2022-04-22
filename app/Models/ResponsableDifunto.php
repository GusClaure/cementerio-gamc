<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableDifunto extends Model
{
    use HasFactory;

    protected $table = 'responsable_difunto';
    protected $fillable = [
        'id',
        'responsable_id',
        'difunto_id',
        'codigo_nicho',
        'fecha_adjudicacion',
        'tiempo',       
        'user_id',
        'created_at'
    ];

    protected $hiden = [
        'id',
        'updated_at'
    ];

}
