<?php /** @noinspection PhpVoidFunctionResultUsedInspection */
/**
 * @var $menuitem Menu
 * @var $comments
 * @var $users User
 */

use app\models\Menu;
use app\models\User;
use tn\phpmvc\Application;

$this->title = "Dish Comments";

?>
        <!-- Breadcrumb -->
        <div class="breadcrumb row">
            <a href="/admin">Dashboard</a>
            <div class="separator">/</div>
            <a href="/admin_dishes">Dishes</a>
            <div class="separator">/</div>
            <a href="/admin_dish_comments">Comments</a>
        </div>

        <h1>Dish Comments</h1>
        <div class="underline"></div>
        <br />
        <div class="row flex-row-even">
            <div class="col-6">
                <?php
                $img = str_starts_with($menuitem->img,'public')?substr($menuitem->img,7):$menuitem->img;

                echo '<img class="img-fluid" src="'.$img.'" alt="bugger" width="300" height="600">
                    <h2>'.$menuitem->item_title.'</h2>
                    <p>'.$menuitem->desc.'</p>';
                ?>
            </div>
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Comment</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($comments as $comment) {
                            $key = $comment->primaryKey();
                            $table = $comment->tableName();
                            $author = "";
                            foreach ($users as $user) {
                                if($user->id == $comment->author) {
                                    $author = $user->firstname." ".$user->lastname;
                                }
                            }
                            echo "<tr>
                    <td>$comment->comment</td>
                    <td>$author</td>
                    <td>$comment->date</td>
                        ";
                            echo '<td>
                        <button class="btn bg-warning action-btn" data-target="deleteModalWrapper" data-table="'.$table.'" data-id="'.$comment->$key.'" data-title="'.$author.'">Delete</button>
                    </td>
                </tr>';
                        }

                        ?>
                        <!--        <button class="btn bg-success action-btn" data-target="editModalWrapper" data-table="'.$table.'" data-id="'.$dish->$key.'" data-title="'.$dish->item_title.'">Edit</button>-->
                        </tbody>
                    </table>
                </div>
            </div>
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