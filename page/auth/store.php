<?php $mysqlConnection = new PDO(
    'mysql:host=db4free.net:3306;dbname=unicorp_bd;charset=utf8', 

    'unicorp', 

    'nzjRLN0!RirP'
);
    $requete = $mysqlConnection->prepare('SELECT * FROM user WHERE login= :login OR email= :login  AND pwd= :pwd');
    $requete->execute([
        'login' => $_POST["login"],
        'pwd' => $_POST["pwd"],
    ]);
    $ligne= $requete->fetch();
    //var_dump($ligne);die();
    if($ligne){
        session_start();
        $_SESSION["login"]=$_POST["login"];
        $password=$_POST["pwd"];
        $hashed_password=hash('sha256', $password);
        header("Location:http://127.0.0.1/les_sportifs_de_pasteur/welcome.php?erreur=0");
    }
    else
    {
        header("Location:http://127.0.0.1/les_sportifs_de_pasteur/page/auth/login.php?erreur=1");
    }
    ?>