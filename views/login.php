<?php
/** @var $model User */

use app\models\User;

$this->title = "Login";

?>
<main class="container flex-col-center">
    <div class="flex-col-center">
        <a href="/"><img src="./images/mama-fish.png" alt="Logo" height="45"></a>
    </div>
    <h1>Log in to continue</h1>

    <div class="underline"></div>
    <br>

    <!-- Login Form-->
    <section class="row">
        <div class="col-6 box">
            <?php $form = tn\phpmvc\form\Form::begin("","post") ?>
                <?php echo $form->field($model,'email') ?>
                <div class="flex-col-end"><a href="/password-reset" class="nav-link"> Forgot Password?</a></div>
                <?php echo $form->field($model,'password')->passwordField() ?>
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
        <p class="b">New here? <a href="/register" class="nav-link"> Create an account</a></p>
        </div>
    </section>
</main>