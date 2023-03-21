<?php
if(isset($_GET["modif"])){
if($_GET["modif"]==1){
if (isset($_POST["login"])==false || empty($_POST["login"])){

    $_SESSION["error"]="Le login est obligatoire";
    echo"<script>window.location.href='index.php?route=modifprofil&id=".$_GET["id"]."'</script>";
}
else
{
        $mysqlConnection = new PDO(
        'mysql:host='.SERVER.';dbname='.DBNAME.';charset=utf8', 
    
        USER, 
    
        PASSWORD,
        
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );

// ordre de mission
$requete = $mysqlConnection->prepare('update user set login = :login where id_user =:id');
//execution de la requete
$requete->execute( ["id"=>$_GET["id"],"login"=>$_POST["login"]]);
$mysqlConnection = null;
$requete = null;
$_SESSION["success"]="login modifié avec succès";
   
echo"<script>window.location.href='index.php?route=welcome&id=".$_GET["id"]."'</script>";
}
}

else if($_GET["modif"]==2){
    if (isset($_POST["mail"])==false || empty($_POST["mail"])){

        $_SESSION["error"]="Le mail est obligatoire";
        echo"<script>window.location.href='index.php?route=modifprofil&id=".$_GET["id"]."'</script>";
    }
    else
    {
        $mysqlConnection = new PDO(
            'mysql:host=db4free.net:3306;dbname=unicorp_bd;charset=utf8',
            
            'unicorp', 
        
            'nzjRLN0!RirP',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        );
    
    // ordre de mission
    $requete = $mysqlConnection->prepare('update user set email = :mail where id_user =:id');
    //execution de la requete
    $requete->execute( ["id"=>$_GET["id"],"mail"=>$_POST["mail"]]);
    $mysqlConnection = null;
    $requete = null;
    $_SESSION["success"]="mail modifié avec succès";

    echo"<script>window.location.href='index.php?route=welcome&id=".$_GET["id"]."'</script>";
    }
}
}
?>