<?php
class KollDB
{	var $db;
	function  __construct( $db = null )
	{	if( $db )
		{	$this -> db = $db;
		}
		else
		{	$this -> db = new SQLite3( 'inc/DB/lister.sqlite.s3db' );
		  if( ! $this->db )
			{	return( "<b>KEINE Verbindung zur Datenbank möglich</b>" );
			}
		}
	}
  
  function getListID( $liste )
  {
    $liste[ 'now'      ] = $this -> chkr( $liste[ 'now'      ] );
    $liste[ 'courseID' ] = $this -> chkr( $liste[ 'courseID' ] );
    
    $SQL = "
		SELECT listID FROM LISTEN
		WHERE lastchanged == '". $liste[ 'now' ] ."' AND courseID == '". $liste[ 'courseID' ]."'";
  
    $listID =  $this -> db -> querySingle( $SQL );
    $_SESSION[ 'currentList' ]['listID']	= $listID;
    return $listID;
  }
  
  function insertNewListInDB( $liste )// Neuer Satz in DB anlegen mit Standarddaten
	{ $liste['now'] =   strftime( '%Y-%m-%d %H-%M-%S'  );
  
	  $SQL ="INSERT INTO LISTEN
		(datum
		,kollHead
		,kollInfo	
		,anzSlots	
		,slotDauer	
		,startZeit	
		,endeZeit	
		,anzStudis	
    ,courseID
    ,lastchanged
		,visibleT
		,activeT
		,visibleA
		,activeA
		,anonymA
    ,activeT_start
    ,activeT_end
    ,visibleT_start
    ,visibleT_end
		)
		VALUES
		(\"".$this -> chkr( $liste[ 'datum'         ]['ep']  ) ."\"
		,\"".$this -> chkr( $liste[ 'kollHead'      ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'kollInfo'      ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'anzSlots'      ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'slotDauer'     ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'startZeit'     ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'endeZeit'      ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'anzStudis'     ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'courseID'      ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'now'           ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'visibleT'      ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'activeT'       ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'visibleA'      ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'activeA'       ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'anonymA'       ]        ) ."\"
		,\"".$this -> chkr( $liste[ 'activeT_start'  ]['ep'] ) ."\"
		,\"".$this -> chkr( $liste[ 'activeT_end'    ]['ep'] ) ."\"
		,\"".$this -> chkr( $liste[ 'visibleT_start' ]['ep'] ) ."\"
		,\"".$this -> chkr( $liste[ 'visibleT_end'   ]['ep'] ) ."\"
		)
		";
 #deb($SQL,1);
   $this -> db -> exec( $SQL );
   return $this -> getListID( $liste );
	}

