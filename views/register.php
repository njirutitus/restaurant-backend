<?php
/** @var $model User */

use app\models\User;

$this->title = "Register";

?>

<main class="container">

    <div class="flex-col-center">
        <a href="/"><img src="./images/mama-fish.png" alt="Logo" height="45"></a>
    </div>
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
        <p class="b">Already have an account? <a href="/login" class="nav-link"> Login</a></p>

    </section>
</main>