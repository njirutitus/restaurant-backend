<?php
/** @var $model PasswordResetForm */

use app\models\PasswordResetForm;

$this->title = "Reset password";

?>
<main class="container flex-col-center">
    <div>
        <a href="/"><img src="./images/mama-fish.png" alt="Logo" height="45"></a>
    </div>

    <!-- Feedback Form-->
    <section class="row">
        <div class="col-6 box">
        <h2> Forgot Your Password? </h2>
        <p>We get it, stuff happens. Just enter your email below and we'll send you instructions to reset your password!</p>
            <?php $form = tn\phpmvc\form\Form::begin("","post") ?>
                <?php echo $form->field($model,'email') ?>
                <div class="form-control row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <input
                                type="submit"
                                class="btn bg-primary"
                                name="submit"
                                value="Reset Password"
                                id="submit"
                        />
                    </div>
                </div>
        <?php echo tn\phpmvc\form\Form::end(); ?>
        <p class="b">New here? <a href="/register" class="nav-link"> Create an account</a></p>
        <p class="b">Already have an account? <a href="/login" class="nav-link"> Login</a></p>
        </div>
    </section>
</main>