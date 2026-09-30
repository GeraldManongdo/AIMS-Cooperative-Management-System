<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AIMS | Admin Dashboard</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >

    <style>
        :root {
            --primary: #0d6efd;
            --sidebar-width: 250px;
            --topbar-height: 64px;
            --body-bg: #f5f7fa;
            --sidebar-bg: #ffffff;
            --border-color: #e9ecef;
            --text-muted: #6c757d;
        }

        body {
            background: var(--body-bg);
            color: #212529;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            z-index: 1030;
        }

        .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.25rem;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-nav {
            padding: 1rem 0.75rem;
        }

        .sidebar .nav-link {
            color: #495057;
            padding: 0.7rem 0.85rem;
            margin-bottom: 0.25rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar .nav-link:hover {
            background: #f1f3f5;
            color: var(--primary);
        }

        .sidebar .nav-link.active {
            background: #e7f1ff;
            color: var(--primary);
            font-weight: 500;
        }

        .sidebar .nav-link i {
            font-size: 1.1rem;
        }

        /* Main */
        .main {
            margin-left: var(--sidebar-width);
        }

        /* Topbar */
        .topbar {
            height: var(--topbar-height);
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        /* Profile */
        .profile-button {
            border: 0;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.35rem 0.5rem;
            border-radius: 0.5rem;
        }

        .profile-button:hover {
            background: #f8f9fa;
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--primary);
            color: #ffffff;
            font-weight: 600;
        }

        /* Content */
        .content {
            padding: 1.5rem;
        }

        .stat-card {
            border: 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
            background: #e7f1ff;
            color: var(--primary);
            font-size: 1.25rem;
        }

        /* Mobile */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.2s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .menu-button {
                display: block !important;
            }
        }

        .menu-button {
            display: none;
            border: 0;
            background: transparent;
            font-size: 1.4rem;
        }
    </style>
</head>

<body>

<!-- ================= SIDEBAR ================= -->
<aside class="sidebar" id="sidebar">

    <!-- Logo -->
    <div class="sidebar-brand">
        <a href="#" class="text-decoration-none d-flex align-items-center gap-2">
            <div class="bg-primary text-white rounded-2 p-2">
                <i class="bi bi-buildings"></i>
            </div>

            <div>
                <div class="fw-bold text-dark">AIMS</div>
                <small class="text-muted">AMCOOP</small>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">

        <small class="text-uppercase text-muted fw-semibold px-2">
            Main
        </small>

        <ul class="nav flex-column mt-2">

            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-people"></i>
                    <span>Members</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-wallet2"></i>
                    <span>CBU Contributions</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Loan Applications</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-cash-stack"></i>
                    <span>Repayments</span>
                </a>
            </li>

        </ul>

        <small class="text-uppercase text-muted fw-semibold px-2 d-block mt-4">
            Management
        </small>

        <ul class="nav flex-column mt-2">

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-bar-chart"></i>
                    <span>Reports</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-person-gear"></i>
                    <span>User Accounts</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-shield-check"></i>
                    <span>Activity Logs</span>
                </a>
            </li>

        </ul>

    </nav>

    <!-- Bottom navigation -->
    <div class="position-absolute bottom-0 start-0 w-100 p-3 border-top">

        <a href="#" class="nav-link text-secondary mb-1">
            <i class="bi bi-gear"></i>
            <span>Settings</span>
        </a>

        <a href="#" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>

    </div>

</aside>


