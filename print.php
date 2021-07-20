<?php
session_start();

require_once("inc/class.php/liste.class.php");
require_once( "inc/class.php/koll.DB.class.php"			);
require_once( "inc/class.php/koll.renderHTML.class.php"	);

$Li 				= new Liste();
$db 				= new KollDB();
$render			= new RenderHTML();

$error 			= $Li -> checkHost(); 												// -- Zugriff auf diese Seite nur von registrierten Refferer

$user			  = $Li -> decodeAuthData();											//

$listen			= $db -> getListenData( $Li   );			// -- Array mit allen Kolloquien mit Status 'online'

foreach ( $listen as $liste )
{
	if ( $liste[ 'listID' ] == $_GET[ 'ID' ] )
	{
		$k = $liste;
		$user[ 'userVorname'  ] = $k[ 'kollHead' ] ;								// Variable Studi wird hier missbraucht.
		$user[ 'userNachname' ] = " -- " .$k[ 'datum' ] ." -- ". $k[ 'startZeit' ] ." - ".$k[ 'endeZeit' ] ;
		break;	
	}
}

$kollListeHTML = $render -> createUserListe( $k ,	 false, true );

$template  	= file_get_contents( "inc/template/print.php" );
echo $Li -> renderSite2( $kollListeHTML, $template );
?>
