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
    'id' => $_GET["id"]
  ]);

  $user = $requete->fetch();
  $_SESSION["id"] = $user["id_user"];
  ?>

  <body class="bg-neutral-900">
    <div class="grid grid-cols-2 gap-8">
      <div
        class="sm:max-w-md mt-8 px- py-40 rounded-lg bg-neutral-800 flex flex-col justify-center items-center w-full mx-auto shadow">
        <form action=<?php echo "'index.php?route=insertSport&id=" . $_SESSION["id"] . "'"; ?> method="post">
          <div class="form-group">
            <label for="id" class="block mb-10 text-sm font-medium text-fuchsia-700 ">Titre du sport</label>
            <input type="text" id="sports" name="sports"
              class="bg-gray-50 mb-2 border border-gray-300 text-fuchsia-700 text-sm rounded-lg focus:ring-fuchsia-700 focus:border-fuchsia-700 block w-full p-2.5 "
              placeholder="Entrer un sport" required>
            <button type="submit"
              class="text-white bg-fuchsia-900 shadow-lg hover:bg-fuchsia-700 hover:scale-105 focus:ring 5 focus:outline-none focus:ring-fuchsia-900 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
              Créer un sport</button>
          </div>
        </form>
    </div>
      <div class="sm:max-w-md mt-8 px- py-4 rounded-lg bg-neutral-800 flex flex-col justify-center items-center w-full mx-auto shadow">
          
          <label for="id" class="block mb-10 text-sm font-medium text-fuchsia-700 ">Tableau sport</label>
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <tbody> 
          <?php
        foreach ($mysqlConnection->query("SELECT * FROM sport") as $ligne){
            ?>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $ligne["nom_sports"] ?></th>
                <td class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    <a href="index.php?route=delete-atelier&id=<?= $ligne["id_sports"] ?>"><button class="btn btn-danger">Supprimer</button></a>

                </td>
                <td class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    <a href="index.php?route=delete-atelier&id=<?= $ligne["id_sports"] ?>"><button class="btn btn-danger">Modifier</button></a>

                </td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
          </div>
      </div>
    </div>
    </p>

    <?php
} else {
  $_SESSION["error"] = "il faut être connecté pour avoir acces";
  header("location:./index.php");
}
?>
