<?php
ini_set('session.cookie_samesite', 'None');
ini_set('session.cookie_secure',   'true');
session_start();
require_once( "inc/class.php/liste.class.php"           );
require_once( "inc/class.php/koll.DB.class.php"			    );
require_once( "inc/class.php/koll.renderHTML.class.php"	);

$db 	  = new KollDB();
$li 	  = new Liste($db);
$render	= new RenderHTML();
$li -> decodeAuthData();

if ( $_SESSION[ 'currentUser'  ][ 'userRole' ] <= 2 )
{ $kollOnline      = $li -> getOnlineKoll( $db  );		                  // -- Array mit allen Listen mit Status 'online'
  $tmp             = $db -> manipuliateUserDB( $kollOnline	);					// -- INSERT - DELETE  USER from List
  $listenOnline    = $li -> getOnlineKoll( $db );		                    // -- Array mit allen Listen mit Status 'online'
  $kollListeHTML   = '';
  
  foreach ( $listenOnline as $listeOnline )
  { $kollListeHTML .= $render -> createUserListe( $listeOnline );
  }
  
  echo $li -> renderSite2( $kollListeHTML );
}

else if ( $_SESSION[ 'currentUser' ][ 'userRole' ]  >= 3 )
{ $li -> getListenValue();                                               // -- POST und GET Variablen einlesen und weitere Werte berechnen
  $res = $db -> manipuliateDB();                                         // -- SAVE - NEW - DELETE - SPLIT MODE EIN/AUS
  $li -> getCurrentList( $render );                                   	 // -- Aktuelles Kolloquim ermitteln und dem weitere Daten hinzufügen (status: online)
  
  echo $li -> renderSite();
}

?>
