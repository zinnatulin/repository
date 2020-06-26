<?php
use yii\helpers\Html;
?>
<p>Вы ввели следующую информацию:</p>

<ul>
	<li><label>Name</label>: <?= Html::encode($model->name) ?></li>
	<li><label>Email</label>: <?= Html::encode($model->email) ?></li>
</ul>
<ul>
	<p>На данный момент в БД:</p>
	<?php 
	foreach ($files[0] as $file) { 
	?>
		<li>Файл: <?= Html::encode($file['name'] . " " . $file['date']) ?></li>
	<?php
	}
	?>
</ul>