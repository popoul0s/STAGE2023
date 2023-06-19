<?php
ob_start();

$title = "Le blog de GAP"; ?>
<a href="index.php" class="text-black"><button type="button" class="py-2 px-5 mb-5 mt-2 text-sm font-medium ml-12 text-white focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:text-black dark:border-gray-600">Retour aux billets</button></a>

<div class="flex flex-col items-center justify-center lg:py-3">
    <p class="block mt-1 mb-2 text-xl leading-tight font-medium text-indigo-500 text-center">Edition du Post n°<?= $_GET['id']; ?></p>
</div>
<form action="index.php?action=editPost&id=<?= $_GET['id'] ?>" method="post">
    <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-6xl">
        <div class="p-5">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Titre</label>
                <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre titre" required="" value="<?= $post->title ?>">
            </div>
            <div class="py-2">
                <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Post</label>
                <textarea type="text" name="content" id="content" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre Post" required=""><?= $post->content ?>  </textarea>
            </div>
            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Modifier le Post</button>

        </div>
    </div>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
