<?php $title = "Le blog de GAP"; ?>
<?php ob_start(); ?>
<?php if (@$_SESSION['login'] == true) { ?>
    <?php if (@$_SESSION['info'] == 0) { ?>
        <?php if(!empty(@$_GET['error'])){
            if($_GET['error'] == 4) {
                $errorImage = "Veillez selectionner une photo de profile.";
            }
        } ?>
        <div class="pb-52"></div>
        <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-2xl overflow-hidden md:max-w-5xl">
            <div class="py-8">
                <form action="index.php?action=createprofile&id_user=<?= @$_SESSION['id_user_verif'] ?>" method="post" enctype="multipart/form-data">
                    <div class="flex flex-col ml-12">
                        <div class="flex flex-row pb-8">
                            <div class="basis-1/5">
                                <label for="name" class="font-bold">🪪 Prénom :</label>
                                <input readonly class="border-b w-20" type="text" name="name" id="name" value="<?= $_SESSION['name'] ?>">
                            </div>
                            <div class="basis-1/5">
                                <label for="firstname" class="font-bold">🪪 Nom :</label>
                                <input readonly class="border-b w-24" type="text" name="firstname" id="firstname" value="<?= $_SESSION['firstname'] ?>">
                            </div>
                            <div class="basis-3/5">
                                <label for="number" class="font-bold">☎️ Numéro de Téléphone :</label>
                                <input class="border-b w-36" type="tel" name="number" id="number" required pattern="0[6-7][0-9]{8}$" maxlength="10" placeholder="0x xx xx xx xx">
                            </div>
                        </div>
                        <div class="flex flex-row pb-8">
                            <div class="basis-2/5">
                                <label for="ville" class="font-bold">📍 Ville :</label>
                                <input class="border-b w-72" type="text" name="ville" id="ville" required pattern="^[a-zA-Z]+|[a-zA-Z]+\s[a-zA-Z]+$" placeholder="Paris">
                            </div>
                            <div class="basis-2/5">
                                <label for="code_postal" class="font-bold">📌 Code Postal :</label>
                                <input class="border-b w-52" type="text" name="code_postal" required pattern="[0-9]{5}$" maxlength="5" id="code_postal" placeholder="05000">
                            </div>
                        </div>
                        <div class="flex flex-row pb-8">
                            <div class="basis-2/5">
                                <label for="adresse" class="font-bold">🔑 Adresse :</label>
                                <input class="border-b w-64" type="text" name="adresse" required pattern="([0-9]*) ?([a-zA-Z,\. ]*)$" id="adresse" placeholder="X Rue de l'Exemple">
                            </div>
                            <div class="basis-3/5">
                                <label for="mail" class="font-bold">✉️ Mail :</label>
                                <input class="border-b w-64" type="email" name="mail" required pattern=".+(.com|.fr)$" id="mail" placeholder="example@something.com">
                            </div>
                        </div>
                        <div class="flex flex-row pb-4">
                            <div class="basis-4/5">
                                <label for="bio" class="font-bold">🗒 Bio :</label>
                            </div>
                        </div>

                        <div class="flex flex-row pb-4">
                            <div class="basis-5/5">
                                <textarea name="bio" id="bio" cols="94" rows="3" required class="border-l border-t"></textarea>
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
                                            Profile Photo <span class="text-red-600"> </span>
                                        </label>

                                        <div class="text-center">
                                            <!-- Current Profile Photo -->
                                            <div class="mt-2" x-show="! photoPreview">
                                                <img src="uploads/default.png" class="w-20 h-20 m-auto rounded-full shadow">
                                            </div>
                                            <!-- New Profile Photo Preview -->
                                            <div class="mt-2" x-show="photoPreview" style="display: none;">
                                                <span class="block w-20 h-20 rounded-full m-auto shadow" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'" style="background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url('null');">
                                                </span>
                                            </div>
                                        </div>

                                            <button type="button" class="inline-flex items-center ml-8 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2" x-on:click.prevent="$refs.photo.click()">
                                                Select New Photo
                                            </button>
                                            <p class="text-red-600"><?= @$errorImage ?></p>
                                    </div>
                                </div>

                            </div>
                            <div class="basis-2/5">
                                <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    Valider Mon Profil
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    <?php } else { ?>
        <div class="pb-52"></div>
        <div class="max-w-md mx-auto mb-2 bg-white rounded-xl shadow-2xl overflow-hidden md:max-w-2xl">
            <div class="p-8">
                <h1 class="pb-8 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                    Votre profile est deja créé .
                </h1>

                <table class="text-left text-sm font-light mx-auto" id="GestUserTable">
                    <thead class="bg-white font-medium dark:border-indigo-700 dark:bg-white">
                        <tr>
                            <th scope="col" class="px-12 py-6 border-t dark:border-indigo-700">
                                <a href="index.php?action=seeprofile" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-8 py-2 lg:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Votre Profile</a>
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
