<?php

$pageTitle = 'Dashboard';
$pageName = "dashboard";

ob_start();
?>

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

<?php

$pageContent = ob_get_clean();

include __DIR__ . '/../../layouts/staff.php';