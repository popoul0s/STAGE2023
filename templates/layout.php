<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Le super blog de l'AVBN !</title>
    <link href="./dist/style.css" rel="stylesheet" />
    <script type="text/javascript" src="./js.js"></script>
</head>

<body>
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="index.php?action=destroysession">

                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"><?= $title ?></span>
                </a>
                <div class="flex items-center lg:order-2">
                    <?php if (@$_SESSION['login'] == true) { ?>
                        <a href="index.php?action=un_login" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Se Déconnecter</a>
                        <a href="index.php?action=seeprofile"><button data-tooltip-target="tooltip-profile" type="button" class="inline-flex text-white font-medium text-sm flex-col items-center justify-center px-5 rounded-r-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
                                <img class="w-10 h-10 rounded-full" src="./img/1536784688.svg" alt="Rounded avatar">

                                <?= ucfirst($_SESSION['name']) . ' ' . ucfirst($_SESSION['firstname']) ?>
                            </button>
                        </a>
                    <?php } else { ?>
                        <a href="index.php?action=pagelogin" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Se Connecter</a>
                        <a href="index.php?action=pageregister" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Créer un Compte</a>
                    <?php } ?>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="index.php" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">Home</a>
                        </li>

                        <?php if (@$_SESSION['role'] == 'super-admin') { ?>
                            <li>
                                <a href="index.php?action=gest_user" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Gestion des Utilisateurs</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?= $content ?>
</body>

</html>
