<?php

if (isset($_SESSION["login"])) {
  $mysqlConnection = new PDO(
    'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',

    USER,

    PASSWORD,

    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
  );
  $requete = $mysqlConnection->prepare('SELECT * FROM user WHERE id_user=:id');
  $requete->execute([
      'id'=>$_GET["id"]
  ]);

  $user= $requete->fetch();
  $_SESSION["id"]=$user["id_user"];
?>
  <div>
    <div class="col center">
      <form action=<?php echo"'index.php?route=insertSport&id=".$_SESSION["id"]."'"; ?> method="post">
        <div class="form-group">
          <label for="titre">Titre</label>
          <input type="text" class="form-control" id="sports" name="sports" placeholder="Entrer un sport">
        </div>
        <button type="submit" class="btn btn-primary">Créer un sport</button>
      </form>

    </div>
  </div>

<?php
} else {
  $_SESSION["error"] = "il faut être connecté pour avoir acces";
  header("location:./index.php");
}
?>