<?php

namespace App\Models;

use App\Models\Traits\PrimaryUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model
{
    use HasFactory, PrimaryUuid;

    protected $table = 'employee_departments';
//    protected $primaryKey = ['user_id', 'department_id'];

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'department_id',
    ];
}
