<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Error 404. Page Not Found.';
?>
<div class="text-center">
	<div class="title-404">404</div>
	<p class="lead">Page Not Found</p>
	<p>It looks like you found a glitch in the matrix...</p>
	<a href="<?= Url::to(['index']) ?>">&larr; Back to Dashboard</a>
</div>