<?php
//Connexion à la base de données
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
  $requete = null;
  $requete2 = $mysqlConnection->prepare('SELECT * FROM user WHERE id_user=:id');
  $requete2->execute([
    'id' => $_GET["id"]
  ]);

  $user = $requete2->fetch();
  $_SESSION["id"] = $user["id_user"];
  ?>

  <!--HTML CSS de la page -->
  <div class="grid grid-cols-2 gap-8">
    <div
      class="sm:max-w-md mt-6 px- py-4 rounded-lg bg-neutral-800 flex flex-col justify-center items-center w-full mx-auto shadow">
      <form action=<?php echo "'index.php?route=insertSeance&id=" . $_SESSION["id"] . "'"; ?>, method="post">
        <div class="form-group">
          <label for="seance" class="block mb-2 text-sm font-medium text-fuchsia-700 ">Séances</label>
          <input type="text" class="form-control rounded-lg" id="seance" name="seance" placeholder="Entrer une séance">
        </div>
        <div class="form-group">
          <label for="dte" class="block mb-2 text-sm font-medium text-fuchsia-700 ">Date</label>
          <input type="date" class="form-control rounded-lg" id="dte" name="dte" placeholder="Entrer une date">
        </div>
        <div class="form-group">
          <label for="hDebut" class="block mb-2 text-sm font-medium text-fuchsia-700 ">Heure début</label>
          <input type="time" class="form-control rounded-lg" id="hDebut" name="hDebut" placeholder="Entrer une heure">
        </div>
        <div class="form-group">
          <label for="hFin" class="block mb-2 text-sm font-medium text-fuchsia-700 ">Heure fin</label>
          <input type="time" class="form-control rounded-lg" id="hFin" name="hFin" placeholder="Entrer une heure">
        </div>
        <div class="form-group">
          <label for="sports" class="block mb-2 text-sm font-medium text-fuchsia-700 ">Sports</label>
          <select class="form-control rounded-lg" id="sports" name="sports" placeholder="Sélectionner un sport">
            <option value="" disabled selected hidden>Choisir un sport</option>
            <?php
            foreach ($sports as $ligne) {
              ?>
              <option value="<?= $ligne["id_sports"] ?>"><?= $ligne["nom_sports"] ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary text-white bg-fuchsia-900 shadow-lg hover:bg-fuchsia-700 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-fuchsia-900 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Créer
          une séance</button>
      </form>
    </div>
    <div class="sm:max-w-md mt-6 px- py-4 rounded-lg bg-neutral-800 flex flex-col justify-center items-center w-full mx-auto shadow">
      <label for="id" class="block mb-2 text-sm font-medium text-fuchsia-700 ">Tableau séances</label>
      <table class="w-full text-sm text-left text-gray-500 bg-neutral-800">
        <tbody>
          <?php
         $res= $mysqlConnection->query("SELECT * FROM seance");
         $seances=$res->fetchAll(); 
          foreach ($seances as $ligne) {
            ?>
            <tr class="bg-white border-b ">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                <?= $ligne["dte_seance"] ?>
              </th>
              <td class="font-medium text-blue-600 ">
                <a href="index.php?route=delete-atelier&id=<?= $ligne["id_seance"] ?>"><button
                    class="btn btn-danger text-fuchsia-700">Supprimer</button></a>
              <td>
                <a href="index.php?route=edit-atelier&id=<?= $ligne["id_seance"] ?>"><button
                    class="btn btn-info">Modifier</button></a>
              </td>

            </tr>
            <?php
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

    <?php
          
} else {
  $_SESSION["error"] = "il faut être connecté pour avoir acces";
  header("location:./index.php");
}
?>