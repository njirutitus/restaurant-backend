<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/** @var $this View */
/** @var $model Menu */
/** @var $dishes */


use app\models\Menu;
use tn\phpmvc\View;

$this->title = "New Dish";

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
<a href="/admin_dishes_add" class="mr-auto btn bg-success">
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
                echo '<tr>
                    <td><img src="'.$dish->img.'" alt="'.$dish->item_title.'" class="thumbnail">'."</td>
                    <td>$dish->item_title</td>
                    <td>$dish->price</td>
                    <td>$dish->item_category</td>
                    <td>$dish->desc</td>
                        ";
                    echo '<td>
                        <button class="btn bg-warning delete-btn" href="" data-table="'.$table.'" data-id="'.$dish->$key.'" data-title="'.$dish->item_title.'">Delete</button>
                        <button class="btn bg-success" href="">Edit</button>
                    </td>
                </tr>';
            }

        ?>
                </tbody>
            </table>
        </div>
<div class="modal-wrapper" id="modalWrapper">

<div class="modal">
    <!-- Header -->
    <div class="modal__header">
        <h2>Delete <span id="dishId"></span>?</h2>
        <span class="close-icon" id="closeModal">
        <i class="fas fa-times fa-2x"></i>
        </span>
    </div>

    <!-- Content -->
    <p> Are you sure you want to delete <span id="dishTitle"></span>? </p>
    <!-- Footer -->
    <div class="modal__footer">
        <div class="btn btn-warning">Cancel</div>
        <div class="btn btn-primary" id="deleteDish">Delete</div>
    </div>
</div>
</div>
