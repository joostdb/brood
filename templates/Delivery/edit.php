<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery $delivery
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $delivery->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $delivery->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Delivery'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delivery form content">
            <?= $this->Form->create($delivery) ?>
            <fieldset>
                <legend><?= __('Edit Delivery') ?></legend>
                <?php
                    echo $this->Form->control('subject');
                    echo $this->Form->control('text');
                echo $this->Form->control(
                    'items',
                    ['autocomplete' => 'off',
                        'type' => 'select',
                        'multiple' => true,
                        'options' => $itemsext,
                        'empty' => true,
                        'class' => 'form-select mb-4',
                        'label' => __('Items')
                    ]
                );
                ?>

                <div class="custom-control custom-switch">
                    <?= $this->Form->control('pickup', ['type' => 'checkbox', 'class' => 'custom-control-input']) ?>
                </div>

                <?php

                    echo $this->Form->control('deadline');
                    echo $this->Form->control('distributiondate', ['empty' => true]);
                    echo $this->Form->control('date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
