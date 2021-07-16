<?php

function deb( $var, $kill = false )
{
  echo "<pre>";
  print_r( $var );
  echo "</pre>";
  if ( $kill ) { die(); }
}

class Liste
{
	function checkHost()
	{  #print_r($_SERVER);
   /*
    $host1 = explode('/', $_SERVER[HTTP_REFERER]);
		if
		(      ($host1[2] != "www.emil-archiv.haw-hamburg.de"		)
			&& ($host1[2] != "www.elearning.el.haw-hamburg.de"	    ) 
			&& ($host1[2] != "www.emil2-test.ls.haw-hamburg.de"	    ) 
			&& ($host1[2] != "www.elearning.haw-hamburg.de"	        ) 
			&& ($host1[2] != "lernserver.el.haw-hamburg.de" 	    ) 
			&& ($host1[2] != "localhost"						    ) 
   			&& ($host1[2] != "141.22.110.70"						) 
		)
		{	die("<div style='text-align:center;'><h1>ACCESS ERROR<h1></div>");
		}
    */
	}

	function getListenValue( )				// -- TODO -- VALIDATE CHECKEN!!  SECURITY! ------
	{
    $stdlst      = $_SESSION[ 'stdlst'      ];
    $currentList = $_SESSION[ 'currentList' ];
 
    if (isset( $currentList[ 'courseID'  	] ) )   {                                                                        } else { $currentList[ 'courseID'	   ]	= $stdlst[ 'courseID'	  ]; }
    if (isset( $currentList[ 'courseName' ] ) )   {                                                                        } else { $currentList[ 'courseName'   ]	= $stdlst[ 'courseName' ]; }
    if (isset( $_POST[ 'datum'			      ] ) )   { $currentList[ 'datum'	      ]	= $_POST[ 'datum'			                ]; } else { $currentList[ 'datum'	       ]	= $stdlst[ 'datum'	    ]; }
    if (isset( $_POST[ 'datum'            ] ) )   { $currentList[ 'USdatum'     ]	= $this -> makeUSdatum($_POST['datum' ]);} else { $currentList[ 'USdatum'	     ]	= $stdlst[ 'USdatum'	  ]; }
    if (isset( $_POST[ 'anzslots'			    ] ) )   { $currentList[ 'anzSlots'	  ]	= $_POST[ 'anzslots'			            ]; } else { $currentList[ 'anzSlots'	   ]	= $stdlst[ 'anzSlots'	  ]; }
    if (isset( $_POST[ 'startzeit'	   	  ] ) )   { $currentList[ 'startZeit'   ]	= $_POST[ 'startzeit'	   	            ]; } else { $currentList[ 'startZeit'    ]	= $stdlst[ 'startZeit'  ]; }
    if (isset( $_POST[ 'endezeit'			    ] ) )   { $currentList[ 'endeZeit'    ]	= $_POST[ 'endezeit'			            ]; } else { $currentList[ 'endeZeit'	   ]	= $stdlst[ 'endeZeit'	  ]; }
    if (isset( $_POST[ 'slotdauer'	      ] ) )   { $currentList[ 'slotDauer'   ]	= $_POST[ 'slotdauer'	                ]; } else { $currentList[ 'slotDauer'    ]	= $stdlst[ 'slotDauer'  ]; }
    if (isset( $_POST[ 'anzstudis'	  	  ] ) )   { $currentList[ 'anzStudis'   ]	= $_POST[ 'anzstudis'	  	            ]; } else { $currentList[ 'anzStudis'    ]	= $stdlst[ 'anzStudis'  ]; }
    if (isset( $_POST[ 'kollhead'			    ] ) )   { $currentList[ 'kollHead'    ]	= $_POST[ 'kollhead'			            ]; } else { $currentList[ 'kollHead'	   ]	= $stdlst[ 'kollHead'	  ]; }
    if (isset( $_POST[ 'aktiv'		    	  ] ) )   { $currentList[ 'aktiv'       ]	= $_POST[ 'aktiv'		    	            ]; } else { $currentList[ 'aktiv'		     ]	= $stdlst[ 'aktiv'		  ]; }
    if (isset( $_POST[ 'editable'		 	    ] ) )   { $currentList[ 'editable'    ]	= $_POST[ 'editable'		 	            ]; } else { $currentList[ 'editable'	   ]	= $stdlst[ 'editable'   ]; }
    if (isset( $_POST[ 'split' 		        ] ) )   { $currentList[ 'split'       ]	= $_POST[ 'split' 		                ]; } else { $currentList[ 'split'		     ]	= $stdlst[ 'split'		  ]; }
    if (isset( $_POST[ 'kollinfo'         ] ) )   { $currentList[ 'kollInfo'    ]	= nl2br( $_POST[ 'kollinfo'           ]);} else { $currentList[ 'kollInfo'	   ]	= $stdlst[ 'kollInfo'   ]; }
    if (isset( $_POST[ 'aktion'	          ] ) )   { $currentList[ 'aktion'      ]	= trim(  $_POST[ 'aktion'	            ]);} else { $currentList[ 'aktion'	     ]	= $stdlst[ 'aktion'	    ]; }
 
    if( isset( $_POST[ 'listID'           ] ) )	  { $currentList[ 'listID'      ] = $_POST[ 'listID'                    ] ;}
    else if( isset( $_GET[  'listID'      ] ) )	  { $currentList[ 'listID'      ] = $_GET[ 'listID'                     ] ;}
    else                                          { $currentList[ 'listID'      ] = $stdlst[ 'listID'                   ] ;
                                                    $currentList[ 'aktiv'		     ] = 1;
                                                    $currentList[ 'editable'	   ] = 1;                                    }
    
#    if (isset( $_POST[ 'aktiv'		    	  ] ) )   { $currentList[ 'aktiv'       ]	= $_POST[ 'aktiv'		    	            ]; } else { $currentList[ 'aktiv'		     ]	= $stdlst[ 'aktiv'		  ]; }
#    if (isset( $_POST[ 'editable'		 	    ] ) )   { $currentList[ 'editable'    ]	= $_POST[ 'editable'		 	            ]; } else { $currentList[ 'editable'	   ]	= $stdlst[ 'editable'   ]; }
    
    $_SESSION[ 'currentList'   ] = $currentList ;
 
    return $currentList;
	}
	
