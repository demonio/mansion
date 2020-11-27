<?php
/**
 */
class Caja
{
    #
    public function progreso($titulo, $progreso)
    {
    	$ok = ($progreso=='100') ? 'checked' : 'disabled';
    	$badge = 'red white-text';
    	if ($progreso>75) $badge = 'green white-text';
    	else if ($progreso>25) $badge = ' yellow';
    	?>
		<div class="card">
			<input type="checkbox" <?=$ok?> id="app">
			<label class="mha" for="app"><?=$titulo?></label>
			<span class="badge <?=$badge?>"><?=$progreso?>%</span>
			<div class="progress black">
			    <div class="determinate red darken-1" style="width:<?=$progreso?>%"></div>
			</div>
		</div>
		<?php
    }
}
