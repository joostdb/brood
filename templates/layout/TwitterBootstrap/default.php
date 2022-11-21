<?php
/**
 * @var \Cake\View\View $this
 */

use Cake\Core\Configure;

/**
 * Default `html` block.
 */
if (!$this->fetch('html')) {
    $this->start('html');
    if (Configure::check('App.language')) {
        printf('<html lang="%s">', Configure::read('App.language'));
    } else {
        echo '<html>';
    }
    $this->end();
}

/**
 * Default `title` block.
 */
if (!$this->fetch('title')) {
    $this->start('title');
    echo Configure::read('App.title');
    $this->end();
}

/**
 * Default `footer` block.
 */
if (!$this->fetch('tb_footer')) {
    $this->start('tb_footer');
    if (Configure::check('App.title')) {
        printf('&copy;%s %s', date('Y'), Configure::read('App.title') . ' & YellowSmile bv');
    } else {
        printf('&copy;%s', date('Y'));
    }
    $this->end();
}

/**
 * Default `body` block.
 */
$this->prepend(
    'tb_body_attrs',
    ' class="' . implode(' ', [h($this->request->getParam('controller')), h($this->request->getParam('action'))]) . '" '
);
if (!$this->fetch('tb_body_start')) {
    $this->start('tb_body_start');
    echo '<body' . $this->fetch('tb_body_attrs') . '>';
    $this->end();
}
/**
 * Default `flash` block.
 */
if (!$this->fetch('tb_flash')) {
    $this->start('tb_flash');
    echo $this->Flash->render();
    $this->end();
}
if (!$this->fetch('tb_body_end')) {
    $this->start('tb_body_end');
    echo '</body>';
    $this->end();
}

/**
 * Prepend `meta` block with `author` and `favicon`.
 */
if (Configure::check('App.author')) {
    $this->prepend(
        'meta',
        $this->Html->meta('author', null, ['name' => 'author', 'content' => Configure::read('App.author')])
    );
}
//$this->prepend('meta', $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']));

/**
 * Prepend `css` block with Bootstrap stylesheets
 * Change to bootstrap.min to use the compressed version
 */
if (Configure::read('debug')) {
    $this->prepend('css', $this->Html->css(['BootstrapUI.bootstrap']));
} else {
    $this->prepend('css', $this->Html->css(['BootstrapUI.bootstrap.min']));
}
$this->prepend(
    'css',
    $this->Html->css(['BootstrapUI./font/bootstrap-icons', 'BootstrapUI./font/bootstrap-icon-sizes'])
);

/**
 * Prepend `script` block with Popper and Bootstrap scripts
 * Change popper.min and bootstrap.min to use the compressed version
 */
if (Configure::read('debug')) {
    $this->prepend('script', $this->Html->script(['BootstrapUI.popper', 'BootstrapUI.bootstrap']));
} else {
    $this->prepend('script', $this->Html->script(['BootstrapUI.popper.min', 'BootstrapUI.bootstrap.min']));
}

?>
<!doctype html>
<?= $this->fetch('html') ?>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= h($this->fetch('title')) ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $baseURL ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $baseURL ?>/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $baseURL ?>/favicon-16x16.png">
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-input-spinner@3.1.13/src/bootstrap-input-spinner.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/dc5e7787b6.js" crossorigin="anonymous"></script>
</head>

<?php
echo $this->fetch('tb_body_start');
echo $this->fetch('tb_flash');
echo $this->fetch('content');
?>
<div class="container sticky-bottom pb-3 bg-white">
    <div class="row text-center">
        <div class="col-12"><hr><?= $this->fetch('tb_footer') ?> </div>
    </div></div>

<?php
echo $this->fetch('script');
echo $this->fetch('tb_body_end');
?>

</html>
