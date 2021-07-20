<?php
class KollDB
{	var $db;
	function  __construct( $db = null )
	{	if( $db )
		{	$this -> db = $db;
		}
		else
		{	$this -> db = new SQLite3( 'inc/DB/lister.sqlite.s3db' );
		  if( $this->db )
			{	}
			else
			{	return( "<b>KEINE Verbindung zur Datenbank möglich</b>" );
			}
		}
	}
  
  function getListID( $liste )
  { $SQL = "
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
		,USdatum		
		,kollHead	
		,kollInfo	
		,anzSlots	
		,slotDauer	
		,startZeit	
		,endeZeit	
		,anzStudis	
		,aktiv		
		,editable	
    ,courseID
    ,lastchanged
		)
		VALUES
		(\"".date( "d.m.Y"  ) ."\"
		,\"".date( "Y.m.d"  ) ."\"
		,\"".$liste[ 'kollHead'    ] ."\"
		,\"".$liste[ 'kollInfo'    ] ."\"
		,  ".$liste[ 'anzSlots'    ] ."
		,  ".$liste[ 'slotDauer'   ] ."
		,\"".$liste[ 'startZeit'   ] ."\"
		,\"".$liste[ 'endeZeit'    ] ."\"
		,  ".$liste[ 'anzStudis'   ] ."
		,  ".$liste[ 'aktiv'       ] ."
		,  ".$liste[ 'editable'    ] ."
		,  ".$liste[ 'courseID'    ] ."
		,\"".$liste[ 'now'         ] ."\"
		)
		";
   $this -> db -> exec( $SQL );
   return $this -> getListID( $liste );
	}

	function updateListInDB( $liste, $user )			// Wenn Daten kommen, speicher in Datenbank
	{  $SQL =
		"UPDATE LISTEN SET
		 datum		    =	\"".$this->chkr( $liste[ 'datum'		  ]	)."\"
		,USdatum	    =	\"".$this->chkr( $liste[ 'USdatum'	  ]	)."\"
		,kollHead	    =	\"".$this->chkr( $liste[ 'kollHead'	  ]	)."\"
		,kollInfo	    =	\"".$this->chkr( $liste[ 'kollInfo'	  ]	)."\"
		,anzSlots	    =	\"".$this->chkr( $liste[ 'anzSlots'	  ]	)."\"
		,slotDauer	  =	\"".$this->chkr( $liste[ 'slotDauer'	]	)."\"
		,startZeit	  =	\"".$this->chkr( $liste[ 'startZeit'	]	)."\"
		,endeZeit	    =	\"".$this->chkr( $liste[ 'endeZeit'	  ]	)."\"
		,anzStudis  	=	\"".$this->chkr( $liste[ 'anzStudis'	]	)."\"
		,aktiv	    	=	\"".$this->chkr( $liste[ 'aktiv'	  	]	)."\"
		,editable	    =	\"".$this->chkr( $liste[ 'editable'	  ]	)."\"
		,lastchanged  =	 strftime('%Y-%m-%d %H-%M-%S','now')
		WHERE listID  =	\"".$this->chkr( $liste[ 'listID'     ]	)."\"
		";
 
    return  $this -> db -> exec( $SQL );
	}

	function chkr( $input )
	{	return  $input ;
	}

	function deleteListInDB( $liste, $user )
	{	$SQL ="
		DELETE FROM LISTEN
    WHERE  courseID == \"".$liste[ 'courseID' ]."\" AND listID == \"".$liste[ 'listID' ]."\"";
		return  $this -> db -> exec( $SQL );
	}

