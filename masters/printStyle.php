<style>
		<?php if($podaci->rukopis == 1) { ?>		
			@font-face {
				font-family: rukopis;
				src: url('../../fonts/rukopis.ttf');
			}
			
			.rukopis, #datumDnevnika span{
				font-family: rukopis !important;
				color: black;
				letter-spacing: 1px;
			}
			
			.fwn{ 
				font-weight: normal !important;
				}
			
			.fwb{ 
				font-weight: bold !important;
				}	
				
			.ls{
				letter-spacing: 1.8mm; 
				}	
		<?php }else{ ?>
			.b{ 
				font-weight: bold !important;
				}
				
			.ls{
				letter-spacing: 1.45mm; 
				}
		<?php } ?>
</style>