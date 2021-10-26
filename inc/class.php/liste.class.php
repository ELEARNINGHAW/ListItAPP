<?php

function deb( $var, $kill = false )
{ echo "<pre>";
  print_r( $var );
  echo "</pre>";
  if ( $kill ) { die(); }
}

class Liste
{ var $db;
  function __construct( $db )
  {  $this -> db =  $db ;
  }

	function getListenValue( )				// -- TODO -- VALIDATE CHECKEN!!  SECURITY! ------
	{ $stdlst      = $_SESSION[ 'stdlst'      ];
    $currentList = $_SESSION[ 'currentList' ];
 
    if (isset( $currentList[ 'courseID'  	] ) )   {                                                                                       } else { $currentList[ 'courseID'	     ]	= $stdlst[ 'courseID'	     ]; }
    if (isset( $currentList[ 'courseName' ] ) )   {                                                                                       } else { $currentList[ 'courseName'    ]	= $stdlst[ 'courseName'    ]; }
    if (isset( $_POST[ 'datum'			      ] ) )   { $currentList[ 'datum'	        ]	= $this->db->getDateSet( $_POST[ 'datum'	       ] ); } else { $currentList[ 'datum'	       ]	= $stdlst[ 'datum'	       ]; }
    if (isset( $_POST[ 'activeT_start'    ] ) )   { $currentList[ 'activeT_start' ]	= $this->db->getDateSet( $_POST[ 'activeT_start' ] ); } else { $currentList[ 'activeT_start' ]	= $stdlst[ 'activeT_start' ]; }
    if (isset( $_POST[ 'activeT_end'		  ] ) )   { $currentList[ 'activeT_end'	  ]	= $this->db->getDateSet( $_POST[ 'activeT_end'   ] ); } else { $currentList[ 'activeT_end'	 ]	= $stdlst[ 'activeT_end'	 ]; }
    if (isset( $_POST[ 'visibleT_start'   ] ) )   { $currentList[ 'visibleT_start']	= $this->db->getDateSet( $_POST[ 'visibleT_start'] ); } else { $currentList[ 'visibleT_start']	= $stdlst[ 'visibleT_start']; }
    if (isset( $_POST[ 'visibleT_end'	    ] ) )   { $currentList[ 'visibleT_end'  ]	= $this->db->getDateSet( $_POST[ 'visibleT_end'	 ] ); } else { $currentList[ 'visibleT_end'	 ]	= $stdlst[ 'visibleT_end'	 ]; }
    if (isset( $_POST[ 'anzslots'			    ] ) )   { $currentList[ 'anzSlots'	    ]	= $_POST[ 'anzslots'			                       ]  ; } else { $currentList[ 'anzSlots'	     ]	= $stdlst[ 'anzSlots'	     ]; }
    if (isset( $_POST[ 'startzeit'	   	  ] ) )   { $currentList[ 'startZeit'     ]	= $_POST[ 'startzeit'	   	                       ]  ; } else { $currentList[ 'startZeit'     ]	= $stdlst[ 'startZeit'     ]; }
    if (isset( $_POST[ 'endezeit'			    ] ) )   { $currentList[ 'endeZeit'      ]	= $_POST[ 'endezeit'			                       ]  ; } else { $currentList[ 'endeZeit'	     ]	= $stdlst[ 'endeZeit'	     ]; }
    if (isset( $_POST[ 'slotdauer'	      ] ) )   { $currentList[ 'slotDauer'     ]	= $_POST[ 'slotdauer'	                           ]  ; } else { $currentList[ 'slotDauer'     ]	= $stdlst[ 'slotDauer'     ]; }
    if (isset( $_POST[ 'anzstudis'	  	  ] ) )   { $currentList[ 'anzStudis'     ]	= $_POST[ 'anzstudis'	  	                       ]  ; } else { $currentList[ 'anzStudis'     ]	= $stdlst[ 'anzStudis'     ]; }
    if (isset( $_POST[ 'kollhead'			    ] ) )   { $currentList[ 'kollHead'      ]	= $_POST[ 'kollhead'			                       ]  ; } else { $currentList[ 'kollHead'	     ]	= $stdlst[ 'kollHead'	     ]; }
    if (isset( $_POST[ 'visibleA'		   	  ] ) )   { $currentList[ 'visibleA'      ]	= $_POST[ 'visibleA'	   	                       ]  ; } else { $currentList[ 'visibleA'	     ]	= $stdlst[ 'visibleA'	     ]; }
    if (isset( $_POST[ 'activeA'	 	      ] ) )   { $currentList[ 'activeA'       ]	= $_POST[ 'activeA'		  	                       ]  ; } else { $currentList[ 'activeA'	     ]	= $stdlst[ 'activeA'       ]; }
    if (isset( $_POST[ 'anonymA'	 	      ] ) )   { $currentList[ 'anonymA'       ]	= $_POST[ 'anonymA'		  	                       ]  ; } else { $currentList[ 'anonymA'	     ]	= $stdlst[ 'anonymA'       ]; }
    if (isset( $_POST[ 'visibleT'		   	  ] ) )   { $currentList[ 'visibleT'      ]	= $_POST[ 'visibleT'	   	                       ]  ; } else { $currentList[ 'visibleT'	     ]	= $stdlst[ 'visibleT'	     ]; }
    if (isset( $_POST[ 'activeT'	 	      ] ) )   { $currentList[ 'activeT'       ]	= $_POST[ 'activeT'		  	                       ]  ; } else { $currentList[ 'activeT'	     ]	= $stdlst[ 'activeT'       ]; }
    if (isset( $_POST[ 'split' 		        ] ) )   { $currentList[ 'split'         ]	= $_POST[ 'split' 		                           ]  ; } else { $currentList[ 'split'		     ]	= $stdlst[ 'split'		     ]; }
    if (isset( $_POST[ 'kollinfo'         ] ) )   { $currentList[ 'kollInfo'      ]	= nl2br( $_POST[ 'kollinfo'                      ] ); } else { $currentList[ 'kollInfo'	     ]	= $stdlst[ 'kollInfo'      ]; }
    if (isset( $_POST[ 'aktion'	          ] ) )   { $currentList[ 'aktion'        ]	= trim(  $_POST[ 'aktion'	                       ] ); } else { $currentList[ 'aktion'	       ]	= $stdlst[ 'aktion'	       ]; }
 
    if(      isset( $_POST[ 'listID'      ] ) )	  { $currentList[ 'listID'        ] = $_POST[ 'listID'                     ] ;}
    else if( isset( $_GET [ 'listID'      ] ) )	  { $currentList[ 'listID'        ] = $_GET [ 'listID'                     ] ;}
    else                                          { $currentList[ 'listID'        ] = $stdlst[ 'listID'                    ] ;
                                                    $currentList[ 'visibleA'	    ] = 1;
                                                    $currentList[ 'activeA'	      ] = 1                                      ;}
    $_SESSION[ 'currentList'   ] = $currentList ;
 
    return $currentList;
	}
	
