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
    <ul class="list-group">
        <?php foreach ($stock as $stock): ?>
            <li class="list-group-item bg-light">
                <?= __('User') ?>: <?= $stock->has('user') ? $this->Html->link($stock->user->name, ['controller' => 'Users', 'action' => 'view', $stock->user->id]) : '' ?><br>
                <?= __('Ordered') ?>: <?= h($stock->quantity) ?> <span class="badge badge-primary"><?= __('Item') ?>: <?= $stock->has('item') ? $this->Html->link($stock->item->name, ['controller' => 'Items', 'action' => 'view', $stock->item->id]) : '' ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
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
