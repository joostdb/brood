<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tour $tour
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>


<table>
    <tr>
        <th><?= __('Id') ?></th>
        <th><?= __('Name') ?></th>
        <th><?= __('First Name') ?></th>
        <th><?= __('City') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>


    <?php

    use Cake\I18n\FrozenTime;
  //  FrozenTime::setToStringFormat("EEEE, MMMM");
    $date = new FrozenTime($tour->distributiondate);
    $dist = $date->i18nFormat("EEEE dd MMMM");

    foreach ($clients as $client) :

            ?>
            <tr>
                <td><?= $client->id ?></td>
                <td class="h6"><?= $client->name ?></td>
                <td class="h6"><?= $client->first_name ?></td>
                <td><?= @$client->clientsaddress->city ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('invite'), ['controller' => 'Orders', 'action' => 'clientadd', '?' =>['t' => md5($tour->id), 'c' => md5($client->id)]]) ?>
                    <?= $this->Html->link(__('mail'), ['controller' => 'tour', 'action' => 'mailinvitation', '?' =>['t' => md5($tour->id), 'm' => md5($client->id)]]) ?>
                    <?= $this->Html->link(
                        'WhatsApp',
                        'https://wa.me/'. $client->clientsaddress->telephone .'?text=Hallo '. $client->first_name .'%0aOp ' . $dist . ' is er een nieuwe broodronde, via de link hieronder kan je intekenen:%0ahttps://brood.eke.be/brood/orders/clientadd?t='.md5($tour->id).'%26c='.md5($client->id) .' %0aGroeten, Joost',['target'=>'_blank'] ) ?>
     </td>
            </tr>

    <?php endforeach; ?>
</table>
