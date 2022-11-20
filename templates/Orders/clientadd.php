<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
$this->extend('../layout/clientorder');
?>

<h4><?= __('Hello {0}', $user->first_name) ?></h4>
<?php
use Cake\I18n\FrozenTime;
$date = new FrozenTime($tour->distributiondate);
$minDate = $date->modify('-1 hours');
$plusDate = $date->modify('+1 hours');
?>
<h6><?= __('Expected delivery on {0} between {1}h and {2}h', [$minDate->format('d-m-Y'), $minDate->format('H:00'), $plusDate->format('H:00')]) ?></h6>


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
                            <div class="col-2">

                                <?= $this->Form->postLink(__('Delete Order'),['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete your order?')]) ?>

                            </div>
                        <?php
                        }

                        ?>


                            <div class="col-10">

                                Besteld op: <?= $order->date ?><hr>
                                <?php
                                foreach ($orders as $itemorder) {

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
else{
?>
    <h6><?= __('Order before {0}', $delivery->deadline) ?></h6>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <legend><?= __('Add Order') ?></legend>
        </div>
    </aside>
    <div class="row">
        <?= $this->Form->create(null) ?>
        <div class="col-12 orders form content">
            <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php
            foreach ($delivery['itemlist'] AS $item){
                $cell = $this->cell('Clientitem', [$item]);
                echo $cell;
            }
            ?>
            </div>
            <fieldset>

                <?php
                    echo $this->Form->control('order_session', ['type' => 'hidden', 'value' => $tour->delivery_id]);
                    echo $this->Form->control('tour_id', ['type' => 'hidden', 'value' => $tour->id]);
                    echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $user->id]);
                    echo $this->Form->control('notes');
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
?>
