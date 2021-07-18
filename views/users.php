<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/** @var $this View */
/** @var $model User */
/** @var $users */


use app\models\Menu;
use tn\phpmvc\form\Form;
use tn\phpmvc\form\TextareaField;
use tn\phpmvc\View;

$this->title = "New Dish";

?>
<!-- Breadcrumb -->
<div class="breadcrumb">
    <a href="/admin">Dashboard</a>
    <div class="separator">/</div>
    <a href="">Users</a>
</div>

<h1>Users</h1>
<div class="underline"></div>
<br />

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Is Staff</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $user) {
            $key = $user->primaryKey();
            $table = $user->tableName();
            $name = $user->getDisplayName();
            echo "<tr>
                    <td>$user->firstname</td>
                    <td>$user->lastname</td>
                    <td>$user->email</td>
                    <td>$user->is_staff</td>";
            echo '<td>
                        <button class="btn bg-warning action-btn" data-target="userDeleteModalWrapper" data-table="'.$table.'" data-id="'.$user->$key.'" data-title="'.$name.'">Delete</button>
                    </td>
                </tr>';
        }

        ?>
        </tbody>
    </table>
</div>

<div class="modal-wrapper" id="userDeleteModalWrapper">

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
            <div class="btn btn-primary" id="deleteUser">Delete</div>
        </div>
    </div>
</div>

