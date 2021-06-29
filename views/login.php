<?php
/** @var $model User */

use app\models\User;

$this->title = "Login";

?>
<main class="container">
    <h1>Log in to continue</h1>

    <div class="underline"></div>
    <br>

    <!-- Feedback Form-->
    <section class="container box">
            <?php $form = tn\phpmvc\form\Form::begin("","post") ?>
                <?php echo $form->field($model,'email') ?>
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
    </section>
</main>