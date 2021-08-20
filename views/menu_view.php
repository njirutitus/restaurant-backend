<?php
/**
 * @var $menuitem Menu
 * @var $comments
 * @var $users User
 */

use app\models\Menu;
use app\models\User;
use tn\phpmvc\Application;

?>
<?php
$this->title = "Menu";
?>

<!-- Menu Items -->
<main class="container">
    <h1>Menu Item Details</h1>

    <div class="underline"></div>
    <br />

    <div class="row">
        <div class="col-6">
            <?php
            $img = str_starts_with($menuitem->img,'public')?substr($menuitem->img,7):$menuitem->img;

            echo '<img class="img-fluid" src="'.$img.'" alt="bugger" width="300" height="600">
            <h2>'.$menuitem->item_title.'</h2>
            <p>'.$menuitem->desc.'</p>
        </div>';
            ?>
        <div class="col-6">
            <h2>Comments</h2>
            <ul class="list-unstyled">
                <div class="scrollableList">
                <?php
                    foreach ($comments as $comment) {
                        $author = "";
                        foreach ($users as $user) {
                            if($user->id == $comment->author) {
                                $author = $user->firstname." ".$user->lastname;
                            }
                        }
                        echo "
                        <li>
                            <p>$comment->comment</p>
                            <p>--$author $comment->date</p>
                        </li>
                        ";
                    }
                ?>
                </div>

                <li>
                    <form action="" id="commentForm">
                        <input type="hidden" name="menu" value="<?php echo $menuitem->id?>">
                        <input type="hidden" name="author" value="<?php echo Application::$app->user->id ?? ""?>">
                        <div class="mb3">
                            <textarea class="form-control col-6" name="comment" id="comment" cols="10" rows="5"></textarea>
                        </div>
                        <input class="btn bg-primary" type="submit" value="Comment">
                    </form>
                </li>
            </ul>
        </div>
    </div>
</main>
