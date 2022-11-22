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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tour->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tour->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Tour'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tour form content">
            <?= $this->Form->create($tour) ?>
            <fieldset>
                <legend><?= __('Edit Tour') ?></legend>
                <?php
                echo $this->Form->control(
                    'delivery_id',
                    ['autocomplete' => 'off',
                        'type' => 'select',
                        'multiple' => false,
                        'options' => $deliveryext,
                        'empty' => true,
                        'class' => 'form-select mb-4',
                        'label' => __('Delivery')
                    ]
                );
                    echo $this->Form->control('text');
                echo $this->Form->control(
                    'clients',
                    ['autocomplete' => 'off',
                        'multiple' => 'checkbox',
                        'options' => $clientsext,
                        'empty' => true,
                        'class' => 'mb-4',
                        'label' => __('Clients')
                    ]
                );
                echo $this->Form->control('volume', ['default' => '100']);
                echo $this->Form->control('pickup', ['type' => 'checkbox', 'class' => 'custom-control-input']);
                    echo $this->Form->control('distributiondate', ['empty' => true]);
                    echo $this->Form->control('date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
