<?php

$pageTitle = 'My CBU';

ob_start();
?>

<h2>My CBU</h2>

<div class="card">
    <div class="card-body">

        <p>Current CBU Balance</p>

        <h1>₱10,000.00</h1>

    </div>
</div>

<?php

$content = ob_get_clean();

include __DIR__ . '/../../layouts/member.php';