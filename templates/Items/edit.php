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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $item->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $item->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="items form content">
            <?= $this->Form->create($item, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Item') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('ingredients');
                    echo $this->Form->control('quantity');
                    echo $this->Form->control('price');
                    echo $this->Form->control('weight');
                    if($item->photo){
                        echo $this->Html->image('/files/items/photo/' . $item->photo_dir .'/mobile_' . $item->photo, ['alt' => $item->name]);
                        echo   $this->Form->control('del_photo', ['type' => 'checkbox', 'label' => __('delete photo')]);
                        echo   $this->Form->control('photo', ['type' => 'hidden']);
                        echo   $this->Form->control('photo_dir', ['type' => 'hidden']);
                    }
                    else{
                        echo $this->Form->control('photo', ['type' => 'file', 'class' => 'form-control']);
                    }

                    echo $this->Form->control('deadline');
                    echo $this->Form->control('productiondate', ['empty' => true]);
                    echo $this->Form->control('distributiondate', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
