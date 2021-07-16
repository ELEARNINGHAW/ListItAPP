<?php
session_start();

require_once( "inc/class.php/liste.class.php"           );
require_once( "inc/class.php/koll.DB.class.php"			    );
require_once( "inc/class.php/koll.renderHTML.class.php"	);

$li 	  = new Liste();
$db 	  = new KollDB();
$render	= new RenderHTML();

#$error 				= $Ko->checkHost(); 				#DEPRECATED!								// -- Zugriff auf diese Seite nur von registrierten Refferer

$li -> decodeAuthData();											//

$kollOnline      = $li -> getOnlineKoll( $db  );		// -- Array mit allen Kolloquien mit Status 'online'

$tmp             = $db -> manipuliateUserDB( $kollOnline	);					// -- INSERT - DELETE  USER from List

$listenOnline    = $li -> getOnlineKoll( $db );		// -- Array mit allen Kolloquien mit Status 'online'

$kollListeHTML   = '';

foreach ( $listenOnline as $listeOnline )
{  $kollListeHTML .= $render -> createUserListe( $listeOnline );
}

$template   		= file_get_contents( "inc/template/page2.php" );
echo $li->renderSite2( $kollListeHTML, $template );
?>
