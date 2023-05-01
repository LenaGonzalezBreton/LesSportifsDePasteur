<?php
if (isset($_SESSION["login"])) {
  $mysqlConnection = new PDO(
    'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8',
    USER,
    PASSWORD,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
  );
  // ordre de mission
  $requete = $mysqlConnection->prepare('SELECT * FROM user where id_user =:id');
  //execution de la requete
  $requete->execute(["id" => $_GET["id"]]);

  $user = $requete->fetch();
  $mysqlConnection = null;
  $requete = null;
} else {
  $_SESSION["error"] = "il faut être connecté pour avoir acces";
  header("location:index.php?route=welcome");
}
?>
<p>

  <body class="bg-neutral-900">
    <div class="text-xl text-white flex justify-center text mt-16 mb-8 text-4xl">MODIFICATION DU PROFIL</div>

    <div class="grid grid-cols-2 ">
      <div class="sm:max-w-md mt-6 mb-6 py-4 rounded-lg bg-neutral-800 flex flex-col justify-center items-center w-full mx-auto shadow ">
        <form method="post" action="index.php?route=update_id&id=<?= $_GET["id"] ?>&modif=1">
          <div class="mb-6">
            <label for="id" class="block mb-2 text-sm font-medium text-fuchsia-700 ">Modifier le login</label>
            <input type="text" name="login"
              class="bg-gray-50 mb-2 border border-gray-300 text-fuchsia-700 text-sm rounded-lg focus:ring-fuchsia-700 focus:border-fuchsia-700 block w-full p-2.5 "
              placeholder="nouveau login" required>
            <button type="submit"
              class="text-white bg-fuchsia-900 shadow-lg hover:bg-fuchsia-700 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-fuchsia-900 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
              Modifier</button>
          </div>
        </form>
        <form method="post" action="index.php?route=update_id&id=<?= $_GET["id"] ?>&modif=2">
          <div class="mb-6">
            <label for="mail" class="block mb-2 text-sm font-medium text-fuchsia-700">Modifier le mail</label>
            <input type="text" name="mail"
              class="bg-gray-50 border mb-2 border-gray-300 text-fuchsia-700 text-sm rounded-lg focus:ring-fuchsia-700 focus:border-fuchsia-700 block w-full p-2.5 "
              placeholder="nouveau mail" required>
            <button type="submit"
              class="text-white bg-fuchsia-900 shadow-lg hover:bg-fuchsia-700 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-fuchsia-900 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
              Modifier</button>
          </div>
      </div>

      </form>
      <div class="sm:max-w-md mt-6 mb-6 py-4 rounded-lg bg-neutral-800 flex flex-col justify-center items-center w-full mx-auto shadow ">
        <form method="post" action="index.php?route=update_id&id=<?= $_GET["id"] ?>&modif=3">
          <div class="mb-6">
            <label for="pwd" class="block mb-4 text-sm font-medium text-fuchsia-700">Modifier le mot de passe</label>
            <input type="password" name="old_pwd" id="old_pwd"
              class="bg-gray-50 border mb-4 border-gray-300 text-fuchsia-700 text-sm rounded-lg focus:ring-fuchsia-700 focus:border-fuchsia-700 block w-full p-2.5 "
              placeholder="Ancien mot de passe" required>
            <input type="password" name="new_pwd" id="new_pwd"
              class="bg-gray-50 border mb-2 border-gray-300 text-fuchsia-700 text-sm rounded-lg focus:ring-fuchsia-700 focus:border-fuchsia-700 block w-full p-2.5 "
              placeholder="Nouveau mot de passe" required>
            <input type="password" name="confirm_pwd" id="confirm_pwd"
              class="bg-gray-50 border mb-2 border-gray-300 text-fuchsia-700 text-sm rounded-lg focus:ring-fuchsia-700 focus:border-fuchsia-700 block w-full p-2.5 "
              placeholder="Confirmer mot de passe" required>
            <button type="submit"
              class="text-white bg-fuchsia-900 shadow-lg hover:bg-fuchsia-700 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-fuchsia-900 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
              Modifier</button>
          </div>
        </form>
        <label for="pwd" class="block mb-4 text-sm font-medium text-fuchsia-700">Modifier sa photo de profil</label>
        <form method="post" action="index.php?route=update_id&id=<?= $_GET["id"] ?>&modif=4" enctype="multipart/form-data" class="block mb-4 text-sm font-medium text-fuchsia-700"> 
    <input type="file" id="photo" name="photo" accept="image/*">
    <br>
    <button type="submit" value="Upload" class=" mt-2 flex text-white bg-fuchsia-900 shadow-lg hover:bg-fuchsia-700 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-fuchsia-900 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Upload</button>
</br>
  </form>

      </div>
    </div>
</p>

</body>