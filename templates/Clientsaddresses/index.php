<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Clientsaddress> $clientsaddresses
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="clientsaddresses index content">
    <?= $this->Html->link(__('New Clientsaddress'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Clientsaddresses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('street') ?></th>
                    <th><?= $this->Paginator->sort('number') ?></th>
                    <th><?= $this->Paginator->sort('zip') ?></th>
                    <th><?= $this->Paginator->sort('city') ?></th>
                    <th><?= $this->Paginator->sort('telephone') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientsaddresses as $clientsaddress): ?>
                <tr>
                    <td><?= $this->Number->format($clientsaddress->id) ?></td>
                    <td><?= $clientsaddress->has('user') ? $this->Html->link($clientsaddress->user->name, ['controller' => 'Users', 'action' => 'view', $clientsaddress->user->id]) : '' ?></td>
                    <td><?= h($clientsaddress->street) ?></td>
                    <td><?= h($clientsaddress->number) ?></td>
                    <td><?= h($clientsaddress->zip) ?></td>
                    <td><?= h($clientsaddress->city) ?></td>
                    <td><?= h($clientsaddress->telephone) ?></td>
                    <td><?= h($clientsaddress->email) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $clientsaddress->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $clientsaddress->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $clientsaddress->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsaddress->id)]) ?>
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
