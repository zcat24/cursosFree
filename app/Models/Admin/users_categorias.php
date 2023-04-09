<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_categorias extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gestores()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoriaAsignada()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

}
