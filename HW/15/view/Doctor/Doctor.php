
<?php if (!$controllBasicProfile) { ?>

    <p class="text-center text-[20px] font-[600] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">After completing the profile, your profile will be displayed here 😉</p>
<?php } elseif (!$controlltime) { ?>

    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col gap-4">
        <p class="text-center text-[20px] font-[600]"> Please set <a href="/Doctor-working-time" class="text-blue-600 no-underline hover:underline">working time</a> </p>
    </div>

<?php } else { ?>


    <div class="w-[90%] h-[90%] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg border border-gray-200 shadow-md shadow-gray-700 dark:bg-gray-800 dark:border-gray-700">

        <div class="flex flex-col items-center p-10">
            <img class="mb-3 w-40 h-40 rounded-full shadow-lg" src="<?php echo $controllBasicProfile[0]['profile_photo'] ?>" alt="Bonnie image">
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?php echo $controllBasicProfile[0]['firstName'] . ' ' . $controllBasicProfile[0]['lastName'] ?></h5>
            <div class="container grid grid-cols-2 gap-3 text-center">
                <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Department :' . ' ' . $controllBasicProfile[0]['department']  ?></span>
                <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'History :' . ' ' . $controllBasicProfile[0]['history']  ?></span>
                <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Cost :' . ' ' . $controllBasicProfile[0]['cost']  ?></span>
                <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Address :' . ' ' . $controllBasicProfile[0]['address']  ?></span>
                <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Phone :' . ' ' . $controllBasicProfile[0]['phone']  ?></span>
            </div>
            <div class="flex mt-4 space-x-3 lg:mt-6">
                <a href="/Doctor-edit-profile" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit Profile</a>
            </div>
        </div>

    </div>

<?php } ?>