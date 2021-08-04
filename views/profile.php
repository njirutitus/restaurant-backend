<?php
/** @var $model User */

use app\models\User;
$this->title = "Profile";

?>
<main class="container">
    <h1>My profile</h1>

    <div class="underline"></div>
    <br>

    <!-- Feedback Form-->
    <section class="container box">
        <?php $form = tn\phpmvc\form\Form::begin("","post") ?>
        <?php echo $form->field($model,'firstname') ?>
        <?php echo $form->field($model,'lastname') ?>
        <?php echo $form->field($model,'email') ?>
        <?php echo $form->field($model,'password')->passwordField() ?>
        <?php echo $form->field($model,'confirmPassword')->passwordField() ?>
        <div class="form-control row">
            <div class="col-3"></div>
            <div class="col-6">
                <input
                    type="submit"
                    class="btn bg-primary"
                    name="submit"
                    value="Update"
                    id="submit"
                />
            </div>
        </div>
        <?php echo tn\phpmvc\form\Form::end(); ?>
    </section>
</main>