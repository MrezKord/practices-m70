
<?php if (!$data) { ?>
    
    <p class="text-center text-[20px] font-[600] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">You must first complete your profile.</p>

<?php } else { ?>

    <div class="p-4 w-full bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Appointment</h5>
        </div>
        <div class="flow-root">

            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($data as $key => $value) { ?>
                    <form action="" method="post" class="py-3 sm:py-4">
                        <input type="hidden" name="_method" value="delete">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    <?php echo 'Patient name : '.$value['patient_name'] ?>
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Day : <?php echo $value['day'] ?>
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Hour : <?php echo $value['time'] ?>
                                </p>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </ul>

        </div>
    </div>

<?php } ?>
