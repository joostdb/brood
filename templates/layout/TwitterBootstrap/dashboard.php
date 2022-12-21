<?php
/**
 * @var \Cake\View\View $this
 */
use Cake\Core\Configure;

$this->Html->css('BootstrapUI.dashboard', ['block' => true]);
$this->prepend(
    'tb_body_attrs',
    ' class="' .
        implode(' ', [h($this->request->getParam('controller')), h($this->request->getParam('action'))]) .
        '" '
);
$this->start('tb_body_start');
?>
<body <?= $this->fetch('tb_body_attrs') ?>>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <?= $this->Html->link(
            Configure::read('App.title'),
            '/',
            ['class' => 'navbar-brand col-md-3 col-lg-2 me-0 px-3']
        ) ?>

        <ul class="navbar-nav list-group list-group-horizontal">

            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>tour/dashboard">home</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>items">Items</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>users">Users</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>clientsaddresses">Adresses</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>delivery">Delivery</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>tour">Tour</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>orders">Orders</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>itemorders">Itemorders</a>
            </li>
            <li class="nav-item p-2">
                <a class="nav-link" href="<?= $baseURL ?>stock">Stock</a>
            </li>
        </ul>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="<?= $baseURL ?>/users/logout">Sign out</a>
            </li>
        </ul>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="">
                <div class="position-sticky pt-3">
                    <?= $this->fetch('tb_sidebar') ?>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
                    <style>
                        .step-text {
                            font-size: 1.25rem;
                        }

                    </style>
                    <div class="container mt-5">
                        <div id="stepper" class="bs-stepper vertical linear">
                            <div class="bs-stepper-header" role="tablist">
                                <div class="step active" data-target="#test-vl-1">
                                    <button type="button" class="step-trigger" role="tab" id="stepperTrigger1" aria-controls="test-vl-1" aria-selected="true">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Users</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-vl-2">112
                                    <button type="button" class="step-trigger" role="tab" id="stepperTrigger2" aria-controls="test-vl-2" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Items</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-vl-3">
                                    <button type="button" class="step-trigger" role="tab" id="stepperTrigger3" aria-controls="test-vl-3" aria-selected="false" disabled="disabled">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Delivery</span>
                                    </button>
                                </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#step4">
                                        <button type="button" class="step-trigger" role="tab" id="stepper-4-trigger" aria-controls="step4" aria-selected="false" disabled="disabled">
                                            <span class="bs-stepper-circle">4</span>
                                            <span class="bs-stepper-label">Tour</span>
                                        </button>
                                    </div>
                                <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#step5">
                                        <button type="button" class="step-trigger" role="tab" id="stepper-5-trigger" aria-controls="step5" aria-selected="false" disabled="disabled">
                                            <span class="bs-stepper-circle">5</span>
                                            <span class="bs-stepper-label">Orders</span>
                                        </button>
                                    </div>
                                    </div>
                                    </div>


                </div>
            </nav>

            <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center
                            pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 page-header"><?= h($this->request->getParam('controller')) ?></h1>
                </div>
<?php
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    if (isset($this->Flash)) {
        echo $this->Flash->render();
    }
    $this->end();
}
$this->end();

$this->start('tb_body_end');
echo '</body>';
$this->end();

echo $this->fetch('content');

$this->append('footer', '</main></div></div>');

?>