	function getData()
  { if( $_POST );																	// ------------- POST DATEN ------------------
    { // -- TODO -- VALIDATE CHECKEN!!  SECURITY! ------
      $listUB = ( isset ( $_POST[ 'userbutton' ] ) ) ? trim( $_POST[ 'userbutton' ] ) : '';
      $listID = ( isset ( $_POST[ 'listID'     ] ) ) ?       $_POST[ 'listID'     ]   : '';
    }
  }

	function decodeAuthData()
	{ $_SESSION[' salt' ] = '"dfgb%TBGI$"ert3QZU/ZU!335 "3 35ertwetwert%wertQer$tZHetr%&et$UetwertU"ertEe%tTert/e&rtEwe h$OrzPtr/zKertz(rtJzWertt%EUI §$O "$ $TZqerz wgr f"';
    if ( isset ($_GET[ 'uun' ] ) )
    {
    $currentUser = array();
    $currentList = array();
    
    $d = getdate();
    $epoc = mktime(0,0,0, $d['mon'], $d['mday'], $d['year'] );
    $today = $this -> db -> epoc2Date( $epoc );
  
    $r = rand( 1, 9 );
    $stdusr[ 'userVorname'	  ] = "werner"       .$r;
    $stdusr[ 'userNachname'  	]	= "welte"        .$r;
    $stdusr[ 'userKennung'	  ]	= "aaa123"       .$r;
    $stdusr[ 'userID'	        ]	= "1234"         .$r;
    $stdusr[ 'userEmail'	  	]	= "werner.welte@".$r;
    $stdusr[ 'userRole'	    	]	= "4";
    
    $stdlst[ 'listID'	       ] = '0';
    $stdlst[ 'courseID'	     ] = '0';
    $stdlst[ 'courseName'    ] = 'Kursname';
    $stdlst[ 'datum'	       ] = $today;
    $stdlst[ 'startZeit'     ] = '10:00';
    $stdlst[ 'endeZeit'	     ] = '12:00';
    $stdlst[ 'startZeit2'    ] = '1000';
    $stdlst[ 'endeZeit2'     ] = '1200';
    $stdlst[ 'slotDauer'     ] = '30';
    $stdlst[ 'anzStudis'     ] = '1';
    $stdlst[ 'anzSlots'      ] = '1';
    $stdlst[ 'kollHead'	     ] = 'Listenname';
    $stdlst[ 'kollInfo'      ] = 'Listeninfo';
    $stdlst[ 'split'		     ] =  0;
    $stdlst[ 'aktion'	       ] = '0';
    $stdlst[ 'token'         ] = '';
    $stdlst[ 'timeline'      ] =  0;
    $stdlst[ 'infoTxt'       ] = '';
    $stdlst[ 'studiIsInList' ] =  0;
    $stdlst[ 'visibleA'		   ] =  0;
    $stdlst[ 'activeA'       ] =  0;
    $stdlst[ 'anonymA'       ] =  0;
    $stdlst[ 'visibleT'		   ] =  0;
    $stdlst[ 'activeT'       ] =  0;
  
    $stdlst[ 'activeT_start' ]['d1'] = '';
    $stdlst[ 'activeT_start' ]['da'] = '';
    $stdlst[ 'activeT_start' ]['mo'] = '';
    $stdlst[ 'activeT_start' ]['yr'] = '';
    $stdlst[ 'activeT_start' ]['wd'] = '';
    $stdlst[ 'activeT_start' ]['ep'] = '';
    $stdlst[ 'activeT_start' ]['MO'] = '';
    $stdlst[ 'activeT_start' ]['WD'] = '';

    $stdlst[ 'activeT_end'	 ]['d1'] = '';
    $stdlst[ 'activeT_end'	 ]['da'] = '';
    $stdlst[ 'activeT_end'	 ]['mo'] = '';
    $stdlst[ 'activeT_end'	 ]['yr'] = '';
    $stdlst[ 'activeT_end'	 ]['wd'] = '';
    $stdlst[ 'activeT_end'	 ]['ep'] = '';
    $stdlst[ 'activeT_end'	 ]['MO'] = '';
    $stdlst[ 'activeT_end'	 ]['WD'] = '';

    $stdlst[ 'visibleT_start']['d1'] = '';
    $stdlst[ 'visibleT_start']['da'] = '';
    $stdlst[ 'visibleT_start']['mo'] = '';
    $stdlst[ 'visibleT_start']['yr'] = '';
    $stdlst[ 'visibleT_start']['wd'] = '';
    $stdlst[ 'visibleT_start']['ep'] = '';
    $stdlst[ 'visibleT_start']['MO'] = '';
    $stdlst[ 'visibleT_start']['WD'] = '';

    $stdlst[ 'visibleT_end'  ]['d1'] = '';
    $stdlst[ 'visibleT_end'  ]['da'] = '';
    $stdlst[ 'visibleT_end'  ]['mo'] = '';
    $stdlst[ 'visibleT_end'  ]['yr'] = '';
    $stdlst[ 'visibleT_end'  ]['wd'] = '';
    $stdlst[ 'visibleT_end'  ]['ep'] = '';
    $stdlst[ 'visibleT_end'  ]['MO'] = '';
    $stdlst[ 'visibleT_end'  ]['WD'] = '';
    
    $currentUser = $_SESSION[ 'stdusr'  ] = $stdusr;
    $currentList = $_SESSION[ 'stdlst'  ] = $stdlst;

    if ( isset( $_GET[ 'ufn' ] ) ) {  $currentUser[ 'userVorname'   ] = base64_decode(  rawurldecode( $_GET[ 'ufn' ] ) ); }
    if ( isset( $_GET[ 'uln' ] ) ) {  $currentUser[ 'userNachname'  ] = base64_decode(  rawurldecode( $_GET[ 'uln' ] ) ); }
    if ( isset( $_GET[ 'uid' ] ) ) {  $currentUser[ 'userKennung'   ] = base64_decode(  rawurldecode( $_GET[ 'uid' ] ) ); }
    if ( isset( $_GET[ 'uun' ] ) ) {  $currentUser[ 'userID'        ] = base64_decode(  rawurldecode( $_GET[ 'uun' ] ) ); }
    if ( isset( $_GET[ 'uem' ] ) ) {  $currentUser[ 'userEmail'     ] = base64_decode(  rawurldecode( $_GET[ 'uem' ] ) ); }
    if ( isset( $_GET[ 'rol' ] ) ) {  $currentUser[ 'userRole'      ] = base64_decode(  rawurldecode( $_GET[ 'rol' ] ) ); }

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
  
    $_SESSION[ 'currentUser' ] = $currentUser;
    $_SESSION[ 'currentList' ] = $currentList;
    $_SESSION[ 'stdlst'      ] = $stdlst;
    $_SESSION[ 'stdusr'      ] = $stdusr;
 
    $token = hash('sha512',
     $currentUser[ 'userVorname'   ] .
    $currentUser[ 'userNachname'  ] .
    $currentUser[ 'userKennung'   ] .
    $currentUser[ 'userID'        ] .
    $currentUser[ 'userEmail'     ] .
    $currentList[ 'courseID'      ] .
    $currentList[ 'courseName'    ] .
    $_SESSION[' salt'             ] );
 
    if ( $currentList[ 'token' ] != ( $token ) )
    { die("not allowed");
    }
    
    $_SESSION[ 'svg' ][ 'lock'    ][0] = 'inc/img/edit_0.svg';
    $_SESSION[ 'svg' ][ 'lock'    ][1] = 'inc/img/edit_1.svg';
    $_SESSION[ 'svg' ][ 'visible' ][0] = 'inc/img/eye_0.svg';
    $_SESSION[ 'svg' ][ 'visible' ][1] = 'inc/img/eye_1.svg';
    $_SESSION[ 'svg' ][ 'anonym'  ][0] = 'inc/img/anon_0.svg';
    $_SESSION[ 'svg' ][ 'anonym'  ][1] = 'inc/img/anon_1.svg';
  }
	}
	
