<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/** @var $this View */
/** @var $model ContactForm */

use tn\phpmvc\form\Form;
use tn\phpmvc\form\TextareaField;
use tn\phpmvc\View;
use app\models\ContactForm;

$this->title = "Contact";

?>
<!-- Breadcrumb -->
<div class="breadcrumb row">
    <a href="/">Home</a>
    <div class="separator">/</div>
    <a href="">Contact</a>
</div>

<main class="container">
    <h1>Contact Us</h1>

    <div class="underline"></div>

    <section class="row">
        <div class="col-6">
            <h2>Address Information</h2>
            <address>
                <p>anniversary towers</p>
                <p>along University way</p>
                <p>
                    Email: <a href="mailto:info@mamafish.com">info@mamafish.com</a>
                </p>
                <p>Tel: <a href="tel:254701234567">254701234567</a></p>
                <div>
                    <button class="bg-primary">
                        <i class="fas fa-phone"></i> Call us
                    </button>
                    <button class="bg-primary">
                        <i class="fab fa-skype"></i> Skype
                    </button>
                    <button class="bg-primary">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </button>
                </div>
            </address>
        </div>

        <div class="col-6">
            <h2>Map of our location</h2>
            <!--Map to be placed here-->
        </div>
    </section>

    <!-- Feedback Form-->
    <section class="container box">
        <h2>Send us your feedback</h2>
        <?php $form = Form::begin('','post')?>
        <?php echo $form->field($model,'subject') ?>
        <?php echo $form->field($model,'email') ?>
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
    </section>
</main>