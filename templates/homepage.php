<?php $title = "Le blog de l'AVBN";
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
    <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-xl overflow-hidden md:max-w-2xl">
        <div class="md:flex">
            <div class="p-8">
                <div class="tracking-wide text-sm text-indigo-500 font-semibold">le <?= $post->frenchCreationDate; ?></div>
                <p class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><?= htmlspecialchars($post->title); ?></p>
                <p class="mt-2 text-slate-500"><?= nl2br(htmlspecialchars($post->content)); ?>
                    <br />
                    <em><a href="index.php?action=post&id=<?= urlencode($post->identifier) ?>">Commentaires</a></em>
                </p>
            </div>
        </div>
    </div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
