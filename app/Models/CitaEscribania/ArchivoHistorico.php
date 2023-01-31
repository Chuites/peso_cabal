<?php

namespace App\Models\CitaEscribania;

use Illuminate\Database\Eloquent\Model;

class ArchivoHistorico extends Model
{
    protected $table;
    protected $primaryKey = 'id_archivo_historico';
    public $timestamps = false;
    public function __construct()
    {
        $this->table = env('SCHEMA_APP'). '.' . 'archivo_historico';
    }
    public static function tableName()
    {
        $instance = new static;
        return $instance->table;
    }
}
