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

        <small class="text-uppercase text-muted fw-semibold px-2"> Main </small>

        <ul class="nav flex-column mt-2">

            <li class="nav-item">
                <a href="/Aims/admin-dashboard" class="nav-link <?php echo ($pageName === 'dashboard') ? 'active' : ''; ?>">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/Aims/create-member" class="nav-link <?php echo ($pageName === 'members') ? 'active' : ''; ?>">
                    <i class="bi bi-people"></i>
                    <span>Members</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link <?php echo ($pageName === 'contributions') ? 'active' : ''; ?>">
                    <i class="bi bi-wallet2"></i>
                    <span>CBU Contributions</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link <?php echo ($pageName === 'loans') ? 'active' : ''; ?>">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Loan Applications</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link <?php echo ($pageName === 'repayments') ? 'active' : ''; ?>">
                    <i class="bi bi-cash-stack"></i>
                    <span>Repayments</span>
                </a>
            </li>

        </ul>

        <small class="text-uppercase text-muted fw-semibold px-2 d-block mt-4"> Management</small>

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

        <a href="#" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>

    </div>

</aside>