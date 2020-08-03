<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <form method="post" action="">
                <input type="hidden" name="id" value="<?= $menu['id']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" value="<?= $menu['menu']; ?>">
                        <!-- Show error if not according to the rules in this field  -->
                        <?= form_error('menu', '<small class="text-danger pl-3">* ', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('menu'); ?>" type="button" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->