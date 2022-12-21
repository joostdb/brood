<div class="col">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
        }
    </style>

    <div class="card shadow ">
        <div class="card-img-top"
             style="background-image: url('/brood/files/items/photo/<?= $item->photo_dir ?>/<?= $item->photo ?>');">
        </div>

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
            <?php
            $availablestock = $item->quantity - $item->stocktotaal;

            $availablestock = ($availablestock /100) * $item->tour->volume; // beschikbaar volume per afnemer

            ?>
            <?= $this->Form->control('item['.$item->id.']', ['type' => 'hidden', 'value' => $item->id]) ?>
            <div class="row">
                <div class="col-6 border-end">
                <?= $this->Form->control('quantity['.$item->id.']',['id' => 'quantity['.$item->id.']', 'type' => 'number', 'class' => 'tap', 'label' => __('Quantity'), 'value' => '0', 'onchange' => 'calculateTotal'.$item->id.'()', 'max' => ceil($availablestock), 'min' => '0',
                    'tooltip' => 'Tooltip text', 'templates' => [
                    'tooltip' => '<span data-toggle="tooltip" data-placement="bottom" data-html="true" title="' . __('Nog {0} over.', ceil($availablestock)) .'"><i class="fa-regular fa-circle-question"></i></span>',
                ],'required']) ?>
            </div>
            <div class="col-6">
                <?= $this->Form->control('price['.$item->id.']',['id' => 'price['.$item->id.']', 'label' => __('Price'), 'value' => '0', 'disabled' => true]) ?>
            </div>
        </div>



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
