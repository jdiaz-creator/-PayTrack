<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayTrack | Admin Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #071827;
            color: white;
        }

        .login-container {
            width: 400px;
            padding: 40px;
            background: #102b3d;
            border-radius: 15px;
            box-shadow: 0 10px 35px rgba(0,0,0,.3);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo h1 {
            color: #10b981;
            font-size: 32px;
        }

        .logo p {
            color: #a9bac8;
            margin-top: 8px;
        }

        .login-container h2 {
            margin-bottom: 8px;
        }

        .subtitle {
            color: #a9bac8;
            font-size: 14px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 15px 0 8px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #365166;
            border-radius: 7px;
            background: #071d2c;
            color: white;
            outline: none;
        }

        input:focus {
            border-color: #10b981;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 25px;
            border: none;
            border-radius: 7px;
            background: #10b981;
            color: #071827;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #059669;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #8fa5b5;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="logo">
            <h1>PayTrack</h1>
            <p>Employee & Payroll Management System</p>
        </div>

        <h2>Welcome Back!</h2>
        <p class="subtitle">Please login to your admin account.</p>

        <form>
            <label>Email Address</label>
            <input type="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" placeholder="Enter your password" required>

            <button type="submit">LOGIN</button>
        </form>

        <div class="footer">
            © 2026 PayTrack. All Rights Reserved.
        </div>

    </div>

</body>
</html>