<?php

if (isset($_SESSION["login"])) {
  $mysqlConnection = new PDO(
    'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',

    USER,

    PASSWORD,

    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
  );

?>
  <div>
    <div class="col center">
      <form action="index.php?route=insertSport" method="post">
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