<?php
session_start();

if ($_POST['contenuto']){
    
    
    $link_collegamento=mysqli_connect("sdb-b.hosting.stackcp.net","utenti-3136397783","g5m28ofwtl","utenti-3136397783");
            if(mysqli_connect_error()){
                die("è presente un errore riprova");    
            }
   // echo $_POST['contenuto'];
    //echo $_SESSION['sessione'];
            
               $query_da_inviare= "UPDATE tabella_utenti SET diario = '".$_POST['contenuto']."' WHERE user='".$_SESSION['sessione']."' LIMIT 1";
            
                if($risultato = mysqli_query($link_collegamento,$query_da_inviare)){
                
                //echo "query inviata ed eseguita correttamente";
                
                } else {
                  //  echo "errore query";
                }
    
    
    
             
            }
            

    
    
  




?