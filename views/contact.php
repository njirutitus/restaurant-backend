<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/** @var $this View */
/** @var $model ContactForm */

use tn\phpmvc\form\Form;
use tn\phpmvc\form\TextareaField;
use tn\phpmvc\View;
use app\models\ContactForm;

$this->title = "Contact";

?>

<!-- Jumbotron -->
<!--<header class="jumbotron row">-->
<!--    <div class="col-6">-->
<!--        <h1>Hola, tell us about our services</h1>-->
<!--        <p>-->
<!--            Tell us everything about our services and how we can improve them to keep you around-->
<!--            longer.-->
<!--        </p>-->
<!---->
<!--    </div>-->
<!--    <div class="col-6">-->
<!--        <img class="img-fluid" src="./images/contact-removebg-preview.png" alt="" />-->
<!--    </div>-->
<!--</header>-->

<main class="container flex-col-center">
    <section class="row">
        <div class="box col-6">
        <h2>Send us your feedback</h2>
        <?php $form = Form::begin('','post')?>
        <?php echo $form->field($model,'subject') ?>
        <?php echo $form->field($model,'name') ?>
        <?php echo $form->field($model,'email')->emailField() ?>
        <?php echo new TextareaField($model,'body') ?>

        <div class="form-control row">
                <div class="col-3"></div>
                <div class="col-6">
                    <input
                            type="submit"
                            class="btn bg-primary"
                            name="submit"
                            value="Send"
                            id="submit"
                    />
                </div>
            </div>
        <?php echo Form::end()?>
        </div>
        <div class="col-6 box bg-success">
            <h2>Address Information</h2>
            <address>
                <p>anniversary towers</p>
                <p>along University way</p>
                <p>
                    Email: <a href="mailto:info@mamafish.com">info@mamafish.com</a>
                </p>
                <p>Tel: <a href="tel:254701234567">254701234567</a></p>
                <div class="social">
                    <a href="" class="nav-link">
                        <i class="fas fa-phone fa-2x"></i>
                    </a>
                    <a href="" class="nav-link">
                        <i class="fab fa-skype fa-2x"></i>
                    </a>
                    <a href="" class="nav-link">
                        <i class="fab fa-whatsapp fa-2x"></i>
                    </a>
                </div>
            </address>
        </div>
    </section>
</main>