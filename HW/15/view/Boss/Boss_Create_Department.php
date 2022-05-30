<?php
use Core\Form\Form; ?>
<?php if (!$find['status']) { ?>
    <p class="text-center text-[20px] font-[600] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">You have not yet been approved by the original boss</p>

<?php }elseif($find['status'] && !$join) { ?>
    <p class="text-center text-[20px] font-[600] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">You must first complete your profile</p>
<?php }else { ?>

<div class="container p-5">

    <?php $form = Form::begin('', 'post'); ?>

    <div class="flex flex-col">
        <div>
            <?php echo $form->field($model, 'name')->input() ?>
            <?php echo $form->field($model, 'cost_ceiling')->input() ?>
            <?php echo $form->field($model, 'user_active_day')->input()  ?>
            <input type="hidden" name="creator_id" value="<?php echo $join[0]['id'] ?>">
        </div>
    
        <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Edite Profile</button>        
    </div>


    <?php Form::end(); ?>

</div>

<?php } ?>