	function getData()
  {
    if( $_POST );																	// ------------- POST DATEN ------------------
    { // -- TODO -- VALIDATE CHECKEN!!  SECURITY! ------
      $listUB = ( isset ( $_POST[ 'userbutton' ] ) ) ? trim( $_POST[ 'userbutton' ] ) : '';
      $listID = ( isset ( $_POST[ 'listID'     ] ) ) ?       $_POST[ 'listID'     ]   : '';
    }
  }
	
	function decodeAuthData()
	{
    $currentUser = array();
    $currentList = array();
    
    $d = getdate();
    $today = $d['mday'].'.'.$d['mon'].'.'.$d['year'];

    $salt = '1aFpeznX4Ek3FaCBsbTCR74D1EjcUlfAU9qiddE7';
    
		$r = rand( 1, 9 );
    $stdusr[ 'userVorname'	  ] = "werner"       .$r;
    $stdusr[ 'userNachname'  	]	= "welte"        .$r;
    $stdusr[ 'userKennung'	  ]	= "aaa123"       .$r;
    $stdusr[ 'userID'	        ]	= "1234"         .$r;
    $stdusr[ 'userEmail'	  	]	= "werner.welte@".$r;
    
    $stdlst[ 'listID'	    ] = '0';
    $stdlst[ 'courseID'	  ] = '0';
    $stdlst[ 'courseName' ] = 'Kursname';
    $stdlst[ 'datum'	    ] = $today;
    $stdlst[ 'startZeit'  ] = '10:00';
    $stdlst[ 'endeZeit'	  ] = '12:00';
    $stdlst[ 'startZeit2' ] = '1000';
    $stdlst[ 'endeZeit2'  ] = '1200';
    $stdlst[ 'slotDauer'  ] = '30';
    $stdlst[ 'anzStudis'  ] = '1';
    $stdlst[ 'anzSlots'   ] = '1';
    $stdlst[ 'kollHead'	  ] = 'Listenname';
    $stdlst[ 'kollInfo'   ] = 'Listeninfo';
    $stdlst[ 'aktiv'		  ] =  0;
    $stdlst[ 'editable'   ] =  0;
    $stdlst[ 'split'		  ] =  0;
    $stdlst[ 'aktion'	    ] = '0';
    $stdlst[ 'USdatum'	  ] = '0';
    $stdlst[ 'token'      ] = '';
    $stdlst[ 'timeline'   ] =  0;
    $stdlst[ 'infoTxt'    ] = '';
    $stdlst['studiIsInList'] = 0;
    
		if ( isset ($_GET[ 'uun' ] ))
		{
      $currentUser = $stdusr;
      $currentList = $stdlst;
      
      if ( isset( $_GET[ 'ufn' ] ) ) {  $currentUser[ 'userVorname'   ] = base64_decode(  rawurldecode( $_GET[ 'ufn' ] ) ); }
      if ( isset( $_GET[ 'uln' ] ) ) {  $currentUser[ 'userNachname'  ] = base64_decode(  rawurldecode( $_GET[ 'uln' ] ) ); }
      if ( isset( $_GET[ 'uid' ] ) ) {  $currentUser[ 'userKennung'   ] = base64_decode(  rawurldecode( $_GET[ 'uid' ] ) ); }
      if ( isset( $_GET[ 'uun' ] ) ) {  $currentUser[ 'userID'        ] = base64_decode(  rawurldecode( $_GET[ 'uun' ] ) ); }
      if ( isset( $_GET[ 'uem' ] ) ) {  $currentUser[ 'userEmail'     ] = base64_decode(  rawurldecode( $_GET[ 'uem' ] ) ); }

      if ( isset( $_GET[ 'cid' ] ) ) {  $currentList[ 'courseID'      ] = base64_decode(  rawurldecode( $_GET[ 'cid' ] ) );}
      if ( isset( $_GET[ 'cfn' ] ) ) {  $currentList[ 'courseName'    ] = base64_decode(  rawurldecode( $_GET[ 'cfn' ] ) );}
      if ( isset( $_GET[ 'tok' ] ) ) {  $currentList[ 'token'         ] = base64_decode(  rawurldecode( $_GET[ 'tok' ] ) );}
     
      $_SESSION[ 'u' ][ 'userVorname'   ] = $currentUser[ 'userVorname'   ] ;
      $_SESSION[ 'u' ][ 'userNachname'  ] = $currentUser[ 'userNachname'  ] ;
      $_SESSION[ 'u' ][ 'userKennung'   ] = $currentUser[ 'userKennung'   ] ;
      $_SESSION[ 'u' ][ 'userID'        ] = $currentUser[ 'userID'        ] ;
      $_SESSION[ 'u' ][ 'userEmail'     ] = $currentUser[ 'userEmail'     ] ;

      $_SESSION[ 'l' ][ 'courseID'      ] = $currentList[ 'courseID'      ] ;
      $_SESSION[ 'l' ][ 'courseName'    ] = $currentList[ 'courseName'    ] ;
      $_SESSION[ 'l' ][ 'token'         ] = $currentList[ 'token'         ] ;
   
      $token = hash('sha512',
           $currentUser[ 'userVorname'   ] .
           $currentUser[ 'userNachname'  ] .
           $currentUser[ 'userKennung'   ] .
           $currentUser[ 'userID'        ] .
           $currentUser[ 'userEmail'     ] .
           $currentList[ 'courseID'      ] .
           $currentList[ 'courseName'    ] .
           $salt );
           
      $_SESSION[ 'currentUser' ] = $currentUser;
      $_SESSION[ 'currentList' ] = $currentList;
      $_SESSION[ 'stdlst'      ] = $stdlst;
      $_SESSION[ 'stdusr'      ] = $stdusr;
      
      if ( $currentList[ 'token' ] != ( $token ) )
      {
        die("not allowed");
      }
      $_SESSION[ 'svg' ][ 'lock'    ][0] = '<img  style="top: 3px; position: relative;"  height="15px" width="15px" src="inc/img/edit_0.svg" />';
      $_SESSION[ 'svg' ][ 'lock'    ][1] = '<img  style="top: 3px; position: relative;"  height="15px" width="15px" src="inc/img/edit_1.svg" />';
      $_SESSION[ 'svg' ][ 'visible' ][0] = '<img  style="top: 3px; position: relative;"  height="15px" width="15px" src="inc/img/eye_0.svg" />';
      $_SESSION[ 'svg' ][ 'visible' ][1] = '<img  style="top: 3px; position: relative;"  height="15px" width="15px" src="inc/img/eye_1.svg" />';
    }
	}
	
