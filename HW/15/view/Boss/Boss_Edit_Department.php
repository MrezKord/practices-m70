<?php use Core\Form\Form; ?>

<div class="container p-5">

    <?php $form = Form::begin('', 'post'); ?>

    <div class="flex flex-col">
        <div>
            <?php echo $form->field($model, 'name')->input() ?>
            <?php echo $form->field($model, 'cost_ceiling')->input() ?>
            <?php echo $form->field($model, 'user_active_day')->input()  ?>
            <input type="hidden" name="creator_id" value="<?php echo $creator_id ?>">
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="department_id" value="<?php echo $department_id ?>">
        </div>
    
        <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Edite Profile</button>        
    </div>


    <?php Form::end(); ?>

</div>