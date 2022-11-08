<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tour> $tour
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="tour index content">
    <?= $this->Html->link(__('New Tour'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tour') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tour as $tour): ?>
                <tr>
                    <td><?= $this->Number->format($tour->id) ?></td>
                    <td><?= h($tour->date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tour->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tour->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tour->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tour->id)]) ?>
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