	function renderSite()
	{
    $liste = $_SESSION['currentList'];
	  $site  = $liste[ 'template1' ] ;
 
		if ( isset( $liste[ 'listID'	    ] ) )  { $site = str_replace( "#listID#"            , $liste[ 'listID'	   	]	,  $site  ); }
    if ( isset( $liste[ 'datum'	  		] ) )  { $site = str_replace( "#datum#"             , $liste[ 'datum'	  	  ]	,  $site  ); }
    if ( isset( $liste[ 'courseName'	] ) )  { $site = str_replace( "#courseName#"        , $liste[ 'courseName'	]	,  $site  ); }
    if ( isset( $liste[ 'startZeit'  	] ) )  { $site = str_replace( "#kollStart#"         , $liste[ 'startZeit'   ]	,  $site  ); }
    if ( isset( $liste[ 'endeZeit'		] ) )  { $site = str_replace( "#kollEnde#"          , $liste[ 'endeZeit'		]	,  $site  ); }
    if ( isset( $liste[ 'startZeit2'  ] ) )  { $site = str_replace( "#kollStart2#"        , $liste[ 'startZeit2' 	]	,  $site  ); }
    if ( isset( $liste[ 'endeZeit2'   ] ) )  { $site = str_replace( "#kollEnde2#"         , $liste[ 'endeZeit2'	  ]	,  $site  ); }
    if ( isset( $liste[ 'slotDauer'		] ) )  { $site = str_replace( "#slotDauer#"         , $liste[ 'slotDauer'	  ]	,  $site  ); }
    if ( isset( $liste[ 'anzStudis'		] ) )  { $site = str_replace( "#anzStudisProSlot#"  , $liste[ 'anzStudis'	  ]	,  $site  ); }
    if ( isset( $liste[ 'kollHead'		] ) )  { $site = str_replace( "#kollHead#"          , $liste[ 'kollHead'		]	,  $site  ); }
    if ( isset( $liste[ 'aktiv'	  		] ) )  { $site = str_replace( "#aktiv#"             , $liste[ 'aktiv'	  	  ]	,  $site  ); }
    if ( isset( $liste[ 'editable'		] ) )  { $site = str_replace( "#editable#"          , $liste[ 'editable'	  ]	,  $site  ); }
    if ( isset( $liste[ 'anzSlots'		] ) )  { $site = str_replace( "#anzSlots#"          , $liste[ 'anzSlots'		]	,  $site  ); }
    if ( isset( $liste[ 'CBLabel'			] ) )  { $site = str_replace( "#CBLabel#"           , $liste[ 'CBLabel'		  ]	,  $site  ); }
    if ( isset( $liste[ 'CBAttrib'		] ) )  { $site = str_replace( "#CBAttrib#"          , $liste[ 'CBAttrib'		]	,  $site  ); }
    if ( isset( $liste[ 'EDLabel'			] ) )  { $site = str_replace( "#EDLabel#"           , $liste[ 'EDLabel'		  ]	,  $site  ); }
    if ( isset( $liste[ 'EDAttrib'		] ) )  { $site = str_replace( "#EDAttrib#"          , $liste[ 'EDAttrib'		]	,  $site  ); }
    if ( isset( $liste[ 'listlist'		] ) )  { $site = str_replace( "#listlist#"          , $liste[ 'listlist'		]	,  $site  ); }
    if ( isset( $liste[ 'userlist'		] ) )  { $site = str_replace( "#userlist#"          , $liste[ 'userlist'		]	,  $site  ); }
    if ( isset( $liste[ 'kollInfo'		] ) )  { $site = str_replace( "#kollInfo#"          , $this -> br2nl( $liste[ 'kollInfo' ] )	,  $site  ); }

		return $site;
	}

