<?php

if (isset($_SESSION["login"])) {
  $mysqlConnection = new PDO(
    'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',

    USER,

    PASSWORD,

    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
  );
 // ordre de mission
 $requete = $mysqlConnection->prepare('SELECT * FROM sport');
 //execution de la requete
 $requete->execute();

 $sports = $requete->fetchAll();
 $mysqlConnection = null;
 $requete = null;
?>
  <div>
    <div class="col center">
      <form action="index.php?route=insertSeance" method="post">
        <div class="form-group">
          <label for="seance">Séances</label>
          <input type="text" class="form-control" id="seance" name="seance" placeholder="Entrer une séance">
        </div>
        <div class="form-group">
          <label for="dte">date</label>
          <input type="date" class="form-control" id="dte" name="dte" placeholder="Entrer une date">
        </div>
        <div class="form-group">
          <label for="hDebut">heure debut</label>
          <input type="time" class="form-control" id="hDebut" name="hDebut" placeholder="Entrer une heure">
        </div>
        <div class="form-group">
          <label for="hFin">heure fin</label>
          <input type="time" class="form-control" id="hFin" name="hFin" placeholder="Entrer une heure">
        </div>
        <div class="form-group">
              <label for="sports">Sports</label>
              <select class="form-control" id="sports" name="sports" placeholder="Sélectionner un sport">
                  <option value="" disabled selected hidden>Choisir un sport</option>
                  <?php
                  foreach ($sports as $ligne){
                      ?>
                      <option value="<?= $ligne["id_sports"] ?>" ><?= $ligne["nom_sports"]?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>           
        <button type="submit" class="btn btn-primary">Créer une séance</button>
      </form>

    </div>
  </div>

<?php
} else {
  $_SESSION["error"] = "il faut être connecté pour avoir acces";
  header("location:./index.php");
}
?>