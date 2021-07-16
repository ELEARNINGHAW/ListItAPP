<?php
class RenderHTML
{
 
	function createUserListe( $liste, $enable = true, $printVersion = false )
	{
    $user =  $_SESSION[ 'currentUser' ];
    
    if(!isset($liste[ 'infoTxt' ] ))
    {$liste[ 'infoTxt' ]  = '';}
   
		if ( $printVersion )
		{
			$style = 'float:left; border:0px solid black; width:700px; padding:25px; margin:25px;';
			$tabstyle = 'float:left; width:300px;  border:1px solid black;margin:5px; padding-bottom:10px;  ';
		}
		else
		{
			$style = 'float:left; border:1px solid black; width:300px; padding:10px; margin:10px;';
			$tabstyle = 'float:left; width:300px';
		}
		
		$kl = '<div style="'.$style.'">';
    
    $kl .= '<div class="menuItem1">'. $liste[ 'kollHead' ] .'</div> ';
    
    
    $kl .= '<div class="menuItem0">'. $liste[ 'infoTxt' ] .'</div> ';

		if ( $enable )
		{
   		if ( $liste[ 'editable' ]  )
			{	$kl .= $this->renderInsertDeleteButton( $liste );
			}
    }
		elseif (!$printVersion)
    {	$kl .= $this->renderClosedButton( $liste );
    }
		#	$kl .= '<br /> ';
      $kl .= '<div class="menuItem3">'. $liste[ 'kollInfo' ].'</div>';
			$kl .= '<div class="menuItem2">'. $liste[ 'datum' 	 ] .' &nbsp; &nbsp; &nbsp;  '. $liste[ 'startZeit' ] .'&nbsp;-&nbsp;'. $liste[ 'endeZeit' ] .' </div>';
			
	  	$counter = 0;
 
		  for ( $i = 0; $i < $liste[ 'anzSlots' ]; $i++ )
  		{
  		  if ( isset ( $liste[ 'timeline' ][ $i ] ) ) { $tl =  $liste[ 'timeline' ][ $i ]; }
  		  else                                        { $tl = ''; }
			  
        $kl .='
        <table style="'.$tabstyle.'">
        <tr>
        <th width="75"  rowspan="'.( $liste[ 'anzStudis' ] + 1 ) .'" scope="col">' . $tl. '</th>
        <th width="25"  scope="col">&nbsp;</th>
        <th width="500" scope="col">&nbsp;</th>
        </tr>';
		  
      #    print_r($koll);
	  	for ($j = 0; $j < $liste['anzStudis']; $j++ )
			{
        $studiname = ( ( isset( $liste['studiListe'][$counter]['firstname']) AND isset( $liste['studiListe'][$counter]['lastname'] ) ) ) ?   $liste['studiListe'][$counter]['firstname'] .' '. $liste['studiListe'][$counter]['lastname'] : '';
        $kl .= '<tr><td style="padding-left:10px">'. ($counter+1) .'</td><td  style="padding-left:10px">' . $studiname.	 '</td> </tr>';
		    $counter++;
			}
		  $kl .= '</table>';
	  }
	
	  $kl .= '<a class="printer"  target="_blank" style="float:right;border:0;" href="print.php?ID='.$liste['listID'].'"><img border="0" src="inc/img/drucker.gif" /></a>';
	  $kl .= '</div>';
	  return  $kl;
	}

	function renderInsertDeleteButton($liste )
	{  	$button = '<form action="./index.php" method="post" name="xform">';
    
    if(  isset ($liste[ 'studiIsInList' ]) && $liste[ 'studiIsInList' ] )
		{
			$button .= '<input  style="width:300px; heigth:50px  text-align:center; background-color: #770000; font-size:1.2em; font-weight:bold; color:#FFF" type="submit" name="userbutton" value="Aus dieser Liste austragen" id="userbutton" />';
		}
		else
		{
			$button .= '<input   style="width:300px; heigth:50px text-align:center; background-color: #007700; font-size:1.2em; font-weight:bold;  color:#FFF "  type="submit" name="userbutton" value="In diese Liste eintragen" id="userbutton" />';
		}
		$button .= '<input type="hidden" name="listID" value="'.$liste['listID'].'"/></form>';
		return $button;
	}

	function getListenListeHTML( $listen, $currListe , $split  ) /* kleines Menu mit Auswahlliste aller Kolls  (oben rechts) */
	{
    $checkedTrue = '';
    $checkedFalse = '';
    if ( $split == 'true') { $checkedTrue  = 'checked = "checked"'; }
	  else                   { $checkedFalse = 'checked = "checked"'; }
    $tmp = '<div style="position:absolute; top:10px; left:600px; width:400px; height: 425px; background-color:#eee; overflow:auto">';
	 
		$tmp .= '<form action="./index2.php" method="post" name="form2">
		<input type="radio" '.$checkedTrue.'  name="split" id="split" value="true"  onchange="submitsplit();"/>Split Mode ein &nbsp;&nbsp; 
		<input type="radio" '.$checkedFalse.' name="split" id="split" value="false" onchange="submitsplit();"/>Split Mode aus</br>
		<input type="hidden" name="ID" id="ID" value="'.$currListe[ 'listID' ].'"/>
    </form>';

		$tmp .= '<hr /><table width="100%;">';
		$i = 1;
	
    foreach ($listen as $liste )
		{
      if (  $liste['listID']  != 0)
      {
		  #$online = '';
      { if( $liste['aktiv'] == "online" )
			{ #$online = "background:#FFF";
			}
		
			if ( $currListe['listID'] == $liste['listID'] )
			{	 $st2 = 'curLine';
        #$st1 = ' style="border-top: 1px solid black; border-bottom: 1px solid black;  padding: 3px;"';
			}
			else 
			{ $st2 = 'allLine';
   
			}
			$tmp .= '<tr><td class="koll ' .$st2. ' ">'
			  .'<a class="koll" href="?listID=' .$liste['listID']. '">'
        .$_SESSION[ 'svg' ][ 'lock'    ][$liste['editable']]. ' '
        .$_SESSION[ 'svg' ][ 'visible' ][$liste['aktiv'   ]]. ' '
        .$liste[ 'datum' ].' '.$liste['kollHead'].'</td></a></tr>';
      }
      }
    }
    
		$tmp .= '</table>
		</div>';
		return $tmp;
	}

}