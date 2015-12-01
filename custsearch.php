<?php
$page_title = 'Kundesøk';
require_once('includes/load.php');
// Checking userlevel
page_require_level(3);

include_once('layouts/header.php');

if (isset($_POST['search'])) {
    $results = search_custnr($_POST['custnr']);
}

?>

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Kundesøk</span>
            </strong>
        </div>
        <div class="row">
            <div class="col-md-2">
                <form method="post">
                    <input class="form-control" type="number" min="0" max="10000000" size="8" name="custnr" placeholder="Kundenummer" autocomplete="on" required>
                    <button class="btn btn-danger" name="search" type="submit">Søk</button>
                </form>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th> Produkt</th>
                    <th class="text-center" style="width: 5%;"> Antall</th>
                    <th class="text-center" style="width: 5%;"> Total</th>
                    <th class="text-center" style="width: 5%;"> Dato</th>
                    <th class='text-center' style="width: 5%;"> Bruker</th>
                    <th class="text-center" style="width: 5%;"> Kundenummer</th>
                    <th class="text-center" style="width: 50%;"> Kommentar</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($_POST['custnr'])){ foreach ($results as $result): ?>
                    <tr>
                        <td class="text-center"><?php echo count_id(); ?></td>
                        <td><?php echo remove_junk($result['name']); ?></td>
                        <td class="text-center"><?php echo (int)$result['qty']; ?></td>
                        <td class="text-center"><?php echo remove_junk($result['price']); ?>,-</td>
                        <td class="text-center"><?php echo $result['date']; ?></td>
                        <?php if (get_userlevel() == 1) {
                            echo("<td class='text-center'>{$result['username']}</td> ");
                        } ?>
                        <td class="text-center"><?php echo $result['custnr']; ?></td>
                        <td class="text-center"><?php echo $result['comment']; ?></td>
                    </tr>
                <?php endforeach;} ?>
                </tbody>
            </table>
        </div>
        <div class="row">
        </div>
    </div>
</div>
