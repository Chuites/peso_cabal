<?php

namespace App\Models\CitaEscribania;

use Illuminate\Database\Eloquent\Model;

class SeccionDeTierras extends Model
{
    protected $table;
    protected $primaryKey = 'id_seccion_de_tierras';
    public $timestamps = false;
    public function __construct()
    {
        $this->table = env('SCHEMA_APP'). '.' . 'seccion_de_tierras';
    }
    public static function tableName()
    {
        $instance = new static;
        return $instance->table;
    }
}
