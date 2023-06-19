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
                    <em>
                        <a href="index.php?action=post&id=<?= urlencode($post->identifier) ?>" onMouseOver="displayDivInfo('Commentaires');" onMouseOut="displayDivInfo()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mx-auto">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                            </svg>
                        </a>
                    </em>
                    <?php if (@$_SESSION['role'] == 'super-admin') { ?>
                        <div class="flex flex-col">
                            <div class="flex flex-row ml-auto">
                                <div class="basis-1/10">
                                    <a href="index.php?action=editPostredirection&id=<?= urlencode($post->identifier) ?>" class="mt-1 text-md leading-tight font-medium text-black hover:underline" onMouseOver="displayDivInfo('Modifier');" onMouseOut="displayDivInfo()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="basis-1/10 ml-2">
                                    <a href="index.php?action=delPost&id=<?= $post->identifier ?>" style="color: red" class="mt-1 text-md leading-tight font-medium text-black hover:underline" onMouseOver="displayDivInfo('Supprimer');" onMouseOut="displayDivInfo()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    <?php } ?>
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