//--  Student trägt sich in Liste ein	
function insertUserInListDB( $user, $listID, $listeOnline )// Neuer Satz in DB anlegen
{
 
  if ( $this -> ifSplit( $listeOnline[ $listID ], $user ) == "true" )
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
	(  \"".date('d.m.Y  G:i:s')        ."\"
		,\"". time()                            ."\"
		,\"". $user['userKennung']              ."\"
		,\"". $user['userVorname']              ."\"
		,\"". $user['userNachname']             ."\"
		,\"". $user['userID']                   ."\"
		,\"". $user['userEmail']	                  ."\"
		,\"". $listID                           ."\"
		,\"". $listID ."". $user['userKennung'] ."\"
		,\"". $listeOnline[ $listID ]['courseID']                 ."\"
 	)
	";
	return   $this -> db -> exec( $SQL );
}

//--  Student trägt sich aus Liste aus		
	function deleteUserFromListDB( $user, $listID )
	{	$SQL =  "
		DELETE  FROM USER
		WHERE kollIDkennung == '". $listID ."".$user[ 'userKennung' ]."'";
		return  $this -> db -> exec( $SQL );
	}
	
	function getListenData(  $Li   )
	{
    $liste = $_SESSION[ 'currentList' ];
 
    $listen[ 0 ] = $_SESSION[ 'stdlst' ];
    
    $SQL 	= "SELECT * FROM LISTEN WHERE courseID = ".$liste[ 'courseID' ]." ORDER by USdatum DESC";
 
    $result =  $this -> db -> query( $SQL );
 
		while ( $liste = $result -> fetchArray() )										// Daten zeilenweise in Array speichern
		{ $i =   $liste[ 'listID'     ];
			$listen[ $i ][ 'listID'		  ] = $liste[ 'listID'        ];
      $listen[ $i ][ 'courseID'		] = $liste[ 'courseID'      ];
      $listen[ $i ][ 'courseName'	] = $_SESSION['l'][ 'courseName' ];
			$listen[ $i ][ 'startZeit'	]	= $liste[ 'startZeit'   	];
			$listen[ $i ][ 'endeZeit'	  ]	= $liste[ 'endeZeit' 	    ];
			$listen[ $i ][ 'slotDauer'	]	= $liste[ 'slotDauer'   	];
			$listen[ $i ][ 'anzStudis'	]	= $liste[ 'anzStudis'   	];
			$listen[ $i ][ 'kollHead'	  ]	= $liste[ 'kollHead' 	    ];
			$listen[ $i ][ 'kollInfo'  	]	= $liste[ 'kollInfo'    	];
			$listen[ $i ][ 'aktiv'		  ]	= $liste[ 'aktiv' 	    	];
			$listen[ $i ][ 'editable'	  ]	= $liste[ 'editable'    	];
			$listen[ $i ][ 'studiListe'	]	= $this -> getUserList( $listen[ $i ] );
			$listen[ $i ][ 'anzSlots'	  ]	= $Li -> getAnzSlots( $liste );
			$listen[ $i ][ 'timeline'	  ]	= $Li -> getTimeLine( $listen[ $i ] );
      $listen[ $i ][ 'datum'		  ]	= date_format( date_create( $liste[ 'datum' ] ), 'd.m.Y' );
      $listen[ $i ][ 'USdatum'	  ]	= date_format( date_create( $liste[ 'datum' ] ), 'Y.m.d' );
      $listen[ $i ][ 'startZeit2'	]	= preg_replace( '#:#' , '', $liste[ 'startZeit' 	] ); // Zeit ohne ":" -- "10:20" wird zu "1020"
 			$listen[ $i ][ 'endeZeit2'  ]	= preg_replace( '#:#' , '', $liste[ 'endeZeit' 	] );
		}
  
		return $listen;
	}

	function isUserInList( $user, $liste )
	{ $SQL =  "
		SELECT * FROM USER
		WHERE kollIDkennung =='". $liste[ 'listID' ] ."".$user[ 'userKennung' ]."' AND courseID = ".$liste[ 'courseID' ];

		$result = $this -> db -> query( $SQL );
		
		while ( $kolloq = $result -> fetchArray() )										// Daten zeilenweise in Array speichern
		{ 	$r[]				= $kolloq;
		}
		if ( isset( $r[ 0 ][ 0 ] ) )  return true;
		else                 return false;
	}

	function getUserList( $liste )
	{ $userlist =  array();
    $list = array();
		$SQL = "
		SELECT * FROM USER
		WHERE kolloquiumID == '". $liste[ 'listID' ] ."' AND courseID == '". $liste[ 'courseID' ]."'";
 
		$result =  $this -> db -> query( $SQL );

		while ( $user = $result -> fetchArray() )	// TODO -- kann optimiert werden --
		{
		  $userlist[]				= $user;
		}

		return $userlist;
	}

  
  function ifSplit( $liste  )
	{
	  if (isset( $liste[ 'courseID' ] ) )
    {
      $SQL = "SELECT * FROM SPLIT WHERE courseID = ". $liste[ 'courseID' ];
      $result = $this   -> db -> query( $SQL );
      $split  = $result -> fetchArray();
      if (  isset($split[ 0 ]) && $split[ 0 ] )
      {	return $split[ 0 ];
      }
      else // DB Eintrag besteht noch nocht (z.B init in neuem LR)
      {	$SQL ="INSERT INTO SPLIT ( split, courseID ) VALUES ( \"true\", ".$liste[ 'courseID' ].")";
        $this -> db -> exec( $SQL );
      }
    }
	}

	function updateIfSplit( $liste )			// Wenn Daten kommen, speicher in Datenbank
	{	if ( $liste[ 'split' ] == "true" )
		{	$SQL ="UPDATE SPLIT SET split = \"true\"  WHERE courseID = ".$liste[ 'courseID' ];
 			return  $this->db->exec($SQL );
		}
		else if ( $liste[ 'split' ]  == "false" )
		{	$SQL = "UPDATE SPLIT SET split = \"false\" AND courseID = ".$liste[ 'courseID' ];
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
      $_SESSION[ 'currentList' ][ 'aktiv'		   ] = 1;
      $_SESSION[ 'currentList' ][ 'editable'   ] = 1;
		}
    else if  ( $liste[ 'aktion'  ]   && $liste[ 'aktion' ] == 'NEW' )									// --
    {
      $courseID   = $_SESSION[ 'currentList' ][ 'courseID' ];
      $courseName = $_SESSION[ 'currentList' ][ 'courseName' ];
      $_SESSION[ 'currentList' ] = $_SESSION[ 'stdlst'   ];
      $_SESSION[ 'currentList' ][ 'courseID'   ] = $courseID ;
      $_SESSION[ 'currentList' ][ 'courseName' ] = $courseName ;
      $_SESSION[ 'currentList' ][ 'aktiv'		   ] = 1;
      $_SESSION[ 'currentList' ][ 'editable'   ] = 1;
    }

		return $tmp;
	}
	
	function manipuliateUserDB( $kollOnline)
	{
    $liste = $_SESSION[ 'currentList' ];
    $user  = $_SESSION[ 'currentUser' ];
    
	  $ret = 0;
	  
    if( $_POST );																	// ------------- POST DATEN ------------------
		{	// -- TODO -- VALIDATE CHECKEN!!  SECURITY! ------
			$listUB			=	 ( isset ($_POST[ 'userbutton'	] )) ?  trim( $_POST[ 'userbutton' ]) : '' ;
			$listID			=  ( isset ($_POST[ 'listID'	    ] )) ?		    $_POST[ 'listID'		 ]  : '' ;
 
			if	   	( $listUB	==	'In diese Liste eintragen'   )  { $this -> insertUserInListDB( $user, $listID , $kollOnline);       $ret = 1; }
			else if ( $listUB	==	'Aus dieser Liste austragen' )	{ $this -> deleteUserFromListDB( $user, $listID );	    	          $ret = 2;	}
		}
		return $ret;
  }
}
?>