<?php
/** @var $model User */

use app\models\User;

?>
<!-- Breadcrumb -->
<div class="breadcrumb row">
    <a href="/">Home</a>
    <div class="separator">/</div>
    <a href="">Sign Up</a>
</div>

<main class="container">
    <h1>Create Account</h1>

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
                            value="Submit"
                            id="submit"
                    />
                </div>
            </div>
        <?php echo tn\phpmvc\form\Form::end(); ?>
    </section>
</main>