<?php

namespace App\Models\CitaEscribania;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table;
    protected $primaryKey = 'id_cita';
    public $timestamps = false;
    public function __construct()
    {
        $this->table = env('SCHEMA_APP'). '.' . 'cita';
    }
    public static function tableName()
    {
        $instance = new static;
        return $instance->table;
    }

    public function horario()
    {
        return $this->belongsto('App\Models\CitaEscribania\CatalogoItem','id_horario','id_catalogo_item');
    }

    public function solicitante()
    {
        return $this->belongsTo('App\Models\CitaEscribania\Solicitante', 'id_solicitante', 'id_solicitante');
    }
}
