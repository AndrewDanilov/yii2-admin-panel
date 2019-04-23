<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="container-fluid">

	<!-- 404 Error Text -->
	<div class="text-center">
		<div style="font-size:100px">404</div>
		<p class="lead">Page Not Found</p>
		<p>It looks like you found a glitch in the matrix...</p>
		<a href="<?= Url::to(['index']) ?>">&larr; Back to Dashboard</a>
	</div>

</div>

