<?php
$pageTitle = $pageTitle ?? 'AIMS';
include __DIR__ . '/../components/head.php';

?>

<!-- ================= MAIN ================= -->
<div class="main">

	<main class="content">
		<?= $pageContent ?? '' ?>
	</main>

</div>


<?php
include __DIR__ . '/../components/footer.php';

include __DIR__ . '/../components/foot.php';
?>