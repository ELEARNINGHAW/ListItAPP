    function change2Time( t )
	{  var time=new Array();
		
		mm=  t%100;
		if (mm <  10) mm = "0"+mm;
		if (mm >= 60) mm = "55";
       
	    time['m'] = mm;
		time['h'] = Math.floor(t/100);
	     
		return time; 
	}

    function toggleVisible_T( newVal = 2  )  // -- TIMER --
    { if ( newVal == 2 ) // -- TOGGLE --
      { if (($("#visibleT").is(':checked'))) { newVal = 1; }
        else                                        { newVal = 0; }
      }
      $( '#visibleT_start' ).prop('disabled', !newVal       );
      $( '#visibleT_end'   ).prop('disabled', !newVal       );
      $( "#visibleT"       ).val(newVal                          );
    }

    function toggleActive_T( newVal = 2 )  // -- TIMER --
    { if ( newVal == 2 ) // -- TOGGLE --
      { if (($("#activeT").is(':checked')))  { newVal = 1; }
        else                                        { newVal = 0; }
      }
      $( '#activeT_start').prop('disabled', !newVal         );
      $( '#activeT_end'  ).prop('disabled', !newVal         );
      $( "#activeT"      ).val(newVal                            );
    }

    function toggleAnonym_A( newVal = 2 )
    { if (newVal == 2)
    { if ( $( "#anonymA" ).is( ':checked'     ) ) { newVal = 1; }
    else                                                 { newVal = 0; }
    }
    if (newVal == 1)
    { var newlabel       = 'AN';
      var newVal         = 1;
      var rL =  'buttL0'
      var aL =  'buttL1'
      var visimg = 'inc/img/anon_1.svg';
    }
    else
    { var newlabel       = 'AUS';
      var newVal         = 0;
      var rL =  'buttL1'
      var aL =  'buttL0'
      var visimg = 'inc/img/anon_0.svg';
    }

    $("#ANOimg").attr("src", visimg);
    $( '#anonymlabel1' ).removeClass( rL );
    $( '#anonymlabel1' ).addClass( aL    );
    $( "#anonymA"      ).button( "option", "label", newlabel );
    $( "#anonymA"      ).val( newVal                         );
    }



    function toggleVisible_A( newVal = 2 )
    { if (newVal == 2)
      { if ( $( "#visibleA" ).is( ':checked'     ) ) { newVal = 1; }
        else                                                { newVal = 0; }
      }

      if (newVal == 1)
      { var newlabel       = 'AN';
        var newVal         = 1;
        var rL =  'buttL0'
        var aL =  'buttL1'
        var visimg = 'inc/img/eye_1.svg';
      }
      else
      { var newlabel       = 'AUS';
        var newVal         = 0;
        var rL =  'buttL1'
        var aL =  'buttL0'
        var visimg = 'inc/img/eye_0.svg';
      }

      $("#VISimg").attr("src", visimg);
      $( '#visiblelabel1' ).removeClass( rL );
      $( '#visiblelabel1' ).addClass( aL    );
      $( "#visibleA"      ).button( "option", "label", newlabel );
      $( "#visibleA"      ).val( newVal                         );
    }

    function toggleActive_A( newVal = 2)
    {  if (newVal == 2)
       { if ( $( "#activeA" ).is( ':checked'     ) ) { newVal = 1; }
          else                                              { newVal = 0; }
        }
        if (newVal == 1)
        { var newlabel       = 'AN';
          var newVal         = 1;
            var rL =  'buttL0'
            var aL =  'buttL1'
            var actimg = 'inc/img/edit_1.svg';
        }
        else
        { var newlabel       = 'AUS';
          var newVal         = 0;
          var rL =  'buttL1'
          var aL =  'buttL0'
          var actimg = 'inc/img/edit_0.svg';
        }

        $("#ACTimg").attr("src", actimg);
        $( '#activelabel1' ).removeClass( rL );
        $( '#activelabel1' ).addClass( aL    );
        $( "#activeA"      ).button( "option", "label", newlabel );
        $( "#activeA"      ).val( newVal                         );
    }

// -------------------------------------------------------------------------------------------------------	

