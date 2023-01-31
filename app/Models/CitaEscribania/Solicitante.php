<?php

namespace App\Models\CitaEscribania;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    protected $table;
    protected $primaryKey = 'id_solicitante';
    public $timestamps = false;
    public function __construct()
    {
        $this->table = env('SCHEMA_APP'). '.' . 'solicitante';
    }
    public static function tableName()
    {
        $instance = new static;
        return $instance->table;
    }
}
