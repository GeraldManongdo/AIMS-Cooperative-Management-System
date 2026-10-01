<?php
$pageTitle = $pageTitle ?? 'AIMS';
include __DIR__ . '/../components/head.php';

include __DIR__ . '/../components/sidebar.php';
?>

<!-- ================= MAIN ================= -->
<div class="main">

    <?php
    include __DIR__ . '/../components/header.php';
    ?>

    <!-- ================= CONTENT ================= -->
    <main class="content">
        <?= $pageContent ?? '' ?>
    </main>

</div>

<script src="/AIMS-Cooperative-Management-System/front-end/assets/js/device-check.js"></script>

<?php
include __DIR__ . '/../components/footer.php';

include __DIR__ . '/../components/foot.php';
?>