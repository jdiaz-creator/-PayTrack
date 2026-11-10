<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | JOLERY</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #06202b, #081b29);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: white;
        }

        .container {
            width: 100%;
            max-width: 480px;
            background: #102f40;
            padding: 45px;
            border-radius: 20px;
            border: 1px solid #1b4659;
            box-shadow: 0 20px 50px rgba(0,0,0,.3);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .logo-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #10b981;
            color: #06202b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: bold;
        }

        .logo h2 {
            color: #10b981;
            letter-spacing: 3px;
        }

        .logo p {
            color: #a7c5d6;
            font-size: 10px;
            margin-top: 5px;
        }

        h1 {
            font-size: 27px;
            margin-bottom: 12px;
        }

        .description {
            color: #a7c5d6;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-size: 13px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 16px;
            border: 2px solid #24495a;
            border-radius: 10px;
            background: #e8f0ff;
            color: #081b29;
            font-size: 14px;
            margin-bottom: 20px;
            outline: none;
        }

        input:focus {
            border-color: #10b981;
        }

        button {
            width: 100%;
            padding: 17px;
            border: none;
            border-radius: 10px;
            background: #10b981;
            color: #06202b;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            transition: .3s;
        }

        button:hover {
            background: #059669;
        }

        .message {
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .error {
            background: #7f1d1d;
            color: #fecaca;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #10b981;
            text-decoration: none;
            font-size: 13px;
        }

        @media(max-width: 500px) {
            .container {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="logo">
        <div class="logo-box">JL</div>
        <div>
            <h2>JOLERY</h2>
            <p>PAYROLL MANAGEMENT SOLUTIONS</p>
        </div>
    </div>

    <h1>Create New Password</h1>

    <p class="description">
        Choose a strong password for your administrator account.
        Make sure to confirm your new password before continuing.
    </p>

    @if($errors->any())
        <div class="message error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <label for="password">New Password</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter new password"
            minlength="8"
            required
        >

        <label for="password_confirmation">Confirm New Password</label>
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
