<?php
$page_title = 'Registrer salg';
require_once('includes/load.php');
// Checking userlevel
page_require_level(3);

include_once('layouts/header.php');

if (get_userlevel() == 1) {
    $isAdmin = true;
} else {
    $isAdmin = false;
}

$prod_id = get_last_product_id();


if ($isAdmin) {
    $products = get_products_from_categories();
    $categories = find_all('categories');
} else {
    $categories = get_categories_user();
    $products = get_products_user();
}


?>
<script type="text/javascript" src="add_prod.js"></script>
<script type="text/javascript" src="includes/jquery.js"></script>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Salg</span>
            </strong>
        </div>
        <div class="panel-body">
            <form method="post" action="">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                                 </span>
                                <input class="form-control" type="number" min="0" max="10000000" size="8" name="custnr" placeholder="Kundenummer" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                                 </span>
                                <input class="form-control" type="text" name="comment" placeholder="Kommentar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form method="post" action="ajax.php">
                        <?php foreach ($products as $prod): ?>
                            <button id="#sug-form" type="submit" name="<?php echo($prod['id']); ?>" class="btn btn-danger"><?php echo $prod['name']; ?></button>
                        <?php endforeach; ?>
                    </form>
                </div>
        </div>
    </div>
</div>