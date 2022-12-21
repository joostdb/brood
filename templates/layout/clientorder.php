<nav class="navbar bg-light ">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1 mx-auto"><i class="fa-solid fa-bread-slice"></i> brOOdnOdig</span>
        <span class="d-flex"><?= $this->Html->link('<i class="fas fa-user-astronaut"></i>', '/users/profile/'.md5($user->id).'?t='.$this->request->getQuery('t'), ['escape' => false, 'class' => 'btn btn-dark ']) ?>

        </span>

    </div>
</nav>
    <main class="main">
        <div class="container mt-4 mb-4">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>

        </div>
    </main>

<!-- Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" data-bs-async-target>
                <!-- Modal content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#profileModal').on('bs.modal.show', function(e) {
            var $modal = $(this);
            var $link = $(e.relatedTarget);
            var url = $link.data('bs-url');
            if (url) {
                $modal.find('[data-bs-async-target]').load(url);
            }
        });
    });
</script>
