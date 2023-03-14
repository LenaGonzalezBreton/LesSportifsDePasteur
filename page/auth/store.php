<?php $mysqlConnection = new PDO(
    'mysql:host='.SERVEUR';dbname='.DBNAME';charset=utf8', 

    USER, 

    PASSWORD,
    
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);
    $requete = $mysqlConnection->prepare('SELECT * FROM user WHERE login= :login OR email= :login  AND pwd= :pwd');
    $requete->execute([
        'login' => $_POST["login"],
        'pwd' => $_POST["pwd"],
    ]);
    session_start();
    $user= $requete->fetch();
    //var_dump($ligne);die();
    if($user){

        $_SESSION["login"]=$_POST["login"];
        $password=$_POST["pwd"];
        $hashed_password=hash('sha256', $password);
        header("Location:index.php?route=welcome&id=".$user["id_user"]);
    }
    else
    {
        header("Location:index.php?route=welcome?erreur=1");
    }
    ?>