<!-- <h1>Doctors</h1> -->


<div class="container h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 py-8 px-8 flex gap-5 flex-wrap justify-center">
    <?php foreach ($data as $key => $value) { ?>

        <form action="/profile-doctor-fake" method="post" class="w-[300px] h-[300px] pt-3 bg-white rounded-lg border border-gray-200 shadow-md shadow-gray-600 dark:bg-gray-800 dark:border-gray-700">

            <div class="flex flex-col items-center pb-10">
                <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="<?php echo $value['profile_photo'] ?>" alt="Bonnie image" />
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?php echo $value['firstName'] . ' ' . $value['lastName'] ?></h5>
                <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo 'Specialty : ' . $value['department'] ?></span>
                <input type="hidden" name="profile" value="<?php echo $value['id'] ?>">
                <div class="flex mt-4 space-x-3 lg:mt-6">
                    <button type="submit" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Profile</button>
                </div>
            </div>
        </form>

    <?php } ?>
</div>