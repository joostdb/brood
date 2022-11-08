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
        </div>
    </div>
</div>
