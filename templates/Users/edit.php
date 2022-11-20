<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                <?php
                echo $this->Form->control('email');
                echo $this->Form->control('password');
                echo $this->Form->control('name');
                echo $this->Form->control('first_name');

                echo $this->Form->control('street');
                echo $this->Form->control('number');
                echo $this->Form->control('zip');
                echo $this->Form->control('city');
                echo $this->Form->control('description');
                echo $this->Form->control('telephone');

                echo $this->Form->control('photo');
                echo $this->Form->control('photo_dir');
                echo $this->Form->control('user_type');
                echo $this->Form->control('contract');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
