<?php

namespace App\Models\CitaEscribania;

use Illuminate\Database\Eloquent\Model;

class DiaHorarioHabil extends Model
{
    protected $table;
    protected $primaryKey = 'id_dia_habil';
    public $timestamps = false;
    public function __construct()
    {
        $this->table = env('SCHEMA_APP'). '.' . 'dia_habil';
    }
    public static function tableName()
    {
        $instance = new static;
        return $instance->table;
    }
}
