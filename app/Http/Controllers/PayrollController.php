<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::latest()->get();

        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::orderBy('last_name')->get();

        return view('payrolls.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string',
            'pay_period_start' => 'required|date',
            'pay_period_end' => 'required|date|after_or_equal:pay_period_start',
            'allowances' => 'required|numeric|min:0',
            'deductions' => 'required|numeric|min:0',
        ]);

        $employee = Employee::where(
            'employee_id',
            $validated['employee_id']
        )->firstOrFail();

        $periodStart = Carbon::parse(
            $validated['pay_period_start']
        )->startOfDay();

        $periodEnd = Carbon::parse(
            $validated['pay_period_end']
        )->endOfDay();

        // Prevent overlapping payroll periods.
        $overlappingPayroll = Payroll::where(
            'employee_id',
            $employee->employee_id
        )
            ->where('pay_period_start', '<=', $periodEnd)
            ->where('pay_period_end', '>=', $periodStart)
            ->exists();

        if ($overlappingPayroll) {
            return back()
                ->withInput()
                ->withErrors([
                    'pay_period_start' =>
                        'This employee already has a payroll record covering this period.',
                ]);
        }

        $basicSalary = (float) $employee->basic_salary;
        $allowances = (float) $validated['allowances'];
        $deductions = (float) $validated['deductions'];

        $grossPay = $basicSalary + $allowances;
        $netPay = $grossPay - $deductions;

        if ($netPay < 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'deductions' =>
                        'Deductions cannot exceed gross pay.',
                ]);
        }

        Payroll::create([
            'employee_id' => $employee->employee_id,
            'pay_period_start' => $periodStart,
            'pay_period_end' => $periodEnd,
            'basic_salary' => $basicSalary,
            'allowances' => $allowances,
            'deductions' => $deductions,
            'gross_pay' => $grossPay,
            'net_pay' => $netPay,
            'status' => 'Pending',
        ]);

        return redirect()
            ->route('payrolls.index')
            ->with('success', 'Payroll created successfully!');
    }

    public function edit($payroll)
    {
        $payroll = Payroll::findOrFail($payroll);

        // Prevent editing finalized payroll.
        if ($payroll->status === 'Paid') {
            return redirect()
                ->route('payrolls.index')
                ->with(
                    'error',
                    'This payroll has already been paid and can no longer be edited.'
                );
        }

        return view('payrolls.edit', compact('payroll'));
    }

    public function update(Request $request, $payroll)
    {
        $payroll = Payroll::findOrFail($payroll);

        // Prevent direct updates to paid payroll.
        if ($payroll->status === 'Paid') {
            return redirect()
                ->route('payrolls.index')
                ->with(
                    'error',
                    'This payroll has already been paid and can no longer be modified.'
                );
        }

        $validated = $request->validate([
            'pay_period_start' =>
                'required|date',

            'pay_period_end' =>
                'required|date|after_or_equal:pay_period_start',

            'basic_salary' =>
                'required|numeric|min:0',

            'allowances' =>
                'required|numeric|min:0',

            'deductions' =>
                'required|numeric|min:0',

            // Status cannot be changed through the edit form.
            'status' => [
                'required',
                Rule::in([$payroll->status]),
            ],
        ]);

        $basicSalary = (float) $validated['basic_salary'];
        $allowances = (float) $validated['allowances'];
        $deductions = (float) $validated['deductions'];

        $grossPay = $basicSalary + $allowances;
        $netPay = $grossPay - $deductions;

        if ($netPay < 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'deductions' =>
                        'Deductions cannot exceed gross pay.',
                ]);
        }

        $periodStart = Carbon::parse(
            $validated['pay_period_start']
        )->startOfDay();

        $periodEnd = Carbon::parse(
            $validated['pay_period_end']
        )->endOfDay();

        // Exclude the current payroll when checking overlaps.
        $overlappingPayroll = Payroll::where(
            'employee_id',
            $payroll->employee_id
        )
            ->where('_id', '!=', $payroll->getKey())
            ->where('pay_period_start', '<=', $periodEnd)
            ->where('pay_period_end', '>=', $periodStart)
            ->exists();

        if ($overlappingPayroll) {
            return back()
                ->withInput()
                ->withErrors([
                    'pay_period_start' =>
                        'This employee already has a payroll record covering this period.',
                ]);
        }

        $payroll->update([
            'pay_period_start' => $periodStart,
            'pay_period_end' => $periodEnd,
            'basic_salary' => $basicSalary,
            'allowances' => $allowances,
            'deductions' => $deductions,
            'gross_pay' => $grossPay,
            'net_pay' => $netPay,
        ]);

        return redirect()
            ->route('payrolls.index')
            ->with('success', 'Payroll updated successfully!');
    }

    public function destroy($payroll)
    {
        $payroll = Payroll::findOrFail($payroll);

        // Finalized payroll records cannot be deleted.
        if ($payroll->status === 'Paid') {
            return redirect()
                ->route('payrolls.index')
                ->with(
                    'error',
                    'Paid payroll records cannot be deleted.'
                );
        }

        $payroll->delete();

        return redirect()
            ->route('payrolls.index')
            ->with('success', 'Payroll deleted successfully!');
    }

    public function approve($payroll)
    {
        $payroll = Payroll::findOrFail($payroll);

        if ($payroll->status !== 'Pending') {
            return redirect()
                ->route('payrolls.index')
                ->with(
                    'error',
                    'Only pending payroll can be approved.'
                );
        }

        $payroll->update([
            'status' => 'Approved',
        ]);

        return redirect()
            ->route('payrolls.index')
            ->with('success', 'Payroll approved successfully!');
    }

    public function markPaid($payroll)
    {
        $payroll = Payroll::findOrFail($payroll);

        if ($payroll->status !== 'Approved') {
            return redirect()
                ->route('payrolls.index')
                ->with(
                    'error',
                    'Only approved payroll can be marked as paid.'
                );
        }

        $payroll->update([
            'status' => 'Paid',
        ]);

        return redirect()
            ->route('payrolls.index')
            ->with(
                'success',
                'Payroll marked as paid successfully!'
            );
    }
}
