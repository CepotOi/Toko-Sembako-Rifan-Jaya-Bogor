<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <form method="post" action="">
                <input type="hidden" name="id" value="<?= $subMenu['id']; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <h6 class="form-text text-muted">Submenu Title</h6>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $subMenu['title']; ?>">
                        <!-- Show error if not according to the rules in this field  -->
                        <?= form_error('title', '<small class="text-danger pl-3">* ', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <h6 class="form-text text-muted">Submenu Menu_id</h6>
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <?php if ($m['id'] == $subMenu['menu_id']) : ?>
                                    <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <!-- Show error if not according to the rules in this field  -->
                        <?= form_error('menu_id', '<small class="text-danger pl-3">* ', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <h6 class="form-text text-muted">Submenu URL</h6>
                        <input type="text" class="form-control" id="url" name="url" value="<?= $subMenu['url']; ?>">
                        <!-- Show error if not according to the rules in this field  -->
                        <?= form_error('url', '<small class="text-danger pl-3">* ', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <h6 class="form-text text-muted">Submenu Icon</h6>
                        <input type="text" class="form-control" id="icon" name="icon" value="<?= $subMenu['icon']; ?>">
                        <!-- Show error if not according to the rules in this field  -->
                        <?= form_error('icon', '<small class="text-danger pl-3">* ', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('menu/subMenu'); ?>" type="button" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->