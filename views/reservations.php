<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/** @var $this View */
/** @var $model ReservationForm */
/** @var $reservations */


use app\models\Menu;
use app\models\ReservationForm;
use tn\phpmvc\form\Form;
use tn\phpmvc\form\TextareaField;
use tn\phpmvc\View;

$this->title = "Dishes";

?>
<!-- Breadcrumb -->
<div class="breadcrumb row">
    <a href="/admin">Dashboard</a>
    <div class="separator">/</div>
    <a href="">Reservations</a>
</div>

<h1>Reservations</h1>
<div class="underline"></div>
<br />
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Reserved By</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Adults</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
        <?php
            foreach ($reservations as $reservation) {
                $key = $reservation->primaryKey();
                $table = $reservation->tableName();
                echo '<tr>
                    <td>'.$reservation->reserved_by.'</td>
                    <td>'.$reservation->date.'</td>
                    <td>'.$reservation->time.'</td>
                    <td>'.$reservation->adults.'</td>
                    <td>
                        <button class="btn bg-warning action-btn" data-target="deleteModalWrapper" data-table="'.$table.'" data-id="'.$reservation->$key.'" data-title="'.$reservation->reserved_by.'">Cancel</button>
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
