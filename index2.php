<?php
session_start();
# session_destroy();
require_once( "inc/class.php/liste.class.php"           );
require_once( "inc/class.php/koll.DB.class.php"         );
require_once( "inc/class.php/koll.renderHTML.class.php" );


$li 	  = new Liste();
$db 	  = new KollDB();
$render	= new RenderHTML();

$li -> checkHost();                                             # deb( $_SESSION );

$li -> decodeAuthData();                                        # deb( $_SESSION );      // -- Zugriff auf diese Seite nur von registrierten Refferer

$li -> getListenValue();                                        # deb( $_SESSION );      // -- POST und GET Variablen einlesen und weitere Werte berechnen

$res = $db -> manipuliateDB();                                  # deb( $res );           // -- SAVE - NEW - DELETE - SPLIT MODE EIN/AUS

$li -> getCurrentList( $render, $db );                          # deb( $_SESSION );	 // -- Aktuelles Kolloquim ermitteln und dem weitere Daten hinzufügen (status: online)

echo $li -> renderSite();
?>