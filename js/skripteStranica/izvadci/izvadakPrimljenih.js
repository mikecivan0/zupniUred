tinymce.init({
	selector:'#napomene',
    theme: 'modern',
    height : 134,
    width: 742,
    toolbar: 'styleselect | bullist numlist',
    style_formats: [
    	{ title: '6px', inline: 'span', styles: { 'font-size': '6px'} },
        { title: '7px', inline: 'span', styles: { 'font-size': '7px'} },
        { title: '8px', inline: 'span', styles: { 'font-size': '8px'} },
        { title: '10px', inline: 'span', styles: { 'font-size': '10px'} },
        { title: '12px', inline: 'span', styles: { 'font-size': '12px'} },
        { title: '14px', inline: 'span', styles: { 'font-size': '14px'} },
    ]
});
             

$(function(){		
	$("#printP").children().click(function(){
	  $("#izvadakPrimljenih").attr('action', '../../printanje/izvadci/izvadakPrimljenih.php?vrstaDokumenta=15');
	  $('#izvadakPrimljenih').submit();
	});		
	
	$("#previewP").children().click(function(){
	  $('#izvadakPrimljenih').attr('action', '../../printanje/izvadci/izvadakPrimljenih.php?preview=true&vrstaDokumenta=15');
	  $('#izvadakPrimljenih').submit();
	});			
	
	$("#saveP").children().click(function(){
		if($("#imePrezimeZanimanje").val().length==0){
			swal('Greška!', 'Obavezno unijeti ime i prezime prije spremanja', 'error');
		}else{
			 $('form').attr('action', window.location.pathname);
			 $('form').removeAttr('target');
			 $('form').submit();
		}		
	});		
});