	function renderSite()
	{ $liste = $_SESSION['currentList'];
 
	  $site  = $liste[ 'template1' ] ;

		if ( isset( $liste[ 'listID'	      ] ) )  { $site = str_replace( "#listID#"            , $liste[ 'listID'	   	  ]	      ,  $site  ); }
    if ( isset( $liste[ 'courseName'	  ] ) )  { $site = str_replace( "#courseName#"        , $liste[ 'courseName'	  ]	      ,  $site  ); }
    if ( isset( $liste[ 'startZeit'  	  ] ) )  { $site = str_replace( "#startZeit#"         , $liste[ 'startZeit'     ]	      ,  $site  ); }
    if ( isset( $liste[ 'endeZeit'		  ] ) )  { $site = str_replace( "#endeZeit#"          , $liste[ 'endeZeit'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'startZeit2'    ] ) )  { $site = str_replace( "#startZeit2#"        , $liste[ 'startZeit2' 	  ]	      ,  $site  ); }
    if ( isset( $liste[ 'endeZeit2'     ] ) )  { $site = str_replace( "#endeZeit2#"         , $liste[ 'endeZeit2'	    ]	      ,  $site  ); }
    if ( isset( $liste[ 'slotDauer'	  	] ) )  { $site = str_replace( "#slotDauer#"         , $liste[ 'slotDauer'	    ]	      ,  $site  ); }
    if ( isset( $liste[ 'anzStudis'	  	] ) )  { $site = str_replace( "#anzStudisProSlot#"  , $liste[ 'anzStudis'	    ]	      ,  $site  ); }
    if ( isset( $liste[ 'kollHead'	  	] ) )  { $site = str_replace( "#kollHead#"          , $liste[ 'kollHead'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'anzSlots'  		] ) )  { $site = str_replace( "#anzSlots#"          , $liste[ 'anzSlots'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'VIS'     	  	] ) )  { $site = str_replace( "#VIS#"               , $liste[ 'VIS'     		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'VISLabel'      ] ) )  { $site = str_replace( "#VISLabel#"          , $liste[ 'VISLabel'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'VISALabel'     ] ) )  { $site = str_replace( "#VISALabel#"         , $liste[ 'VISALabel'	    ]	      ,  $site  ); }
    if ( isset( $liste[ 'VIS_A'        	] ) )  { $site = str_replace( "#VIS_A#"             , $liste[ 'VIS_A'	        ]	      ,  $site  ); }
    if ( isset( $liste[ 'VIS_T'         ] ) )  { $site = str_replace( "#VIS_T#"             , $liste[ 'VIS_T'	        ]	      ,  $site  ); }
    if ( isset( $liste[ 'ACT'	      		] ) )  { $site = str_replace( "#ACT#"               , $liste[ 'ACT'     		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'ACTLabel'    	] ) )  { $site = str_replace( "#ACTLabel#"          , $liste[ 'ACTLabel'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'ACTALabel'    	] ) )  { $site = str_replace( "#ACTALabel#"         , $liste[ 'ACTALabel'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'ACT_A'         ] ) )  { $site = str_replace( "#ACT_A#"             , $liste[ 'ACT_A'	        ]	      ,  $site  ); }
    if ( isset( $liste[ 'ACT_T'         ] ) )  { $site = str_replace( "#ACT_T#"             , $liste[ 'ACT_T'	        ]	      ,  $site  ); }
    if ( isset( $liste[ 'ANOLabel'    	] ) )  { $site = str_replace( "#ANOLabel#"          , $liste[ 'ANOLabel'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'ANOALabel'    	] ) )  { $site = str_replace( "#ANOALabel#"         , $liste[ 'ANOALabel'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'ANO_A'         ] ) )  { $site = str_replace( "#ANO_A#"             , $liste[ 'ANO_A'	        ]	      ,  $site  ); }
    if ( isset( $liste[ 'ANO_T'         ] ) )  { $site = str_replace( "#ANO_T#"             , $liste[ 'ANO_T'	        ]	      ,  $site  ); }
    if ( isset( $liste[ 'listlist'	  	] ) )  { $site = str_replace( "#listlist#"          , $liste[ 'listlist'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'userlist'		  ] ) )  { $site = str_replace( "#userlist#"          , $liste[ 'userlist'		  ]	      ,  $site  ); }
    if ( isset( $liste[ 'anonymA'      	] ) )  { $site = str_replace( "#anonymA#"           , $liste[ 'anonymA'       ]	      ,  $site  ); }
    if ( isset( $liste[ 'anonymL'      	] ) )  { $site = str_replace( "#anonymL#"           , $liste[ 'anonymL'       ]	      ,  $site  ); }
    if ( isset( $liste[ 'visibleA'    	] ) )  { $site = str_replace( "#visibleA#"          , $liste[ 'visibleA'      ]	      ,  $site  ); }
    if ( isset( $liste[ 'visibleT'    	] ) )  { $site = str_replace( "#visibleT#"          , $liste[ 'visibleT'      ]	      ,  $site  ); }
    if ( isset( $liste[ 'visibleL'    	] ) )  { $site = str_replace( "#visibleL#"          , $liste[ 'visibleL'      ]	      ,  $site  ); }
    if ( isset( $liste[ 'activeA'		    ] ) )  { $site = str_replace( "#activeA#"           , $liste[ 'activeA'	      ]	      ,  $site  ); }
    if ( isset( $liste[ 'activeT'		    ] ) )  { $site = str_replace( "#activeT#"           , $liste[ 'activeT'	      ]	      ,  $site  ); }
    if ( isset( $liste[ 'activeL'		    ] ) )  { $site = str_replace( "#activeL#"           , $liste[ 'activeL'	      ]	      ,  $site  ); }
    if ( isset( $liste[ 'activeT_start' ] ) )  { $site = str_replace( "#activeT_start#"     , $liste[ 'activeT_start' ]['d1']	,  $site  ); }
    if ( isset( $liste[ 'activeT_end'	  ] ) )  { $site = str_replace( "#activeT_end#"       , $liste[ 'activeT_end'	  ]['d1']	,  $site  ); }
    if ( isset( $liste[ 'visibleT_start'] ) )  { $site = str_replace( "#visibleT_start#"    , $liste[ 'visibleT_start']['d1']	,  $site  ); }
    if ( isset( $liste[ 'visibleT_end'	] ) )  { $site = str_replace( "#visibleT_end#"      , $liste[ 'visibleT_end'  ]['d1']	,  $site  ); }
    if ( isset( $liste[ 'datum'	  		  ] ) )  { $site = str_replace( "#datum#"             , $liste[ 'datum'	  	    ]['d1']	,  $site  ); }
    if ( isset( $liste[ 'kollInfo'		  ] ) )  { $site = str_replace( "#kollInfo#"          , $this -> br2nl( $liste[ 'kollInfo' ] )	,  $site  ); }

		return $site;
	}

