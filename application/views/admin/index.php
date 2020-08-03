<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('msg'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Date Order</th>
                <th scope="col">Payment Deadline</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($order as $o) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $o['name']; ?></td>
                    <td><?= $o['email']; ?></td>
                    <td><?= $o['phone']; ?></td>
                    <td><?= $o['address']; ?></td>
                    <td><?= $o['date_order']; ?></td>
                    <td><?= $o['payment_deadline']; ?></td>
                    <td><?= $o['payment_method']; ?></td>
                    <td><?= $o['total']; ?></td>
                    <td>
                        <?php if ($o['status'] == 0) : ?>
                            <span class="badge badge-danger">Belum bayar</span>
                        <?php else : ?>
                            <span class="badge badge-success">Sudah bayar</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/edit/') . $o['id']; ?>" class="btn btn-success mb-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('admin/detail/') . $o['id']; ?>" class="btn btn-primary mb-2">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <a href="<?= base_url('admin/delete/') . $o['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->