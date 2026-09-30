<?php

$pageTitle = 'CBU Management';

ob_start();
?>

<h2>CBU Management</h2>

<!-- Payroll CBU interface -->

<?php

$content = ob_get_clean();

include __DIR__ . '/../../layouts/staff.php';