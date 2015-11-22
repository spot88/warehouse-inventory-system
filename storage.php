<?php
$page_title = 'Lagerstatus';
require_once('includes/load.php');
include_once('layouts/header.php');

// Checking userlevel
page_require_level(2);

//Show only own sales, unless userlevel is admin
if (get_userlevel() == 1) {
    $is_admin = true;
} else {
    $is_admin = false;
}

$storageStatus = storage_status();

?>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Lagerstatus</span>
                    </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 20%">Produkt</th>
                            <th class="text-center" style="width: 20%">Hovedlager</th>
                            <th class="text-center" style="width: 20%">KS-lager</th>
                            <th class="text-center"><a class="btn btn-primary" href="">KS-lager</a></th>
                            <?php if($is_admin) { echo "<th class=\"text-center\"><a class=\"btn btn-primary\" href=\"\">Hovedlager</a></th>"; } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($storageStatus as $storage): ?>
                            <tr class="text-center">
                                <td><?php echo first_character($storage['name']); ?></td>
                                <td><?php echo ($storage['ks_storage']); ?> stk</td>
                                <td><?php echo ($storage['quantity']); ?> stk</td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include_once('layouts/footer.php'); ?>