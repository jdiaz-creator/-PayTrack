<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | JOLERY</title>

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
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: white;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background: #102f40;
            padding: 40px;
            border-radius: 20px;
            border: 1px solid #20485a;
        }

        .logo {
            color: #10b981;
            font-size: 27px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        h2 {
            margin-bottom: 12px;
        }

        p {
            color: #b9cbd8;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 15px 0 8px;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px;
            border-radius: 9px;
            border: 1px solid #7894a5;
            background: #e8f0ff;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 15px;
            margin-top: 25px;
            background: #059669;
            color: #001b19;
            border: none;
            border-radius: 9px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #10b981;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: #10b981;
            text-decoration: none;
        }

        .error {
            color: #ff8585;
            font-size: 13px;
            margin-top: 6px;
        }

        .success {
            color: #10b981;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="logo">JL JOLERY</div>

    <h2>Change Password</h2>

    <p>
        Secure your administrator account by updating
        your current password.
    </p>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('password.change.update') }}" method="POST">
        @csrf
        @method('PUT')

        <label>Current Password</label>
        <input type="password" name="current_password"
               placeholder="Enter current password" required>

        <label>New Password</label>
        <input type="password" name="password"
               placeholder="Enter new password" required>

        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation"
               placeholder="Confirm new password" required>

        <button type="submit">UPDATE PASSWORD</button>
    </form>

    <a href="{{ route('dashboard') }}" class="back">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>
