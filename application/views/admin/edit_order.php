<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('msg'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col-lg-6">

        <form method="post" action="">
            <div class="form-group">
                <label for="id">Id transactions</label>
                <input type="text" readonly class="form-control" name="id" id="id" value="<?= $order['id']; ?>">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="custom-select" name="status" id="status">
                    <?php foreach ($status as $s) : ?>
                        <?php if ($s == $order['status']) : ?>
                            <option value="<?= $s; ?>" selected><?= $s; ?></option>
                        <?php else : ?>
                            <option value="<?= $s; ?>"><?= $s; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <a href="<?= base_url('admin'); ?>" class="btn btn-primary mr-2">Back</a>
            <button type="submit" class="btn btn-success">Edit</button>
        </form>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->