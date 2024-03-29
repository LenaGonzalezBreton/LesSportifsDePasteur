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

    $requete = $mysqlConnection->prepare('SELECT photos FROM user WHERE id_user=:id');
    $requete->execute([
        'id' => $_GET["id"]
    ]);

    $userPhoto = $requete->fetch();
    ?>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <nav class="bg-fuchsia-900 shadow-lg border-gray-200 px-2 sm:px-4 py-2.5 rounded-b">
        <div class="container flex flex-wrap items-center mx-auto grid grid-cols-3 w-screen">
            <div class="flex items-center">
                <img src="assets/logosite.png" class="mr-5 sm:h-14 hover:animate-spin" alt="Logosite" />
                <a href=<?php echo "'index.php?route=welcome&id=" . $_SESSION["id"] . "'"; ?> class="self-center text-xl font-semibold whitespace-nowrap">Les sportifs de Pasteur</a>
            </div>
            <?php
            if ($_SESSION["droit"] == "N") { ?>
                <div class="items-center justify-center hidden w-full md:flex md:w-auto" id="mobile-menu-2">
                    <ul
                        class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-transparent md:flex-row md:space-x-24 md:mt-0 md:text-sm md:font-medium md:border-0 md:transparent">
                        <li>
                            <a href=<?php echo "'index.php?route=inscription&id=" . $_SESSION["id"] . "'"; ?>
                                class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:scale-125 md:p-0 md:text-lg">S'inscrire</a>
                        </li>
                        <li>
                            <a href=<?php echo "'index.php?route=welcome&id=" . $_SESSION["id"] . "'"; ?>
                                class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:scale-125 md:p-0 md:text-lg ">Menu</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:scale-125 md:p-0 md:text-lg ">Voir
                                ses inscriptions</a>
                        </li>
                    </ul>
                </div>
            <?php } else if ($_SESSION["droit"] == "Y") { ?>
                    <div class="items-center justify-center hidden w-full md:flex md:w-auto" id="mobile-menu-2">
                        <ul
                            class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-transparent md:flex-row md:space-x-24 md:mt-0 md:text-sm md:font-medium md:border-0 md:transparent">
                            <li>
                                <a href=<?php echo "'index.php?route=addSport&id=" . $_SESSION["id"] . "'"; ?>
                                    class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:scale-125 md:p-0 md:text-lg">Sport</a>
                            </li>
                            <li>
                                <a href=<?php echo "'index.php?route=welcome&id=" . $_SESSION["id"] . "'"; ?>
                                    class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:scale-125 md:p-0 md:text-lg ">Menu</a>
                            </li>
                            <li>
                                <a href=<?php echo "'index.php?route=addSeance&id=" . $_SESSION["id"] . "'"; ?>
                                    class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:scale-125 md:p-0 md:text-lg ">Séance</a>
                            </li>
                        </ul>
                    </div>
            <?php } ?>

            <div class="flex justify-end mr-10">
                <button type="button" class="mr-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <?php if (empty($userPhoto[0])) {
                        $defaultPhoto = "iconuser.svg";
                        echo '<img class="rounded-full bg-cover bg-center w-12 h-12" src="' . $defaultPhoto . '" alt="user photo" >';
                    } else {
                        echo '<img class="rounded-full bg-cover bg-center w-12 h-12" src="' . $userPhoto[0] . '" alt="user photo" >';
                    }
                    ?>
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900"></span>
                        <span class="block text-sm font-medium text-gray-500 truncate">Bonjour
                            <?= $user["prenom"] ?> !
                        </span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href=<?php echo "'index.php?route=modifprofil&id=" . $_SESSION["id"] . "'"; ?>
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                            <a href=index.php?route=logout
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Se déconnecter</a>

                    </ul>
                </div>
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
<?php } ?>