	function updateListInDB( $liste, $user )
	{  $SQL =	"UPDATE LISTEN SET ";
     $SQL .=	"lastchanged   =	 strftime('%Y-%m-%d %H-%M-%S','now' )";

	if ( isset( $liste[ 'datum'		       ][ 'ep' ] ) ) {$SQL .=	" ,datum		     =	\"".$this -> chkr( $liste[ 'datum'		      ][ 'ep' ]	)."\"" ; }
  if ( isset( $liste[ 'activeT_start'  ][ 'ep' ] ) ) {$SQL .=	"	,activeT_start =	\"".$this -> chkr( $liste[ 'activeT_start'  ][ 'ep' ]	)."\"" ; }
	if ( isset( $liste[ 'activeT_end'	   ][ 'ep' ] ) ) {$SQL .=	"	,activeT_end	 =	\"".$this -> chkr( $liste[ 'activeT_end'	  ][ 'ep' ]	)."\"" ; }
	if ( isset( $liste[ 'visibleT_start' ][ 'ep' ] ) ) {$SQL .=	"	,visibleT_start=	\"".$this -> chkr( $liste[ 'visibleT_start' ][ 'ep' ]	)."\"" ; }
	if ( isset( $liste[ 'visibleT_end'   ][ 'ep' ] ) ) {$SQL .=	"	,visibleT_end	 =	\"".$this -> chkr( $liste[ 'visibleT_end'   ][ 'ep' ]	)."\"" ; }
  if ( isset( $liste[ 'visibleT'	             ] ) ) {$SQL .=	"	,visibleT	   	 =	\"".$this -> chkr( $liste[ 'visibleT'	             ]	)."\"" ; }
  if ( isset( $liste[ 'activeT'	               ] ) ) {$SQL .=	"	,activeT	     =	\"".$this -> chkr( $liste[ 'activeT'	             ]	)."\"" ; }
  if ( isset( $liste[ 'visibleA'	             ] ) ) {$SQL .=	"	,visibleA	   	 =	\"".$this -> chkr( $liste[ 'visibleA'	             ]	)."\"" ; }
  if ( isset( $liste[ 'activeA'	               ] ) ) {$SQL .=	"	,activeA       =	\"".$this -> chkr( $liste[ 'activeA'	             ]	)."\"" ; }
  if ( isset( $liste[ 'anonymA'	               ] ) ) {$SQL .=	"	,anonymA       =	\"".$this -> chkr( $liste[ 'anonymA'	             ]	)."\"" ; }
	if ( isset( $liste[ 'kollHead'	             ] ) ) {$SQL .=	"	,kollHead	     =	\"".$this -> chkr( $liste[ 'kollHead'	             ]	)."\"" ; }
	if ( isset( $liste[ 'kollInfo'	             ] ) ) {$SQL .=	"	,kollInfo	     =	\"".$this -> chkr( $liste[ 'kollInfo'	             ]	)."\"" ; }
	if ( isset( $liste[ 'anzSlots'	             ] ) ) {$SQL .=	"	,anzSlots	     =	\"".$this -> chkr( $liste[ 'anzSlots'	             ]	)."\"" ; }
	if ( isset( $liste[ 'slotDauer'	             ] ) ) {$SQL .=	"	,slotDauer	   =	\"".$this -> chkr( $liste[ 'slotDauer'	           ]	)."\"" ; }
	if ( isset( $liste[ 'startZeit'	             ] ) ) {$SQL .=	"	,startZeit	   =	\"".$this -> chkr( $liste[ 'startZeit'	           ]	)."\"" ; }
	if ( isset( $liste[ 'endeZeit'	             ] ) ) {$SQL .=	"	,endeZeit	     =	\"".$this -> chkr( $liste[ 'endeZeit'	             ]	)."\"" ; }
	if ( isset( $liste[ 'anzStudis'	             ] ) ) {$SQL .=	"	,anzStudis  	 =	\"".$this -> chkr( $liste[ 'anzStudis'	           ]	)."\"" ; }
                                                     $SQL .=	"	WHERE listID   =	\"".$this -> chkr( $liste[ 'listID'                ]	)."\"" ;
# deb($SQL,1)  ;
  return  $this -> db -> exec( $SQL );
	}

	function deleteListInDB( $liste, $user )
	{	$SQL ="
		DELETE FROM LISTEN
    WHERE  courseID == \"".$this -> chkr( $liste[ 'courseID' ])."\" AND listID == \"".$this -> chkr( $liste[ 'listID' ])."\"";
		return  $this -> db -> exec( $SQL );
	}

//--  Student trägt sich in Liste ein	
function insertUserInListDB( $user, $listID, $listeOnline )
{ if ( $this -> ifSplit( $listeOnline[ $listID ], $user ) == "true" )
	{	if ( $listeOnline )
		foreach ( $listeOnline as $listeOn )
		{	$this -> deleteUserFromListDB( $user, $listeOn[ 'listID' ] );
		}
	}
 
	$SQL ="INSERT INTO USER
    (datum		
    ,timestamp
    ,kennung
    ,firstname	
    ,lastname	
    ,matrikel	
    ,email	
    ,kolloquiumID	
    ,KollIDkennung	
    ,courseID
	)
	VALUES
	(  \"".date('d.m.Y  G:i:s')             ."\"
		,\"". time()                                ."\"
		,\"".$this -> chkr(  $user['userKennung']                )  ."\"
		,\"".$this -> chkr(  $user['userVorname']                )  ."\"
		,\"".$this -> chkr(  $user['userNachname']               )  ."\"
		,\"".$this -> chkr(  $user['userID']                     )  ."\"
		,\"".$this -> chkr(  $user['userEmail']	                 )  ."\"
		,\"".$this -> chkr(  $listID                             )  ."\"
		,\"".$this -> chkr(  $listID ."". $user['userKennung']   )  ."\"
		,\"".$this -> chkr(  $listeOnline[ $listID ]['courseID'] )  ."\"
 	)
	";
	return   $this -> db -> exec( $SQL );
}


