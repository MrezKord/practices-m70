<h1 class="text-[50px] text-white mb-5">WorkingTime</h1>

<?php

use Core\Form\Form;

$form = Form::begin('', 'post'); ?>

<input type="hidden" name="_method", value="put">

<div class="flex flex-col gap-5">
    
    <div class="flex flex-row w-[900px]">
        <div class="fixed left-4">Sunday</div>
        <div class="flex gap-5 ml-[130px]">
            <?php echo $form->field($model, 'Sun')->typeRadio()->Radio('24-08') ?>
            <?php echo $form->field($model, 'Sun')->typeRadio()->Radio('08-16') ?>
            <?php echo $form->field($model, 'Sun')->typeRadio()->Radio('16-24') ?>
        </div>
    </div>

    <div class="flex flex-row gap-10">
        <div class="fixed left-4">Monday</div>
        <div class="flex gap-5 ml-[130px]">
            <?php echo $form->field($model, 'Mon')->typeRadio()->Radio('24-08') ?>
            <?php echo $form->field($model, 'Mon')->typeRadio()->Radio('08-16') ?>
            <?php echo $form->field($model, 'Mon')->typeRadio()->Radio('16-24') ?>

        </div>
    </div>

    <div class="flex flex-row gap-10">
        <div class="fixed left-4">Tuesday</div>
        <div class="flex gap-5 ml-[130px]">
            <?php echo $form->field($model, 'Tues')->typeRadio()->Radio('24-08') ?>
            <?php echo $form->field($model, 'Tues')->typeRadio()->Radio('08-16') ?>
            <?php echo $form->field($model, 'Tues')->typeRadio()->Radio('16-24') ?>
        </div>    
    </div>

    <div class="flex flex-row gap-10">
        <div class="fixed left-4">Wednesday</div>
        <div class="flex gap-5 ml-[130px]">
            <?php echo $form->field($model, 'Wed')->typeRadio()->Radio('24-08') ?>
            <?php echo $form->field($model, 'Wed')->typeRadio()->Radio('08-16') ?>
            <?php echo $form->field($model, 'Wed')->typeRadio()->Radio('16-24') ?>
        </div>
    </div>

    <div class="flex flex-row gap-10">
        <div class="fixed left-4">Thursday</div>
        <div class="flex gap-5 ml-[130px]">
            <?php echo $form->field($model, 'Thurs')->typeRadio()->Radio('24-08') ?>
            <?php echo $form->field($model, 'Thurs')->typeRadio()->Radio('08-16') ?>
            <?php echo $form->field($model, 'Thurs')->typeRadio()->Radio('16-24') ?>
        </div>
    </div>

    <div class="flex flex-row gap-10">
        <div class="fixed left-4">Friday</div>
        <div class="flex gap-5 ml-[130px]">
            <?php echo $form->field($model, 'Fri')->typeRadio()->Radio('24-08') ?>
            <?php echo $form->field($model, 'Fri')->typeRadio()->Radio('08-16') ?>
            <?php echo $form->field($model, 'Fri')->typeRadio()->Radio('16-24') ?>
        </div>
    </div>

    <div class="flex flex-row gap-10">
        <div class="fixed left-4">Saturday</div>
        <div class="flex gap-5 ml-[130px]">
            <?php echo $form->field($model, 'Sat')->typeRadio()->Radio('24-08') ?>
            <?php echo $form->field($model, 'Sat')->typeRadio()->Radio('08-16') ?>
            <?php echo $form->field($model, 'Sat')->typeRadio()->Radio('16-24') ?>
        </div>
    </div>

    <?php if ($model->getError()) { ?>
        <div class="error-message"><?php echo $model->getError()['Sun'][0] ?></div>
    <?php } ?>

    <button type="submit" class="w-[100px] mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Save</button>
</div>
<?php Form::end(); ?>