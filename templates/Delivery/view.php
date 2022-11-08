<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery $delivery
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Delivery'), ['action' => 'edit', $delivery->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Delivery'), ['action' => 'delete', $delivery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $delivery->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Delivery'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Delivery'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delivery view content">
            <h3><?= h($delivery->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Subject') ?></th>
                    <td><?= h($delivery->subject) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($delivery->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deadline') ?></th>
                    <td><?= h($delivery->deadline) ?></td>
                </tr>
                <tr>
                    <th><?= __('Distributiondate') ?></th>
                    <td><?= h($delivery->distributiondate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($delivery->date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($delivery->text)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Items') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($delivery->items)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