<!-- ================= MAIN ================= -->
<div class="main">

    <!-- ================= TOPBAR ================= -->
    <header class="topbar">

        <div class="d-flex align-items-center w-100">

            <!-- Mobile menu -->
            <button
                class="menu-button"
                type="button"
                onclick="toggleSidebar()"
            >
                <i class="bi bi-list"></i>
            </button>

            <div class="ms-auto">

                <!-- Profile Dropdown -->
                <div class="dropdown">

                    <button
                        class="profile-button dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >

                        <div class="profile-avatar">
                            AD
                        </div>

                        <div class="text-start d-none d-sm-block">
                            <div class="fw-semibold small">
                                Admin
                            </div>

                            <div class="text-muted small">
                                Administrator
                            </div>
                        </div>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person me-2"></i>
                                My Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear me-2"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item text-danger" href="#">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </header>


    <!-- ================= CONTENT ================= -->
    <main class="content">

        <!-- Page Header -->
        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Dashboard
            </h4>

            <p class="text-muted mb-0">
                Overview of cooperative members, contributions, and loan transactions.
            </p>

        </div>


        <!-- ================= STATISTICS ================= -->
        <div class="row g-3 mb-4">

            <!-- Members -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="card stat-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                                <p class="text-muted small mb-1">
                                    Total Members
                                </p>

                                <h4 class="fw-bold mb-0">
                                    200
                                </h4>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-people"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- CBU -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="card stat-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                                <p class="text-muted small mb-1">
                                    Total CBU
                                </p>

                                <h4 class="fw-bold mb-0">
                                    ₱450,000
                                </h4>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-wallet2"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Active Loans -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="card stat-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                                <p class="text-muted small mb-1">
                                    Active Loans
                                </p>

                                <h4 class="fw-bold mb-0">
                                    24
                                </h4>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Pending -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="card stat-card h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between">

                            <div>
                                <p class="text-muted small mb-1">
                                    Pending Applications
                                </p>

                                <h4 class="fw-bold mb-0">
                                    8
                                </h4>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- ================= LOWER CONTENT ================= -->
        <div class="row g-4">

            <!-- Recent Transactions -->
            <div class="col-12 col-xl-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white border-0 pt-4 px-4">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h6 class="fw-bold mb-1">
                                    Recent Transactions
                                </h6>

                                <p class="text-muted small mb-0">
                                    Latest cooperative transactions
                                </p>
                            </div>

                            <a href="#" class="btn btn-sm btn-outline-primary">
                                View All
                            </a>

                        </div>

                    </div>

                    <div class="card-body px-4">

                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Transaction</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="fw-semibold">
                                                Juan Dela Cruz
                                            </div>
                                            <small class="text-muted">
                                                MEM-001
                                            </small>
                                        </td>

                                        <td>
                                            CBU Contribution
                                        </td>

                                        <td>
                                            ₱1,500
                                        </td>

                                        <td>
                                            <span class="badge text-bg-success">
                                                Completed
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="fw-semibold">
                                                Maria Santos
                                            </div>
                                            <small class="text-muted">
                                                MEM-002
                                            </small>
                                        </td>

                                        <td>
                                            Loan Application
                                        </td>

                                        <td>
                                            ₱15,000
                                        </td>

                                        <td>
                                            <span class="badge text-bg-warning">
                                                Pending
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="fw-semibold">
                                                Pedro Reyes
                                            </div>
                                            <small class="text-muted">
                                                MEM-003
                                            </small>
                                        </td>

                                        <td>
                                            Loan Repayment
                                        </td>

                                        <td>
                                            ₱2,000
                                        </td>

                                        <td>
                                            <span class="badge text-bg-success">
                                                Completed
                                            </span>
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Quick Actions -->
            <div class="col-12 col-xl-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h6 class="fw-bold mb-1">
                            Quick Actions
                        </h6>

                        <p class="text-muted small mb-3">
                            Common administrative tasks
                        </p>

                        <div class="d-grid gap-2">

                            <a href="#" class="btn btn-primary">
                                <i class="bi bi-person-plus me-2"></i>
                                Manage Members
                            </a>

                            <a href="#" class="btn btn-outline-primary">
                                <i class="bi bi-upload me-2"></i>
                                Import CBU Records
                            </a>

                            <a href="#" class="btn btn-outline-primary">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                Review Loan Applications
                            </a>

                            <a href="#" class="btn btn-outline-secondary">
                                <i class="bi bi-bar-chart me-2"></i>
                                Generate Reports
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>