<?php
class RenderHTML
{
	function createUserListe( $liste, $enable = true, $printVersion = false, $anonymState = 2)
	{ $user = $_SESSION[ 'currentUser' ];
   
    if      ( $anonymState == 2 ) { $setAnonym = $liste[ 'anonymL' ]; }
    else if ( $anonymState == 0 ) { $setAnonym = false;               }
    else                          { $setAnonym = true;                }
    
    if( !isset( $liste[ 'infoTxt' ] ) )
    { $liste[ 'infoTxt' ]  = ''; }
   
		if ( $printVersion )
		{	$style = 'float:left; border:0px solid black; width:700px; padding:25px; margin:25px;';
			$tabstyle = ' width:100%;  border:1px solid black;margin:5px;';
		}
		else
		{ $style = 'float:left; border:1px solid black;  min-width: 350px; height: available; width:25%; padding:10px; margin:10px;';
			$tabstyle = ' width:100%';
		}
		
		$kl = '<div style="'.$style.'">';
    $kl .= '<div class="menuItem1">'. $liste[ 'kollHead' ] .'</div> ';
    $kl .= '<div class="menuItem0">'. $liste[ 'infoTxt' ] .'</div> ';

		if ( $enable )
		{	if ( $liste[ 'activeL' ]  )
			{	$kl .= $this->renderInsertDeleteButton( $liste );
			}
    }
		
		elseif (!$printVersion)
    {	$kl .= $this->renderClosedButton( $liste );
    }
      $kl .= '<div class="menuItem3">'. $liste[ 'kollInfo' ].'</div>';
			$kl .= '<div class="menuItem2">'. $liste[ 'datum' 	 ][ 'd1' ] .' &nbsp; &nbsp; &nbsp;  '. $liste[ 'startZeit' ] .'&nbsp;-&nbsp;'. $liste[ 'endeZeit' ] .' </div>';
			
	  	$counter = 0;
 
		  for ( $i = 1; $i <= $liste[ 'anzSlots' ]; $i++ )
  		{ if ( isset ( $liste[ 'timeline' ][ $i ] ) ) { $tl =  $liste[ 'timeline' ][ $i ]; }
  		  else                                        { $tl = ''; }
			  
        $kl .='<table style="'.$tabstyle.'">';
       
	  	  for ($j = 0; $j < $liste['anzStudis']; $j++ )
	  	  { $lastname  = '';
          $firstname = '';

        if (isset($liste['studiListe'][$counter]))
        { $cuser = $liste['studiListe'][$counter];
          if ($user[ 'userKennung' ] == $cuser['kennung']) {$isCuser = true;} else {$isCuser = false;}
          if   ($setAnonym AND !$isCuser )
          { $frnd = rand(3, 7 ); for ($x = 0; $x < $frnd; $x++) { $firstname .= 'x'; }
            $lrnd = rand(4, 10); for ($x = 0; $x < $lrnd; $x++) { $lastname  .= 'x'; }
          }
          else
          { $firstname = ($cuser['firstname']);
            $lastname = ($cuser['lastname']);
          }
        }
        $studiname =  $firstname. ' '. $lastname;
        
        if ($j == 0)
        { $kl .= '<tr><td class="ulT" rowspan="' . ($liste['anzStudis'] ) . '" >' . $tl . '</td>
                      <td class="ulNr" >' . $counter +1  . '</td>
                      <td class="ulNa" >' . $studiname   . '</td></tr>';
        }
        else
        { $kl .= '<tr><td  class="ulNr"> '. $counter +1 . '</td><td class="ulNa" >' . $studiname . '</td> </tr>';
        }
		    $counter++;
			}
		  $kl .= '</table>';
	  }
		if( !$setAnonym )
    { $h   = hash('sha256',  $liste['listID'].$_SESSION[' salt' ]) ;
      $kl .= '<a class="printer"  target="_blank" style="float:right;border:0;"                  href="tools.php?a=1&ID='.$liste['listID'].'&h='.$h.'"><img src="inc/img/drucker.gif" /></a>';
      $kl .= '<a class="printer"  target="_blank" style="float:right;border:0; margin-right:5px" href="tools.php?a=2&ID='.$liste['listID'].'&h='.$h.'"><img src="inc/img/csv.png" /></a>';
    }
      $kl .= '</div>';
	   return  $kl;
	}

	function renderInsertDeleteButton( $liste )
	{  	$button = '<form action="./index.php" method="post" name="xform">';
    
    if(  isset ($liste[ 'studiIsInList' ]) && $liste[ 'studiIsInList' ] )
		{  $button .= '<input  style="width:100%; heigth:50px  text-align:center; background-color: #770000; font-size:1.2em; font-weight:bold; color:#FFF" type="submit" name="userbutton" value="Aus dieser Liste austragen" id="userbutton" />';
		}
		else
		{	$button .= '<input   style="width:100%; heigth:50px text-align:center; background-color: #007700; font-size:1.2em; font-weight:bold;  color:#FFF "  type="submit" name="userbutton" value="In diese Liste eintragen" id="userbutton" />';
		}
		$button .= '<input type="hidden" name="listID" value="'.$liste['listID'].'"/></form>';
		return $button;
	}

	function getListenListeHTML( $listen, $currListe , $split  ) /* kleines Menu mit Auswahlliste aller Kolls  (oben rechts) */
	{ $checkedTrue  = '';
    $checkedFalse = '';
    if ( $split == 'true') { $checkedTrue  = 'checked = "checked"'; }
	  else                   { $checkedFalse = 'checked = "checked"'; }
	 
		$tmp  = '<form action="./index.php" method="post" name="form2">
		<input type="radio" '.$checkedTrue.'  name="split" id="split" value="true"  onchange="submitsplit();"/>Single Mode ein &nbsp;&nbsp;
		<input type="radio" '.$checkedFalse.' name="split" id="split" value="false" onchange="submitsplit();"/>Single Mode aus</br>
		<input type="hidden" name="ID" id="ID" value="'.$currListe[ 'listID' ].'"/>
    </form>';

		$tmp .= '<hr /><table width="100%;">';
		$i = 1;
	   
    foreach ($listen as $liste )
		{ if (  $liste['listID']  != 0)
      {
        { if( $liste['visibleA'] == "online" )
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
        ."<img  style=\"top: 3px; position: relative;\"  height=\"15px\" width=\"15px\" src=\"".$_SESSION[ 'svg' ][ 'anonym'  ][$liste['anonymL'  ]]. "\"  />"
        ."<img  style=\"top: 3px; position: relative;\"  height=\"15px\" width=\"15px\" src=\"".$_SESSION[ 'svg' ][ 'lock'    ][$liste['activeL'  ]]. "\"  />"
        ."<img  style=\"top: 3px; position: relative;\"  height=\"15px\" width=\"15px\" src=\"".$_SESSION[ 'svg' ][ 'visible' ][$liste['visibleL' ]]. "\"  />"
        .$liste[ 'datum' ][ 'd1' ].' '.$liste['kollHead'].'</td></a></tr>';
      }
      }
    }
    
		$tmp .= '</table>';
		return $tmp;
	}

}