	function deleteUserFromListDB( $user, $listID )                  //--  Student trägt sich aus Liste aus
	{	$SQL =  "
		DELETE  FROM USER
		WHERE kollIDkennung == '".$this -> chkr(  $listID ."".$user[ 'userKennung' ] )."'";
		return  $this -> db -> exec( $SQL );
	}
	
	function getListenData(  $Li   )
	{ $liste = $_SESSION[ 'currentList' ];
    $listen[ 0 ] = $_SESSION[ 'stdlst' ];
    
    $SQL 	= "SELECT * FROM LISTEN WHERE courseID = ".$this -> chkr( $liste[ 'courseID' ] )." ORDER by datum ASC";
 
    $result =  $this -> db -> query( $SQL );
 
    while ( $liste = $result -> fetchArray() )										// Daten zeilenweise in Array speichern
		{ $i =   $liste[ 'listID'        ];
      $listen[ $i ][ 'courseName'	   ]  = $_SESSION[ 'l' ][ 'courseName' ];
			$listen[ $i ][ 'listID'		     ]  = $liste[ 'listID'        ];
      $listen[ $i ][ 'courseID'		   ]  = $liste[ 'courseID'      ];
			$listen[ $i ][ 'startZeit'	   ]	= $liste[ 'startZeit'   	];
			$listen[ $i ][ 'endeZeit'	     ]	= $liste[ 'endeZeit' 	    ];
			$listen[ $i ][ 'slotDauer'	   ]	= $liste[ 'slotDauer'   	];
			$listen[ $i ][ 'anzStudis'     ]	= $liste[ 'anzStudis'   	];
			$listen[ $i ][ 'kollHead'	     ]	= $liste[ 'kollHead' 	    ];
			$listen[ $i ][ 'kollInfo'  	   ]	= $liste[ 'kollInfo'    	];
			$listen[ $i ][ 'visibleT'		   ]	= $liste[ 'visibleT' 	   	];
			$listen[ $i ][ 'activeT'	     ]	= $liste[ 'activeT'      	];
      $listen[ $i ][ 'visibleA'	     ]	= $liste[ 'visibleA' 	   	];
      $listen[ $i ][ 'activeA'	     ]	= $liste[ 'activeA'      	];
      $listen[ $i ][ 'anonymA'	     ]	= $liste[ 'anonymA'      	];
			$listen[ $i ][ 'studiListe'	   ]	= $this -> getUserList( $listen[ $i ] );
			$listen[ $i ][ 'anzSlots'	     ]	= $Li   -> getAnzSlots( $liste );
			$listen[ $i ][ 'timeline'	     ]	= $Li   -> getTimeLine( $listen[ $i ] );
      $listen[ $i ][ 'datum'		     ]	= $this -> epoc2Date( $liste[ 'datum' ] );
      $listen[ $i ][ 'activeT_start' ]	= $this -> epoc2Date( $liste[ 'activeT_start'  ] );
      $listen[ $i ][ 'activeT_end'	 ]	= $this -> epoc2Date( $liste[ 'activeT_end'    ] );
      $listen[ $i ][ 'visibleT_start']	= $this -> epoc2Date( $liste[ 'visibleT_start' ] );
      $listen[ $i ][ 'visibleT_end'	 ]	= $this -> epoc2Date( $liste[ 'visibleT_end'   ] );

      $listen[ $i ][ 'startZeit2'	]	= preg_replace( '#:#' , '', $liste[ 'startZeit' 	] ); // Zeit ohne ":" -- "10:20" wird zu "1020"
 			$listen[ $i ][ 'endeZeit2'  ]	= preg_replace( '#:#' , '', $liste[ 'endeZeit' 	] );
		}
 
		return $listen;
	}

	function isUserInList( $user, $liste )
	{ $SQL =  "
		SELECT * FROM USER
		WHERE kollIDkennung =='". $this -> chkr(  $liste[ 'listID' ] ."".$user[ 'userKennung' ] ) . "' AND courseID = ".$liste[ 'courseID' ];

		$result = $this -> db -> query( $SQL );
		
		while ( $kolloq = $result -> fetchArray() )										// Daten zeilenweise in Array speichern
		{ 	$r[]				= $kolloq;
		}
		if ( isset( $r[ 0 ][ 0 ] ) )  return true;
		else                 return false;
	}

