<div class="large-12 columns">
	<?php Html::Textarea('Kada, kako i zašto je prekinuta ženidbena veza ili izvanbračna zajednica?', 'prekidVeze', 'prekidVeze',null,array('width'=>'100%','height'=>'85px !important'),null,null) ?>
</div>
<div class="large-12 columns">
	<?php Html::Input('Imate li obaveza prema osobi s kojom ste bili u toj ženidbenoj vezi ili izvanbračnoj zajednici i koje?', 'text', 'obaveze', 'obaveze') ?>
</div>
<div class="large-12 columns">
	<?php Html::Input('Ispunjavate li ih?', 'text', 'ispunjavanje', 'ispunjavanje') ?>
</div>
<div class="large-12 columns">
	<?php Html::Textarea('Koje obaveze imate prema djeci rođenoj u toj ženidbenoj vezi ili izvanbračnoj zajednici? Kako ih ispunjavate?', 'obavezePremaDjeci', 'obavezePremaDjeci',null,array('width'=>'100%','height'=>'85px !important'),null,null) ?>
</div>
<div class="large-12 columns">
	<?php Html::Textarea('Imate li još nešto reći s obzirom na tu ženidbenu vezu - izvanbračnu zajednicu?', 'dodatno', 'dodatno',null,array('width'=>'100%','height'=>'85px !important'),null,null) ?>
</div>
<div class="large-6 columns">
	<?php Html::Input('Mjesto', 'text', 'mjesto', 'mjesto') ?>
</div>
<div class="large-6 columns">
	<?php Html::Input('Datum', 'date', 'datum', 'datum',null,null,date("Y-m-d")) ?>
</div>