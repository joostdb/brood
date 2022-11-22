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
            <?= $this->Html->link(__('Edit Tour'), ['action' => 'edit', $tour->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tour'), ['action' => 'delete', $tour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tour->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tour'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tour'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tour view content">
            <h3><?= h($tour->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tour->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Delivery Id') ?></th>
                    <td><?= $this->Number->format($tour->delivery_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($tour->date) ?></td>
                </tr>
            </table>
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
<?= $totaal['name'] ?> = <?= $totaal['quantity'] ?><br>

                        <?php endforeach; ?>
            <div class="related">
                <h4><?= __('Detail Item Orders') ?></h4>
                <?php if (!empty($tour->itemorders)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Order Session') ?></th>
                            <th><?= __('Tour Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Item') ?></th>
                            <th><?= __('Quantity') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Pay') ?></th>
                            <th><?= __('Review') ?></th>
                            <th><?= __('Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>


                        <?php
                        foreach ($clients as $client) :
                                    foreach ($client->itemorders as $order) :

                                        if($order->quantity > 0){
                                        ?>
                                        <tr>
                                            <td class="h6"><?= $client->name ?></td>
                                            <td><?= $order->id ?></td>
                                            <td><?= $order->order_session ?></td>
                                            <td><?= h($order->tour_id) ?></td>
                                            <td><?= h($order->user_id) ?></td>
                                            <td><?= h($order->item) ?></td>
                                            <td><?= h($order->quantity) ?></td>
                                            <td><?= h($order->price) ?></td>
                                            <td><?= h($order->notes) ?></td>
                                            <td><?= h($order->pay) ?></td>
                                            <td><?= h($order->review) ?></td>
                                            <td><?= h($order->date) ?></td>
                                            <td class="actions">
                                                <?= $this->Html->link(__('View'), ['controller' => 'Itemorders', 'action' => 'view', $order->id]) ?>
                                                <?= $this->Html->link(__('Edit'), ['controller' => 'Itemorders', 'action' => 'edit', $order->id]) ?>
                                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Itemorders', 'action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?>
                                            </td>
                                        </tr>

                                    <?php
                                        }
                                    endforeach;
                                        ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
