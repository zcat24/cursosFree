<?php

namespace App\Models\Gestion;

use App\Models\Admin\Cursos;
use App\Models\Admin\Estados;
use App\Models\Admin\TiposDocumentos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrosUsuarios extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function curso()
    {
        return $this->belongsTo(Cursos::class, 'curso_id');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TiposDocumentos::class, 'tipo_documento_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estados::class, 'estado_id');
    }
}
