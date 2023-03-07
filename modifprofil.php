<?php
session_start()
?>
<?php
if (isset($_SESSION["login"])){
  $mysqlConnection = new PDO(
    'mysql:host=db4free.net:3306;dbname=unicorp_bd;charset=utf8',

    'unicorp', 

    'nzjRLN0!RirP',

    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
);

  // ordre de mission
  $requete = $mysqlConnection->prepare('SELECT * FROM user where id_user =:id');
  //execution de la requete
  $requete->execute(["id"=>$_GET["id"]]);

  $user = $requete->fetch();
  $mysqlConnection = null;
  $requete = null;
    ?>
     <div class="row">
        <div class="col center">
          <form action="update_id.php?id=<?= $_GET["id"]?>?modif=modif_login" method="post">
            <div class="form-group">
              <label for="login">login</label>
              <input type="text" class="form-control" id="login" name="login" value=""/>
            </div>         
            <button type="submit" class="btn btn-primary">Modifer login</button>
          </form>
          <form action="update_id.php?id=<?= $_GET["id"]?>?modif=modif_mail" method="post">
            <div class="form-group">
              <label for="mail">mail</label>
              <input type="text" class="form-control" id="mail" name="mail" value=""/>
            </div>         
            <button type="submit" class="btn btn-primary">Modifer mail</button>
          </form>

        </div>
      </div>

    <?php
}
else
{
    $_SESSION["error"]="il faut être connecté pour avoir acces";
    header("location:http://127.0.0.1/les_sportifs_de_pasteur/welcome.php?erreur=0");
}
?>