	function  renderSite2( $listenHTML,  $page1Template)
	{
    #$listenHTML = str_replace( 'name="xform"',  'name="xform" style="display: none;"',  $listenHTML );
	  $currentList = $_SESSION[ 'currentList' ];
    $user = $_SESSION[ 'currentUser' ];
		#$site  = "";
	  $site  = str_replace( "#listID#"	   	     , '' 		        		,  $page1Template  );
		$site  = str_replace( "#kollListen#"		   , $listenHTML				      ,  $site  );
		$site  = str_replace( "#studiVorname#"		 , $user[ 'userVorname'  ]	,  $site  );
		$site  = str_replace( "#studiNachname#"	 , $user[ 'userNachname' ]	,  $site  );
		$site  = str_replace( "#studiKennung#"		 , $user[ 'userKennung'  ]	,  $site  );
		$site  = str_replace( "#studiMatrikel#"	 , $user[ 'userID'       ]	,  $site  );
		$site  = str_replace( "#courseName#"		   , $currentList[ 'courseName'   ]	,  $site  );
	#	$site  = str_replace( "#info#"				     , $currentList[ 'infoText'     ]	,  $site  );
		return $site;
	}
	
	function makeUSdatum( $datum )
	{ if (isset ($datum))
    {
  		$d = explode('.', $datum );
	  	$USdatum = $d[ '2' ].'.'.$d[ '1' ].'.'.$d[ '0' ];
  		return $USdatum;
    }
	}
	
