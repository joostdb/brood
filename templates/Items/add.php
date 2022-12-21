<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="items form content">
            <?= $this->Form->create($item, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Item') ?></legend>
                <?php
                use Cake\I18n\FrozenTime;
                FrozenTime::setToStringFormat("d/m/Y 00:0:00");
                $dist = FrozenTime::now();
                $date = FrozenTime::createFromTimestamp(time());
                $dead = $date->modify('+1 week');


                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('ingredients');
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('price');
                    echo $this->Form->control('weight');
                    echo $this->Form->control('photo', ['type' => 'file', 'class' => 'form-control']);
                    echo $this->Form->control('deadline', ['value' => $dead]);
                    echo $this->Form->control('productiondate', ['empty' => true, 'value' => $dist]);
                    echo $this->Form->control('distributiondate', ['empty' => true, 'value' => $dist]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
