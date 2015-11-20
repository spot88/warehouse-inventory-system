<?php
$page_title = 'Add Sale';
require_once('includes/load.php');
// Checking userlevel
page_require_level(3);


if (isset($_POST['add_sale'])) {
    $req_fields = array('s_id', 'quantity', 'price', 'total', 'date');
    validate_fields($req_fields);
    if (empty($errors)) {
        $p_id = $db->escape((int)$_POST['s_id']);
        $s_qty = $db->escape((int)$_POST['quantity']);
        $s_total = $db->escape($_POST['total']);
        $date = $db->escape($_POST['date']);
        $custnr = $db->escape($_POST['custnr']);
        $comment = $db->escape($_POST['comment']);
        $s_date = make_date();
        $s_userID = $_SESSION['user_id'];

        $sql = "INSERT INTO sales (";
        $sql .= " product_id, qty, price, date, custnr, comment, FK_userID";
        $sql .= ") VALUES (";
        $sql .= "'{$p_id}', '{$s_qty}', '{$s_total}', '{$s_date}', '{$custnr}', '{$comment}','$s_userID'";
        $sql .= ")";

        if ($db->query($sql)) {
            update_product_qty($s_qty, $p_id);
            $session->msg('s', "Sale added. ");
            redirect('add_sale.php', false);
        } else {
            $session->msg('d', ' Sorry failed to add!');
            redirect('add_sale.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_sale.php', false);
    }
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-6">
        <?php echo display_msg($msg); ?>
        <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
            <div class="form-group">
                <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Find It</button>
            </span>
                    <input type="text" id="sug_input" class="form-control" name="title" placeholder="Search for product name" autofocus>
                </div>
                <div id="result" class="list-group"></div>
            </div>
        </form>
    </div>
</div>
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Salg</span>
                </strong>
            </div>
            <div class="panel-body">
                <form method="post" action="add_sale.php">
                    <table class="table table-bordered">
                        <thead>
                        <th> Produkt</th>
                        <th> Pris</th>
                        <th> Antall</th>
                        <th> Total</th>
                        <th> Dato</th>
                        <th> Kundenummer</th>
                        <th> Kommentar</th>
                        <th> </th>
                        </thead>
                        <tbody id="product_info"></tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include_once('layouts/footer.php'); ?>
