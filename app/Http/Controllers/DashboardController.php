<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================================
        // DASHBOARD STATISTICS
        // =====================================

        $totalEmployees = Employee::count();

        $totalPayrolls = Payroll::count();

        $totalGrossPay = Payroll::sum('gross_pay');

        $totalNetPay = Payroll::sum('net_pay');


        // =====================================
        // PAYROLL STATUS BREAKDOWN
        // =====================================

        $pendingPayrolls = Payroll::where('status', 'Pending')->count();

        $approvedPayrolls = Payroll::where('status', 'Approved')->count();

        $paidPayrolls = Payroll::where('status', 'Paid')->count();


        // =====================================
        // PAYROLL ANALYTICS
        // =====================================

        $payrollRecords = Payroll::orderBy(
            'pay_period_start',
            'asc'
        )->get();

        // Group payrolls by pay period
        $payrollChartData = $payrollRecords
            ->groupBy(function ($payroll) {

                return Carbon::parse($payroll->pay_period_start)
                    ->format('Y-m-d')
                    . '_'
                    . Carbon::parse($payroll->pay_period_end)
                    ->format('Y-m-d');

            })
            ->map(function ($group) {

                return (object) [
                    'pay_period_start' => $group->first()->pay_period_start,

                    'pay_period_end' => $group->first()->pay_period_end,

                    'total_gross_pay' => $group->sum('gross_pay'),

                    'total_net_pay' => $group->sum('net_pay'),
                ];

            })
            ->values();


        // =====================================
        // CHART LABELS
        // =====================================

        $payrollChartLabels = $payrollChartData->map(function ($payroll) {

            return Carbon::parse($payroll->pay_period_start)
                ->format('M d')
                . ' - '
                . Carbon::parse($payroll->pay_period_end)
                ->format('M d, Y');

        })->values();


        // =====================================
        // GROSS PAY AND NET PAY CHART DATA
        // =====================================

        $payrollGrossValues = $payrollChartData
            ->pluck('total_gross_pay')
            ->values();

        $payrollNetValues = $payrollChartData
            ->pluck('total_net_pay')
            ->values();


        // =====================================
        // ALLOWANCES AND DEDUCTIONS
        // =====================================

        $totalAllowances = $payrollRecords->sum(function ($payroll) {

            return (float) ($payroll->allowances ?? 0);

        });

        $totalDeductions = $payrollRecords->sum(function ($payroll) {

            return (float) ($payroll->deductions ?? 0);

        });


        // =====================================
        // RECENT PAYROLL RECORDS
        // =====================================

        $recentPayrollRecords = Payroll::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get only employees included in recent payrolls
        $employeesById = Employee::whereIn(
            'employee_id',
            $recentPayrollRecords->pluck('employee_id')->unique()
        )->get()->keyBy('employee_id');


        // Attach employee names to payroll records
        $recentPayrollRecords->transform(function ($payroll) use ($employeesById) {

            $employee = $employeesById->get($payroll->employee_id);

            $payroll->employee_name = $employee
                ? trim(
                    ($employee->first_name ?? '')
                    . ' '
                    . ($employee->last_name ?? '')
                )
                : 'Employee not found';

            return $payroll;

        });


        // =====================================
        // RETURN DASHBOARD VIEW
        // =====================================

        return view('dashboard', compact(

            'totalEmployees',
            'totalPayrolls',
            'totalGrossPay',
            'totalNetPay',

            'pendingPayrolls',
            'approvedPayrolls',
            'paidPayrolls',

            'payrollChartLabels',
            'payrollGrossValues',
            'payrollNetValues',

            'totalAllowances',
            'totalDeductions',

            'recentPayrollRecords'

        ));
    }
}