	function getNextID( $listID, $liste )
	{  
		$anzListen = sizeof( $liste );
		for ($i = 0; $i < $anzListen; $i++ )
		{	if ( $liste[ $i ][ 'ID' ] == $listID )
			{  	if ( $i < ( $anzListen-1 ) )  			$ret = $liste[ ( $i + 1 ) ] [ 'ID' ];
				  else                                $ret = $liste[ 0 ][ 'ID' ];
			}
		}
		return $ret;
	}

	function getPrevID($listID, $kolloquium)
	{  
		$anzKoll = sizeof($kolloquium);
		$ret = $kolloquium[$anzKoll]['ID'];
		for ( $i = $anzKoll; $i >= 0 ; $i-- )
		{	 
			if ($kolloquium[$i]['ID'] == $listID )
			{
				if ($i >= $anzKoll-1)
					$ret = $kolloquium[($i-1)]['ID'];
				else 	
					$ret = $kolloquium[$anzKoll-1]['ID'];
			}
		}
		return $ret;
	}

	function getCurrentList(  $render, $db ) 	// Ermittelt für das aktuelle Kolloq den Datensatz. // 1.Prio: Neu angelegter 2.Prio den über nächstes/vorhergehendes Koll angewählte 3. Prio. Default = Datensatz 0.
	{
    $currentUser = $_SESSION[ 'currentUser' ];
    $currentList = $_SESSION[ 'currentList' ];
    $listen      = $db -> getListenData( $this );                    # deb( $listen );        // -- Alle aktuellen Kolloqien Daten holen:

    if ( $currentList[ 'listID' ] )											// Ansonsten, Wenn Attribut 'POST_ID' dann ist  Kolloqui[POSTID] das aktuelle Kolloq.
		{ $currentList = $listen[ $currentList[ 'listID' ] ];
    }
    
    $currentList[ 'listlist'   ]	= $render -> getListenListeHTML( $listen, $currentList , $db -> ifSplit( $currentList ) );
    $currentList[ 'userlist'   ]	= $render -> createUserListe( $currentList,  $currentUser, false ); ;
    $currentList[ 'template1'  ]	= file_get_contents("inc/template/page1.php" );
    
    if( isset( $currentList[ 'aktiv' 	  ] ) && $currentList[ 'aktiv'    ] == '1' )      { $currentList[ 'CBLabel'	]	= "ONLINE "; $currentList[ 'CBAttrib'	]	= 'checked="checked"'; }
    else                                                                                { $currentList[ 'CBLabel'	]	= "OFFLINE"; $currentList[ 'CBAttrib'	]	= '';                  }
    
    if( isset( $currentList[ 'editable' ] ) && $currentList[ 'editable' ] == '1' )      { $currentList[ 'EDLabel'	]	= "AKTIV";     $currentList[ 'EDAttrib'	]	= 'checked="checked"'; }
    else                                                                                { $currentList[ 'EDLabel'	]	= "NICHT AKTIV"; $currentList[ 'EDAttrib'	]	= '';    }

    $_SESSION['currentList'] = $currentList;
	}

	
	function getAnzSlots( $liste )
	{
		$startZeit2 = str_replace(":","",$liste[ 'startZeit' ] );
		$endeZeit2  = str_replace(":","",$liste[ 'endeZeit'  ] );
		
		$startH = floor( $startZeit2 / 100 );
		$startM = $startZeit2 % 100;

		$endeH = floor( $endeZeit2 / 100 );
		$endeM = $endeZeit2 % 100;

		$start = $startH * 60  + $startM;
		$ende  = $endeH  * 60  + $endeM;
	 
		if   ( $liste[ 'slotDauer' ] )                  			$anzSlots =  ( ( $ende - $start )  /  $liste['slotDauer'] ) ;
		if   ( ( $anzSlots - floor( $anzSlots ) ) == 0 ) 			$anzSlots += 1;
		else                                             			$anzSlots =  ceil($anzSlots) ;
		
		return  $anzSlots;
	} 

	
	
