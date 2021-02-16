<?php
session_start();
//inizio modifica
//ciao

$error="";
$invioRiuscito="";

if ($_POST){
    
    if(!$_POST["email"]){
         
        $error .="Attenzione,non hai inserito l'indirizzo email!";
        
    }
     if(!$_POST["password"]){
        
        $error .="Attenzione,non hai inserito la password!";
    }


    if($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
        
        $error .="Formato email non valido";
    }
     
    if ($error != ""){
        
       $error ='<div class="alert alert-danger" role="alert">'. $error . '</div>';
        
    } else
    
    {
        
        //invio query di login oppure registrazione in base all'attributo name del submit che cambia valore e premiamo il link in questione
        
       
        
        //controlliamo se nel POST è presenta l attributo name con valore uguale a login
        
       // print_r($_POST);
         if(array_key_exists("login",$_POST)){
                         
             //se è presente login allora effettuiamo la procedura di login utente
       $email = $_POST["email"];
        $pwd = $_POST['password'];
                 
        // controlla se utente inserise email e password
        if ($email and $pwd){
         
                    $link_collegamento=mysqli_connect("sdb-b.hosting.stackcp.net","utenti-3136397783","g5m28ofwtl","utenti-3136397783");
        if(mysqli_connect_error()){
        die($error .="Errore nella connessione al database, riprova più tardi"); 
            
        }
            
        $query_da_inviare = "SELECT user FROM tabella_utenti WHERE user = '".mysqli_real_escape_string($link_collegamento, $email)."'";

            $risultato = mysqli_query($link_collegamento,$query_da_inviare);
            $io = mysqli_num_rows($risultato);

            if ($io > 0){
                 
                //email presente, adesso confrontre accoppiata email e password
                $query_da_inviare = "SELECT pwd FROM tabella_utenti WHERE user = '".mysqli_real_escape_string($link_collegamento, $email)."'";
                
                 $risultato = mysqli_query($link_collegamento,$query_da_inviare);
                 $riga= mysqli_fetch_array($risultato);
                
                
                $salto="ghj7h35j2n098";
                $pwd_criptata = md5($salto.$pwd);
        
               
                if($riga['0'] == $pwd_criptata){
                    
                   
                     //impostare sessione e cookie e reindirizzare a diario_segreto.php
                     $_SESSION['sessione'] = $email;
                   // setcookie("biscotto","3u5ng924h46",time() + 60 * 60 * 24);

                    header("Location: diario_segreto.php");
                     echo "passwprd corretta";
                    
                    
                    
                    
                }else {
                    
                   $error .="Attenzione,hai inserito una password errata, riprova";
                }
                
            }else{
                 $error .="utente non registrato,clicca su REGISTRATI ed effettua la registrazione";
            }

            
            
        }
           
        
             
            ////////////////////////////////////////////////////////////////////////////            
                            }
                           else {
   //se non è presente l'attributo login (sarà modificato con valore "register") allora effettuiamo la procedura di registrazione utente utente

                               
          $email = $_POST["email"];
        $pwd = $_POST['password'];

        // controlla se utente inserise email e password
        if ($email and $pwd){


            $link_collegamento=mysqli_connect("sdb-b.hosting.stackcp.net","utenti-3136397783","g5m28ofwtl","utenti-3136397783");
        if(mysqli_connect_error()){
        die($error .="errore nella connessione del database, riprova più tardi");    
        }

        $query_da_inviare = "SELECT user FROM tabella_utenti WHERE user = '".mysqli_real_escape_string($link_collegamento, $email)."'";

            $risultato = mysqli_query($link_collegamento,$query_da_inviare);
            $io = mysqli_num_rows($risultato);

            if ($io > 0){

                die ($error .="Registrazione fallita, email gia presente, usa un altra email o effettua il login");
            }


        else{
            
            
            //procedere con la registrazione
             $salto="ghj7h35j2n098";
         $pwd_criptata = md5($salto.$pwd);
            
             $query_da_inviare2= "INSERT INTO tabella_utenti (user,pwd) VALUES ('".mysqli_real_escape_string($link_collegamento, $email)."','".mysqli_real_escape_string($link_collegamento, $pwd_criptata)."')";
             mysqli_query($link_collegamento,$query_da_inviare2);
           
              $_SESSION['sessione'] = $email;
           // setcookie("biscotto","3u5ng924h46",time() + 60 * 60 * 24);
            header("Location: diario_segreto.php");
            
             echo "registrazioen avvenuta con sucesso";
            
            //impostare sessione e cookie e reindirizzare a diario_segreto.php
            

        }


        } else{
           //echo "email o password mancanti";
            $error .="email o password mancanti";
        }
            

}
                            
                            }
        
        ////////////////////////////////////////////////////////
        
       
    }
    

  if ($error != ""){
        
       $error ='<div class="alert alert-danger" role="alert">'. $error . '</div>';
        
    }




