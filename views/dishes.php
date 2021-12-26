<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/** @var $this View */
/** @var $model Menu */
/** @var $dishes */


use app\models\Menu;
use tn\phpmvc\form\Form;
use tn\phpmvc\form\TextareaField;
use tn\phpmvc\View;

$this->title = "Dishes";

?>
<!-- Breadcrumb -->
<div class="breadcrumb row">
    <a href="/admin">Dashboard</a>
    <div class="separator">/</div>
    <a href="">Dishes</a>
</div>

<h1>Dishes</h1>
<div class="underline"></div>
<br />
<a href="/admin_dishes_add" class="mr-auto btn bg-primary">
    <i class="fas fa-plus"></i> Add Dish
</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Dish Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
        <?php
            foreach ($dishes as $dish) {
                $key = $dish->primaryKey();
                $table = $dish->tableName();
                $img = str_starts_with($dish->img,'public')?substr($dish->img,7):$dish->img;
                echo '<tr>
                    <td><img src="'.$img.'" class="thumbnail">'."</td>
                    <td>$dish->item_title</td>
                    <td>$dish->price</td>
                    <td>$dish->item_category</td>
                    <td>$dish->desc</td>
                        ";
                    echo '<td>
                        <button class="btn bg-warning action-btn" data-target="deleteModalWrapper" data-table="'.$table.'" data-id="'.$dish->$key.'" data-title="'.$dish->item_title.'">Delete</button>
                        <a class="btn bg-success" href="/admin_dish_edit?id='.$dish->$key.'">Edit</a>
                        <a class="btn bg-primary" href="/admin_dish_comments?id='.$dish->$key.'">View comments</a>
                    </td>
                </tr>';
            }

        ?>
<!--        <button class="btn bg-success action-btn" data-target="editModalWrapper" data-table="'.$table.'" data-id="'.$dish->$key.'" data-title="'.$dish->item_title.'">Edit</button>-->
                </tbody>
            </table>
        </div>
<div class="modal-wrapper" id="deleteModalWrapper">

<div class="modal">
    <!-- Header -->
    <div class="modal__header">
        <h2>Delete <span class="id"></span>?</h2>
        <span class="close-icon closeModal">
        <i class="fas fa-times fa-2x"></i>
        </span>
    </div>

    <!-- Content -->
    <p> Are you sure you want to delete <span class="title"></span>? </p>
    <!-- Footer -->
    <div class="modal__footer">
        <div class="btn btn-warning closeModal">Cancel</div>
        <div class="btn btn-primary" id="deleteDish">Delete</div>
    </div>
</div>
</div>

<div class="modal-wrapper" id="editModalWrapper">

    <div class="modal">
        <!-- Header -->
        <div class="modal__header">
            <h2>Edit Menu with id <span class="id"></span>?</h2>
            <span class="close-icon closeModal">
                <i class="fas fa-times fa-2x"></i>
            </span>
        </div>

        <!-- Content -->
        <!-- Feedback Form-->
            <?php $form = Form::begin('','post')?>
            <?php echo $form->field($model,'item_title') ?>
            <?php echo $form->field($model,'price') ?>
            <?php echo $form->field($model,'item_category') ?>
            <!--        <div class='file-input'>-->
            <?php echo $form->field($model,'img')->fileField() ?>
            <!--        </div>-->
            <?php echo new TextareaField($model,'desc') ?>
        <!-- Footer -->
        <div class="modal__footer">
            <div class="btn btn-warning closeModal">Cancel</div>
            <div class="btn btn-primary" id="editDish">Edit</div>
        </div>
        <?php echo Form::end()?>

    </div>
</div>
