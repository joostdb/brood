

    <?php
    foreach ($lastorders as $order):
    ?>
    <div class="row mb-4 pb-4 border-bottom">
    <div class="col-4 border-end"><?= $order['date'] ?></div>
    <div class="col-8">
        <?php
      //  dd($order);
        foreach($order AS $itemorder) {

            $orderitems = json_decode($order->itemorders);
        dd($orderitems);
            foreach ($orderitems as $item) {
?>
        <div class="row">
            <div class="col"><?= $i->name ?></div>
            <div class="col"><?= $item->orderedquantity ?></div>
            <div class="col">€<?= $i->orderedprice ?></div>
        </div>

<?php

            }

        }
        ?>


        <hr>
        <div class="row">
            <div class="col-1"><?php
                if($order['pay'] === 0){
                    echo '<i class="fa-solid fa-comment-dollar"></i>';
                }
                else{
                    echo '<i class="fa-brands fa-gratipay"></i>';
                }
                ?></div>
            <div class="col-11"><?= __('Total: €{0}', $order['price']) ?></div>

        </div>

    </div>
    </div>
<?php
endforeach;
?>


