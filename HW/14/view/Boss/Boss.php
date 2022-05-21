<?php
$findUser = $model->find(['email' => $_SESSION['email']]);
$request = $model->get(['firstName', 'lastName', 'role', 'email'], ['AND' => ['role[!]' => 'Patient', 'status' => 0]]);
?>

<?php if ($findUser['status']) { ?>

    <div class="p-4 w-full bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Confirmation</h5>
        </div>
        <div class="flow-root">

            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($request as $key => $value) { ?>
                    <form action="/Boss-confirm" method="post" class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    <?php echo $value['firstName'] . '  ' . $value['lastName']  ?>
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Role : <?php echo $value['role'] ?>
                                </p>
                            </div>
                            <input type="hidden" name="email" value="<?php echo $value['email'] ?>">
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Confirm</button>      
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </ul>

        </div>
    </div>

<?php } else { ?>

    <p class="text-center text-[20px] font-[600] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">You have not yet been approved by the original boss</p>

<?php } ?>