<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clientsaddress $clientsaddress
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Clientsaddresses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clientsaddresses form content">
            <?= $this->Form->create($clientsaddress) ?>
            <fieldset>
                <legend><?= __('Add Clientsaddress') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('street');
                    echo $this->Form->control('number');
                    echo $this->Form->control('zip');
                    echo $this->Form->control('city');
                    echo $this->Form->control('description');
                    echo $this->Form->control('telephone');
                    echo $this->Form->control('email');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