	function  renderSite2( $listenHTML )
	{ $page1Template	= file_get_contents( "inc/template/page2.php" );
	  $currentList = $_SESSION[ 'currentList' ];
    $user        = $_SESSION[ 'currentUser' ];
	  $site  = str_replace( "#listID#"	   	   , '' 		        		,  $page1Template  );
		$site  = str_replace( "#kollListen#"		 , $listenHTML				      ,  $site  );
		$site  = str_replace( "#studiVorname#"	 , $user[ 'userVorname'  ]	,  $site  );
		$site  = str_replace( "#studiNachname#"	 , $user[ 'userNachname' ]	,  $site  );
		$site  = str_replace( "#studiKennung#"	 , $user[ 'userKennung'  ]	,  $site  );
		$site  = str_replace( "#studiMatrikel#"	 , $user[ 'userID'       ]	,  $site  );
		$site  = str_replace( "#courseName#"		 , $currentList[ 'courseName'   ]	,  $site  );
	#	$site  = str_replace( "#info#"				     , $currentList[ 'infoText'     ]	,  $site  );
		return $site;
	}
	
	function getNextID( $listID, $liste )
	{ $anzListen = sizeof( $liste );
		for ($i = 0; $i < $anzListen; $i++ )
		{	if ( $liste[ $i ][ 'ID' ] == $listID )
			{  	if ( $i < ( $anzListen-1 ) )  			$ret = $liste[ ( $i + 1 ) ] [ 'ID' ];
				  else                                $ret = $liste[ 0 ][ 'ID' ];
			}
		}
		return $ret;
	}

