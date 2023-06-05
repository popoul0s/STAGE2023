<?php

if (@$_SESSION['login'] == true) {
    if ($_SESSION['role'] == 'super-admin') {
?>
        <?php $title = "Le blog de l'AVBN"; ?>
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
                        <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><strong><?= htmlspecialchars($comment->author) . '   ' . htmlspecialchars($_SESSION['role']) ?></strong></p>
                        <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($comment->comment)) ?></p>
                        <p>(<a href="index.php?action=editredirection&id=<?= $comment->id ?>&comment=<?= $comment->comment ?>" class="mt-1 text-md leading-tight font-medium text-black hover:underline">modifier</a> | <a href="index.php?action=delredirection&id_post=<?= $post->identifier ?>&id=<?= $comment->id ?>" style="color: red" class="mt-1 text-md leading-tight font-medium text-black hover:underline">supprimer</a>)</p>
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
    <?php } else { ?>
        <?php $title = "Le blog de l'AVBN"; ?>
        <?php
        $_SESSION['id_post'] = $post->identifier;
        ?>
        <?php ob_start(); ?>
        <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-2xl">
            <div class="md:flex">
                <div class="p-2">
                    <p class="block mt-1 text-lg leading-tight font-medium text-indigo-500 hover:underline"><a href="index.php">Retour aux billets</a></p>
                </div>
            </div>
        </div>
        <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-2xl">
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
                            <p>(<a href="index.php?action=editredirection&id=<?= $comment->id ?>&comment=<?= $comment->comment ?>" class="mt-1 text-md leading-tight font-medium text-black hover:underline">modifier</a> | <a href="index.php?action=delredirection&id_post=<?= $post->identifier ?>&id=<?= $comment->id ?>" style="color: red" class="mt-1 text-md leading-tight font-medium text-black hover:underline">supprimer</a>)</p>
                        <?php } ?>
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
    <?php $title = "Le blog de l'AVBN"; ?>
    <?php
    $_SESSION['id_post'] = $post->identifier;
    ?>
    <?php ob_start(); ?>
    <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-2xl">
        <div class="md:flex">
            <div class="p-2">
                <p class="block mt-1 text-lg leading-tight font-medium text-indigo-500 hover:underline"><a href="index.php">Retour aux billets</a></p>
            </div>
        </div>
    </div>
    <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-2xl">
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
