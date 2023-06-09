<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Le super blog de GAP !</title>
    <link href="./dist/style.css" rel="stylesheet" />
    <script type="text/javascript" src="./js.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.3.x/dist/index.js"></script>


</head>

<body>
    <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="index.php">

                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"><?= $title ?></span>
                </a>
                <div class="flex items-center lg:order-2">
                    <?php if (@$_SESSION['login'] == true) { ?>
                        <a href="index.php?action=un_login" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Se Déconnecter</a>

                        <?php if ($_SESSION['info'] == 1 || @$_SESSION['info_validate'] == true) { ?>
                            <a href="index.php?action=seeprofile&id_user=<?= $_SESSION['id_user_verif'] ?>" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                <div class="flex flex-row">
                                    <div class="basis-1/9">

                                        <img class="w-7 h-7 rounded-full" src="<?php if(file_exists('uploads/profilepicture_' . $_SESSION['id_user_verif'] . '.png')) {?>uploads/profilepicture_<?= $_SESSION['id_user_verif']?>.png <?php } else { ?> uploads/default.png <?php } ?>" alt="Rounded avatar">
                                    </div>
                                    <div class="basis-1/9 mt-1">
                                        <?= ucfirst($_SESSION['name']) . ' ' . ucfirst($_SESSION['firstname']) ?>
                                    </div>
                                </div>
                                

                                

                            </a>
                        <?php } elseif ($_SESSION['info'] == 0) { ?>
                            <a href="index.php?action=profileredirection"><button data-tooltip-target="tooltip-profile" type="button" class="inline-flex text-white underline font-medium text-sm flex-col items-center justify-center px-5 rounded-r-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
                                    Parametrer mon Profil ..?
                                </button>
                            </a>
                        <?php } ?>
                    <?php } else { ?>
                        <a href="index.php?action=pagelogin" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Se Connecter</a>
                        <a href="index.php?action=pageregister" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Créer un Compte</a>
                    <?php } ?>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <?php if (@$_SESSION['role'] == 'super-admin') { ?>
                            <li>
                                <a href="index.php?action=gest_user" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Gestion des Utilisateurs</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="index.php" class="block py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">Home</a>
                        </li>


                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?= $content ?>
</body>

</html>