	function getTimeLine( $liste )
	{
		$startZeit = str_replace(":","", $liste[ 'startZeit' ] );
		$startH    = floor( $startZeit / 100 );
		$startM    = $startZeit % 100;

		$H = $startH;
		$M = $startM;
		
		if( $M < 10 ) $M = '0'.$M;
		$ret[] = $H .':'. $M;
		
		// alle Restlichen 
		for ( $i = 0; $i < $liste[ 'anzSlots' ]; $i++ )
		{ if( ( $startM +  $liste[ 'slotDauer' ] ) >= 60 )
			{ $H = $startH + 1;
				$M = ( $startM + $liste[ 'slotDauer' ] ) - 60;
			}
			else 
			{	$H = $startH;
				$M = $startM + $liste[ 'slotDauer' ];
			}
			if( $M < 10 ) $M = '0'.$M;
			$ret[] = $H .':'. $M;
			$startH = $H;
			$startM = $M;
		}   
		return $ret;
	}
	
	function getOnlineKoll( $db ) // Ermittelt für das aktuelle Kolloq den Datensatz. // 1er Datensatz mit Attribut aktiv=online
	{
    $listen =  $db -> getListenData( $this );
 
		foreach( $listen as $liste)
		{ if ( $liste[ 'aktiv' ] )
			{ $currentListen[$liste['listID']] =  $this->getListInfo($db, $liste);
			}
		}
		return $currentListen;
	}

	function getListInfo($db, $liste)
  {
    $user   = $_SESSION[ 'currentUser' ];
 
    if (!isset($liste[ 'studiListe' ]))  { $liste[ 'studiListe' ] = array(); }
    $liste[ 'anzStudiInList'  ] = sizeof( $liste[ 'studiListe' ] );
    $liste[ 'studiIsInList'   ] = $db -> isUserInList( $user, $liste );
    $liste[ 'studiPosInList'  ] = $this -> getStudiPosInList( $liste, $user[ 'userKennung' ] );
    $liste[ 'maxStudisInList' ] = $liste[ 'anzSlots' ] * $liste[ 'anzStudis' ];
    $liste[ 'position' ] = $liste[ 'maxStudisInList' ] -  $liste[ 'studiPosInList' ]; // ermittelt die Wartelistenposition
    
    if( $liste[ 'position' ] < 0 )
    {	$liste[ 'infoTxt' ] = '<div class="menuItem0a"><strong>ACHTUNG:</strong> Sie haben keinen Teilnahmeplatz!<br />Ihre Wartelistenposition ist<br /><div class="position">'. ABS($liste[ 'position' ])."</div></div>";
    }
    else if( $liste['studiPosInList'] > 0 )
    {	$liste[ 'infoTxt' ] = '<div class="menuItem0b">In dieser Liste sind Sie auf Platz <br /><div class="position">'. $liste['studiPosInList']."</div></div>";
    }
    else
    {	$liste[ 'infoTxt' ] = '<div class="menuItem0c">Sie sind nicht in dieser Liste eingetragen</div>';
    }

    return $liste;
  }
	
	function getStudiPosInList( $listen, $userKennung )  // Ermittelt die Position des Studis in der Liste
	{ for($i = 0; $i < sizeof( $listen['studiListe'] ); $i++ )
		{ if( $listen[ 'studiListe' ][ $i ][ 'kennung' ] == $userKennung )
			return $i+1;
		}
		return 0;
	}
    
  function br2nl( $string )
  { return preg_replace("/<br[^>]*>\s*\r*\n*/is", "\n", $string);
  }
}
?>