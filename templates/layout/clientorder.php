<nav class="navbar bg-light ">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 mx-auto"><i class="fa-solid fa-bread-slice"></i> brOOdnOdig</span>
    </div>
</nav>
    <main class="main">
        <div class="container mt-4 mb-4">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>

        </div>
    </main>

