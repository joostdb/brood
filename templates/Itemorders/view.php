<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Itemorder $itemorder
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Itemorder'), ['action' => 'edit', $itemorder->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Itemorder'), ['action' => 'delete', $itemorder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemorder->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Itemorders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Itemorder'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="itemorders view content">
            <h3><?= h($itemorder->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $itemorder->has('user') ? $this->Html->link($itemorder->user->name, ['controller' => 'Users', 'action' => 'view', $itemorder->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($itemorder->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Session') ?></th>
                    <td><?= $this->Number->format($itemorder->order_session) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tour Id') ?></th>
                    <td><?= $this->Number->format($itemorder->tour_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Item') ?></th>
                    <td><?= $this->Number->format($itemorder->item) ?></td>
                    <td class="h6"><?= $itemorder->itemdetail->name ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($itemorder->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($itemorder->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pay') ?></th>
                    <td><?= $this->Number->format($itemorder->pay) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($itemorder->date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Notes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($itemorder->notes)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Review') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($itemorder->review)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
