
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JOLERY | Payroll Management Solutions</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #071827;
            color: white;
            min-height: 100vh;
        }

        header {
            min-height: 108px;
            background: #123448;
            display: flex;
            align-items: center;
            padding: 20px 6%;
            border-bottom: 1px solid #20485c;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo {
            width: 55px;
            height: 55px;
            background: #10b981;
            color: #071827;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            font-weight: bold;
        }

        .brand h1 {
            color: #10b981;
            font-size: 29px;
            letter-spacing: 3px;
        }

        .brand p {
            color: #b6c8d5;
            font-size: 11px;
            letter-spacing: 1.5px;
            margin-top: 7px;
        }

        main {
            max-width: 1450px;
            margin: auto;
            padding: 90px 6% 80px;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.4fr 0.8fr;
            gap: 65px;
            align-items: center;
        }

        .eyebrow {
            color: #10b981;
            font-weight: bold;
            letter-spacing: 3px;
            font-size: 15px;
            margin-bottom: 25px;
        }

        .hero h2 {
            font-size: clamp(42px, 5vw, 64px);
            line-height: 1.12;
            margin-bottom: 28px;
        }

        .hero h2 span {
            color: #10b981;
        }

        .description {
            color: #b6c8d5;
            font-size: 18px;
            line-height: 1.9;
            max-width: 700px;
            margin-bottom: 35px;
        }

        .get-started {
            display: inline-block;
            padding: 19px 35px;
            background: #10b981;
            color: #071827;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: .3s;
        }

        .get-started:hover {
            background: #059669;
            transform: translateY(-3px);
        }

        .get-started span {
            margin-left: 12px;
        }

        .features {
            background: #123448;
            border: 1px solid #24536a;
            border-radius: 22px;
            padding: 35px;
        }

        .features h3 {
            color: #10b981;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .features > p {
            color: #b6c8d5;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .feature-item {
            background: #092638;
            padding: 23px 20px;
            border-radius: 14px;
            margin-bottom: 16px;
        }

        .feature-item:last-child {
            margin-bottom: 0;
        }

        .feature-item small {
            color: #a9bac8;
            font-size: 12px;
        }

        .feature-item h4 {
            color: #10b981;
            font-size: 22px;
            margin-top: 13px;
        }

        .highlights {
            display: flex;
            flex-wrap: wrap;
            gap: 35px;
            margin-top: 55px;
        }

        .highlight strong {
            display: block;
            color: #10b981;
            font-size: 18px;
            margin-bottom: 12px;
        }

        .highlight p {
            color: #b6c8d5;
            font-size: 14px;
        }

        .bottom-section {
            margin-top: 100px;
            text-align: center;
            padding: 55px 25px;
            background: #102f42;
            border: 1px solid #20485c;
            border-radius: 18px;
        }

        .bottom-section h2 {
            font-size: 30px;
            margin-bottom: 15px;
        }

        .bottom-section p {
            color: #b6c8d5;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        footer {
            background: #123448;
            text-align: center;
            padding: 25px;
            color: #91a7b7;
            font-size: 12px;
            line-height: 1.8;
        }

        @media(max-width: 850px) {
            .hero {
                grid-template-columns: 1fr;
                gap: 45px;
            }

            main {
                padding-top: 60px;
            }

            .hero h2 {
                font-size: 43px;
            }
        }

        @media(max-width: 480px) {
            header {
                padding: 18px 5%;
            }

            .brand h1 {
                font-size: 23px;
            }

            main {
                padding: 45px 6%;
            }

            .hero h2 {
                font-size: 37px;
            }

            .features {
                padding: 24px;
            }

            .highlights {
                gap: 25px;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="brand">
        <div class="logo">JL</div>

        <div>
            <h1>JOLERY</h1>
            <p>PAYROLL MANAGEMENT SOLUTIONS</p>
        </div>
    </div>
</header>

<main>

    <section class="hero">

        <div class="hero-content">

            <p class="eyebrow">
                PEOPLE. PAYROLL. PROGRESS.
            </p>

            <h2>
                Smarter Payroll.<br>
                Better Workforce.<br>
                <span>Stronger Business.</span>
            </h2>

            <p class="description">
                Welcome to JOLERY Payroll Management Solutions.
                A centralized platform designed to simplify employee
                management, organize payroll records, and help your
                organization make smarter decisions.
            </p>

            <a href="/login" class="get-started">
                GET STARTED <span>→</span>
            </a>

            <div class="highlights">

                <div class="highlight">
                    <strong>01</strong>
                    <p>Employee Management</p>
                </div>

                <div class="highlight">
                    <strong>02</strong>
                    <p>Payroll Monitoring</p>
                </div>

                <div class="highlight">
                    <strong>03</strong>
                    <p>Payroll Analytics</p>
                </div>

            </div>

        </div>

        <div class="features">

            <h3>JOLERY SYSTEM</h3>

            <p>
                Everything you need to manage your employees
                and payroll operations in one organized platform.
            </p>

            <div class="feature-item">
                <small>EMPLOYEE MANAGEMENT</small>
                <h4>Organized Workforce</h4>
            </div>

            <div class="feature-item">
                <small>PAYROLL MANAGEMENT</small>
                <h4>Accurate Records</h4>
            </div>

            <div class="feature-item">
                <small>BUSINESS ANALYTICS</small>
                <h4>Smarter Decisions</h4>
            </div>

        </div>

    </section>

    <section class="bottom-section">

        <h2>Manage Your Workforce Smarter.</h2>

        <p>
            Simplify your employee records, monitor payroll transactions,
            and gain better insights through organized payroll analytics.
        </p>

        <a href="/login" class="get-started">
            ACCESS ADMIN LOGIN <span>→</span>
        </a>

    </section>

</main>

<footer>
    © 2026 JOLERY Payroll Management Solutions.
    <br>
    People. Payroll. Progress.
</footer>

</body>
</html>
