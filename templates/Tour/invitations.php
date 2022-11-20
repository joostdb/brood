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
    foreach ($clients as $client) :

            ?>
            <tr>
                <td><?= $client->id ?></td>
                <td class="h6"><?= $client->name ?></td>
                <td class="h6"><?= $client->first_name ?></td>
                <td><?= @$client->clientsaddress->city ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('invite'), ['controller' => 'Orders', 'action' => 'clientadd', '?' =>['t' => md5($tour->id), 'c' => md5($client->id)]]) ?>
     </td>
            </tr>

    <?php endforeach; ?>
</table>
