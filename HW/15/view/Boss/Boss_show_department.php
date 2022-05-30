<div class="p-4 w-full bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex justify-between items-center mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Department</h5>
    </div>
    <div class="flow-root">

        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            <?php foreach ($department as $key => $value) { ?>
                <div class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                <?php echo $value['name']  ?>
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                Number of working days of each employee : <?php echo $value['user_active_day'] ?>
                            </p>
                        </div>
                        <!-- <input type="hidden" name="email" value="<?php echo $value['email'] ?>"> -->

                        <form action="/Boss-create-department" method="get" class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            <input type="hidden" name="department_id" value="<?php echo $value['id'] ?>">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                        </form>
                        <form action="/Boss-create-department" method="post" class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="department_id" value="<?php echo $value['id'] ?>">
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </ul>

    </div>
</div>