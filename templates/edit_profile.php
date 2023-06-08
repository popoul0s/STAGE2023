<!-- SVG LOGO EDIT : 
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
</svg>

SVG LOGO DELETE : 
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
</svg>

SVG LOGO DECONNEXION : 
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
</svg> -->



<?php $title = "Le blog de GAP"; ?>
<?php ob_start(); ?>
<?php if (@$_SESSION['login'] == true) { ?>
    <?php if (@$_SESSION['info'] == 1 || @$_SESSION['info_validate'] == true) { ?>
        <div class="pb-52"></div>
        <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-2xl overflow-hidden md:max-w-5xl">
            <div class="py-8">
                <?php foreach ($profiles as $profile) { ?>
                    <form action="index.php?action=editprofile&id_user=<?= $_GET['id_user'] ?>" method="post" enctype="multipart/form-data">
                        <div class="flex flex-col ml-12">
                            <div class="flex flex-row pb-8">
                                <div class="basis-2/7 ml-12 mr-2">
                                    <label for="name" class="font-bold">🪪 Prénom :</label>
                                    <input readonly class="border-b w-20" type="text" name="name" id="name" value="<?= $_SESSION['name'] ?>">
                                </div>
                                <div class="basis-2/7 mr-32">
                                    <label for="firstname" class="font-bold">🪪 Nom :</label>
                                    <input readonly class="border-b w-24" type="text" name="firstname" id="firstname" value="<?= $_SESSION['firstname'] ?>">
                                </div>
                                <div class="basis-3/7">
                                    <label for="number" class="font-bold">☎️ Numéro de Téléphone :</label>
                                    <input class="border-b w-32" type="tel" name="number" required pattern="0[6-7][0-9]{8}$" maxlength="10" id="number" value="<?= $profile->tel ?>">
                                </div>
                            </div>
                            <div class="flex flex-row pb-8">
                                <div class="basis-2/5 ml-12 mr-24">
                                    <label for="ville" class="font-bold">📍 Ville :</label>
                                    <input class="border-b w-72" type="text" name="ville" required pattern="^[a-zA-Z]+|[a-zA-Z]+\s[a-zA-Z]+$" id="ville" value="<?= $profile->ville ?>">
                                </div>
                                <div class="basis-2/5">
                                    <label for="code_postal" class="font-bold">📌 Code Postal :</label>
                                    <input class="border-b w-52" type="text" name="code_postal" required pattern="[0-9]{5}$" maxlength="5" id="code_postal" value="<?= $profile->code_postal ?>">
                                </div>
                            </div>
                            <div class="flex flex-row pb-8">
                                <div class="basis-2/5 ml-12 mr-24">
                                    <label for="adresse" class="font-bold">🔑 Adresse :</label>
                                    <input class="border-b w-64" type="text" name="adresse" required id="adresse" pattern="([0-9]*) ?([a-zA-Z,\. ]*)$" value="<?= $profile->adresse ?>">
                                </div>
                                <div class="basis-2/5">
                                    <label for="mail" class="font-bold">✉️ Mail :</label>
                                    <input class="border-b w-64" type="email" name="mail" id="mail" required pattern=".+(.com|.fr)$" value="<?= $profile->mail ?>">
                                </div>
                            </div>
                            <div class="flex flex-row pb-4">
                                <div class="basis-4/5 ml-12">
                                    <label for="bio" class="font-bold">🗒 Bio :</label>
                                </div>
                            </div>
                            <div class="flex flex-row pb-4">
                                <div class="basis-3/6 ml-12">
                                    <textarea name="bio" id="bio" required cols="60" rows="3" class="border-l border-t"><?= $profile->bio ?></textarea>
                                </div>
                                <div class="basis-1/10 ml-28">
                                    <button type="submit" onMouseOver="displayDivInfo('Confirmer la modification');" onMouseOut="displayDivInfo()">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex flex-row pb-4">
                                <div class="basis-3/5 flex flex-row pb-4">
                                    <div class="basis-2/5">

                                        <div x-data="{photoName: null, photoPreview: null}" class="basis-3/5">
                                            <!-- Photo File Input -->
                                            <input type="file" name="fileToUpload" id="fileToUpload" class="hidden" x-ref="photo" x-on:change="
                                                                                            photoName = $refs.photo.files[0].name;
                                                                                            const reader = new FileReader();
                                                                                            reader.onload = (e) => {
                                                                                                photoPreview = e.target.result;
                                                                                            };
                                                                                            reader.readAsDataURL($refs.photo.files[0]);
                                                                                            ">

                                            <label class="block text-gray-700 text-sm font-bold mb-2 text-center" for="photo">
                                                Photo de Profile <span class="text-red-600"> </span>
                                            </label>

                                            <div class="text-center">
                                                <!-- Current Profile Photo -->
                                                <div class="mt-2" x-show="! photoPreview">
                                                    <img src="<?php if(file_exists('uploads/profilepicture_' . $_SESSION['id_user_verif'] . '.png')) {?>uploads/profilepicture_<?= $_SESSION['id_user_verif']?>.png <?php } else { ?> uploads/default.png <?php } ?>" class="w-20 h-20 m-auto rounded-full shadow">
                                                </div>
                                                <!-- New Profile Photo Preview -->
                                                <div class="mt-2" x-show="photoPreview" style="display: none;">
                                                    <span class="block w-20 h-20 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                                    </span>
                                                </div>
                                            </div>

                                            <button type="button" class="inline-flex items-center ml-12 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2" x-on:click.prevent="$refs.photo.click()">
                                                Change Photo
                                            </button>
                                            <p class="text-red-600"><?= @$errorImage ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>

                <?php } ?>

            <?php } elseif (@$_SESSION['info_validate']) { ?>
                <div class="pb-52"></div>
                <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-2xl overflow-hidden md:max-w-2xl">
                    <div class="p-8">
                        <h1 class="pb-8 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                            Votre profile est pas encore créé .
                        </h1>

                        <table class="text-left text-sm font-light mx-auto" id="GestUserTable">
                            <thead class="bg-white font-medium dark:border-indigo-700 dark:bg-white">
                                <tr>
                                    <th scope="col" class="px-12 py-6 border-t dark:border-indigo-700">
                                        <a href="index.php?action=profileredirection" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-8 py-2 lg:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Votre Profile</a>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <p>
                </p>
                <?php  ?>
            <?php } else { ?>
                <div class="pb-52"></div>
                <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-2xl overflow-hidden md:max-w-2xl">
                    <div class="p-8">
                        <h1 class="pb-8 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                            Votre profile est pas encore créé .
                        </h1>

                        <table class="text-left text-sm font-light mx-auto" id="GestUserTable">
                            <thead class="bg-white font-medium dark:border-indigo-700 dark:bg-white">
                                <tr>
                                    <th scope="col" class="px-12 py-6 border-t dark:border-indigo-700">
                                        <a href="index.php?action=profileredirection" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-8 py-2 lg:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Votre Profile</a>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <p>
                </p>
            <?php } ?>
        <?php } else { ?>
            <div class="pb-52"></div>
            <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-2xl overflow-hidden md:max-w-2xl">
                <div class="p-8">
                    <h1 class="pb-8 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                        Vous n'êtes pas connecté.
                    </h1>



                    <table class="text-left text-sm font-light mx-auto" id="GestUserTable">
                        <thead class="bg-white font-medium dark:border-indigo-700 dark:bg-white">
                            <tr>
                                <th scope="col" class="px-12 py-6 border-r dark:border-indigo-700">
                                    <a href="index.php?action=pagelogin" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-8 py-2 lg:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Se Connecter</a>
                                </th>
                                <th scope="col" class="px-12 py-4">
                                    <a href="index.php?action=pageregister" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Créer un Compte</a>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        <?php } ?>
        <?php $content = ob_get_clean(); ?>

        <?php require('layout.php') ?>
