
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JOLERY | Administrator Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        :root {
            --bg: #061725;
            --panel: #102d40;
            --green: #10c995;
            --muted: #9bb4c7;
            --white: #ffffff;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 35px 20px;
            background:
                radial-gradient(circle at 15% 15%,
                rgba(16,201,149,.13), transparent 30%),
                radial-gradient(circle at 85% 85%,
                rgba(16,201,149,.10), transparent 30%),
                var(--bg);
            color: var(--white);
        }

        .login-layout {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #0d2638;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 90px rgba(0,0,0,.4);
        }

        /* LEFT PANEL */

        .brand-panel {
            padding: 55px 45px;
            background:
                linear-gradient(145deg,
                #123b4b 0%,
                #0b2639 65%,
                #071b2b 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            border: 1px solid rgba(16,201,149,.15);
            border-radius: 50%;
            right: -180px;
            top: 100px;
            box-shadow:
                0 0 0 35px rgba(16,201,149,.025),
                0 0 0 70px rgba(16,201,149,.02);
        }

        .brand-panel::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(16,201,149,.07);
            filter: blur(65px);
            bottom: 30px;
            left: 20px;
        }

        .brand-content,
        .brand-bottom {
            position: relative;
            z-index: 1;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo {
            width: 58px;
            height: 58px;
            background: linear-gradient(135deg,
                #10d9a0, #059669);
            color: #062b36;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: 900;
            box-shadow: 0 8px 25px rgba(16,201,149,.2);
        }

        .brand-name {
            color: var(--green);
            font-size: 30px;
            font-weight: 800;
            letter-spacing: 3px;
        }

        .brand-subtitle {
            color: #b4ccdc;
            font-size: 10px;
            letter-spacing: 1.5px;
            margin-top: 5px;
        }

        .welcome-content {
            margin-top: 75px;
            margin-bottom: 65px;
        }

        .eyebrow {
            display: inline-block;
            color: var(--green);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            padding: 9px 14px;
            border: 1px solid rgba(16,201,149,.3);
            background: rgba(16,201,149,.08);
            border-radius: 30px;
            margin-bottom: 27px;
        }

        .welcome-content h1 {
            font-size: 43px;
            line-height: 1.17;
            margin-bottom: 22px;
        }

        .welcome-content h1 span {
            color: var(--green);
        }

        .welcome-content p {
            color: #b2c7d6;
            font-size: 14px;
            line-height: 1.9;
            max-width: 370px;
        }

        .benefits {
            margin-top: 35px;
            display: grid;
            gap: 17px;
        }

        .benefit {
            display: flex;
            align-items: center;
            gap: 13px;
            color: #d4e4ed;
            font-size: 13px;
        }

        .benefit-icon {
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 9px;
            background: rgba(16,201,149,.13);
            color: var(--green);
            font-weight: bold;
        }

        .brand-bottom {
            color: #7894a8;
            font-size: 11px;
            line-height: 1.8;
        }

        /* RIGHT PANEL */

        .form-panel {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 55px 48px;
            background: #0b2233;
        }

        .login-form {
            width: 100%;
            max-width: 365px;
        }

        .form-heading {
            margin-bottom: 32px;
        }

        .form-heading h2 {
            font-size: 29px;
            margin-bottom: 10px;
        }

        .form-heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .field {
            margin-bottom: 23px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #e3edf4;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            height: 53px;
            padding: 0 16px;
            background: #071b2a;
            border: 1px solid #29485b;
            border-radius: 10px;
            color: white;
            outline: none;
            font-size: 13px;
            transition: .25s;
        }

        .input-wrap input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(16,201,149,.12);
        }

        .input-wrap input::placeholder {
            color: #71899c;
        }

        .password-input {
            padding-right: 75px !important;
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--green);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin: 3px 0 27px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #b7cbd8;
            font-size: 12px;
            cursor: pointer;
        }

        .remember input {
            accent-color: var(--green);
            width: 15px;
            height: 15px;
        }

        .forgot {
            color: var(--green);
            text-decoration: none;
            font-size: 11px;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg,
                #10c995, #059e78);
            color: #052b27;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1px;
            cursor: pointer;
            transition: .3s;
            box-shadow: 0 8px 22px rgba(16,201,149,.15);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(16,201,149,.25);
            background: linear-gradient(135deg,
                #34d9a8, #10b981);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .security {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            color: #8ca7b9;
            font-size: 11px;
        }

        .security span {
            color: var(--green);
        }

        .alert {
            padding: 13px 15px;
            margin-bottom: 20px;
            border-radius: 9px;
            font-size: 12px;
            line-height: 1.6;
        }

        .error {
            background: rgba(239,68,68,.10);
            border: 1px solid rgba(239,68,68,.4);
            color: #fca5a5;
        }

        .success {
            background: rgba(16,201,149,.10);
            border: 1px solid rgba(16,201,149,.4);
            color: #6ee7b7;
        }

        /* RESPONSIVE */

        @media(max-width: 800px) {
            .login-layout {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .brand-panel {
                padding: 35px;
            }

            .welcome-content {
                margin: 40px 0 20px;
            }

            .welcome-content h1 {
                font-size: 32px;
            }

            .benefits {
                display: none;
            }

            .brand-bottom {
                display: none;
            }

            .form-panel {
                padding: 40px 30px;
            }
        }

        @media(max-width: 420px) {
            body {
                padding: 12px;
            }

            .brand-panel {
                padding: 27px 23px;
            }

            .form-panel {
                padding: 35px 23px;
            }

            .brand-name {
                font-size: 25px;
            }

            .welcome-content h1 {
                font-size: 29px;
            }
        }
    </style>
</head>

<body>

<div class="login-layout">

    <!-- LEFT BRAND PANEL -->

    <section class="brand-panel">

        <div class="brand-content">

            <div class="brand">
                <div class="logo">JL</div>

                <div>
                    <div class="brand-name">JOLERY</div>
                    <div class="brand-subtitle">
                        PAYROLL MANAGEMENT SOLUTIONS
                    </div>
                </div>
            </div>

            <div class="welcome-content">

                <div class="eyebrow">
                    PEOPLE. PAYROLL. PROGRESS.
                </div>

                <h1>
                    Manage Better.<br>
                    Pay Smarter.<br>
                    <span>Grow Together.</span>
                </h1>

                <p>
                    Your workforce deserves a smarter way
                    to work. Manage employee information,
                    organize payroll records, and monitor
                    your business operations in one place.
                </p>

                <div class="benefits">

                    <div class="benefit">
                        <div class="benefit-icon">✓</div>
                        Employee Management
                    </div>

                    <div class="benefit">
                        <div class="benefit-icon">✓</div>
                        Organized Payroll Records
                    </div>

                    <div class="benefit">
                        <div class="benefit-icon">✓</div>
                        Payroll Analytics
                    </div>

                </div>

            </div>

        </div>

        <div class="brand-bottom">
            © 2026 JOLERY Payroll Management Solutions.
            <br>
            People. Payroll. Progress.
        </div>

    </section>

    <!-- RIGHT LOGIN PANEL -->

    <section class="form-panel">

        <div class="login-form">

            <div class="form-heading">

                <h2>Welcome Back!</h2>

                <p>
                    Sign in to your administrator account
                    to access the JOLERY dashboard.
                </p>

            </div>

            @if(session('success'))
                <div class="alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('status'))
                <div class="alert success">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}"
                  method="POST">

                @csrf

                <div class="field">

                    <label for="email">
                        Email Address
                    </label>

                    <div class="input-wrap">

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email address"
                            value="{{ old('email') }}"
                            autocomplete="username"
                            required
                            autofocus
                        >

                    </div>

                </div>

                <div class="field">

                    <label for="password">
                        Password
                    </label>

                    <div class="input-wrap">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="password-input"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="toggle-password"
                            id="toggleText"
                            onclick="togglePassword()"
                        >
                            SHOW
                        </button>

                    </div>

                </div>

                <div class="form-options">

                    <label class="remember">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >
                        Remember Me
                    </label>

                    <a href="{{ route('password.request') }}" class="forgot">
    Forgot Password?
</a>

                </div>

                <button type="submit" class="login-button">
                    SIGN IN TO JOLERY →
                </button>

            </form>

            <div class="security">
                <span>●</span>
                Secure Administrator Access
            </div>

        </div>

    </section>

</div>

<script>

    function togglePassword() {

        const password =
            document.getElementById('password');

        const toggle =
            document.getElementById('toggleText');

        if (password.type === 'password') {

            password.type = 'text';
            toggle.textContent = 'HIDE';

        } else {

            password.type = 'password';
            toggle.textContent = 'SHOW';

        }

    }

</script>

</body>
</html>
