<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'employees';

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'email',
        'department',
        'position',
        'basic_salary',
        'status',
    ];

    protected $casts = [
        'basic_salary' => 'float',
    ];
}
