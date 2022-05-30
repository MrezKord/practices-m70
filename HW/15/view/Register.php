<h1 class="text-[50px] text-white mb-5">Register</h1>

<?php

use Core\Form\Form;

$form = Form::begin('', 'post'); ?>

<div class="grid grid-cols-2 gap-4">
    <?php echo $form->field($model, 'firstName')->input() ?>
    <?php echo $form->field($model, 'lastName')->input()  ?>
    <?php echo $form->field($model, 'email')->input()  ?>
    <?php echo $form->field($model, 'role')->selectBox(['Boss', 'Doctor', 'Patient']) ?>
    <?php echo $form->field($model, 'password')->typePassword()->input()  ?>
    <?php echo $form->field($model, 'confirmPassword')->typePassword()->input() ?>
    <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Register new account</button>
</div>



<?php Form::end(); ?>