<?php
ini_set('session.cookie_samesite', 'None');
ini_set('session.cookie_secure', 'true');
session_start();
require_once( "inc/class.php/liste.class.php"           );
require_once( "inc/class.php/koll.DB.class.php"         );
require_once( "inc/class.php/koll.renderHTML.class.php" );

$db 	  = new KollDB();
$li 	  = new Liste( $db );
$render	= new RenderHTML( );
$li -> decodeAuthData();                                        # deb( $_SESSION );      // -- Zugriff auf diese Seite nur von registrierten Refferer

$li -> getListenValue();                                        # deb( $_SESSION );      // -- POST und GET Variablen einlesen und weitere Werte berechnen

$res = $db -> manipuliateDB();                                  # deb( $res );           // -- SAVE - NEW - DELETE - SPLIT MODE EIN/AUS

$li -> getCurrentList( $render );                               # deb( $_SESSION );	 // -- Aktuelles Kolloquim ermitteln und dem weitere Daten hinzufügen (status: online)

echo $li -> renderSite();

?>