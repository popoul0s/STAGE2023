<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<p>Une erreur est survenue :</p>
<?php
if (@$_GET['action'] == 'createlogin') {
    $errorMessage = "Création du compte impossible. Veuillez vérifier que tous les champs soient remplis";
    echo $errorMessage;
    //sleep(3);
    //header('Location: ./login.php');
} else {
    echo @$errorMessage;
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
