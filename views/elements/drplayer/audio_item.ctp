<?php

?>
	<div href="<?= $path ?>" style="<?= $style ?>" class="item">
	    <div>
	        <div class="fr duration"><?= $duration ?></div>
	        <div class="btn play"></div>
	        <div class="title"><?php if ($artist) : ?><b><?= $artist ?></b> - <?php endif; ?><?= $title ?></div>
	    </div>
	    <div class="player inactive"></div>
	</div>
	
	<div class="clear"></div>
