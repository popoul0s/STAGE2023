<?php
$title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>

<button type="button" class="py-2 px-5 mb-5 mt-2 text-sm font-medium ml-12 text-white focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700  dark:text-gray-400 dark:border-gray-600"><a href="index.php" class="text-black">Retour aux billets</a></button>
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-5xl">
    <div class="md:flex">

        <?php
        if (@$_SESSION['role'] != 'super-admin') { ?>
            <div class="p-8">
                <p> Informations Confidentielle, accès refusé.</p>
            </div>
        <?php } else { ?>
            <div>
                <div class="flex flex-col items-center justify-center lg:py-3">
                    <p class="block mt-1 mb-2 text-xl leading-tight font-medium text-indigo-500 text-center">Edition de l'Utilisateurs n°<?= $_GET['id']; ?></p>
                </div>
                <form action="index.php?action=edit_user" method="post">
                    <table class="text-left text-sm font-light">
                        <thead class="border-b bg-white font-medium dark:border-indigo-700 dark:bg-gray-50">
                            <tr>
                                <th scope="col" class="px-0.5 py-4">#</th>
                                <th scope="col" class="px-0.5 py-4">Username</th>
                                <th scope="col" class="px-0.5 py-4">Password</th>
                                <th scope="col" class="px-0.5 py-4">Name</th>
                                <th scope="col" class="px-0.5 py-4">Firstname</th>
                                <th scope="col" class="px-0.5 py-4">Role</th>
                                <th scope="col" class="px-0.5 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user) {
                                if ($user->role != 'super-admin') {
                            ?>
                                    <tr class="border-b dark:border-indigo-700">
                                        <td class="whitespace-nowrap px-0.5 py-4 font-medium"><input readonly True id="id" name="id" value="<?= $_GET['id']; ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="text" id="username" name="username" value="<?= $user->username ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="text" id="password" name="password" value="<?= $user->password ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="text" id="name" name="name" value="<?= $user->name ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="text" id="firstname" name="firstname" value="<?= $user->firstname ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="list" id="role" name="role" value="<?= $user->role ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><button type="submit" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-1 mr-3 dark:bg-white dark:text-black dark:border-gray-600 dark:hover:bg-gray-100">edit</button></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                </form>
                </table>
            <?php } ?>
            </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php'); ?>
