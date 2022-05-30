<h1>Profile</h1>


<?php  
use Core\Form\Form; ?>

<div class="container p-5">

    <?php $form = Form::begin('', 'post','enctype="multipart/form-data"'); ?>
    
    <?php echo $form->field($model, 'family_history')->input() ?>
    <?php echo $form->field($model, 'profile_photo')->typeFile()->input()  ?>
    <?php echo $form->field($model, 'phone')->input()  ?>

    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
    <input type="hidden" name="_method" value="put">
    
    <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Edite Profile</button>
    
    
    <?php Form::end(); ?>
    
</div>
