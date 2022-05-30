
<?php if (!$data) { ?>
    
    <p class="text-center text-[20px] font-[600] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">There is no doctorate yet.</p>

<?php } else { ?>

    <div class="p-4 w-full bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Doctors</h5>
        </div>
        <div class="flow-root">

            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($data as $key => $value) { ?>
                    <div class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    <?php echo  $value['firstName'].' '.$value['lastName'] ?>
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    department : <?php echo $value['department'] ?>
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Specialty : <?php echo $value['specialty'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </ul>

        </div>
    </div>

<?php } ?>
