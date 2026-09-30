<?php

$pageTitle = 'Not Applicable';
$returnPage = $_GET['return'] ?? '/Aims/front-end/pages/admin/dashboard.php';
ob_start();
?>

<main class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">

    <div class="text-center px-4">

        <!-- Icon -->
        <div class="mb-4">
            <i class="bi bi-display display-1 text-primary"></i>
        </div>

        <!-- Title -->
        <h1 class="fw-bold mb-3">
            Device Not Supported
        </h1>

        <!-- Message -->
        <p class="text-secondary fs-5 mb-4">
            This system is designed for laptops, desktops,
            and tablets in landscape orientation.
        </p>

        <!-- Recommendation -->
        <div class="alert alert-primary d-inline-flex align-items-center gap-2 mb-4">
            <i class="bi bi-arrow-repeat"></i>
            <span>
                Please use a larger screen or rotate your tablet
                to landscape mode.
            </span>
        </div>

        <!-- Additional Information -->
        <p class="text-muted small mb-0">
            Supported devices: Desktop, Laptop, and Landscape Tablet
        </p>

    </div>

</main>

<script>

        function checkDevice() {

            const width = window.innerWidth;
            const height = window.innerHeight;

            // Laptop/Desktop
            const isDesktop = width >= 1024;

            // Tablet Landscape
            const isTabletLandscape =
                width >= 768 &&
                width < 1024 &&
                width > height;

            const isAllowed = isDesktop || isTabletLandscape;

            if (isAllowed) {

                window.location.href =
                    <?= json_encode($returnPage) ?>;

            }
        }

        // Check when page loads
        checkDevice();

        // Check when tablet is rotated
        window.addEventListener("resize", checkDevice);

    </script>

<?php

$pageContent = ob_get_clean();

include __DIR__ . '/../layouts/member.php';