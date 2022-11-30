<?php

namespace App\Models\CitaEscribania;

use Illuminate\Database\Eloquent\Model;

class T3CatalogoItem extends Model
{
    protected $table;
    protected $primaryKey = 'id_catalogo_item';
    public $timestamps = false;
    public function __construct()
    {
        $this->table = env('SCHEMA_ESCRIBANIA') .'.'.'catalogo_item';
    }
    public static function tableName()
    {
        $instance = new static;
        return $instance->table;
    }

}
