<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>ListIt</title>
<link rel="shortcut icon" type="image/x-icon" href="inc/img/favicon.ico"        />
<link rel="stylesheet"    type="text/css"	  href="inc/css/jquery.ui.all.css"	/>
<link rel="stylesheet"    type="text/css"	  href="inc/css/demos.css"			/>
<link rel="stylesheet"    type="text/css"	  href="inc/css/jquery-ui.css"      />
<link rel="stylesheet"    type="text/css"     href="inc/css/koll.css"           />
<link rel="stylesheet"    type="text/css"     href="inc/css/jquery.modal.min.css" />


<script type="text/javascript" src="inc/js/jquery-3.6.0.min.js">                        </script>
<script type="text/javascript" src="inc/js/jquery-ui-1.12.1/jquery-ui.min.js">          </script>


<script type="text/javascript"	src="inc/js/lib.js" >                                   </script>
<script type="text/javascript"  src="inc/js/ckeditor/ckeditor.js">                      </script>
<script type="text/javascript"	src="inc/js/functions.js">                              </script>

<script type="text/javascript"	src="inc/js/jquery.modal.min.js"></script>

    
<script type="text/javascript">
function submitsplit() { document.forms.form2.submit(); }
function submitkoll()  { //document.forms.form.submit();
}

$(function() {
    CKEDITOR.replace( 'kollinfo' );
    
    $( "#startzeit"  ).val( '#startZeit#'          );
    $( "#endezeit"   ).val( '#endeZeit#'           );
    $( "#anzslots"   ).val('' + #anzSlots#         );
    $( "#anzstudis"  ).val('' + #anzStudisProSlot# );
    $( "#slotdauer"  ).val('' + #slotDauer#        );

    $( ".butt1" ).checkboxradio({ icon: false });
    $( "#datum" ).datepicker( { 	dateFormat: 'dd M yy', }  );
 
    $( "#activeT_start" ).datepicker( { dateFormat: 'dd M yy',   onClose: function( ) { setAAnAus(1); } } );
    $( "#activeT_end"   ).datepicker( {	dateFormat: 'dd M yy',   onClose: function( ) { setAAnAus(2); } } );
 
    $( "#visibleT_start" ).datepicker( { dateFormat: 'dd M yy', onClose: function( )  { setVAnAus(1); } } );
    $( "#visibleT_end"   ).datepicker( { dateFormat: 'dd M yy', onClose: function( )  { setVAnAus(2); } } );
    
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
        values: ['#startZeit2#', '#endeZeit2#'],
        step: 5,
        
        slide: function(event, ui) {
          t0 = change2Time( ui.values[ 0 ]);
          t1 = change2Time( ui.values[ 1 ]);
          $( "#startzeit" ).val( t0['h'] + ':' + t0['m'] );
          $( "#endezeit"  ).val( t1['h'] + ':' + t1['m'] );
        }
    });
});

function setVAnAus( d )
{  now = Date.now();
   vts = Date.parse( $( '#visibleT_start').val() );
   vte = Date.parse( $( '#visibleT_end'  ).val() );
   console.log( " D:"+d+"- " )
   console.log( " S:"+vts+"- " )
   console.log( " E:"+vte+"- " )
   if ( isNaN( vts ) ) {  vts = 0;                }
   if ( isNaN( vte ) ) {  vte = 8640000000000000; }
   
   if ( vts <= now && now <= vte )   { toggleVisible_A( 1 ); }
   else                              { toggleVisible_A( 0 ); }
}

function setAAnAus( d )
{
  now = Date.now();
  vts = Date.parse( $( '#activeT_start').val() );
  vte = Date.parse( $( '#activeT_end'  ).val() );

  if ( isNaN( vts ) ) {  vts = 0;                }
  if ( isNaN( vte ) ) {  vte = 8640000000000000; }

  if ( vts <= now && now <= vte )   { toggleActive_A( 1 ); }
  else                              { toggleActive_A( 0 ); }
}

</script>


</head>
<body>
<div style="padding:10px; margin:10px; float:left; width:30%;border: solid black 1px ; min-width: 600px; background-color:#e9e9e9; background-image: url('inc/img/bggrey.jpg'); overflow:auto; float: left">
<form action="./index.php" method="post" name="form">
  <table>
    <tr><td> Titel    </td><td colspan="2"><input	  class="title" 	id ="kollhead"		name="kollhead"		value="#kollHead#"	type="text"	                         /></td></tr>
    <tr><td> Datum    </td><td colspan="2"><input     class="date"      id ="datum" 		name="datum"		value="#datum#"	 	type="text"	                         /></td></tr>
    <tr><td> Info     </td><td colspan="2"><textarea                    id ="kollinfo"		name="kollinfo"		cols="50" 			rows="4"		>#kollInfo#</textarea></td> </tr>
    <tr><td> Zeitraum </td>
        <td><div                 id ="startzeit-endezeit"															    style="width:260px; margin:5px;" ></div></td>
        <td><input               id ="startzeit"		name="startzeit"	value="#startZeit#"	        type="text"		style="width:40px; margin:5px;"/> bis
            <input               id ="endezeit"		    name="endezeit"		value="#endeZeit#"	        type="text"		style="width:40px; margin:5px;" /></td>
    </tr>
  	<tr><td> Slotdauer </td>
        <td><div                 id ="sliderslotdauer" 													 			    style="width:260px; margin:5px;"></div></td>
        <td><input               id ="slotdauer" 	    name="slotdauer"	value="#slotDauer#"	        type="text"	 	style="width:25px; margin:5px;"/></td>
    </tr>

    <tr><td> Studi/Slot </td>
        <td><div 				id ="slideranzstudis"																    style="width:260px; margin:5px;" ></div></td>
        <td><input  			id ="anzstudis"         name="anzstudis"	value="#anzStudisProSlot#"	type="text"		style="width:40px; margin:5px;"/></td>
    </tr>


      <tr>
          <td> ANONYM </td>
          <td>
              <label class="buttX"          id = "anonymlabelT" for="anonymT"> TIMER     </label><input style="float:left; " class="butt1" onclick="toggleAnonym_T( );" type="checkbox" name="anonymT" value="#anonymT#" id="anonymT" #ANO_T#/>
              <div   class="buttL#activeL#" id = "anonymlabel1"><img id="ANOimg" style="top: 3px; position: relative;"  height="25px" width="25px" src="#ANOLabel#"  /></div>
              <label class="butt"           id = "anonymlabelA" for="anonymA">#ANOALabel#</label><input style="float:left; " class="butt1" onclick="toggleAnonym_A( );" type="checkbox" name="anonymA" value="#anonymA#" id="anonymA" #ANO_A#/>
          </td>
          <td>
              <input style="visibility: hidden" class="date" type="text" name="anonymT_start" id="anonymT_start" value="#anonymT_start#" #ACT# />
              <input style="visibility: hidden" class="date" type="text" name="anonymT_end"   id="anonymT_end"   value="#anonymT_end#"   #ACT# />
          </td>

      
      </tr>
      
    <tr>
      <td> EINSCHREIBEN </td>
      <td>
        <label  class="butt"           id = "activelabelT" for="activeT"> TIMER     </label><input style="float:left; " class="butt1" onclick="toggleActive_T( );" type="checkbox" name="activeT" value="#activeT#" id="activeT" #ACT_T#/>
        <div    class="buttL#activeL#" id = "activelabel1"><img id="ACTimg" style="top: 3px; position: relative;"  height="25px" width="25px" src="#ACTLabel#"  /></div>
        <label  class="butt"           id = "activelabelA" for="activeA">#ACTALabel#</label><input style="float:left; " class="butt1" onclick="toggleActive_A( );" type="checkbox" name="activeA" value="#activeA#" id="activeA" #ACT_A#/>
      </td>

      <td>
        <input class="date" type="text" name="activeT_start" id="activeT_start" value="#activeT_start#" #ACT# />
        <input class="date" type="text" name="activeT_end"   id="activeT_end"   value="#activeT_end#"   #ACT# />
      </td>
      </tr>

      <tr>
      <td>SICHTBAR</td>
      <td>
        <label class="butt"            id = "visiblelabelT" for="visibleT"> TIMER      </label><input style="float:right;" class="butt1" onclick="toggleVisible_T( );" type="checkbox" name="visibleT" value="#visibleT#" id="visibleT" #VIS_T# />
        <div   class="buttL#visibleL#" id = "visiblelabel1"><img  id="VISimg" style="top: 3px; position: relative;"  height="25px" width="25px" src="#VISLabel#"  /></div>
        <label class="butt"            id = "visiblelabelA" for="visibleA"> #VISALabel#</label><input style="float:right;" class="butt1" onclick="toggleVisible_A( );" type="checkbox" name="visibleA" value="#visibleA#" id="visibleA" #VIS_A# />
      </td>

      <td>
        <input class="date" type="text" name="visibleT_start" id="visibleT_start" value="#visibleT_start#" #VIS# />
        <input class="date" type="text" name="visibleT_end"   id="visibleT_end"   value="#visibleT_end#"   #VIS# />
      </td>
      </tr>

      <tr><td style="vertical-align:bottom;"></td>
          <td style="vertical-align:bottom;">
        <input type="hidden" name="listID" 		value="#listID#"	/>
        <div id="popup0" class="lipop "><input  style="float:right; margin-right:0px; height:50px;" type="button" value=" DELETE? " onclick="show_block( 'popup1' ),  false" /></div>
        <div id="popup2" class="lipop " style="display:none; visibility:hidden;" ><input style="float:right; margin-right:0px; height:50px;" type="submit" name="aktion"	value=" SAVE "	/></div>
        <div id="popup1" class="lipop " style="display:none;" ><input style=" float: right; margin-right: 0px; height: 50px; background: red; color: white;  " type="submit" name="aktion"	value="DELETE! "  onclick="hide_block('popup0'), show_block('popup1'); false"	/></div>
      </td>

      <td style="vertical-align:bottom;">
        <input style="float:right; width:175px; vertical-align: middle; margin-right:0px; height:50px; " type="submit" name="aktion"	value=" SAVE " />
        <input style="float:right; height:50px; " type="submit" name="aktion"	value=" NEW "  />
      </td>
      </tr>
  </table>
</form>

    <div id="ex1" class="modal">
        <img src="inc/img/hilfe-listit.png" width="1030" height="817" alt="Helpme" />
    </div>

    <!-- Link to open the modal -->
    <p><a href="#ex1" rel="modal:open" style="float:left; color:#000; text-decoration:none; font-family:Arial, Helvetica, sans-serif"  >HELP</a></p>
    
</div>

<div style="padding: 10px; margin:10px; min-height: 100px; min-width: 350px; height: available; float:left; width:25%;  border: black solid 1px; background-color:#eee; background-image: url('inc/img/bggrey.jpg'); overflow:auto; float: left">
 #listlist#
</div>

#userlist#

</body>
</html>