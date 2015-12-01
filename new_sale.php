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

if (isset($_POST['custnr'])) {
    echo var_dump($_POST['sale']);
    echo "banana";
}

?>
<script type="text/javascript" src="includes/jquery.js"></script>
<script type="text/javascript" src="add_prod.js"></script>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Salg</span>
            </strong>
        </div>
        <div class="panel-body">
            <div id="productButton">
                <?php foreach ($products as $prod): ?>
                    <button name="<?php echo($prod['id']); ?>" class="btn btn-danger"><?php echo $prod['name']; ?></button>
                <?php endforeach; ?>
            </div>
            <form>
            <div class="form-group" style="margin-top: 15px">
                <div class="row">
                    <div class="col-md-2">
                        <div class="input-group">
                                <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                                 </span>
                            <input class="form-control" type="number" min="0" max="10000000" size="8" name="custnr" placeholder="Kundenummer" autocomplete="on" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-group">
                                <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                                 </span>
                            <input type="date" class="form-control datePicker" name="date" data-date data-date-format="yyyy-mm-dd" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-group">
                                <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-info-sign"></i>
                                 </span>
                            <textarea rows="1" class="form-control" type="text" name="comment" placeholder="Kommentar" required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                <th> Produkt</th>
                <th> Pris</th>
                <th> Antall</th>
                <th> Total</th>
                <th></th>
                </thead>

                <tbody id="result">

                </tbody>
                <button type="submit" name="sale" class="btn btn-primary">Add sale</button>
                </form>
            </table>
        </div>
    </div>
</div>