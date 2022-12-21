<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tour $tour
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <div class="btn-group w-100">
                <?= $this->Html->link(__('Edit Tour'), ['action' => 'edit', $tour->id], ['class' => 'btn btn-secondary']) ?>
                <?= $this->Form->postLink(__('Delete Tour'), ['action' => 'delete', $tour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tour->id), 'class' => 'btn btn-secondary']) ?>
                <?= $this->Html->link(__('List Tour'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
                <?= $this->Html->link(__('New Tour'), ['action' => 'add'], ['class' => 'btn btn-secondary']) ?>
            </div>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tour view content">
            <h3><?= h($tour->id) ?></h3>
            <div class="container">
                <div class="row">
                    <div class="col-4"><?= __('Id') ?></div>
                    <div class="col-8"><?= $this->Number->format($tour->id) ?></div>
                </div>
                <div class="row">
                    <div class="col-4"><?= __('Delivery Id') ?></div>
                    <div class="col-8"><?= $this->Number->format($tour->delivery_id) ?></div>
                </div>
                <div class="row">
                    <div class="col-4"><?= __('Date') ?></div>
                    <div class="col-8"><?= h($tour->date) ?></div>
                </div>
            </div>
            <div class="text">
                <strong><?= __('Text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($tour->text)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Clients') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($tour->clients)); ?>
                </blockquote>
            </div>

            <h4><?= __('Total Orders') ?></h4>
            <?php
            foreach ($totalen as $totaal) :
                ?>
                <ul class="list-group w-50">
                    <li class="list-group-item"><?= $totaal['name'] ?> = <?= $totaal['quantity'] ?></li>
                </ul>
            <?php endforeach; ?>

            <div class="related">

                <h4><?= __('Detail Item Orders') ?></h4>
                <?php if (!empty($tour->itemorders)) : ?>
                <div class="row">
                    <?php
                    foreach ($clients as $client) :
                    foreach ($client->itemorders as $order) :
                    if ($order->quantity > 0) {
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $client->name ?></h5>
                                <p class="card-text">
                                    <strong><?= __('Id') ?>:</strong> <?= $order->id ?><br>
                                    <strong><?= __('Order Session') ?>:</strong> <?= $order->order_session ?><br>
                                    <strong><?= __('Tour Id') ?>:</strong> <?= h($order->tour_id) ?><br>
                                    <strong><?= __('User Id') ?>:</strong> <?= h($order->user_id) ?><br>
                                    <strong><?= __('Item') ?>:</strong> <?= h($order->item) ?><br>
                                    <strong><?= __('Quantity') ?>:</strong> <?= h($order->quantity) ?><br>
                                    <strong><?= __('Price') ?>:</strong> <?= h($order->price) ?><br>
                                    <strong><?= __('Notes') ?>:</strong> <?= h($order->notes) ?><br>
                                    <strong><?= __('Pay') ?>:</strong> <?= h($order->pay) ?><br>
                                    <strong><?= __('Review') ?>:</strong> <?= h($order->review) ?><br>
                                    <strong><?= __('Date') ?>:</strong> <?= h($order->date) ?>
                                </p>

                                <div class="text-center">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Itemorders', 'action' => 'view', $order->id], ['class' => 'btn btn-secondary']) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Itemorders', 'action' => 'edit', $order->id], ['class' => 'btn btn-primary']) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Itemorders', 'action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id), 'class' => 'btn btn-danger']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                    }
                    endforeach;
                        ?>
                    <?php endforeach; ?>
                </div>
                                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
