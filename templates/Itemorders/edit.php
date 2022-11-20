<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Itemorder $itemorder
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $itemorder->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $itemorder->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Itemorders'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="itemorders form content">
            <?= $this->Form->create($itemorder) ?>
            <fieldset>
                <legend><?= __('Edit Itemorder') ?></legend>
                <?php
                    echo $this->Form->control('order_session');
                    echo $this->Form->control('tour_id');
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('item');
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('price');
                    echo $this->Form->control('notes');
                    echo $this->Form->control('pay');
                    echo $this->Form->control('review');
                    echo $this->Form->control('date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
