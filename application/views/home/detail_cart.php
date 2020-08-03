<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('msg'); ?>


    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Sub-Total</th>
        </tr>
        <?php $no = 1;
        foreach ($this->cart->contents() as $c) : ?>
            <?php $id = $c['id']; ?>

            <tr>
                <td><?= $no++; ?></td>
                <td><?= $c['name']; ?></td>
                <td>
                    <a href="<?= base_url('home/removeItem/') . $c['rowid'] . '/' . $c['qty']; ?>" class="btn btn-sm btn-danger">-</a>
                    <?= $c['qty']; ?>
                    <?php $barang = $this->db->get_where('products', ['id' => $id])->result_array(); ?>
                    <?php foreach ($barang as $b) : ?>
                        / <?= $b['measure']; ?>
                    <?php endforeach; ?>
                    <a href="<?= base_url('home/addItem/') . $c['rowid'] . '/' . $c['qty']; ?>" class="btn btn-sm btn-success">+</a>
                </td>
                <!-- number_format() for make format price to IDR -->
                <td>Rp. <?= number_format($c['price'], 0, ',', '.'); ?></td>
                <td>Rp. <?= number_format($c['subtotal'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="4">Total :</td>
            <td>Rp. <?= number_format($this->cart->total(), 0, ',', '.'); ?></td>
        </tr>
    </table>
    <?php if ($this->cart->contents()) : ?>
        <div align="right">
            <a href="<?= base_url('home'); ?>" class="btn btn-primary">Continue shopping</a>
            <a href="<?= base_url('home/checkOut'); ?>" class="btn btn-success">Checkout</a>
        </div>
    <?php else : ?>
        <div align="right">
            <a href="<?= base_url('home'); ?>" class="btn btn-primary">Continue shopping</a>
        </div>
    <?php endif; ?>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->