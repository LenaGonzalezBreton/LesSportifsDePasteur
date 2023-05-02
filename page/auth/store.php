<?php

//require 'recaptchalib.php';
//$siteKey = '6LftebglAAAAAMIJoRj1zxSjmT-yqO5b3r2rUQ7-'; // votre clé publique
//$secret = '6LftebglAAAAAJXJtCiHfA58xjcroUSsKJ6FFNjx'; // votre clé privée

//$reCaptcha = new ReCaptcha($secret);
//if(isset($_POST["g-recaptcha-response"])) {
  //  $resp = $reCaptcha->verifyResponse(
    //    $_SERVER["REMOTE_ADDR"],
      //  $_POST["g-recaptcha-response"]
        //);
    //if ($resp != null && $resp->success) {echo "OK";}
    //else {echo "CAPTCHA incorrect";}
    //}

$mysqlConnection = new PDO(
    'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8', 

    USER, 

    PASSWORD,
    
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);
    $requete = $mysqlConnection->prepare('SELECT pwd,id_user,admin FROM user WHERE (login= :login OR email= :login)  ');
    $requete->execute([
        'login' => $_POST["login"],
    ]);

    $user= $requete->fetch();
  
    if($user){
       if( password_verify($_POST["pwd"], $user["pwd"]) == true){

        $_SESSION["login"]=$_POST["login"];
        $_SESSION["droit"]=$user["admin"];
           
        $password=$_POST["pwd"];
       echo"<script>window.location.href='index.php?route=welcome&id=".$user["id_user"]."'</script>";
       }
       else
       {
           echo"<script>window.location.href='index.php?route=login&erreur=1'</script>";
       }
    }
    else
    {
        echo"<script>window.location.href='index.php?route=login&erreur=1'</script>";
    }
    ?>