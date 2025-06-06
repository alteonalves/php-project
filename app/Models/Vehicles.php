<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;
    // tabela de registro de usuários
    protected $table = 'vehicles';

    protected $primaryKey = 'id';
    protected $fillable = ['vehicle', 'brand', 'year', 'sold', 'description'];
    protected $casts = [
        'sold' => 'boolean'
    ];

}
