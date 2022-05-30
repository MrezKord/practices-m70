<div class="w-[90%] h-[90%] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg border border-gray-200 shadow-md shadow-gray-700 dark:bg-gray-800 dark:border-gray-700">

    <div class="flex flex-col items-center p-10">
        <img class="mb-3 w-40 h-40 rounded-full shadow-lg" src="<?php echo $data[0]['profile_photo'] ?>" alt="Bonnie image">
        <h5 class="mb-3 text-xl font-medium text-gray-900 dark:text-white"><?php echo $data[0]['firstName'] . ' ' . $data[0]['lastName'] ?></h5>
        <div class="container grid grid-cols-2 gap-3 text-center">
            <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Department :' . ' ' . $data[0]['department']  ?></span>
            <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'History :' . ' ' . $data[0]['history']  ?></span>
            <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Cost :' . ' ' . $data[0]['cost']  ?></span>
            <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Address :' . ' ' . $data[0]['address']  ?></span>
            <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Phone :' . ' ' . $data[0]['phone']  ?></span>
            <span class="text-md text-gray-500 dark:text-gray-400"><?php echo 'Specialty :' . ' ' . $data[0]['specialty']  ?></span>
        </div>
        <h5 class="mb-3 text-xl font-medium text-gray-900 dark:text-white">Working Time</h5>
        <div class="container grid grid-cols-3 gap-3 text-center">
            <?php $result = array_filter($working_time, fn ($val) => array_search($val, $working_time) !== 'id' &&  array_search($val, $working_time) !== 'doctor_id') ?>
            <?php foreach ($result as $key => $value) { ?>
                <form action="/doctor-appointment" method="get">
                    <input type="hidden" name="day" value="<?php echo $label[$key] ?>">
                    <input type="hidden" name="day-key" value="<?php echo $key ?>">
                    <input type="hidden" name="hours" value="<?php echo $value ?>" >
                    <input type="hidden" name="doctor_id" value="<?php echo $working_time['doctor_id'] ?>">
                    <button type="submit" class="text-md text-gray-500 dark:text-gray-400 hover:bg-gray-200" <?php echo $value == '-' ? 'disabled' : ''  ?>><?php echo $label[$key].' :' . ' ' . $value  ?></button>
                </form>
            <?php } ?>
        </div>
    </div>

</div>