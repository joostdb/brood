<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery $delivery
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
use Cake\I18n\FrozenTime;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Delivery'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delivery form content">
            <?= $this->Form->create($delivery) ?>
            <fieldset>
                <legend><?= __('Add Delivery') ?></legend>
                <?php
                    echo $this->Form->control('subject');
                    echo $this->Form->control('text');

                echo $this->Form->control(
                    'items',
                    ['autocomplete' => 'off',
                        'type' => 'select',
                        'multiple' => true,
                        'options' => $items,
                        'empty' => true,
                        'class' => 'form-select mb-4',
                        'label' => __('Items')
                    ]
                );

                    echo $this->Form->control('deadline');
                    echo $this->Form->control('distributiondate', ['empty' => true]);
                $time = FrozenTime::now();
                    echo $this->Form->control('date', ['value' => $time]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
