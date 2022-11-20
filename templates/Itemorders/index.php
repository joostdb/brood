<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Itemorder> $itemorders
 */
$this->extend('../layout/TwitterBootstrap/dashboard');

?>
<div class="itemorders index content">
    <?= $this->Html->link(__('New Itemorder'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Itemorders') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_session') ?></th>
                    <th><?= $this->Paginator->sort('tour_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('item') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('pay') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($itemorders as $itemorder): ?>
                <tr>
                    <td><?= $this->Number->format($itemorder->id) ?></td>
                    <td><?= $this->Number->format($itemorder->order_session) ?></td>
                    <td><?= $this->Number->format($itemorder->tour_id) ?></td>
                    <td><?= $itemorder->has('user') ? $this->Html->link($itemorder->user->name, ['controller' => 'Users', 'action' => 'view', $itemorder->user->id]) : '' ?></td>
                    <td><?= $this->Number->format($itemorder->item) ?></td>
                    <td><?= $this->Number->format($itemorder->quantity) ?></td>
                    <td><?= $this->Number->format($itemorder->price) ?></td>
                    <td><?= $this->Number->format($itemorder->pay) ?></td>
                    <td><?= h($itemorder->date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $itemorder->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemorder->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemorder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemorder->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

