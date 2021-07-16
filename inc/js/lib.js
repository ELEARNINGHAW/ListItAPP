function show_block(block, anzBlocks)
{

 try {
if (animatedcollapse)
{
animatedcollapse.toggle(block);
}
else
{
if(anzBlocks) hide_block(anzBlocks);
if ( document.getElementById(block).style.display == "block" )
 { document.getElementById(block).style.display = "none";        }
 else
 { document.getElementById(block).style.display = "block";    }
}
 }

catch (e)
{

{
 
if(anzBlocks) hide_block(anzBlocks);
if ( document.getElementById(block).style.display == "block" )
 { document.getElementById(block).style.display = "none";        }
 else
 { document.getElementById(block).style.display = "block";    }
}

}
}
function hide_block(anzBlocks)
{
 /* Originaltext vestecken */  
 if (document.getElementById("block0"))
    document.getElementById("block0").style.visibility = "hidden";

 /* Alle Blöcke verschwinden lassen */  
 for (i = 1; i < anzBlocks + 1; i++ )
  eval("document.getElementById(\"block"+i+"\").style.display = \"none\";");   
}