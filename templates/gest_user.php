<?php $title = "Le blog de GAP"; ?>

<?php ob_start(); ?>
<a href="index.php" class="text-black"><button type="button" class="py-2 px-5 mb-5 mt-2 text-sm font-medium ml-12 text-black focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:text-black">Retour aux billets</button></a>
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
                    <p class="block mt-1 mb-2 text-xl leading-tight font-medium text-indigo-500 text-center">Gestion des Utilisateurs </p>
                </div>
                <table class="text-left text-sm font-light" id="GestUserTable">
                    <thead class="border-b bg-white font-medium dark:border-indigo-700 dark:bg-gray-50">
                        <tr>
                            <th scope="col" class="pl-12 py-4">#</th>
                            <th scope="col" class="pl-8 py-4">Username</th>
                            <th scope="col" class="pl-8 py-4">Password</th>
                            <th scope="col" class="pl-10 py-4">Name</th>
                            <th scope="col" class="px-3 py-4">Firstname</th>
                            <th scope="col" class="pl-12 py-4">Role</th>
                            <th scope="col" class="px-12 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b dark:border-indigo-700">
                            <form action="index.php?action=registergest" method="post">
                                <td class="whitespace-nowrap px-12 py-4 font-medium">X</td>
                                <td class="whitespace-nowrap px-3 py-4"><input type="text" name="user" id="user" class="block w-full p-2 text-gray-900 border-b border-gray-300  bg-white sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-indigo-700 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4"><input type="password" name="pw" id="pw" class="block w-full p-2 text-gray-900 border-b border-gray-300  bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-indigo-700 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4"><input type="text" name="name" id="name" class="block w-full p-2 text-gray-900 border-b border-gray-300  bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-indigo-700 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4"><input type="text" name="firstname" id="firstname" class="block w-full p-2 text-gray-900 border-b border-gray-300  bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-indigo-700 dark:placeholder-gray-400 dark:text-gray-900 dark:focus:ring-blue-500 dark:focus:border-blue-500"></td>
                                <td class="whitespace-nowrap px-3 py-4">
                                    <select id="role" name="role" class="border-b border-indigo-700 text-gray-200 sm:text-sm  block p-2.5 dark:border-indigo-700 dark:text-black">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </td>
                                <td class="whitespace-nowrap px-12 py-4">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 5.25l-7.5 7.5-7.5-7.5m15 6l-7.5 7.5-7.5-7.5" />
                                        </svg>

                                    </button>
                                </td>
                            </form>
                        </tr>
                        <?php
                        foreach ($users as $user) {
                            if ($user->role != 'super-admin') {
                        ?>
                                <tr class="border-b dark:border-indigo-700">
                                    <td class="whitespace-nowrap px-12 py-4 font-medium"><?= $user->id_user; ?></td>
                                    <td class="whitespace-nowrap px-12 py-4"><?= $user->username; ?></td>
                                    <td class="whitespace-nowrap px-12 py-4"><?= $user->password; ?></td>
                                    <td class="whitespace-nowrap px-12 py-4"><?= $user->name; ?></td>
                                    <td class="whitespace-nowrap px-12 py-4"><?= $user->firstname; ?></td>
                                    <td class="whitespace-nowrap px-12 py-4"><?= $user->role; ?></td>
                                    <td class="whitespace-nowrap px-12 py-4">
                                        <a href="index.php?action=edituser_redirection&id=<?= $user->id_user; ?>&role=<?= $user->role ?>" class="text-black">
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                </svg>
                                            </button>
                                        </a>
                                        <a href="index.php?action=dellogin&id_user=<?= $user->id_user ?>" class="text-black">
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
            </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
