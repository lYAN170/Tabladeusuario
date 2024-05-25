<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
 
    protected $fillable = ['direccion'];
 
    protected $table = 'departamentos';
 
 
    public function departamento()
    {
        return $this->hasMany(Departamento::class);
    }
 
   /* public function rentas()
    {
        return $this->hasManyThrough(Renta::class, Departamento::class);
    } **/
}