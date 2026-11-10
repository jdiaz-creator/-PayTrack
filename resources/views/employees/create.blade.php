
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee | PayTrack</title>
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
    </style>
</head>
<body>
    <header>
        <h2>PayTrack</h2>
        <a class="back" href="{{ route('employees.index') }}">
            Back
        </a>
    </header>

    <div class="container">
        <h1>Add New Employee</h1>
        <p>Enter employee information below.</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <label>Employee ID</label>
            <input type="text" name="employee_id"
                   value="{{ old('employee_id') }}" required>

            <label>First Name</label>
            <input type="text" name="first_name"
                   value="{{ old('first_name') }}" required>

            <label>Last Name</label>
            <input type="text" name="last_name"
                   value="{{ old('last_name') }}" required>

            <label>Email Address</label>
            <input type="email" name="email"
                   value="{{ old('email') }}" required>

            <label>Department</label>
            <input type="text" name="department"
                   value="{{ old('department') }}" required>

            <label>Position</label>
            <input type="text" name="position"
                   value="{{ old('position') }}" required>

            <label>Basic Salary</label>
            <input type="number" name="basic_salary"
                   step="0.01" min="0"
                   value="{{ old('basic_salary') }}" required>

            <label>Status</label>
            <select name="status" required>
                <option value="Active"
                    {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}>
                    Active
                </option>
                <option value="Inactive"
                    {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            <button type="submit">Save Employee</button>
        </form>
    </div>
</body>
</html>
