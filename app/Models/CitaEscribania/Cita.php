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
}
