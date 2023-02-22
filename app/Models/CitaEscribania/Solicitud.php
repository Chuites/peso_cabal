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

    public function cita()
    {
        return $this->belongsto('App\Models\CitaEscribania\Cita','id_cita','id_cita');
    }

    public function tipo_solicitud()
    {
        return $this->belongsTo('App\Models\CitaEscribania\CatalogoItem', 'id_tipo_solicitud', 'id_catalogo_item');
    }

    public function solicitud_protocolo()
    {
        return $this->belongsTo('App\Models\CitaEscribania\EscrituraPublica', 'id_escritura_publica', 'id_escritura_publica');
    }

    public function consulta_tierras()
    {
        return $this->belongsTo('App\Models\CitaEscribania\SeccionDeTierras', 'id_seccion_de_tierras', 'id_seccion_de_tierras');
    }

    public function archivo_historico()
    {
        return $this->belongsTo('App\Models\CitaEscribania\ArchivoHistorico', 'id_archivo_historico', 'id_archivo_historico');
    }
}