	function getPrevID($listID, $kolloquium)
	{ $anzKoll = sizeof( $kolloquium );
		$ret = $kolloquium[ $anzKoll ][ 'ID' ];
		for ( $i = $anzKoll; $i >= 0 ; $i-- )
		{	if ( $kolloquium[ $i ][ 'ID' ] == $listID )
		  {	if ( $i >= $anzKoll - 1 ) {	$ret = $kolloquium[ ( $i - 1 )   ][ 'ID' ]; }
			 	else 	                    { $ret = $kolloquium[ $anzKoll - 1 ][ 'ID' ]; }
			}
		}
		return $ret;
	}

	function getCurrentList(  $render ) 	// Ermittelt für das aktuelle Kolloq den Datensatz. // 1.Prio: Neu angelegter 2.Prio den über nächstes/vorhergehendes Koll angewählte 3. Prio. Default = Datensatz 0.
	{ $currentUser = $_SESSION[ 'currentUser' ];
    $currentList = $this -> adaptList( $_SESSION[ 'currentList' ] );
    $listen      = $this -> db -> getListenData( $this );                    # deb( $listen );        // -- Alle aktuellen Kolloqien Daten holen:

    $lis = $listen;
    foreach ( $lis as $li )
    { $listen[ $li[ 'listID' ] ] = $this -> adaptList( $li );
    }
    
    if ( $currentList[ 'listID' ] )										                	// Ansonsten, Wenn Attribut 'POST_ID' dann ist  Kolloqui[POSTID] das aktuelle Kolloq.
		{ $currentList = $listen[ $currentList[ 'listID' ] ];
    }
  
    $currentList[ 'listlist'   ]	= $render -> getListenListeHTML( $listen, $currentList , $this -> db -> ifSplit( $currentList ) );
    $currentList[ 'userlist'   ]	= $render -> createUserListe( $currentList,  $currentUser, false, false ); ;
    $currentList[ 'template1'  ]	= file_get_contents("inc/template/page1.php" );

    $_SESSION['currentList'] = $currentList;
	}

