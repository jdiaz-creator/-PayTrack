
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Payroll | PayTrack</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #071c2b;
            color: white;
            font-family: Arial, sans-serif;
        }
        header {
            background: #102f40;
            padding: 24px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h2 { color: #10b981; margin: 0; }
        .container {
            max-width: 750px;
            margin: 45px auto;
            padding: 35px;
            background: #123448;
            border-radius: 12px;
        }
        label {
            display: block;
            margin: 18px 0 8px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 13px;
            background: #071c2b;
            color: white;
            border: 1px solid #466174;
            border-radius: 7px;
        }
        .btn {
            display: inline-block;
            background: #10b981;
            color: #071c2b;
            padding: 13px 22px;
            border: none;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }
        button { margin-top: 25px; }
        .error { color: #ff9999; }
        .summary {
            margin-top: 25px;
            padding: 18px;
            background: #071c2b;
            border-radius: 8px;
        }
        .summary p {
            display: flex;
            justify-content: space-between;
        }
        .net { color: #10b981; font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <h2>PayTrack</h2>
        <a href="{{ route('payrolls.index') }}" class="btn">
            Back
        </a>
    </header>

    <div class="container">
        <h1>Create Payroll</h1>
        <p>Enter employee payroll information below.</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payrolls.store') }}" method="POST">
            @csrf

            <label for="employee_id">Select Employee</label>
            <select name="employee_id" id="employee_id" required>
                <option value="">-- Select Employee --</option>
                @foreach ($employees as $employee)
                    <option
                        value="{{ $employee->employee_id }}"
                        data-salary="{{ $employee->basic_salary }}"
                        {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                        {{ $employee->employee_id }} -
                        {{ $employee->first_name }}
                        {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>

            <label for="pay_period_start">Pay Period Start</label>
            <input type="date" name="pay_period_start"
                   id="pay_period_start"
                   value="{{ old('pay_period_start') }}" required>

            <label for="pay_period_end">Pay Period End</label>
            <input type="date" name="pay_period_end"
                   id="pay_period_end"
                   value="{{ old('pay_period_end') }}" required>

            <label for="basic_salary">Basic Salary</label>
            <input type="number" name="basic_salary"
                   id="basic_salary" step="0.01" min="0"
                   value="{{ old('basic_salary', 0) }}" required>

            <label for="allowances">Allowances</label>
            <input type="number" name="allowances"
                   id="allowances" step="0.01" min="0"
                   value="{{ old('allowances', 0) }}" required>

            <label for="deductions">Deductions</label>
            <input type="number" name="deductions"
                   id="deductions" step="0.01" min="0"
                   value="{{ old('deductions', 0) }}" required>

            <div class="summary">
                <p>Gross Pay: <span id="grossPay">₱0.00</span></p>
                <p class="net">
                    Net Pay: <span id="netPay">₱0.00</span>
                </p>
            </div>

            <button type="submit" class="btn">
                Save Payroll
            </button>
        </form>
    </div>

    <script>
        const employeeSelect = document.getElementById('employee_id');
        const salaryInput = document.getElementById('basic_salary');
        const allowancesInput = document.getElementById('allowances');
        const deductionsInput = document.getElementById('deductions');

        function calculatePayroll() {
            const salary = parseFloat(salaryInput.value) || 0;
            const allowances = parseFloat(allowancesInput.value) || 0;
            const deductions = parseFloat(deductionsInput.value) || 0;

            const gross = salary + allowances;
            const net = gross - deductions;

            const peso = value => '₱' + value.toLocaleString(
                'en-PH', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }
            );

            document.getElementById('grossPay').textContent = peso(gross);
            document.getElementById('netPay').textContent = peso(net);
        }

        employeeSelect.addEventListener('change', function () {
            const option = this.options[this.selectedIndex];
            salaryInput.value = option.dataset.salary || 0;
            calculatePayroll();
        });

        [salaryInput, allowancesInput, deductionsInput].forEach(input => {
            input.addEventListener('input', calculatePayroll);
        });

        calculatePayroll();
    </script>
</body>
</html>