	function getUserList( $liste )
	{ $userlist =  array();
		$SQL = "
		SELECT * FROM USER
		WHERE kolloquiumID == '". $this -> chkr( $liste[ 'listID' ] ) ."' AND courseID == '". $this -> chkr( $liste[ 'courseID' ] )."'";
 
		$result =  $this -> db -> query( $SQL );

		while ( $user = $result -> fetchArray() )	// TODO -- kann optimiert werden --
		{ $userlist[]				= $user;
		}

		return $userlist;
	}

  
  function ifSplit( $liste  )
	{ if (isset( $liste[ 'courseID' ] ) )
    { $SQL = "SELECT * FROM SPLIT WHERE courseID = ". $this -> chkr(  $liste[ 'courseID' ] );
      $result = $this   -> db -> query( $SQL );
      $split  = $result -> fetchArray();
      if (  isset($split[ 0 ]) && $split[ 0 ] )
      {	return $split[ 0 ];
      }
      else // DB Eintrag besteht noch nocht (z.B init in neuem LR)
      {	$SQL ="INSERT INTO SPLIT ( split, courseID ) VALUES ( \"true\", ". $this -> chkr( $liste[ 'courseID' ] ).")";
        $this -> db -> exec( $SQL );
      }
    }
	}

	function updateIfSplit( $liste )			// Wenn Daten kommen, speicher in Datenbank
	{	if ( $liste[ 'split' ] == "true" )
		{	$SQL ="UPDATE SPLIT SET split = \"true\"  WHERE courseID = ". $this -> chkr( $liste[ 'courseID' ]);
 			return  $this->db->exec($SQL );
		}
		else if ( $liste[ 'split' ]  == "false" )
		{	$SQL = "UPDATE SPLIT SET split = \"false\" AND courseID = ".$this -> chkr( $liste[ 'courseID' ]);
 			return  $this->db->exec($SQL );
		}
	}
	
	function manipuliateDB( )
  { $liste = $_SESSION[ 'currentList' ];
    $user  = $_SESSION[ 'currentUser' ];
    $tmp   = array();
 
    if (  $liste[ 'split' ]  )
    { $tmp[ 0 ] = $this -> updateIfSplit( $liste );
    }
		
    if      	(  $liste[ 'aktion' ] == 'SAVE'  &&    $liste[ 'listID' ] != 0  )								// -- DB UPDATE ( [SAVE] CLICKED ON FORM )
		{	$tmp[ 1 ] = $this -> updateListInDB( $liste ,$user );
		}	
		else if  ( $liste[ 'aktion' ] == 'SAVE'  &&    $liste[ 'listID' ] == 0  )										// -- DB INSERT new DataSet( [NEW] CLICKED ON FORM )
		{	$tmp[ 2 ] = $this -> insertNewListInDB( $liste );
		}	
		else if  ( $liste[ 'aktion'  ]   && $liste[ 'aktion' ] == 'DELETE!' )						      			// -- DB DELETE DataSet ( [DELETE] CLICKED ON FORM )
		{	$tmp[ 3 ] = $this -> deleteListInDB( $liste , $user );
      $courseID   = $_SESSION[ 'currentList' ][ 'courseID'   ];
      $courseName = $_SESSION[ 'currentList' ][ 'courseName' ];
      $_SESSION[ 'currentList' ] =   $_SESSION[ 'stdlst'     ];
      $_SESSION[ 'currentList' ][ 'courseID'   ] = $courseID ;
      $_SESSION[ 'currentList' ][ 'courseName' ] = $courseName ;
      $_SESSION[ 'currentList' ][ 'visibleT'	 ] = 1;
      $_SESSION[ 'currentList' ][ 'activeT'    ] = 1;
      $_SESSION[ 'currentList' ][ 'visibleA'	 ] = 1;
      $_SESSION[ 'currentList' ][ 'activeA'    ] = 1;
      $_SESSION[ 'currentList' ][ 'anonymA'    ] = 1;
		}
    else if  ( $liste[ 'aktion'  ]   && $liste[ 'aktion' ] == 'NEW' )									// --
    { $courseID   = $_SESSION[ 'currentList' ][ 'courseID' ];
      $courseName = $_SESSION[ 'currentList' ][ 'courseName' ];
      $_SESSION[ 'currentList' ] = $_SESSION[ 'stdlst'   ];
      $_SESSION[ 'currentList' ][ 'courseID'   ] = $courseID ;
      $_SESSION[ 'currentList' ][ 'courseName' ] = $courseName ;
      $_SESSION[ 'currentList' ][ 'visibleT'	 ] = 1;
      $_SESSION[ 'currentList' ][ 'activeT'    ] = 1;
      $_SESSION[ 'currentList' ][ 'visibleA'	 ] = 1;
      $_SESSION[ 'currentList' ][ 'activeA'    ] = 1;
      $_SESSION[ 'currentList' ][ 'anonymA'    ] = 1;
    }

		return $tmp;
	}
	
