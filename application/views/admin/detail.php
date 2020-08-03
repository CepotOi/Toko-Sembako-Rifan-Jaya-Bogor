<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('msg'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id_trans</th>
                <th scope="col">Id_product</th>
                <th scope="col">Product_name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($order as $o) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $o['id_trans']; ?></td>
                    <td><?= $o['id_product']; ?></td>
                    <td><?= $o['product_name']; ?></td>
                    <td><?= $o['quantity']; ?></td>
                    <td>Rp. <?= number_format($o['price'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="5">Total :</td>
                <td>Rp. <?= ($trans['total']); ?></td>
            </tr>
        </tbody>
    </table>

    <a href="<?= base_url('admin'); ?>" class="btn btn-primary">Back</a>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->