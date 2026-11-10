
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOLERY | Payroll Management Solutions</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-logo {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #10b981, #087f68);
            border-radius: 12px;
            color: #082332;
            font-size: 23px;
            font-weight: 900;
        }

        .brand h1 {
            color: #10b981;
            font-size: 28px;
            letter-spacing: 2px;
        }

        .brand p {
            color: #9bb5c8;
            font-size: 10px;
            letter-spacing: 1.4px;
            margin-top: 5px;
        }

        .brand .tagline {
            color: #10b981;
            font-style: italic;
        }

        .logout {
            background: #10b981;
            color: #062b36;
            padding: 12px 23px;
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

        .card p {
            color: white;
            margin-top: 5px;
        }

        .content {
            background: #123448;
            padding: 30px;
            margin-top: 25px;
            border-radius: 12px;
            border: 1px solid #24495c;
        }

        .content > p {
            color: #a8c2d3;
            margin-top: 10px;
        }

        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .analytics-card {
            background: #102f40;
            padding: 25px;
            border-radius: 10px;
        }

        .analytics-card h2 {
            color: #10b981;
            margin-top: 10px;
        }

        .toolbar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        input, select {
            background: #102f40;
            color: white;
            border: 1px solid #315266;
            padding: 12px;
            border-radius: 7px;
        }

        input::placeholder {
            color: #9bb5c8;
        }

        .toolbar input {
            flex: 1;
            min-width: 220px;
        }

        button {
            font-family: Arial, sans-serif;
        }

        .action-toolbar {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin: 15px 0;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-green {
            background: #10b981;
            color: #062b36;
        }

        .btn-gray {
            background: #315266;
            color: white;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            color: #9bd5ef;
            text-align: left;
            padding: 15px 12px;
            border-bottom: 1px solid #315266;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #24495c;
        }

        tr:hover {
            background: #173e52;
        }

        .view-btn {
            background: #10b981;
            color: #062b36;
            padding: 9px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .paid {
            background: #064e3b;
            color: #6ee7b7;
        }

        .pending {
            background: #78350f;
            color: #fcd34d;
        }

        .approved {
            background: #164e63;
            color: #67e8f9;
        }

        /* PAYROLL MODAL */

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.78);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content {
            background: #123448;
            color: white;
            padding: 25px;
            border-radius: 12px;
            width: 100%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-content h2 {
            color: #10b981;
            margin-bottom: 10px;
        }

        .modal-content hr {
            border: 0;
            border-top: 1px solid #315266;
            margin-bottom: 15px;
        }

        .modal-content p {
            margin: 7px 0;
            line-height: 1.5;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .modal-buttons button {
            padding: 12px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        .generate-btn {
            background: #123448;
            color: white;
            border: 1px solid #10b981;
        }

        .close-btn {
            background: #10b981;
            color: #062b36;
            border: none;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #7895a7;
            font-size: 12px;
        }

        @media(max-width: 650px) {
            header {
                padding: 18px;
            }

            .container {
                padding: 18px;
            }

            .brand h1 {
                font-size: 22px;
            }

            .brand-logo {
                width: 45px;
                height: 45px;
            }

            .content {
                padding: 18px;
            }
        }
        /* NAVIGATION MENU */
.main-nav {
    display: flex;
    align-items: center;
    gap: 12px;
}

.main-nav a {
    color: #d7e8f2;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    padding: 11px 16px;
    border-radius: 8px;
    transition: 0.3s ease;
}

.main-nav a:hover {
    background: #10b981;
    color: #06202b;
}

.main-nav a:first-child {
    background: #10b981;
    color: #06202b;
}

@media (max-width: 750px) {
    header {
        flex-wrap: wrap;
        gap: 15px;
    }

    .main-nav {
        flex-wrap: wrap;
    }
}
    </style>
</head>

<body>

<header>
    <div class="brand">
        <div class="brand-logo">JL</div>
        <div>
            <h1>JOLERY</h1>
            <p>PAYROLL MANAGEMENT SOLUTIONS</p>
            <p class="tagline">People. Payroll. Progress.</p>
        </div>
    </div>
    <nav class="main-nav">
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('employees.index') }}">Employees</a>
    <a href="{{ route('employees.create') }}">Add Employee</a>
    <a href="{{ route('payrolls.index') }}">Payroll</a>
</nav>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="logout" type="submit">LOGOUT</button>
    </form>
</header>

<div class="container">

    <div class="welcome">
        <h2>Welcome to JOLERY, Admin!</h2>
        <p>Employee & Payroll Management System</p>
    </div>

    <!-- MAIN STATISTICS -->

    <div class="cards">

        <div class="card">
            <h3>Total Employees</h3>
            <h2>{{ number_format($totalEmployees) }}</h2>
            <p>Registered Employees</p>
        </div>

        <div class="card">
            <h3>Total Payroll Records</h3>
            <h2>{{ number_format($totalPayrolls) }}</h2>
            <p>Recorded Payrolls</p>
        </div>

        <div class="card">
            <h3>Total Gross Pay</h3>
            <h2>₱{{ number_format($totalGrossPay, 2) }}</h2>
            <p>Combined Gross Salary</p>
        </div>

        <div class="card">
            <h3>Total Net Pay</h3>
            <h2>₱{{ number_format($totalNetPay, 2) }}</h2>
            <p>Combined Net Salary</p>
        </div>

    </div>

    <!-- PAYROLL STATUS -->

    <div class="cards" style="margin-top:25px;">

        <div class="card" style="border-top:4px solid #f59e0b;">
            <h3>Pending Payroll</h3>
            <h2>{{ number_format($pendingPayrolls) }}</h2>
            <p>Payroll awaiting approval</p>
        </div>

        <div class="card" style="border-top:4px solid #38bdf8;">
            <h3>Approved Payroll</h3>
            <h2>{{ number_format($approvedPayrolls) }}</h2>
            <p>Approved payroll records</p>
        </div>

        <div class="card" style="border-top:4px solid #10b981;">
            <h3>Paid Payroll</h3>
            <h2>{{ number_format($paidPayrolls) }}</h2>
            <p>Successfully paid records</p>
        </div>

    </div>

    <!-- PAYROLL ANALYTICS -->

    <div class="content">
        <h2>Payroll Analytics</h2>
        <p>Gross Pay vs Net Pay per Payroll Period</p>

        <div style="margin-top:25px;">
            <canvas id="payrollChart"></canvas>
        </div>
    </div>

    <!-- ADDITIONAL STATISTICS -->

    <div class="content">
        <h2>Additional Payroll Statistics</h2>

        <div class="analytics-grid">

            <div class="analytics-card">
                <h3>Total Allowances</h3>
                <h2>₱{{ number_format($totalAllowances, 2) }}</h2>
                <p>Combined Employee Allowances</p>
            </div>

            <div class="analytics-card">
                <h3>Total Deductions</h3>
                <h2>₱{{ number_format($totalDeductions, 2) }}</h2>
                <p>Combined Payroll Deductions</p>
            </div>

        </div>
    </div>

    <!-- RECENT PAYROLL RECORDS -->

    <div class="content">

        <h2>Recent Payroll Records</h2>
        <p>Latest 5 payroll transactions</p>

        <div class="toolbar">

            <input
                type="text"
                id="payrollSearch"
                placeholder="Search employee name or ID..."
            >

            <select id="statusFilter">
                <option value="all">All Status</option>
                <option value="paid">Paid</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
            </select>

        </div>

        <p id="payrollCount" style="color:#9bd5ef;font-size:13px;">
            Showing payroll records
        </p>

        <div class="action-toolbar">

            <button class="btn btn-gray" onclick="printPayrollReport()">
                Print Payroll
            </button>

            <button class="btn btn-green" onclick="printPayrollReport()">
                Export PDF
            </button>

        </div>

        <div class="table-wrapper">

            <table id="payrollTable">

                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Pay Period</th>
                        <th>Gross Pay</th>
                        <th>Net Pay</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentPayrollRecords as $record)

                        <tr class="payroll-row"
                            data-search="{{ strtolower($record->employee_id . ' ' . $record->employee_name) }}"
                            data-status="{{ strtolower($record->status ?? 'Pending') }}">

                            <td>{{ $record->employee_id }}</td>

                            <td>{{ $record->employee_name }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($record->pay_period_start)->format('M d, Y') }}
                                -
                                {{ \Carbon\Carbon::parse($record->pay_period_end)->format('M d, Y') }}
                            </td>

                            <td>₱{{ number_format($record->gross_pay, 2) }}</td>

                            <td>₱{{ number_format($record->net_pay, 2) }}</td>

                            <td>
                                @php
                                    $statusClass = strtolower($record->status ?? 'pending');
                                @endphp

                                <span class="status {{ $statusClass }}">
                                    {{ $record->status ?? 'Pending' }}
                                </span>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="view-btn view-payroll-btn"

                                    data-id="{{ $record->employee_id }}"
                                    data-name="{{ $record->employee_name }}"

                                    data-period="{{ \Carbon\Carbon::parse($record->pay_period_start)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($record->pay_period_end)->format('M d, Y') }}"

                                    data-basic="{{ number_format((float)($record->basic_salary ?? 0), 2) }}"

                                    data-allowances="{{ number_format((float)($record->allowances ?? 0), 2) }}"

                                    data-deductions="{{ number_format((float)($record->deductions ?? 0), 2) }}"

                                    data-gross="{{ number_format((float)($record->gross_pay ?? 0), 2) }}"

                                    data-net="{{ number_format((float)($record->net_pay ?? 0), 2) }}"

                                    data-status="{{ $record->status ?? 'Pending' }}"
                                >
                                    View Details
                                </button>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" style="text-align:center;padding:25px;">
                                No payroll records available.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- PAYROLL DETAILS MODAL -->

<div class="modal" id="payrollModal">

    <div class="modal-content">

        <h2>Payroll Details</h2>

        <hr>

        <p><strong>Employee ID:</strong> <span id="detailId"></span></p>
        <p><strong>Employee Name:</strong> <span id="detailName"></span></p>
        <p><strong>Pay Period:</strong> <span id="detailPeriod"></span></p>
        <p><strong>Basic Salary:</strong> ₱<span id="detailBasic"></span></p>
        <p><strong>Allowances:</strong> ₱<span id="detailAllowances"></span></p>
        <p><strong>Deductions:</strong> ₱<span id="detailDeductions"></span></p>
        <p><strong>Gross Pay:</strong> ₱<span id="detailGross"></span></p>
        <p><strong>Net Pay:</strong> ₱<span id="detailNet"></span></p>
        <p><strong>Status:</strong> <span id="detailStatus"></span></p>

        <div class="modal-buttons">

            <button type="button" class="generate-btn" id="generatePayslipBtn">
                Generate Payslip
            </button>

            <button type="button" class="close-btn" id="closePayrollModal">
                Close
            </button>

        </div>

    </div>

</div>

<footer>
    <strong>JOLERY</strong><br>
    PAYROLL MANAGEMENT SOLUTIONS<br>
    People. Payroll. Progress.
    <br><br>
    © {{ date('Y') }} JOLERY. All Rights Reserved.
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // =====================================
    // SEARCH AND FILTER
    // =====================================

    const search = document.getElementById('payrollSearch');
    const filter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('.payroll-row');
    const count = document.getElementById('payrollCount');

    function filterPayroll() {

        const keyword = search.value.toLowerCase().trim();
        const selectedStatus = filter.value.toLowerCase();

        let visible = 0;

        rows.forEach(function(row) {

            const text = row.dataset.search.toLowerCase();
            const status = row.dataset.status.toLowerCase();

            const matchesSearch = text.includes(keyword);

            const matchesStatus =
                selectedStatus === 'all' ||
                selectedStatus === status;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }

        });

        count.textContent =
            'Showing ' + visible + ' of ' + rows.length + ' payroll records';

    }

    search.addEventListener('input', filterPayroll);
    filter.addEventListener('change', filterPayroll);

    filterPayroll();


    // =====================================
    // PAYROLL MODAL
    // =====================================

    const modal = document.getElementById('payrollModal');

    const closeButton = document.getElementById('closePayrollModal');

    const generateButton = document.getElementById('generatePayslipBtn');

    let selectedPayroll = null;


    // VIEW DETAILS

    document.querySelectorAll('.view-payroll-btn').forEach(function(button) {

        button.addEventListener('click', function() {

            selectedPayroll = {
                id: this.dataset.id,
                name: this.dataset.name,
                period: this.dataset.period,
                basic: this.dataset.basic,
                allowances: this.dataset.allowances,
                deductions: this.dataset.deductions,
                gross: this.dataset.gross,
                net: this.dataset.net,
                status: this.dataset.status
            };

            document.getElementById('detailId').textContent = selectedPayroll.id;
            document.getElementById('detailName').textContent = selectedPayroll.name;
            document.getElementById('detailPeriod').textContent = selectedPayroll.period;
            document.getElementById('detailBasic').textContent = selectedPayroll.basic;
            document.getElementById('detailAllowances').textContent = selectedPayroll.allowances;
            document.getElementById('detailDeductions').textContent = selectedPayroll.deductions;
            document.getElementById('detailGross').textContent = selectedPayroll.gross;
            document.getElementById('detailNet').textContent = selectedPayroll.net;
            document.getElementById('detailStatus').textContent = selectedPayroll.status;

            modal.style.display = 'flex';

        });

    });


    // CLOSE MODAL

    function closeModal() {
        modal.style.display = 'none';
    }

    closeButton.addEventListener('click', closeModal);

    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });


    // =====================================
    // GENERATE JOLERY PAYSLIP
    // =====================================

    generateButton.addEventListener('click', function() {

        if (!selectedPayroll) {
            alert('Please select a payroll record first.');
            return;
        }

        const slip = window.open('', '_blank', 'width=1000,height=800');

        if (!slip) {
            alert('Please allow pop-ups in your browser.');
            return;
        }

        function escapeHTML(value) {
            return String(value).replace(/[&<>"']/g, function(char) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                }[char];
            });
        }

        const p = {
            id: escapeHTML(selectedPayroll.id),
            name: escapeHTML(selectedPayroll.name),
            period: escapeHTML(selectedPayroll.period),
            basic: escapeHTML(selectedPayroll.basic),
            allowances: escapeHTML(selectedPayroll.allowances),
            deductions: escapeHTML(selectedPayroll.deductions),
            gross: escapeHTML(selectedPayroll.gross),
            net: escapeHTML(selectedPayroll.net),
            status: escapeHTML(selectedPayroll.status),
            date: new Date().toLocaleDateString()
        };

        slip.document.open();

        slip.document.write(`<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>JOLERY Employee Payslip - ${p.name}</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 30px;
    background: #f2f5f7;
    font-family: Arial, sans-serif;
    color: #253746;
}

.payslip {
    max-width: 850px;
    margin: auto;
    padding: 45px;
    background: white;
    border: 1px solid #d8e0e5;
}

.brand {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 3px solid #123448;
    padding-bottom: 22px;
    gap: 15px;
}

.brand-left {
    display: flex;
    align-items: center;
    gap: 15px;
}

.logo {
    width: 65px;
    height: 65px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #10b981, #087f68);
    border-radius: 12px;
    color: #082332;
    font-size: 26px;
    font-weight: 900;
}

.brand h1 {
    color: #123448;
    font-size: 32px;
    letter-spacing: 2px;
    margin: 0;
}

.brand h2 {
    color: #0a9875;
    font-size: 13px;
    letter-spacing: 1px;
    margin: 5px 0;
}

.brand p {
    color: #647482;
    font-size: 11px;
    font-style: italic;
    margin: 0;
}

.label {
    background: #123448;
    color: white;
    padding: 12px 15px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
}

.meta {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin: 25px 0;
    color: #647482;
    font-size: 12px;
}

.section-title {
    font-size: 15px;
    color: #123448;
    border-bottom: 1px solid #d8e0e5;
    padding-bottom: 10px;
    margin: 25px 0 15px;
}

.details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px 30px;
}

.detail span {
    display: block;
    color: #71808c;
    font-size: 11px;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.detail strong {
    color: #263b4a;
    font-size: 14px;
}

.salary {
    background: #f0f5f7;
    border-left: 5px solid #0a9875;
    padding: 25px;
    margin-top: 25px;
}

.salary-row {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin: 12px 0;
    font-size: 14px;
}

.net {
    border-top: 1px solid #cbd7dd;
    padding-top: 18px;
    margin-top: 18px;
    color: #078765;
    font-size: 22px;
    font-weight: bold;
}

.signatures {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 45px;
    margin-top: 75px;
}

.signature {
    text-align: center;
    border-top: 1px solid #647482;
    padding-top: 10px;
    color: #52616d;
    font-size: 12px;
}

.footer {
    text-align: center;
    margin-top: 45px;
    color: #89959d;
    font-size: 10px;
    line-height: 1.7;
}

.print-area {
    text-align: center;
    margin-top: 25px;
}

.print-area button {
    background: #0a9875;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

@media(max-width:600px) {
    body {
        padding: 10px;
    }

    .payslip {
        padding: 20px;
    }

    .brand {
        flex-direction: column;
        align-items: flex-start;
    }

    .details {
        grid-template-columns: 1fr;
    }

    .meta {
        flex-direction: column;
    }

    .signatures {
        gap: 20px;
    }
}

@media print {
    body {
        padding: 0;
        background: white;
    }

    .payslip {
        border: none;
        max-width: none;
    }

    .print-area {
        display: none;
    }

    @page {
        size: A4 portrait;
        margin: 12mm;
    }
}

</style>

</head>

<body>

<div class="payslip">

    <div class="brand">

        <div class="brand-left">

            <div class="logo">JL</div>

            <div>
                <h1>JOLERY</h1>
                <h2>PAYROLL MANAGEMENT SOLUTIONS</h2>
                <p>People. Payroll. Progress.</p>
            </div>

        </div>

        <div class="label">
            EMPLOYEE PAYSLIP
        </div>

    </div>

    <div class="meta">
        <span>JOLERY Payroll Management Solutions</span>
        <span>Generated: ${p.date}</span>
    </div>

    <h3 class="section-title">EMPLOYEE INFORMATION</h3>

    <div class="details">

        <div class="detail">
            <span>Employee ID</span>
            <strong>${p.id}</strong>
        </div>

        <div class="detail">
            <span>Employee Name</span>
            <strong>${p.name}</strong>
        </div>

        <div class="detail">
            <span>Pay Period</span>
            <strong>${p.period}</strong>
        </div>

        <div class="detail">
            <span>Payroll Status</span>
            <strong>${p.status}</strong>
        </div>

    </div>

    <h3 class="section-title">PAY SUMMARY</h3>

    <div class="salary">

        <div class="salary-row">
            <span>Basic Salary</span>
            <strong>₱${p.basic}</strong>
        </div>

        <div class="salary-row">
            <span>Allowances</span>
            <strong>₱${p.allowances}</strong>
        </div>

        <div class="salary-row">
            <span>Gross Pay</span>
            <strong>₱${p.gross}</strong>
        </div>

        <div class="salary-row">
            <span>Deductions</span>
            <strong>(₱${p.deductions})</strong>
        </div>

        <div class="salary-row net">
            <span>NET PAY</span>
            <span>₱${p.net}</span>
        </div>

    </div>

    <div class="signatures">

        <div class="signature">
            Prepared By / Authorized Personnel
        </div>

        <div class="signature">
            Employee Signature
        </div>

    </div>

    <div class="footer">

        <strong>JOLERY PAYROLL MANAGEMENT SOLUTIONS</strong><br>

        PEOPLE. PAYROLL. PROGRESS.<br>

        This is a computer-generated payroll document.<br>

        Please keep this document for your personal records.

    </div>

</div>

<div class="print-area">

    <button onclick="window.print()">
        PRINT / SAVE AS PDF
    </button>

</div>

</body>
</html>`);

        slip.document.close();

        closeModal();

    });


    // =====================================
    // PRINT PAYROLL REPORT
    // =====================================

    window.printPayrollReport = function() {

        const table = document.getElementById('payrollTable');

        const reportWindow = window.open(
            '',
            '_blank',
            'width=1100,height=800'
        );

        if (!reportWindow) {
            alert('Please allow pop-ups in your browser.');
            return;
        }

        const reportRows = Array.from(
            table.querySelectorAll('tbody tr')
        ).filter(function(row) {
            return row.style.display !== 'none';
        }).map(function(row) {
            return '<tr>' + row.cells.length > 0
                ? row.outerHTML
                : '';
        }).join('');

        reportWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>JOLERY Payroll Report</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 30px;
                        color: #123448;
                    }

                    h1 {
                        color: #087f68;
                        text-align: center;
                    }

                    p {
                        text-align: center;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 30px;
                    }

                    th, td {
                        border: 1px solid #ccc;
                        padding: 10px;
                        text-align: left;
                        color: #123448;
                    }

                    th {
                        background: #e8f0f3;
                    }

                    button {
                        padding: 10px 20px;
                        background: #0a9875;
                        color: white;
                        border: none;
                        cursor: pointer;
                    }

                    @media print {
                        button {
                            display: none;
                        }
                    }
                </style>
            </head>

            <body>
                <h1>JOLERY</h1>
                <p>PAYROLL MANAGEMENT SOLUTIONS</p>
                <p>Payroll Report</p>

                <table>
                    ${table.outerHTML}
                </table>

                <br>
                <button onclick="window.print()">Print / Save as PDF</button>
            </body>
            </html>
        `);

        reportWindow.document.close();

    };


    // =====================================
    // PAYROLL ANALYTICS CHART
    // =====================================

    const chartCanvas = document.getElementById('payrollChart');

    if (chartCanvas && typeof Chart !== 'undefined') {

        const labels = @json($payrollChartLabels);

        const grossValues = @json($payrollGrossValues);

        const netValues = @json($payrollNetValues);

        new Chart(chartCanvas, {

            type: 'bar',

            data: {

                labels: labels,

                datasets: [

                    {
                        label: 'Gross Pay',
                        data: grossValues,
                        backgroundColor: '#10b981',
                        borderRadius: 5
                    },

                    {
                        label: 'Net Pay',
                        data: netValues,
                        backgroundColor: '#38bdf8',
                        borderRadius: 5
                    }

                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: true,

                plugins: {

                    legend: {
                        labels: {
                            color: '#ffffff'
                        }
                    }

                },

                scales: {

                    x: {
                        ticks: {
                            color: '#d1e5ef'
                        },

                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            color: '#d1e5ef',

                            callback: function(value) {
                                return '₱' + Number(value).toLocaleString();
                            }
                        },

                        grid: {
                            color: 'rgba(255,255,255,0.08)'
                        }
                    }

                }

            }

        });

    }

});
</script>

</body>
</html>
