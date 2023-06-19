<?php
$title = "Le blog de GAP"; ?>

<?php ob_start(); ?>
<a href="index.php?action=gest_user" class="text-black"><button type="button" class="py-2 px-5 mb-5 mt-2 text-sm font-medium ml-12 text-black focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:text-black">Retour à la gestion des utilisateurs</button></a>
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
                                        <td class="whitespace-nowrap px-0.5 py-4 font-medium"><input readonly True id="id" name="id" class="border-b border-indigo-700 text-gray-200 sm:text-sm block w-full p-2.5  dark:border-indigo-700 dark:text-black" value="<?= $_GET['id']; ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="text" id="username" name="username" class="border-b border-indigo-700 text-gray-200 sm:text-sm block w-full p-2.5  dark:border-indigo-700 dark:text-black" value="<?= $user->username ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="text" id="password" name="password" class="border-b border-indigo-700 text-gray-200 sm:text-sm block w-full p-2.5  dark:border-indigo-700 dark:text-black" value="<?= $user->password ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="text" id="name" name="name" class="border-b border-indigo-700 text-gray-200 sm:text-sm block w-full p-2.5  dark:border-indigo-700 dark:text-black" value="<?= $user->name ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4"><input type="text" id="firstname" name="firstname" class="border-b border-indigo-700 text-gray-200 sm:text-sm block w-full p-2.5  dark:border-indigo-700 dark:text-black" value="<?= $user->firstname ?>"></td>
                                        <td class="whitespace-nowrap px-0.5 py-4">
                                            <select id="role" name="role" class="border-b border-indigo-700 text-gray-200 sm:text-sm block p-2.5 dark:border-indigo-700 dark:text-black">
                                                <option value="user" <?php if ($user->role == 'user') {
                                                                            echo 'selected';
                                                                        } ?>>User</option>
                                                <option value="admin" <?php if ($user->role == 'admin') {
                                                                            echo 'selected';
                                                                        } ?>>Admin</option>
                                            </select>
                                        </td>
                                        <td class="whitespace-nowrap px-0.5 py-4">
                                            <button type="submit" class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </button>
                                        </td>
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
