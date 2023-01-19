<?php

namespace App\Models\CitaEscribania;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table;
    protected $primaryKey = 'id_solicitud';
    public $timestamps = false;
    public function __construct()
    {
        $this->table = env('SCHEMA_APP'). '.' . 'solicitud';
    }
    public static function tableName()
    {
        $instance = new static;
        return $instance->table;
    }
}
