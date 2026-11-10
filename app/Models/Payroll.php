<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Payroll extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'payrolls';

    protected $fillable = [
        'employee_id',
        'pay_period_start',
        'pay_period_end',
        'basic_salary',
        'allowances',
        'deductions',
        'gross_pay',
        'net_pay',
        'status',
    ];

    protected $casts = [
        'pay_period_start' => 'date',
        'pay_period_end' => 'date',
        'basic_salary' => 'float',
        'allowances' => 'float',
        'deductions' => 'float',
        'gross_pay' => 'float',
        'net_pay' => 'float',
    ];
}
