<?php
/**
 * @var $menuitem Menu
 */

use app\models\Menu;

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
                    </div>
                    <div class="col-6">
                        <h2>'.$menuitem->item_title.'</h2>
                        <p>'.$menuitem->desc.'</p>
                    </div>';
            ?>
    </div>
</main>
