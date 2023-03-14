<?php $mysqlConnection = new PDO(
    'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8', 

    USER, 

    PASSWORD,
    
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);
    $requete = $mysqlConnection->prepare('SELECT * FROM user WHERE login= :login OR email= :login  AND pwd= :pwd');
    $requete->execute([
        'login' => $_POST["login"],
        'pwd' => $_POST["pwd"],
    ]);

    $user= $requete->fetch();
  
    if($user){

        $_SESSION["login"]=$_POST["login"];
        $password=$_POST["pwd"];
        $hashed_password=hash('sha256', $password);
        echo"<script>window.location.href='index.php?route=welcome&id=".$user["id_user"]."'</script>";
    }
    else
    {
        echo"<script>window.location.href='index.php?route=login&erreur=1'</script>";
    }
    ?>