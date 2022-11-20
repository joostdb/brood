<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tour $tour
 */
$this->extend('../layout/TwitterBootstrap/dashboard');
?>
<?php
if (@$delivery){
    ?>

    <div class="container">
        <div class="row">
            <div class="col-2 h6 border-end"> <?= $delivery['text'] ?><br> <?= $delivery['deadline'] ?><br> <?= $delivery['distributiondate'] ?><br></div>
            <div class="col-10"><?php
                foreach ($totalen as $totaal) :
                    ?>
                    <?= $totaal['name'] ?> = <?= $totaal['quantity'] ?><br>

                <?php endforeach; ?></div>
        </div>
    </div>

<?php
}
?>



