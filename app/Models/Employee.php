<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','company_id','email','phone_number'];

    protected $hidden = [
        'updated_at','created_at'
    ];

    //retorna todos los empleados de una compañia
    public function company(){
        return $this->hasMany(Company::class);
    }
}
