<?php use Core\Application; ?>

<div class="container h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 py-8 px-8 flex gap-5 flex-wrap justify-center">
    <?php foreach ($doctors as $key => $value) { ?>

        <form action="/profile-doctor-fake" method="post" class="hover:bg-gray-100 w-[300px] h-[300px] pt-3 bg-white rounded-lg border border-gray-200 shadow-md shadow-gray-600 dark:bg-gray-800 dark:border-gray-700">
            <button type="submit" class="w-full h-full flex flex-col items-center pb-10" <?php echo (Application::$app->isGust() || !$patient) ? 'disabled' : '' ?>>
                <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="<?php echo $value['profile_photo'] ?>" alt="Bonnie image" />
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?php echo $value['firstName'] . ' ' . $value['lastName'] ?></h5>
                <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo 'Specialty : ' . $value['specialty'] ?></span>
                <input type="hidden" name="profile" value="<?php echo $value['id'] ?>">
            </button>
        </form>

    <?php } ?>
</div>