<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>ListIt</title>
<link   type="text/css"			href="inc/css/jquery.ui.all.css"	rel="stylesheet"/>
<link   type="text/css"			href="inc/css/demos.css"			rel="stylesheet"/>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link   type="text/css"			href="inc/css/koll.css"				rel="stylesheet"/>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript"	src="inc/js/lib.js" ></script>

<script type="text/javascript"  src="inc/js/ckeditor/ckeditor.js"></script>

<!-- script type="text/javascript"	src="inc/js/jquery-1.4.2.js"></script>
<script type="text/javascript"	src="inc/js/ui/jquery.ui.core.js"></script>
<script type="text/javascript"	src="inc/js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript"	src="inc/js/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript"	src="inc/js/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript"	src="inc/js/ui/jquery.ui.slider.js"></script>
<script type="text/javascript"	src="inc/js/ui/jquery.ui.button.js"></script>
<script type="text/javascript"  src="inc/js/ui/jquery.ui.checkbox.js"></script-->

    <script type="text/javascript"	src="inc/js/functions.js"></script>

    
    <script type="text/javascript">
        $( function() {
            $( ".butt1" ).checkboxradio({
                icon: false
            });
        } );
        
function submitsplit()
{
  document.forms.form2.submit();
}

function submitkoll()
{
	//document.forms.form.submit();
}
</script>

<script type="text/javascript">
	$(function() {
		$( "#datum" ).datepicker( { dateFormat: 'dd.mm.yy' }  );

		$( "#aktiv" ).button();

		$( "#editable" ).button();

		
		$("#slideranzSlots").slider({
			value:#anzSlots#,
			min: 1,
			max: 10,
			step: 1,
			animate: true,
			slide: function(event, ui) {
				$("#anzslots").val('' + ui.value);
			}
		});
		
		$("#slideranzstudis").slider({
			value:#anzStudisProSlot#,
			min: 1,
			max: 16,
			step: 1,
			animate: true,
			slide: function(event, ui) {
				$("#anzstudis").val('' + ui.value);
			}
		});
		
		$("#sliderslotdauer").slider({
			value:#slotDauer#,
			min: 5,
			max: 30,
			step: 5,
			animate: true,
			slide: function(event, ui) {
				$("#slotdauer").val('' + ui.value);
			}
		});

		$("#startzeit-endezeit").slider({
			range: true,
			min: 800,
			max: 1600,
			values: ['#kollStart2#', '#kollEnde2#'],
			step: 5,
					
			slide: function(event, ui) {
				
				t0 = change2Time( ui.values[0]);	
				t1 = change2Time( ui.values[1]);
				$("#startzeit").val( t0['h'] + ':' + t0['m'] );
				$("#endezeit").val( t1['h'] + ':' + t1['m'] );;

			}
		});

	$( "#startzeit"  ).val( '#kollStart#'          );
	$( "#endezeit"   ).val( '#kollEnde#'           );
	$( "#anzslots"   ).val('' + #anzSlots#         );
	$( "#anzstudis"  ).val('' + #anzStudisProSlot# );
	$( "#slotdauer"  ).val('' + #slotDauer#        );
	$( "#datum"      ).datepicker( "option", "defaultDate", +0 );
	});


	
</script>

</head>
<body>
<form action="./index2.php" method="post" name="form">
  <table>
    <tr>
      <td>Titel</td>
      <td  colspan="2"><input		id ="kollhead"		name="kollhead"		value="#kollHead#"	type="text"				style="width:100%; margin:5px;" /></td>
    </tr>
    <tr>
      <td>Datum</td>
      <td><input				     id ="datum" 		name="datum"		value="#datum#"	 	type="text"				style="width:80px; margin:5px;"  /></td>
      <td>
		<label style="float:left;"   id="editablelabel"  for="editable">#EDLabel#</label>
		<input style="float:left; " class="butt1"  onclick="toggleButton2( this );"   type="checkbox" name="editable" value="#editable#"   id="editable" #EDAttrib# />

        <label  style="float:right;"  id="aktivlabel"   for="aktiv">#CBLabel#</label>
		<input style="float:right;"  class="butt1"  onclick="toggleButton1( this );"   type="checkbox" name="aktiv"    value="#aktiv#"      id="aktiv" #CBAttrib# />
		</td>
    </tr>
      <td> Info </td>
      <td  colspan="2"><textarea 	id ="kollinfo"		name="kollinfo"		cols="50" 			rows="6"				style="width:100%; margin:5px;">#kollInfo#</textarea></td>
    </tr>
    <tr>
      <td> Zeitraum </td>
      <td><div 						id ="startzeit-endezeit"															style="width:260px; margin:5px;" ></div></td>
      <td><input					id ="startzeit"		name="startzeit"	value="#kollStart#"	type="text"				style="width:40px; margin:5px;"/>
			bis
          <input					id ="endezeit"		name="endezeit"		value="#kollEnde#"	type="text"				style="width:40px; margin:5px;" /></td>
    </tr>

  	<tr>
      <td> Slotdauer </td>
      <td><div 						id ="sliderslotdauer" 													 			style="width:260px; margin:5px;"></div></td>
      <td><input 					id ="slotdauer" 	name="slotdauer"	value="#slotDauer#"	type="text"	 			style="width:25px; margin:5px;"/></td>
    </tr>

      <tr>
          <td> Studi/Slot </td>
          <td><div 						id ="slideranzstudis"																style="width:260px; margin:5px;" ></div></td>
          <td><input  					id ="anzstudis"		name="anzstudis"	value="#anzStudisProSlot#"	type="text"		style="width:40px; margin:5px;"/></td>
      </tr>
<tr>

<td style="vertical-align:bottom;">
</td>
    
<td style="vertical-align:bottom;"> 
  <input type="hidden" name="listID" 		value="#listID#"	/>

 <div id="popup0" class="lipop ">
    <input  style="float:right; margin-right:0px; height:50px;" type="button" value=" DELETE? " onclick="show_block('popup1'),  false" />
 </div>
  
  <div style="display:none; visibility:hidden;" class="lipop ">
    <input style="float:right; margin-right:0px; height:50px;" type="submit" name="aktion"	value=" SAVE "		/>
  </div>

  <div style="display:none;"  id="popup1" class="lipop ">
    <input style=" float: right; margin-right: 0px; height: 50px; background: red; color: white;  " type="submit" name="aktion"	value="DELETE! "  onclick="hide_block('popup0'), show_block('popup1'); false"	/>
  </div>
</td>

<td style="vertical-align:bottom;"> 
<input style="float:right; width:175px; vertical-align: middle; margin-right:0px; height:50px; " type="submit" name="aktion"	value=" SAVE "		/>
 <input style="float:right; height:50px; " type="submit" name="aktion"	value=" NEW "	/>
 </td>
</tr>

</table>
   <a  style="float:left; color:#000; text-decoration:none; font-family:Arial, Helvetica, sans-serif"; href="help.html" target="_blank">HELP</a>		<br />
</form>
 #listlist#
 <hr />
 #userlist#
</body>

<script type="text/javascript">
CKEDITOR.replace( 'kollinfo' );
</script>

</html>