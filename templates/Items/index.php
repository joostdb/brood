<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Item> $items
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
    <div class="items index content">
<?= $this->Html->link(__('New Item'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="display-switch">
        <label class="form-check-label" for="display-switch">Toggle List/Cards</label>
    </div>
    <div class="row" id="card-display">
        <?php foreach ($items as $item): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <?php
                    if($item->photo){
                        ?>
                        <img src="/brood/files/items/photo/<?= $item->photo_dir ?>/<?= $item->photo ?>" class="card-img-top">
                        <?php
                    } else {
                        ?>

                        <?php
                    }
                    ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= h($item->name) ?></h5>
                        <p class="card-text">Quantity: <?= $this->Number->format($item->quantity) ?></p>
                        <p class="card-text">Price: <?= $this->Number->format($item->price) ?></p>
                        <p class="card-text">Weight: <?= $this->Number->format($item->weight) ?></p>
                        <p class="card-text">Deadline: <?= h($item->deadline) ?></p>
                        <p class="card-text">Production Date: <?= h($item->productiondate) ?></p>
                        <p class="card-text">Distribution Date: <?= h($item->distributiondate) ?></p>
                        <div class="text-center">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $item->id], ['class' => 'btn btn-secondary mr-2']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id], ['class' => 'btn btn-primary mr-2']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id), 'class' => 'btn btn-danger']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="table-responsive" id="list-display" style="display:none">
    <table>
    <thead>
<tr>
    <th><?= $this->Paginator->sort('id') ?></th>
    <th><?= $this->Paginator->sort('name') ?></th>
    <th><?= $this->Paginator->sort('quantity') ?></th>
    <th><?= $this->Paginator->sort('price') ?></th>
    <th><?= $this->Paginator->sort('weight') ?></th>
    <th><?= $this->Paginator->sort('photo') ?></th>
    <th><?= $this->Paginator->sort('photo_dir') ?></th>
    <th><?= $this->Paginator->sort('deadline') ?></th>
    <th><?= $this->Paginator->sort('productiondate') ?></th>
    <th><?= $this->Paginator->sort('distributiondate') ?></th>
    <th class="actions"><?= __('Actions') ?></th>
</tr>
    </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $this->Number->format($item->id) ?></td>
                <td><?= h($item->name) ?></td>
                <td><?= $this->Number->format($item->quantity) ?></td>
                <td><?= $this->Number->format($item->price) ?></td>
                <td><?= $this->Number->format($item->weight) ?></td>
                <td><?= h($item->photo) ?></td>
                <td><?= h($item->photo_dir) ?></td>
                <td><?= h($item->deadline) ?></td>
                <td><?= h($item->productiondate) ?></td>
                <td><?= h($item->distributiondate) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $item->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>

    </div>
<script>
    $(function() {
        $('#display-switch').on('change', function() {
            if($(this).is(':checked')) {
                $('#card-display').hide();
                $('#list-display').show();
            } else {
                $('#list-display').hide();
                $('#card-display').show();
            }
        });
    });
</script>
