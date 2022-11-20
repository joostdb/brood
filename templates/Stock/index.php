<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Stock> $stock
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="stock index content">
    <?= $this->Html->link(__('New Stock'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Stock') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('item_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('quantity') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stock as $stock): ?>
                <tr>
                    <td><?= $this->Number->format($stock->id) ?></td>
                    <td><?= $stock->has('item') ? $this->Html->link($stock->item->name, ['controller' => 'Items', 'action' => 'view', $stock->item->id]) : '' ?></td>
                    <td><?= $stock->has('user') ? $this->Html->link($stock->user->name, ['controller' => 'Users', 'action' => 'view', $stock->user->id]) : '' ?></td>
                    <td><?= h($stock->quantity) ?></td>
                    <td><?= h($stock->date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $stock->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $stock->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $stock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stock->id)]) ?>
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
