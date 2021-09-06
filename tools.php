<?php
session_start();
require_once( "inc/class.php/liste.class.php");
require_once( "inc/class.php/koll.DB.class.php"			);
require_once( "inc/class.php/koll.renderHTML.class.php"	);

$salt =  $_SESSION[' salt' ];
$h    =  $_GET[ 'h'        ];
$ID   =  $_GET[ 'ID'       ];
$a    =  $_GET[ 'a'        ];

if ( $h != ( hash('sha256',  $ID.$salt ) ) )  { die("not allowed"); }

$db 				= new KollDB();
$Li 				= new Liste( $db );
$render			= new RenderHTML();

$error 			= $Li -> checkHost(); 												// -- Zugriff auf diese Seite nur von registrierten Refferer
$user			  = $Li -> decodeAuthData();											//
$listen			= $db -> getListenData( $Li   );			// -- Array mit allen Kolloquien mit Status 'online'

foreach ( $listen as $liste )
{	if ( $liste[ 'listID' ] == $_GET[ 'ID' ] )
	{	$k = $liste;
		$user[ 'userVorname'  ] = $k[ 'kollHead' ] ;								// Variable Studi wird hier missbraucht.
		$user[ 'userNachname' ] = " -- " .$k[ 'datum' ]['d1'] ." -- ". $k[ 'startZeit' ] ." - ".$k[ 'endeZeit' ] ;
		break;	
	}
}

$filename= $k[ 'kollHead' ] .'_'.$k[ 'datum' ]['d1'] ."_". $k[ 'startZeit2' ] ."-".$k[ 'endeZeit2' ];

if ( $a == 1 )
{ $kollListeHTML = $render->createUserListe($k, false, true, false );
  $template = file_get_contents("inc/template/print.php" );
  echo $Li->renderSite2( $kollListeHTML, $template );
}

elseif ( $a == 2 )
{ if( isset($k[ 'studiListe' ][ 0 ] ))
  { $ak = array_keys($k['studiListe'][0]);  # Erster User-Datensaz
    $soak = sizeof($ak);
    for ( $i = 0;  $i <= $soak ; $i++ ) { unset( $ak[ $i * 2 ] ); } # Entfernen der doppelten Array-Einträgen
  }
  else
  { $soak = 0;
    $ak   = array();
  }
 
  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename='.$filename.'data.csv');
  
  $output = fopen('php://output', 'w');

  fputcsv($output, $ak);               // output the column headings
  
  foreach( $k['studiListe'] as $studi )
  {  for ( $i = 0;  $i <= $soak ; $i++ ) { unset( $studi[ $i ] ); } # Entfernen der doppelten Array-Einträgen
     fputcsv($output, $studi);
  }
}


?>