	function adaptList($currentList)
  { $now = time();
    if ( $currentList[ 'activeT_start' ]['ep'] == '' )                 { $ASTep                     = 0;                                       }
    else                                                               { $ASTep                     = $currentList[ 'activeT_start'   ]['ep'] ;}
    if ( $currentList[ 'activeT_end'   ]['ep'] == '' )                 { $ASEep                     = 9999999999;                              }
    else                                                               { $ASEep                     = $currentList[ 'activeT_end'     ]['ep'] ;}
  
    if ( $currentList[ 'visibleT_start' ]['ep'] == '' )                { $VSTep                     = 0;                                       }
    else                                                               { $VSTep                     = $currentList[ 'visibleT_start' ]['ep']  ;}
    if ( $currentList[ 'visibleT_end'   ]['ep'] == '' )                { $VSEep                     = 9999999999;                              }
    else                                                               { $VSEep                     = $currentList[ 'visibleT_end'   ]['ep']  ;}
 
    if  ( ( $VSTep <= $now AND  $now <= $VSEep AND  $currentList[ 'visibleT'  ] == '1' ) OR $currentList[ 'visibleA'  ] == '1')   { $currentList[ 'visibleL' ] = '1';                                     }
    else                                                                                                                          { $currentList[ 'visibleL' ] = '0';                                     }
    if ( ( $ASTep <=  $now AND  $now <= $ASEep AND  $currentList[ 'activeT'   ] == '1' ) OR $currentList[ 'activeA'   ] == '1')   { $currentList[ 'activeL'  ] = '1';                                     }
    else                                                                                                                          { $currentList[ 'activeL'  ] = '0';                                     }
    if (                                                                                    $currentList[ 'anonymA'   ] == '1')   { $currentList[ 'anonymL'  ] = '1';                                     }
    else                                                                                                                          { $currentList[ 'anonymL'  ] = '0';                                     }
 
    if( isset( $currentList[ 'anonymA' ] ) && $currentList[ 'anonymA' ] == '1' )   { $currentList[ 'ANO'	]	= "";         $currentList[ 'ANOALabel'	]	= "AN";     $currentList[ 'ANOLabel'	]	=  $_SESSION[ 'svg' ][ 'anonym' ][1]; $currentList[ 'ANO_A'	]	= 'checked="checked"'; }
    else                                                                           { $currentList[ 'ANO'	]	= "disabled"; $currentList[ 'ANOALabel'	]	= "AUS";    $currentList[ 'ANOLabel'	]	=  $_SESSION[ 'svg' ][ 'anonym' ][0]; $currentList[ 'ANO_A'	]	= '';                  }
    
    if( isset( $currentList[ 'activeA'  ] ) && $currentList[ 'activeA'  ] == '1' ) { $currentList[ 'ACT'	]	= "";          $currentList[ 'ACTALabel']	= "AN";     $currentList[ 'ACT_A'	]	= 'checked="checked"'; }
    else                                                                           { $currentList[ 'ACT'	]	= "disabled";  $currentList[ 'ACTALabel']	= "AUS";    $currentList[ 'ACT_A'	]	= '';                  }
  
    if( isset( $currentList[ 'visibleA' ] ) && $currentList[ 'visibleA' ] == '1' ) { $currentList[ 'VIS'	]	= "";          $currentList[ 'VISALabel']	= "AN";     $currentList[ 'VIS_A'	]	= 'checked="checked"'; }
    else                                                                           { $currentList[ 'VIS'	]	= "disabled";  $currentList[ 'VISALabel']	= "AUS";    $currentList[ 'VIS_A'	]	= '';                  }

    if( isset( $currentList[ 'activeT'  ] ) && $currentList[ 'activeT'  ] == '1' ) { $currentList[ 'ACT'	]	= "";          $currentList[ 'ACTLabel'	]	=  $_SESSION[ 'svg' ][ 'lock'    ][ $currentList[ 'activeL'  ]]; $currentList[ 'ACT_T'	]	= 'checked="checked"'; }
    else                                                                           { $currentList[ 'ACT'	]	= "disabled";  $currentList[ 'ACTLabel'	]	=  $_SESSION[ 'svg' ][ 'lock'    ][ $currentList[ 'activeL'  ]]; $currentList[ 'ACT_T'	]	= '';    }
  
    if( isset( $currentList[ 'visibleT' ] ) && $currentList[ 'visibleT' ] == '1' ) { $currentList[ 'VIS'	]	= "";          $currentList[ 'VISLabel'	]	=  $_SESSION[ 'svg' ][ 'visible' ][ $currentList[ 'visibleL' ]];  $currentList[ 'VIS_T'	]	= 'checked="checked"'; }
    else                                                                           { $currentList[ 'VIS'	]	= "disabled";  $currentList[ 'VISLabel'	]	=  $_SESSION[ 'svg' ][ 'visible' ][ $currentList[ 'visibleL' ]];  $currentList[ 'VIS_T'	]	= '';                  }
    
    return $currentList;
  }
	
