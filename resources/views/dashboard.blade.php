
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayTrack | Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #081b29;
            color: white;
            min-height: 100vh;
        }

        header {
            background: #102f40;
            padding: 22px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #10b981;
            font-size: 28px;
        }

        .logout {
            background: #10b981;
            color: #061b29;
            padding: 11px 22px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .container {
            padding: 40px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #9bb5c8;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: #123448;
            padding: 28px;
            border-radius: 12px;
            border: 1px solid #24495c;
        }

        .card h3 {
            color: #a8c2d3;
            font-size: 16px;
            margin-bottom: 18px;
        }

        .card h2 {
            color: #10b981;
            font-size: 30px;
        }

        .content {
            background: #123448;
            padding: 30px;
            margin-top: 30px;
            border-radius: 12px;
        }

        .content p {
            color: #a8c2d3;
            margin-top: 12px;
        }

        @media (max-width: 600px) {
            header, .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>PayTrack</h1>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout" type="submit">LOGOUT</button>
    </form>
</header>

<div class="container">

    <div class="welcome">
        <h2>Welcome, Admin!</h2>
        <p>Employee & Payroll Management System</p>
    </div>

    <div class="cards">

        <div class="card">
            <h3>Total Employees</h3>
            <h2>0</h2>
        </div>

        <div class="card">
            <h3>Present Today</h3>
            <h2>0</h2>
        </div>

        <div class="card">
            <h3>Pending Payroll</h3>
            <h2>0</h2>
        </div>

        <div class="card">
            <h3>Total Payroll</h3>
            <h2>₱0.00</h2>
        </div>

    </div>

    <div class="content">
        <h2>Dashboard Overview</h2>
        <p>
            Welcome to PayTrack! Manage your employees,
            attendance, and payroll in one place.
        </p>
    </div>

</div>

</body>
</html>