?>
<!doctype html>
        <html lang="en">
          <head>
            
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
              
                <link rel="stylesheet" href="diario.css">
            <title>Diario segreto</title>
              
              
          </head>
          <body>
              
               <div class="container">
           <h1>DIARIO SEGRETO</h1>
            
                   
                   
<div id="errore">
<?php echo $error.$invioRiuscito; ?>
</div>
                   
                   
              <form method="post">
                  <div class="form-group">
                    <label for="email">Indirizzo Email</label>
                    <input name="email" type="emaill" class="form-control" id="email" placeholder="name@example.com">
                  </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="">
                  </div>
               
                   <button type="submit" name= "login" class="btn btn-primary" id="submit">Login</button>
                </form>
                   
               
                   
                 <a id="myLink">Registrati</a>
                   
                   
                  <script type="text/javascript"> 
                     
                      
                     document.getElementById("myLink").onclick = function(){
                          
                
                         if(document.getElementById("submit").innerHTML=="Login"){
                             
                             document.getElementById("myLink").innerHTML="Login";
                             document.getElementById("submit").innerHTML="Registrati";
                             //cambviare attributo name de  submit da login a register
                             var b = document.querySelector("button");
                             b.setAttribute("name", "register");
                            
                            
                             
                            }
                           else {

                             
                             document.getElementById("myLink").innerHTML="Registrati";
                             document.getElementById("submit").innerHTML="Login";
                             //cambviare attributo name de  submit da register  a login
                               var b = document.querySelector("button");
                             b.setAttribute("name", "login");
                            }
                     
                       

                        }
                    
                  </script>
      
           
                   
              </div>

              
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
              
              
           <script>
           
               //interrompiamo il flusso del form se premiamo il tasto submit per permetterci di effettuare prima il controllo
               
               //puntiamo sull'azione submit del form
               $("form").submit(function(e){  
                   //interrompiamo la funzione del sumbit
                  // e.preventDefault();
               
                   
                   //inizializziamo una variabile striga vuota che conterrà gli eventuali errori
               var error = "";
                   
      
                   //controlliamo se il campo mail  è vuoto e se lo è riempiamo la variabile errror
              if ($("#email").val() == ""){
                  error += "<p>manca l'indirizzo email<br></p>";
                  
               } 
                    //controlliamo se il campo ogetto  è vuoto e se lo è riempiamo la variabile errror
                    if ($("#password").val() == ""){
                   error += "<p>manca l'pwd<br></p>";
                
               }
                   
                   //se la variabile error è diversa da vuoto quindi è stata riempita con degli errori...
                   if(error != ""){
                       
                       //rendiamo il tag div che elenca gli errori con le classi di bootstrap e  aggiungiamo l'errore
                     $("#errore").html("<div class='alert alert-danger' role='alert'>"+ error + "</div>");
                       
                       return false;
                   }
                   else{
                      
                       return true; 
                   }
                    });
               
           </script>   
            
   
          </body>
       </html>
