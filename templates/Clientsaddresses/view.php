<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clientsaddress $clientsaddress
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Clientsaddress'), ['action' => 'edit', $clientsaddress->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Clientsaddress'), ['action' => 'delete', $clientsaddress->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientsaddress->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Clientsaddresses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Clientsaddress'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clientsaddresses view content">
            <h3><?= h($clientsaddress->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $clientsaddress->has('user') ? $this->Html->link($clientsaddress->user->name, ['controller' => 'Users', 'action' => 'view', $clientsaddress->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Street') ?></th>
                    <td><?= h($clientsaddress->street) ?></td>
                </tr>
                <tr>
                    <th><?= __('Number') ?></th>
                    <td><?= h($clientsaddress->number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zip') ?></th>
                    <td><?= h($clientsaddress->zip) ?></td>
                </tr>
                <tr>
                    <th><?= __('City') ?></th>
                    <td><?= h($clientsaddress->city) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telephone') ?></th>
                    <td><?= h($clientsaddress->telephone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($clientsaddress->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($clientsaddress->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($clientsaddress->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
