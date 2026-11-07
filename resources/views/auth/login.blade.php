
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayTrack | Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #071a29;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 445px;
            background: #102d40;
            padding: 42px 44px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0,0,0,.25);
        }

        .brand {
            text-align: center;
            margin-bottom: 34px;
        }

        .brand h1 {
            color: #10b981;
            font-size: 36px;
            margin-bottom: 8px;
        }

        .brand p {
            color: #b8c9d8;
            font-size: 16px;
        }

        .welcome {
            margin-bottom: 26px;
        }

        .welcome h2 {
            color: white;
            font-size: 26px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #b8c9d8;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            color: white;
            margin-bottom: 10px;
            font-size: 15px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 15px;
            border: 1px solid #365267;
            border-radius: 8px;
            background: #071d2c;
            color: white;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: #10b981;
        }

        input::placeholder {
            color: #8194a5;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            margin-top: 10px;
            background: #10b981;
            border: none;
            border-radius: 8px;
            color: #062b25;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s;
        }

        .login-btn:hover {
            background: #059669;
        }

        .error {
            color: #ff7777;
            font-size: 13px;
            margin-top: 7px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #9bb2c5;
            font-size: 13px;
        }

        @media(max-width: 480px) {
            .login-container {
                padding: 32px 25px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="brand">
            <h1>PayTrack</h1>
            <p>Employee & Payroll Management System</p>
        </div>

        <div class="welcome">
            <h2>Welcome Back!</h2>
            <p>Please login to your admin account.</p>
        </div>

        @if(session('success'))
            <p style="color:#10b981; margin-bottom:15px;">
                {{ session('success') }}
            </p>
        @endif

        @if($errors->any())
            <div class="error" style="margin-bottom:15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button type="submit" class="login-btn">
                LOGIN
            </button>

        </form>

        <div class="footer">
            © 2026 PayTrack. All Rights Reserved.
        </div>

    </div>

</body>
</html>
