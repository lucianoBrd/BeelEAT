<?php

if(isset($alert))
{
?>
	<div class="note note-<?= isset($alert['classAlert']) ? $alert['classAlert'] : 'danger' ?> note-shadow">
		<p>
			<?= $alert['messageAlert'] ?>
		</p>
	</div>
<?php
}
