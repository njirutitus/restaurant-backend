<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/** @var $this View */
/** @var $model \app\models\Menu */
/** @var $img */

use tn\phpmvc\form\Form;
use tn\phpmvc\form\TextareaField;
use tn\phpmvc\View;
use app\models\ContactForm;

$this->title = "Edit Dish";

?>
<!-- Breadcrumb -->
<div class="breadcrumb row">
    <a href="/admin">Dashboard</a>
    <div class="separator">/</div>
    <a href="/admin_dishes">Dishes</a>
    <div class="separator">/</div>
    <a href="">Edit Dish</a>
</div>

<main class="container flex-col-center">
    <h1>Edit Menu Item</h1>

    <div class="underline"></div>
    <br>

    <!-- Form-->
    <section class="row">
        <div class="col-6 box">
        <h2>Menu Details</h2>
        <?php $form = Form::begin('/admin_dish_edit','post')?>
        <div class="img-container">
            <?php if ($img):?>
            <div class="img">
                <?php
                $img = str_starts_with($img,'public')?substr($img,7):$img;
                echo '<img class="img-thumbnail" src="'.$img.'" alt="'.$model->item_title.'"/>';
                ?>
            </div>
            <?php endif; ?>
            <div class="upload">
                <?php echo $form->field($model,'img')->fileField() ?>
            </div>
        </div>
        <?php echo $form->field($model,'item_title') ?>
        <?php echo $form->field($model,'price') ?>
        <?php echo $form->field($model,'item_category') ?>
        <?php echo $form->field($model,'id')->hiddenField() ?>
        <?php echo new TextareaField($model,'desc') ?>
        <div class="form-control row">
            <div class="col-3"></div>
            <div class="col-6">
                <input type="submit" class="btn bg-success" name="submit" value="Update" id="submit">
            </div>
        </div>
        <?php echo Form::end()?>
        </div>
    </section>
</main>