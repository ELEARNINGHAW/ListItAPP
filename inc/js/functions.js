    function change2Time( t )
	{
    	var time=new Array();
		
		mm=  t%100;
		if (mm <  10) mm = "0"+mm;
		if (mm >= 60) mm = "55";
       
	    time['m'] = mm;
		time['h'] = Math.floor(t/100);
	     
		return time; 
	}
	
	function toggleButton1( t1 )
	{
		var oldlabel = $( "#aktiv" ).button( "option", "label" );

        if ( oldlabel == 'OFFLINE' )
        { var newlabel = 'ONLINE ';
          var newVal = 1;
          var newButtonColor = 'buttonON';
        }
		else if ( oldlabel == 'ONLINE ' )
		{ var newlabel = 'OFFLINE';
		  var newVal = 0;
          var newButtonColor = 'buttonOff';
		}


		$( "#aktiv" ).button( "option", "label", newlabel );
        $( "#aktiv" ).val(newVal);
/*        $('#aktivlabel').addClass( newButtonColor );*/

	}	

	function toggleButton2( t2 )
	{
		var oldlabel = $( "#editable" ).button( "option", "label" );

		if (oldlabel ==  "NICHT AKTIV"  )
		{  
			var newlabel = "AKTIV";
            var newVal = 1;
            var newButtonColor = 'buttonOff';
		}
		else if (oldlabel == "AKTIV" )
		{
			var newlabel =  "NICHT AKTIV";
			var newVal = 0;
            var newButtonColor = 'buttonON';
		}

		$( "#editable" ).button( "option", "label", newlabel );
		$( "#editable" ).val(newVal);
        $('#editablelabel').addClass( newButtonColor );
	}	
	

//  ---------- TABS ------------------------------------------------------------------------------------------------------	
/*	
	$(function() {
		var $tab_title_input = $('#tab_title'), $tab_content_input = $('#tab_content');
		var tab_counter = 2;

		// tabs init with a custom tab template and an "add" callback filling in the content
		var $tabs = $('#tabs').tabs({
			tabTemplate: '<li><a href="#{href}">#{label}</a> <span class="ui-icon ui-icon-close">Remove Tab</span></li>',
			add: function(event, ui) {
				var tab_content = $tab_content_input.val() || 'Tab '+tab_counter+' content.';
				$(ui.panel).append('<p>'+tab_content+'</p>');
			}
		});

		// modal dialog init: custom buttons and a "close" callback reseting the form inside
		var $dialog = $('#dialog').dialog({
			autoOpen: false,
			modal: true,
			buttons: {
				'Add': function() {
					addTab();
					$(this).dialog('close');
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			},
			open: function() {
				$tab_title_input.focus();
			},
			close: function() {
				$form[0].reset();
			}
		});

		// addTab form: calls addTab function on submit and closes the dialog
		var $form = $('form',$dialog).submit(function() {
			addTab();
			$dialog.dialog('close');
			return false;
		});

		// actual addTab function: adds new tab using the title input from the form above
		function addTab() {
			var tab_title = $tab_title_input.val() || 'Tab '+tab_counter;
			$tabs.tabs('add', '#tabs-'+tab_counter, tab_title);
			tab_counter++;
		}

		// addTab button: just opens the dialog
		$('#add_tab')
			.button()
			.click(function() {
				$dialog.dialog('open');
			});

		// close icon: removing the tab on click
		// note: closable tabs gonna be an option in the future - see http://dev.jqueryui.com/ticket/3924
		$('#tabs span.ui-icon-close').live('click', function() {
			var index = $('li',$tabs).index($(this).parent());
			$tabs.tabs('remove', index);
		});
	});	
	*/
// -------------------------------------------------------------------------------------------------------	
	