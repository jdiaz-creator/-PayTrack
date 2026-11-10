
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payroll | PayTrack</title>
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
        header h2 { color: #10b98d; margin: 0; }
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
        button, .back {
            display: inline-block;
            background: #10b98d;
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
            padding: 20px;
            background: #071c2b;
            border-radius: 8px;
        }
        .summary p {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }
        .net { color: #10b98d; font-weight: bold; }
    </style>
</head>
<body>
    <header>
        <h2>PayTrack</h2>
        <a class="back" href="{{ route('payrolls.index') }}">Back</a>
    </header>

    <div class="container">
        <h1>Edit Payroll</h1>
        <p>Update employee payroll information below.</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('payrolls.update', $payroll->getKey()) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Employee ID</label>
            <input type="text"
                   value="{{ $payroll->employee_id }}"
                   readonly>

            <label>Pay Period Start</label>
            <input type="date"
                   name="pay_period_start"
                   value="{{ old('pay_period_start', $payroll->pay_period_start?->format('Y-m-d')) }}"
                   required>

            <label>Pay Period End</label>
            <input type="date"
                   name="pay_period_end"
                   value="{{ old('pay_period_end', $payroll->pay_period_end?->format('Y-m-d')) }}"
                   required>

            <label>Basic Salary</label>
            <input type="number" id="basic_salary"
                   name="basic_salary"
                   step="0.01" min="0"
                   value="{{ old('basic_salary', $payroll->basic_salary) }}"
                   required>

            <label>Allowances</label>
            <input type="number" id="allowances"
                   name="allowances"
                   step="0.01" min="0"
                   value="{{ old('allowances', $payroll->allowances) }}"
                   required>

            <label>Deductions</label>
            <input type="number" id="deductions"
                   name="deductions"
                   step="0.01" min="0"
                   value="{{ old('deductions', $payroll->deductions) }}"
                   required>

            <label>Status</label>
<select name="status" required>

    <option value="Pending"
        @selected(old('status', $payroll->status) == 'Pending')>
        Pending
    </option>

    <option value="Approved"
        @selected(old('status', $payroll->status) == 'Approved')>
        Approved
    </option>

    <option value="Paid"
        @selected(old('status', $payroll->status) == 'Paid')>
        Paid
    </option>

</select>
            <div class="summary">
                <p>
                    <span>Gross Pay:</span>
                    <span id="grossPay">₱0.00</span>
                </p>
                <p class="net">
                    <span>Net Pay:</span>
                    <span id="netPay">₱0.00</span>
                </p>
            </div>

            <button type="submit">Update Payroll</button>
        </form>
    </div>

    <script>
        function calculatePayroll() {
            const basic = parseFloat(
                document.getElementById('basic_salary').value
            ) || 0;

            const allowances = parseFloat(
                document.getElementById('allowances').value
            ) || 0;

            const deductions = parseFloat(
                document.getElementById('deductions').value
            ) || 0;

            const gross = basic + allowances;
            const net = gross - deductions;

            const money = value => '₱' + value.toLocaleString('en-PH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('grossPay').textContent = money(gross);
            document.getElementById('netPay').textContent = money(net);
        }

        ['basic_salary', 'allowances', 'deductions'].forEach(id => {
            document.getElementById(id)
                .addEventListener('input', calculatePayroll);
        });

        calculatePayroll();
    </script>
</body>
</html>
