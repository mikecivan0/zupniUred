$(function() {

            $("#primatelj").autocomplete({
			    source: '../ajax/admin/users/nadjiUsera.php?not=' + $("#hfPosiljatelj").val(),
			    minLength: 2,
			    autoFocus: true,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			          $('#primatelj').val(ui.item.ime + " " + ui.item.prezime);
			          $("#hfPrimatelj").val(ui.item.userId);
			        event.preventDefault();				
			    }
				}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
					if(item.userId==3){
						return $( "<li>" )
			        .append( "<a>" + item.ime + " " + item.prezime + ", " + item.alias + "</a>" )
			        .appendTo( ul );
					}else{
						return $( "<li>" )
			        .append( "<a>" + item.ime + " " + item.prezime + ", " + item.username + "</a>" )
			        .appendTo( ul );
					}
			      
			    };

        });
        

 	
 