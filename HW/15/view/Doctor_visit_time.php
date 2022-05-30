<div class="flex flex-col items-center gap-3 p-10">
    <div class="w-full flex items-start">
        <h1><?php echo $request['day'] ?></h1>
    </div>

    <form action="" method="post" class="w-full flex flex-col gap-3">
        <div class="w-full flex gap-4">
            <?php foreach ($hours as $key => $value) { ?>

                <div class="flex items-center">
                    <input id="default-radio-1" type="radio" value="<?php echo $value ?>" name="time" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"><?php echo $value ?></label>
                </div>
            <?php } ?>
            <input type="hidden" name="doctor_id" value="<?php echo $request['doctor_id'] ?>">
            <input type="hidden" name="patient_id" value="<?php echo $patient_id ?>">
            <input type="hidden" name="day" value="<?php echo $request['day-key'] ?>">
            <input type="hidden" name="hours" value="<?php echo base64_encode(json_encode($hours)); ?>">
        </div>
        <div>
            <p class="text-sm text-red-600"><?php echo $error ?></p>
        </div>
        <div class="w-full flex">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Save</button>
        </div>
    </form>

</div>