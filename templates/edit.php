<?php
$title = "Le blog de l'AVBN"; ?>

<?php ob_start();

if ($_SESSION['modeComment'] == 'edit') {
?>
<a href="./index.php?action=post&id=<?= urlencode($_SESSION['id_post']) ?>" class="text-black"><button type="button" class="py-2 px-5 mb-5 mt-2 text-sm font-medium ml-12 text-white focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:text-black dark:border-gray-600">Retour aux commentaires du billets n°<?= $_SESSION['id_post'] ?></button></a>

    <section id="sectionformCom" class="bg-white ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-50 lg:py-0">
            <div class="w-full bg-white rounded-lg shadow-xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-white dark:border-gray-50">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                        Edition Commentaires
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="index.php?action=editComment&id=<?= urlencode($_SESSION['id_post']) ?>&id_comment=<?= $_GET['id']; ?>" method="post">
                        <div>
                            <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Auteur</label>
                            <p class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"><?= ucfirst($_SESSION['name']) . ' ' . ucfirst($_SESSION['firstname']); ?></p>
                            </p>
                        </div>
                        <div>
                            <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Commentaire</label>
                            <input type="text" name="comment" id="comment" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre Commentaire" required="" value="<?= $_GET['comment'] ?>">
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Créer le Commentaire</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php $content = ob_get_clean(); ?>

    <?php require('layout.php'); ?>

<?php
} elseif ($_SESSION['modeComment'] == 'del') {
    header('Location: ./index.php?action=delComment&id=' . $_SESSION['id_post'] . '&id_comment=' . $_GET['id']);
} else {
    require('error.php');
}
?>
