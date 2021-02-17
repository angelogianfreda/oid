<?php

session_start();

$error="";

if ($_SESSION['sessione']){
    
     $error = $_SESSION['sessione'];
    // stampare nella textarea il conenuto della tabella sql
    
     $link_collegamento=mysqli_connect("sdb-b.hosting.stackcp.net","utenti-3136397783","g5m28ofwtl","utenti-3136397783");
            if(mysqli_connect_error()){
                die("è presente un errore riprova");    
            }

   // echo $_POST['contenuto'];
    //echo $_SESSION['sessione'];
            
               $query_da_inviare= "SELECT diario FROM tabella_utenti WHERE user='".$_SESSION['sessione']."'";
            
                if($risultato = mysqli_query($link_collegamento,$query_da_inviare)){
                
               $riga= mysqli_fetch_array($risultato);
                
                $appoggio= $riga['0'];
                
                
                
                
                } else {
                  //  echo "errore query";
                }
    
    
    
    
    
    
}else{
    
    echo "<p>non hai i provilegi per visualizzare la pagina</p>";
}
?>
 


<!doctype html>
<html lang="en">
  <head>
        <!--  Link dove scaricare questo documento:  https://getbootstrap.com/docs/4.3/getting-started/introduction/ -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap aggiuntivo -->
       <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/style.css">
      
     
       <link href="diario.css" rel="stylesheet" type="text/css">
      
    <title>diario segreto</title>
     

  </head>
  <body>
      
    
      
      <div class="container contorno text-center">                                        
      <div id="benvenuto">
              <?php echo "Benvenuto nel tuo diario segreto ".$error; ?>
          </div>

<textarea rows="4" cols="50" id="testo" onkeyup="showpreview()"><?php echo $appoggio; ?>
          </textarea>
    
      </div>
      
<script>
function showpreview(){
    /*
con la chiamata ajax ci colleghiamo alla pagina aggirnadatabase, passiamo il paramentro contenuto con post, la pagina processerà il tutto e in msg verrà salvato l'output che visualizzeremo nell'alert
     */
    $.ajax({
  method: "POST",
  url: "aggiornadatabase.php",
        
  data: { contenuto: $("#testo").val()}
        
})
  .done(function( msg ) {
  //  alert( "Data Saved: " + msg );
  });
}
</script>
      
     
      
      
              <!-- Bootstrap aggiuntivo  js-->
        <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
      
      <!-- script per cambiare colore della barra navigazione allo scroll della pagina -->
      <script type="text/javascript" src="javascripts.js"></script>
      
  </body>
</html>