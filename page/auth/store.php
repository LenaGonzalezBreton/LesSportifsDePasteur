<?php $mysqlConnection = new PDO(
    'mysql:host=db4free.net:3306;dbname=unicorp_bd;charset=utf8', 

    'unicorp', 

    'nzjRLN0!RirP',
    
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
        header("Location:index.php?route=welcome");
    }
    else
    {
        header("Location:index.php?route=welcome?erreur=1");
    }
    ?>