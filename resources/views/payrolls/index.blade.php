
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

        header h2 {
            color: #10b981;
            margin: 0;
        }

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

        .error {
            background: #7f1d1d;
            color: #ffffff;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .action-btn {
            padding: 8px 12px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }

        .edit-btn {
            background: #fbbf24;
            color: black;
        }

        .disabled-btn {
            background: #64748b;
            color: #e2e8f0;
            cursor: not-allowed;
        }

        .approve-btn {
            background: #38bdf8;
            color: black;
        }

        .paid-btn {
            background: #10b981;
            color: white;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .actions {
            white-space: nowrap;
        }

        .actions form {
            display: inline;
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

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
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

                            <td>
                                ₱{{ number_format($payroll->basic_salary, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payroll->allowances, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payroll->deductions, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payroll->gross_pay, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payroll->net_pay, 2) }}
                            </td>

                            <td>{{ $payroll->status }}</td>

                            <td class="actions">

                                {{-- EDIT BUTTON --}}
                                @if($payroll->status === 'Paid')
                                    <span
                                        class="action-btn disabled-btn"
                                        title="Paid payroll cannot be edited."
                                    >
                                        Edit Locked
                                    </span>
                                @else
                                    <a
                                        href="{{ route('payrolls.edit', $payroll->getKey()) }}"
                                        class="action-btn edit-btn"
                                    >
                                        Edit
                                    </a>
                                @endif

                                {{-- APPROVE BUTTON --}}
                                @if($payroll->status === 'Pending')
                                    <form
                                        action="{{ route('payrolls.approve', $payroll->getKey()) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="action-btn approve-btn"
                                        >
                                            Approve
                                        </button>
                                    </form>

                                {{-- MARK AS PAID BUTTON --}}
                                @elseif($payroll->status === 'Approved')
                                    <form
                                        action="{{ route('payrolls.markPaid', $payroll->getKey()) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="action-btn paid-btn"
                                        >
                                            Mark as Paid
                                        </button>
                                    </form>
                                @endif

                                {{-- DELETE BUTTON / DELETE LOCK --}}
                                @if($payroll->status === 'Paid')
                                    <span
                                        class="action-btn disabled-btn"
                                        title="Paid payroll cannot be deleted."
                                    >
                                        Delete Locked
                                    </span>
                                @else
                                    <form
                                        action="{{ route('payrolls.destroy', $payroll->getKey()) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this payroll?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                @endif

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
