<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    use HasFactory;

    protected $table='employees';

    protected $fillable = ['first_name','second_name','company_id','email','phone','website','updated_at','created_at'];

    public function company(){
        return $this->hasOne('App\Models\CompanyModel','id','company_id');
    }
}
