<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('msg'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php
            $i = 1;
            if ($cart = $this->cart->contents()) : ?>
                <h1>
                    <span class="badge badge-success mb-5">
                        Total Shopping: Rp. <?= number_format($this->cart->total(), 0, ',', '.'); ?>
                    </span>
                </h1>
                <?php foreach ($cart as $c) : ?>
                    <?php $id = $c['id']; ?>
                    <?php $barang = $this->db->get_where('products', ['id' => $id])->result_array(); ?>
                    <?php foreach ($barang as $b) : ?>
                        <div class="card float-left mr-3 mb-5" style="width: 18rem; height: 16rem;">
                            <div class="card-header">Items: <?= $i++; ?></div>
                            <div class="card-body">
                                <h5 class="card-title"><b><?= $c['name']; ?></b></h5>
                                <p><?= $b['description']; ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('home/removeItem2/') . $c['rowid'] . '/' . $c['qty']; ?>" class="btn btn-sm btn-danger">-</a>
                                Quantity: <?= $c['qty']; ?>
                                <?= $b['measure']; ?>
                                <a href="<?= base_url('home/addItem2/') . $c['rowid'] . '/' . $c['qty']; ?>" class="btn btn-sm btn-success">+</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="col-lg float-left">
                <form method="post" action="">
                    <div class="col-lg-6">
                        <div class=" form-group">
                            <label for="name">Name</label>
                            <input type="text" readonly class="form-control" name="name" id="name" value="<?= $user['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" readonly class="form-control" name="email" id="email" value="<?= $user['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="<?= set_value('phone'); ?>">
                            <?= form_error('phone', '<small class="text-danger pl-3">* ', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="4"></textarea>
                            <?= form_error('address', '<small class="text-danger pl-3">* ', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input class="form-control" readonly name="total" id="total" value="<?= number_format($this->cart->total(), 0, ',', '.'); ?>">
                        </div>
                        <div class=" form-group">
                            <label for="bank">Payment Method</label>
                            <select class="form-control" name="bank" id="bank">
                                <option>BCA</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-4">Pay</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->