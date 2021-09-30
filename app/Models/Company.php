<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employees;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','image','web_site'];

    protected $hidden = [
        'updated_at','created_at'
    ];

    //retorna todos los empleados de una compañia
    public function employees(){
        return $this->hasMany(Employees::class);
    }
}
