
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employees | PayTrack</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #071b29;
            color: white;
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
            border: none;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            cursor: pointer;
        }

        .btn-edit {
            background: #fbbf24;
            color: #111827;
            padding: 9px 14px;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
            padding: 9px 14px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .actions form { margin: 0; }

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
            background: #064e3b;
            color: #d1fae5;
            padding: 14px;
            border-radius: 7px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
    <h2>PayTrack</h2>

    <nav style="display:flex; gap:12px; align-items:center;">
        <a href="{{ route('dashboard') }}" class="btn">
            Dashboard
        </a>

        <a href="{{ route('employees.index') }}" class="btn">
            Employees
        </a>

        <a href="{{ route('employees.create') }}" class="btn">
            + Add Employee
        </a>

        <a href="{{ route('payrolls.index') }}" class="btn">
            Payroll
        </a>
    </nav>
</header>

    <main>
        <h1>Employee Management</h1>
        <p>Manage employee records and information.</p>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <div class="panel">
            <a href="{{ route('employees.create') }}" class="btn">
                + Add Employee
            </a>

            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $employee->employee_id }}</td>
                        <td>
                            {{ $employee->first_name }}
                            {{ $employee->last_name }}
                        </td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>
                            ₱{{ number_format($employee->basic_salary, 2) }}
                        </td>
                        <td>{{ $employee->status }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('employees.edit', $employee) }}"
                                   class="btn btn-edit">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('employees.destroy', $employee) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-delete">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty">
                            No employees found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
