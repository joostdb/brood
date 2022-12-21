<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->extend('../layout/clientorder');
$this->assign('title', 'Gegevens');
?>
<div class="row">
    <aside class="column">

    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>

                <div class="row">
                    <div class="form-group col-md-6">
                        <?php
                        echo $this->Form->control('name', ['label' =>  __('Name'),'class' => 'form-control']);
                        ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php
                        echo $this->Form->control('first_name', ['label' =>  __('First Name'), 'class' => 'form-control']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <?php
                        echo $this->Form->control('email', ['label' =>  __('Email'),'class' => 'form-control']);
                        ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php
                        echo $this->Form->control('telephone', ['value' => $user->clientsaddress->telephone, 'label' =>  __('Telephone'), 'class' => 'form-control']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6 col-md-3">
                        <?php
                        echo $this->Form->control('street', ['value'=> $user->clientsaddress->street, 'label' =>  __('Street'),'class' => 'form-control']);
                        ?>
                    </div>
                    <div class="form-group col-6 col-md-3">
                        <?php
                        echo $this->Form->control('number', ['value'=> $user->clientsaddress->number, 'label' =>  __('Number'),'class' => 'form-control']);
                        ?>
                    </div>
                    <div class="form-group col-6 col-md-3">
                        <?php
                        echo $this->Form->control('zip', ['value'=> $user->clientsaddress->zip, 'label' =>  __('Zip'),'class' => 'form-control']);
                        ?>
                    </div>
                    <div class="form-group col-6 col-md-3">
                        <?php
                        echo $this->Form->control('city', ['value'=> $user->clientsaddress->city, 'label' =>  __('City'),'class' => 'form-control']);
                        ?>
                    </div>
                </div>
            </fieldset>
            <?= $this->Form->hidden('t',['value' => $this->request->getQuery('t')]) ?>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