	function manipuliateUserDB( $kollOnline)
	{ $user  = $_SESSION[ 'currentUser' ];
    
	  $ret = 0;
	  
    if( $_POST );																	// ------------- POST DATEN ------------------
		{	// -- TODO -- VALIDATE CHECKEN!!  SECURITY! ------
			$listUB			=	 ( isset ($_POST[ 'userbutton'	] )) ?  trim( $_POST[ 'userbutton' ]) : '' ;
			$listID			=  ( isset ($_POST[ 'listID'	    ] )) ?		    $_POST[ 'listID'		 ]  : '' ;
 
			if	   	( $listUB	==	'In diese Liste eintragen'   )  { $this -> insertUserInListDB(   $user, $listID , $kollOnline);  $ret = 1; }
			else if ( $listUB	==	'Aus dieser Liste austragen' )	{ $this -> deleteUserFromListDB( $user, $listID              );  $ret = 2;	}
		}
		return $ret;
  }
  
  function epoc2Date( $epoc )
  { $mon = array( 'Jan', 'Feb', 'Mrz', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez' );
    $day = array ('Mo','Di','Mi','Do','Fr','Sa','So');

    if ($epoc != '')
    { $xtd = date("j n Y w", (int)$epoc );
      $xtd = explode( ' ',  $xtd );
      $td[ 'da' ] = $xtd[ 0 ];
      $td[ 'mo' ] = $xtd[ 1 ];
      $td[ 'yr' ] = $xtd[ 2 ];
      $td[ 'wd' ] = $xtd[ 3 ];
      $td[ 'ep' ] = $epoc;
      $td[ 'MO' ] = $mon[ $td[ 'mo' ]  -1 ];
      $td[ 'WD' ] = $day[ $td[ 'wd' ] ];
      $td[ 'd1' ] = $td[ 'da' ] .' '. $td[ 'MO' ] .' '. $td[ 'yr' ];
    }
    else
    {
      $td['da'] = '';
      $td['mo'] = '';
      $td['yr'] = '';
      $td['wd'] = '';
      $td['ep'] = '';
      $td['MO'] = '';
      $td['WD'] = '';
      $td['d1'] = '';
    }
    return $td;
  }
  
  function getDateSet( $date )            #  $date = '25 Sep 2021'
  { $eMon[] = array ('Jan','January'  );
    $eMon[] = array ('Feb','February' );
    $eMon[] = array ('Mrz','March'    );
    $eMon[] = array ('Apr','April'    );
    $eMon[] = array ('Mai','May'      );
    $eMon[] = array ('Jun','June'     );
    $eMon[] = array ('Jul','July'     );
    $eMon[] = array ('Aug','August'   );
    $eMon[] = array ('Sep','September');
    $eMon[] = array ('Okt','October'  );
    $eMon[] = array ('Nov','November' );
    $eMon[] = array ('Dez','December' );
    
    foreach ( $eMon as $m )
    { $date = str_replace(  $m[0],  $m[1],  $date );
    }
    
    return ( $this -> epoc2Date(  strtotime( $date ) ) );
  }
  
  function chkr( $input )
  {
   return  SQLite3::escapeString( $input ) ;
 
  }
  
  
}
?>