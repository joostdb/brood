<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
$this->extend('../layout/clientorder');
$this->assign('title', 'Bestelling plaatsen');
?>
<h4><?= __('Hello {0}', $user->first_name) ?></h4>
<?php
use Cake\I18n\FrozenTime;
$date = new FrozenTime($tour->distributiondate);
$minDate = $date->modify('-1 hours');
$plusDate = $date->modify('+1 hours');
?>
<h6>
<?php
if($tour->pickup){
    echo __('Pickup on {0} between {1}h and {2}h', [$minDate->format('d-m-Y'), $minDate->format('H:00'), $plusDate->format('H:00')]);
}else{

    echo__('Expected delivery on {0} between {1}h and {2}h', [$minDate->format('d-m-Y'), $minDate->format('H:00'), $plusDate->format('H:00')]);
}
?>
</h6>


<?php
if(@$order){
?>
<?php

if($delivery->deadline > $now){
    ?>
    <h6><?= __('Alter your order before {0}', $delivery->deadline) ?></h6>
    <?php
}

    ?>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <?php

                        if($delivery->deadline > $now){
                            ?>
                            <div class="col-4 col-md-2 border-end">

                          <?= $this->Form->postLink(__('Delete Order'),[ 'action' => 'clientdelete', md5($order->id)], ['class' => 'btn btn-danger','confirm' => __('Are you sure you want to delete your order?')]) ?>

                            </div>
                        <?php
                        }

                        ?>


                            <div class="col-8">

                                Besteld op: <?= $order->date ?><hr>
                                <?php
                                foreach ($pendingorders as $itemorder) {

                                    echo $itemorder->name . ': ' . $itemorder->orderedquantity . ' (€'. ($itemorder->orderedquantity *  $itemorder->price) .')<br>';

                                }
                                ?>
                                Totaal: €<?= $this->Number->format($order->price) ?>

                            </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

    <?php
}
else
{
if($delivery->deadline > $now){
?>

    <h6><?= __('Order before {0}', $delivery->deadline) ?></h6>
<div class="row">
    <aside class="column pb-4 mb-4 border-bottom">
        <div class="side-nav">

        </div>
    </aside>
    <div class="row">
        <?= $this->Form->create(null) ?>
        <div class="col-12 orders form content">
            <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
            foreach ($delivery['itemlist'] AS $item){
                $cell = $this->cell('Clientitem', [$item, $tour->id]);
                echo $cell;
            }
            ?>
            </div>
            <fieldset class="mt-4">

                <?php
                    echo $this->Form->control('order_session', ['type' => 'hidden', 'value' => $tour->delivery_id]);
                    echo $this->Form->control('tour_id', ['type' => 'hidden', 'value' => $tour->id]);
                    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $user->id]);
                //    echo $this->Form->control('notes');
                    echo   $this->Form->control('pay', ['type' => 'checkbox', 'label' => __('I will pay upon delivery'), 'checked', 'disabled' => true]);
                //echo $this->Form->control('review');

                ?>
            </fieldset>

            <?= $this->Form->button(__('Submit')) ?>

        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<?php

}

else{
    ?>
    <div class="alert alert-warning d-flex align-items-center" role="alert">

        <div>
            <h6><i class="fa-solid fa-bullhorn"></i> <?= __('De deadline om te bestellen was {0}, graag tot een volgende bestelronde.', $delivery->deadline) ?></h6>
        </div>
    </div>

<?php
}

}
?>
<hr>
<div class="row ">
    <div class="col-md-6">
        <div class="card text-bg-light mb-3 ">
            <div class="card-header"><?= __('Order History') ?></div>
            <div class="card-body">
                <p class="card-text">

                    <?php
                    foreach ($lastorders as $order):
                    ?>
                <div class="row mb-4 pb-4 border-bottom">
                    <div class="col-4 border-end"><?= $order['date'] ?></div>
                    <div class="col-8">
                        <?php
                        $orderitems = json_decode($order->itemorders);

                            foreach ($orderitems as $i):

                                ?>
                                <div class="row">
                                    <div class="col d-flex"><?= $orders[$i->item]->name ?></div>
                                    <div class="col-2 d-flex"><?= $i->quantity ?></div>
                                    <div class="col d-flex">€<?= $i->price ?></div>
                                </div>

                                <?php

                            endforeach;

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



                </p>
            </div>
        </div>
    </div>
    <div class="col-6"> </div>
</div>


<div class="start-toast toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="20000" data-bs-autohide="true">
        <div class="toast-header">
            🙂
            <strong class="me-auto"> brOOd nOdig?</strong>

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Hallo! Welkom op de eerste versie van mijn broodronde-app. Ik ga dit stelselmatig aanpassen en (hopelijk) verbeteren tot dat brood bestellen een 'piece of cake' is. Groeten, Joost
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip()
        $("#liveToast").toast('show');
    });

</script>


