<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/** @var $this View */
/** @var $model \app\models\Menu */

use tn\phpmvc\form\Form;
use tn\phpmvc\form\TextareaField;
use tn\phpmvc\View;
use app\models\ContactForm;

$this->title = "New Dish";

?>
<!-- Breadcrumb -->
<div class="breadcrumb row">
    <a href="/admin">Dashboard</a>
    <div class="separator">/</div>
    <a href="/admin_dishes">Dishes</a>
    <div class="separator">/</div>
    <a href="">New Dish</a>
</div>

<main class="container">
    <h1>Add New Menu Item</h1>

    <div class="underline"></div>
    <br>

    <!-- Feedback Form-->
    <section class="box">
        <h2>Meal Details</h2>
        <?php $form = Form::begin('','post')?>
        <?php echo $form->field($model,'item_title') ?>
        <?php echo $form->field($model,'price') ?>
        <?php echo $form->field($model,'item_category') ?>
<!--        <div class='file-input'>-->
        <?php echo $form->field($model,'img')->fileField() ?>
<!--        </div>-->
        <?php echo new TextareaField($model,'desc') ?>
        <div class="form-control row">
            <div class="col-3"></div>
            <div class="col-6">
                <input
                    type="submit"
                    class="form-control btn bg-success"
                    name="submit"
                    value="Add"
                    id="submit"
                />
            </div>
        </div>
        <?php echo Form::end()?>
    </section>
</main>