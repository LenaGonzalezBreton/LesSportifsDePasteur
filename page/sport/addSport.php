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
          <table class="w-full text-sm text-left text-gray-500 ">
    <tbody> 
        <?php
        foreach ($mysqlConnection->query("SELECT * FROM sport") as $ligne){
            ?>
            <tr class="bg-neutral-700 border-b-2 border-neutral-800">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap "><?= $ligne["nom_sports"] ?></th>
              <td class="font-medium text-blue-600">
                <form method="post" action="">
                  <input type="hidden" name="id" value="<?= $ligne["id_sports"] ?>">
                  <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
               </form>
              </td>
            </tr>
          <?php
        }

        if(isset($_POST['delete'])){
          $id = $_POST['id'];
          $sql = "DELETE FROM sport WHERE id_sports='$id'";
          if ($mysqlConnection->query($sql) === TRUE) {
              echo "";
          } else {
              echo "" . $mysqlConnection->errorCode();
          }
        }
        ?>

    </tbody>
    </p>

    <?php
} else {
  $_SESSION["error"] = "il faut être connecté pour avoir acces";
  header("location:./index.php");
}
?>
