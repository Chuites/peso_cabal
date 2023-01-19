<?php

namespace App\Models\CitaEscribania;

use Illuminate\Database\Eloquent\Model;

class EscrituraPublica extends Model
{
    protected $table;
    protected $primaryKey = 'id_escritura_publica';
    public $timestamps = false;
    public function __construct()
    {
        $this->table = env('SCHEMA_APP'). '.' . 'escritura_publica';
    }
    public static function tableName()
    {
        $instance = new static;
        return $instance->table;
    }
}
