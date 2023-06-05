<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>

<section class="bg-white ">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow-xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-100 dark:border-gray-50">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                    Créez votre Compte
                </h1>
                <form class="space-y-4 md:space-y-6" action="index.php?action=register" method="post">
                    <div>
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Prénom</label>
                        <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre Prénom" required="">
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nom</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre Nom" required="">
                    </div>
                    <div>
                        <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nom d'utilisateur</label>
                        <input type="text" name="user" id="user" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre Nom d'utilisateur" required="">
                    </div>
                    <div>
                        <label for="pw" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Mot de Passe</label>
                        <input type="password" name="pw" id="pw" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Créer</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>

<?php
/*
if ($_SESSION['admin'] == true) {
?>


<?php
} else {
?>


<?php
}
*/
?>
