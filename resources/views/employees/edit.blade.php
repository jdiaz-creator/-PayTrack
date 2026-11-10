
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee | PayTrack</title>
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

        header h2 {
            color: #10b98d;
            margin: 0;
        }

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

        input:focus, select:focus {
            outline: none;
            border-color: #10b98d;
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

        button:hover, .back:hover {
            background: #0d9e79;
        }

        .error {
            color: #ff9999;
            margin-top: 15px;
        }

        .subtitle {
            color: #b8d4e3;
        }
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
        <h1>Edit Employee</h1>
        <p class="subtitle">
            Update employee information below.
        </p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.update', $employee) }}"
              method="POST">

            @csrf
            @method('PUT')

            <label for="employee_id">Employee ID</label>
            <input type="text"
                   id="employee_id"
                   name="employee_id"
                   value="{{ old('employee_id', $employee->employee_id) }}"
                   required>

            <label for="first_name">First Name</label>
            <input type="text"
                   id="first_name"
                   name="first_name"
                   value="{{ old('first_name', $employee->first_name) }}"
                   required>

            <label for="last_name">Last Name</label>
            <input type="text"
                   id="last_name"
                   name="last_name"
                   value="{{ old('last_name', $employee->last_name) }}"
                   required>

            <label for="email">Email Address</label>
            <input type="email"
                   id="email"
                   name="email"
                   value="{{ old('email', $employee->email) }}"
                   required>

            <label for="department">Department</label>
            <input type="text"
                   id="department"
                   name="department"
                   value="{{ old('department', $employee->department) }}"
                   required>

            <label for="position">Position</label>
            <input type="text"
                   id="position"
                   name="position"
                   value="{{ old('position', $employee->position) }}"
                   required>

            <label for="basic_salary">Basic Salary</label>
            <input type="number"
                   id="basic_salary"
                   name="basic_salary"
                   step="0.01"
                   min="0"
                   value="{{ old('basic_salary', $employee->basic_salary) }}"
                   required>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Active"
                    {{ old('status', $employee->status) == 'Active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="Inactive"
                    {{ old('status', $employee->status) == 'Inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>

            <button type="submit">
                Save Changes
            </button>
        </form>
    </div>

</body>
</html>
