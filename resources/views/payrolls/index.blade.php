
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payroll Management | PayTrack</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #071b29;
            color: white;
            font-family: Arial, sans-serif;
        }
        header {
            background: #102f40;
            padding: 22px 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h2 { color: #10b981; margin: 0; }
        main { padding: 35px; }
        .panel {
            background: #123448;
            border-radius: 12px;
            padding: 25px;
            overflow-x: auto;
        }
        .btn {
            background: #10b981;
            color: #06212a;
            padding: 12px 18px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #355466;
        }
        th { color: #9dd8ed; }
        .empty {
            text-align: center;
            color: #aac4d0;
        }
        .success {
            background: #065f46;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h2>PayTrack</h2>
        <a href="{{ route('dashboard') }}" class="btn">
            Dashboard
        </a>
    </header>

    <main>
        <h1>Payroll Management</h1>
        <p>Manage employee payroll records and salary information.</p>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <div class="panel">
            <a href="{{ route('payrolls.create') }}" class="btn">
                + Create Payroll
            </a>

            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Pay Period</th>
                        <th>Basic Salary</th>
                        <th>Allowances</th>
                        <th>Deductions</th>
                        <th>Gross Pay</th>
                        <th>Net Pay</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payrolls as $payroll)
                    <tr>
                        <td>{{ $payroll->employee_id }}</td>
                        <td>
                            {{ $payroll->pay_period_start?->format('M d, Y') }}
                            -
                            {{ $payroll->pay_period_end?->format('M d, Y') }}
                        </td>
                        <td>₱{{ number_format($payroll->basic_salary, 2) }}</td>
                        <td>₱{{ number_format($payroll->allowances, 2) }}</td>
                        <td>₱{{ number_format($payroll->deductions, 2) }}</td>
                        <td>₱{{ number_format($payroll->gross_pay, 2) }}</td>
                        <td>₱{{ number_format($payroll->net_pay, 2) }}</td>
                        <td>{{ $payroll->status }}</td>
                        
<td>
    <a href="{{ route('payrolls.edit', $payroll->_id) }}"
       style="background:#fbbf24; color:black; padding:8px 12px; border-radius:6px; text-decoration:none;">
        Edit
    </a>

@if($payroll->status === 'Pending')
    <form action="{{ route('payrolls.approve', $payroll->getKey()) }}"
          method="POST" style="display:inline;">
        @csrf
        <button type="submit"
                style="background:#38bdf8; color:black; padding:8px 12px; border:0; border-radius:6px; cursor:pointer;">
            Approve
        </button>
    </form>
@elseif($payroll->status === 'Approved')
    <form action="{{ route('payrolls.markPaid', $payroll->getKey()) }}"
          method="POST" style="display:inline;">
        @csrf
        <button type="submit"
                style="background:#10b981; color:white; padding:8px 12px; border:0; border-radius:6px; cursor:pointer;">
            Mark as Paid
        </button>
    </form>
@endif

    <form action="{{ route('payrolls.destroy', $payroll->_id) }}"
          method="POST"
          style="display:inline;"
          onsubmit="return confirm('Are you sure you want to delete this payroll?');">
        @csrf
        @method('DELETE')

        <button type="submit"
                style="background:#ef4444; color:white; padding:8px 12px; border:0; border-radius:6px; cursor:pointer;">
            Delete
        </button>
    </form>
</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="empty">
                            No payroll records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
