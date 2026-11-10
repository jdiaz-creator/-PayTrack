<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password | JOLERY</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #061c27, #092d3a);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: white;
        }

        .container {
            width: 100%;
            max-width: 480px;
            background: #123343;
            padding: 45px;
            border: 1px solid #1c4859;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 38px;
        }

        .logo {
            background: #10b981;
            color: #062a2a;
            width: 52px;
            height: 52px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: bold;
        }

        .brand h2 {
            color: #10b981;
            letter-spacing: 3px;
            font-size: 23px;
        }

        .brand p {
            font-size: 10px;
            color: #cbd5e1;
            margin-top: 5px;
        }

        h1 {
            font-size: 27px;
            margin-bottom: 12px;
        }

        .description {
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
            margin-top: 19px;
        }

        input {
            width: 100%;
            padding: 15px;
            border-radius: 9px;
            border: 1px solid #cbd5e1;
            background: #eaf0ff;
            color: #172b3a;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border: 2px solid #10b981;
        }

        button {
            width: 100%;
            padding: 16px;
            margin-top: 28px;
            border: none;
            border-radius: 10px;
            background: #10b981;
            color: #052e2b;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 27px;
            color: #10b981;
            text-decoration: none;
            font-size: 13px;
        }

        .back:hover {
            color: white;
        }

        .error {
            background: #7f1d1d;
            color: #fecaca;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .error ul {
            padding-left: 18px;
        }

        @media(max-width: 480px) {
            .container {
                padding: 30px 23px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="brand">
        <div class="logo">JL</div>

        <div>
            <h2>JOLERY</h2>
            <p>PAYROLL MANAGEMENT SOLUTIONS</p>
        </div>
    </div>

    <h1>Reset Password</h1>

    <p class="description">
        Enter your registered administrator email address
        and create your new password below.
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

    <form method="POST" action="{{ route('password.email') }}">

        @csrf

        <label for="email">Administrator Email Address</label>

        <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter your registered email"
            value="{{ old('email') }}"
            required
        >

        <label for="password">New Password</label>

        <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter your new password"
            minlength="8"
            required
        >

        <label for="password_confirmation">
            Confirm New Password
        </label>

        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Confirm your new password"
            minlength="8"
            required
        >

        <button type="submit">
            RESET PASSWORD →
        </button>

    </form>

    <a href="{{ route('login') }}" class="back">
        ← Back to Login
    </a>

</div>

</body>
</html>
