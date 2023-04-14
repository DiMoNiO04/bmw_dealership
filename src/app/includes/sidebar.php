<?php 
	$models = selectAll('models');
?>

<div class="auto__sidebar">
	<ul class="sidebar__list">
		<li class="sidebar__item sidebar__item-active" id="0" model="all">ALL</li>

		<?php foreach($models as $key => $model): ?>
			<li class="sidebar__item" id="<?= $key + 1?>" model="<?= $model['model']?>"><?= $model['model']?></li>	
		<?php endforeach; ?>

	</ul>
</div>