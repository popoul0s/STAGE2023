<?php $title = "Le blog de GAP";
?>
<?php ob_start(); ?>

<div class="max-w-md mx-auto bg-white rounded-xl overflow-hidden md:max-w-2xl">
    <div class="md:flex">
        <p class="block mt-1 text-xl leading-tight font-medium text-black text-center">Derniers billets du blog </p>
    </div>
</div>
<?php
foreach ($posts as $post) {
?>

    <div id="divpost" class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-6xl" id="divEditPost">
        <div class="md:flex">
            <div class="p-8">
                <div class="tracking-wide text-sm text-indigo-500 font-semibold">le <?= $post->frenchCreationDate; ?></div>
                <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><?= htmlspecialchars($post->title); ?></p>
                <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($post->content)); ?>
                    <br />
                    <em><a href="index.php?action=post&id=<?= urlencode($post->identifier) ?>">Commentaires</a></em> <?php if(@$_SESSION['role'] == 'super-admin') { ?> (<a href="index.php?action=editPostredirection&id=<?=urlencode($post->identifier)?>" class="mt-1 text-md leading-tight font-medium text-black hover:underline">modifier</a> | <a href="index.php?action=delPost&id=<?= $post->identifier ?>" style="color: red" class="mt-1 text-md leading-tight font-medium text-black hover:underline">supprimer</a>) <?php } ?>
                </p>

            </div>
        </div>
    </div>

<?php
}

if (@$_SESSION['login'] == true && @$_SESSION['role'] != 'user') {
?>

    <div class="flex flex-col items-center justify-center lg:py-3">
        <button onclick=AddPost() onMouseOver="displayDivInfo('Ajouter un Post');" onMouseOut="displayDivInfo()" id="buttonAddPost" data-tooltip-target="tooltip-new" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </div>
    <section hidden id="sectionformPost" class="bg-white ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-50 lg:py-0">
            <div class="w-full bg-white rounded-lg shadow-xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-white dark:border-gray-50">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                        Créez votre nouveau Post
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="index.php?action=addPost" method="post">
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Titre</label>
                            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre titre" required="">
                        </div>
                        <div>
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Post</label>
                            <textarea type="text" name="content" id="content" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre Post" required=""> </textarea>
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Créer le Post</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