	function getAnzSlots( $liste )
	{ $startZeit2 = str_replace(":","",$liste[ 'startZeit' ] );
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
	{ $startZeit = str_replace(":","", $liste[ 'startZeit' ] );
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
	
	function getOnlineKoll( $db ) // Ermittelt für das aktuelle Kolloq den Datensatz. // 1er Datensatz mit Attribut visible=online
	{ $listen =  $db -> getListenData( $this );
 
		foreach( $listen as $liste)
		{ $liste =  $this -> adaptList($liste);
		  #deb( $liste,1 );
		  if ( $liste[ 'visibleL' ] )
			{ $currentListen[ $liste[ 'listID' ] ] =  $this -> getListInfo( $db, $liste );
			}
		}
		return $currentListen;
	}

	function getListInfo($db, $liste)
  { $user   = $_SESSION[ 'currentUser' ];
 
    if (!isset($liste[ 'studiListe' ]))  { $liste[ 'studiListe' ] = array(); }
    $liste[ 'anzStudiInList'  ] = sizeof( $liste[ 'studiListe' ] );
    $liste[ 'studiIsInList'   ] = $db   -> isUserInList( $user, $liste );
    $liste[ 'studiPosInList'  ] = $this -> getStudiPosInList( $liste, $user[ 'userKennung' ] );
    $liste[ 'maxStudisInList' ] = $liste[ 'anzSlots' ] * $liste[ 'anzStudis' ];
    $liste[ 'position'        ] = $liste[ 'maxStudisInList' ] -  $liste[ 'studiPosInList' ]; // ermittelt die Wartelistenposition
    
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
  
  function checkHost()
  {
  }
  
}
?>