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
            foreach ($trans as $t) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $t['name']; ?></td>
                    <td><?= $t['email']; ?></td>
                    <td><?= $t['phone']; ?></td>
                    <td><?= $t['address']; ?></td>
                    <td><?= $t['date_order']; ?></td>
                    <td><?= $t['payment_deadline']; ?></td>
                    <td><?= $t['payment_method']; ?></td>
                    <td><?= $t['total']; ?></td>
                    <td>
                        <?php if ($t['status'] == 0) : ?>
                            <span class="badge badge-danger">Belum bayar</span>
                        <?php else : ?>
                            <span class="badge badge-success">Sudah bayar</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($t['status'] == 0) : ?>
                            <button class="badge badge-primary" onclick="alert('BCA - XXXXXXXXXX a/n Cepot Segera lakukan pembayaran')">Bayar</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->