<!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
</svg> -->

<?php

if (@$_SESSION['login'] == true) {
    if ($_SESSION['role'] != 'user') {
?>
        <?php $title = "Le blog de GAP"; ?>
        <?php
        $_SESSION['id_post'] = $post->identifier;
        ?>
        <?php ob_start(); ?>
        <a href="index.php" class="text-black"><button type="button" class="py-2 px-5 mb-5 mt-2 text-sm font-medium ml-12 text-white focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:text-black dark:border-gray-600">Retour aux billets</button></a>

        <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-6xl">
            <div class="md:flex">                                                   
                <div class="p-8">
                    <div class="tracking-wide text-sm text-indigo-500 font-semibold">le <?= $post->frenchCreationDate; ?></div>
                    <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><?= htmlspecialchars($post->title); ?></p>
                    <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($post->content)); ?>
                        <br />
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center lg:py-3">
            <p class="block mt-1 text-xl leading-tight font-medium text-black text-center">Commentaires </p>
        </div>
        <?php
        foreach ($comments as $comment) {
        ?>
            <p> </p>
            <p></p>
            <div class="max-w-xl mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden xl:max-w-2xl">
                <div class="md:flex">
                    <div class="p-8">
                        <div class="tracking-wide text-sm text-primary-500 font-semibold">le <?= $comment->frenchCreationDate ?></div>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><strong><?= htmlspecialchars($comment->author) ?> </strong></p>
                        <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($comment->comment)) ?></p>
                        <div class="flex flex-row">
                            <?php if ($_SESSION['role'] == 'super-admin' || $comment->id_author == $_SESSION['id_user_verif']) { ?>
                                <div class="basis-1/9 mr-6">
                                    <a onMouseOver="displayDivInfo('Modifier le Commentaire');" onMouseOut="displayDivInfo()" href="index.php?action=editredirection&id=<?= $comment->id ?>&comment=<?= $comment->comment ?>" class="mt-1 text-md leading-tight font-medium text-black hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="basis-1/9">
                                <a onMouseOver="displayDivInfo('Supprimer le Commentaire');" onMouseOut="displayDivInfo()" href="index.php?action=delredirection&id_post=<?= $post->identifier ?>&id=<?= $comment->id ?>" style="color: red" class="mt-1 text-md leading-tight font-medium text-black hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
        <div class="flex flex-col items-center justify-center lg:py-3">
            <button onclick=AddComment() onMouseOver="displayDivInfo('Ajouter un Commentaire');" onMouseOut="displayDivInfo()" id="buttonAddComment" data-tooltip-target="tooltip-new" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

            </button>
        </div>
        <section hidden id="sectionformCom" class="bg-white ">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-50 lg:py-0">
                <div class="w-full bg-white rounded-lg shadow-xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-white dark:border-gray-50">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                            Créez votre Commentaire
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="index.php?action=addComment&id=<?= $_GET['id']; ?>" method="post">
                            <div>
                                <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Auteur</label>
                                <p class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= @$_SESSION['id_user']; ?>"><?= ucfirst($_SESSION['name']) . ' ' . ucfirst($_SESSION['firstname']); ?></p>
                            </div>
                            <div>
                                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Commentaire</label>
                                <input type="text" name="comment" id="comment" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre Commentaire" required="">
                            </div>
                            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Créer le Commentaire</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php $content = ob_get_clean(); ?>

        <?php require('layout.php') ?>
    <?php } else { ?>
        <?php $title = "Le blog de GAP"; ?>
        <?php
        $_SESSION['id_post'] = $post->identifier;
        ?>
        <?php ob_start(); ?>
        <a href="index.php" class="text-black"><button type="button" class="py-2 px-5 mb-5 mt-2 text-sm font-medium ml-12 text-white focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:text-black dark:border-gray-600">Retour aux billets</button></a>

        <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-6xl">
            <div class="md:flex">
                <div class="p-8">
                    <div class="tracking-wide text-sm text-indigo-500 font-semibold">le <?= $post->frenchCreationDate; ?></div>
                    <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><?= htmlspecialchars($post->title); ?></p>
                    <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($post->content)); ?>
                        <br />
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center lg:py-3">
            <p class="block mt-1 text-xl leading-tight font-medium text-black text-center">Commentaires </p>
        </div>
        <?php
        foreach ($comments as $comment) {
        ?>
            <p> </p>
            <p></p>
            <div class="max-w-xl mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden xl:max-w-2xl">
                <div class="md:flex">
                    <div class="p-8">
                        <div class="tracking-wide text-sm text-primary-500 font-semibold">le <?= $comment->frenchCreationDate ?></div>
                        <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><strong><?= htmlspecialchars($comment->author) ?></strong></p>
                        <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($comment->comment)) ?></p>
                        <?php if ($comment->id_author == $_SESSION['id_user_verif']) { ?>
                            <div class="flex flex-row">
                                <div class="basis-1/9 mr-6">
                                    <a onMouseOver="displayDivInfo('Modifier le Commentaire');" onMouseOut="displayDivInfo()" href="index.php?action=editredirection&id=<?= $comment->id ?>&comment=<?= $comment->comment ?>" class="mt-1 text-md leading-tight font-medium text-black hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="basis-1/9">
                                    <a onMouseOver="displayDivInfo('Supprimer le Commentaire');" onMouseOut="displayDivInfo()" href="index.php?action=delredirection&id_post=<?= $post->identifier ?>&id=<?= $comment->id ?>" style="color: red" class="mt-1 text-md leading-tight font-medium text-black hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                </div>
                            </div> <?php } ?>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
        <div class="flex flex-col items-center justify-center lg:py-3">
            <button onclick=AddComment() id="buttonAddComment" data-tooltip-target="tooltip-new" type="button" class="inline-flex items-center justify-center w-10 h-10 font-medium bg-blue-600 rounded-full hover:bg-blue-700 group focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"></path>
                </svg>
            </button>
        </div>
        <section hidden id="sectionformCom" class="bg-white ">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-50 lg:py-0">
                <div class="w-full bg-white rounded-lg shadow-xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-white dark:border-gray-50">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                            Créez votre Commentaire
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="index.php?action=addComment&id=<?= $_GET['id']; ?>" method="post">
                            <div>
                                <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Auteur</label>
                                <p class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?= @$_SESSION['id_user']; ?>"><?= ucfirst($_SESSION['name']) . ' ' . ucfirst($_SESSION['firstname']); ?></p>
                            </div>
                            <div>
                                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Commentaire</label>
                                <input type="text" name="comment" id="comment" class="bg-gray-50 border border-gray-300 text-gray-200 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-300 dark:border-gray-200 dark:placeholder-gray-700 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Votre Commentaire" required="">
                            </div>
                            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Créer le Commentaire</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php $content = ob_get_clean(); ?>

        <?php require('layout.php') ?>

    <?php
    }
} else {
    ?>
    <?php ob_start(); ?>
    <?php $title = "Le blog de GAP"; ?>
    <?php
    $_SESSION['id_post'] = $post->identifier;
    ?>
    <a href="index.php" class="text-black"><button type="button" class="py-2 px-5 mb-5 mt-2 text-sm font-medium ml-12 text-white focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:text-black dark:border-gray-600">Retour aux billets</button></a>

    <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-6xl">
        <div class="md:flex">
            <div class="p-8">
                <div class="tracking-wide text-sm text-indigo-500 font-semibold">le <?= $post->frenchCreationDate; ?></div>
                <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><?= htmlspecialchars($post->title); ?></p>
                <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($post->content)); ?>
                    <br />
                </p>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center lg:py-3">
        <p class="block mt-1 text-xl leading-tight font-medium text-black text-center">Commentaires </p>
    </div>
    <?php
    foreach ($comments as $comment) {
?>

        <div class="max-w-xl mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden xl:max-w-2xl">
            <div class="md:flex">
                <div class="p-8">
                    <div class="tracking-wide text-sm text-primary-500 font-semibold">le <?= $comment->frenchCreationDate ?></div>
                    <p onMouseOver="displayDivInfo2('<strong>Bio :</strong> <?php if($comment->bio == '') { echo 'Cet utilisateur a aucune bio'; } else { echo $comment->bio; } ?>');" onMouseOut="displayDivInfo2()" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><strong><?= htmlspecialchars($comment->author) ?></strong></p>
                    <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($comment->comment)) ?></p>
                </div>
            </div>
        </div>

    <?php
    }
    ?>
    <?php $content = ob_get_clean(); ?>

    <?php require('layout.php') ?>

<?php
}

?>
