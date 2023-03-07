<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-neutral-900">
    <div class="text-xl text-white flex justify-center text mt-40 text-4xl -">LES SPORTIFS DE PASTEUR</div>
    <div
        class="sm:max-w-md mt-6 px- py-4 rounded-lg bg-neutral-800 flex justify-center items-center w-full mx-auto shadow">
        <form method="post" action="index.php?route=store">
            <div class="mb-6">
                <label for="id" class="block mb-2 text-sm font-medium text-fuchsia-700 ">Identifiant</label>
                <input type="text" name="login"
                    class="bg-gray-50 border border-gray-300 text-fuchsia-700 text-sm rounded-lg focus:ring-fuchsia-700 focus:border-fuchsia-700 block w-full p-2.5 "
                    placeholder="p.nom" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-fuchsia-700">Mot de passe</label>
                <input type="password" name="pwd"
                    class="bg-gray-50 border border-gray-300 text-fuchsia-700 text-sm rounded-lg focus:ring-fuchsia-700 focus:border-fuchsia-700 block w-full p-2.5 "
                    placeholder="Mot de passe" required>
</br>
                    <?php
if(isset($_GET["erreur"])){
    if($_GET["erreur"]==1){
        echo("<p class=text-red-500 >Mot de passe ou identifiant incorrect</p>");
    }
else if($_GET["erreur"]==2) {
    echo('<p class=text-red-500 >Veuillez vous connecter</p>');
}
else{

}
}?>
            </div>
            <div class="mb-6">
                <a class="underline text-fuchsia-700 hover:text-fuchsia-600" href="mdpoublie.php">Mot de passe oublié</a>
            </div>
            <button type="submit"
                class="text-white bg-fuchsia-900 shadow-lg hover:bg-fuchsia-700 hover:scale-105 focus:ring-4 focus:outline-none focus:ring-fuchsia-900 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Se
                connecter</button>
        </form>
    </div>

</body>

</html>