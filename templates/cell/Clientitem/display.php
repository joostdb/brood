<div class="col">
<div class="card">
    <img src="/brood/files/items/photo/<?= $item->photo_dir ?>/<?= $item->photo ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"><?= h($item->name) ?></h5>
        <p class="card-text"><?= $this->Text->autoParagraph(h($item->description)); ?></p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">€ <?= $this->Number->format($item->price) ?></li>
        <li class="list-group-item"><?= $this->Number->format($item->weight) ?>gr</li>
        <li class="list-group-item"><?= $this->Text->autoParagraph(h($item->ingredients)); ?></li>
    </ul>
    <div class="card-body">
        <?= $item->quantity ?><BR><?= $item->stocktotaal ?><BR>
        <?php $availablestock = $item->quantity - $item->stocktotaal; ?>
        <?= $this->Form->control('item['.$item->id.']',['type' => 'hidden', 'value' => $item->id]) ?>
        <?= $this->Form->control('quantity['.$item->id.']',['id' => 'quantity['.$item->id.']', 'type' => 'number', 'class' => 'tap', 'label' => __('Quantity'), 'value' => '0', 'onchange' => 'calculateTotal'.$item->id.'()', 'max' => $availablestock, 'min' => '0', 'required']) ?>
        <?= $this->Form->control('price['.$item->id.']',['id' => 'price['.$item->id.']', 'label' => __('Price'), 'value' => '0', 'disabled' => true]) ?>

    </div>
</div>
</div>

<script>
    function calculateTotal<?= $item->id ?>() {
        var basisprijs = <?= $this->Number->format($item->price) ?>;
        var aantal = document.getElementById('quantity[<?= $item->id ?>]').value;

        var divobj = document.getElementById('price[<?= $item->id ?>]');
        divobj.value = basisprijs * aantal;
        divobj.innerHTML = basisprijs * aantal;
    }

</script>
