<?php $j = 1;
$produk = $this->cart->contents();
foreach ($produk as $p) : ?>
    <div class="card mb-3 float-left mb-3 mr-3" style="width: 18rem;">
        <div class="form-group">
            <div class="card-header">
                <label for="barang">Products <?= $j++; ?></label>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <input type="text" readonly class="form-control" name="barang" id="barang" value="<?= $p['name']; ?>">
                </li>
            </ul>
        </div>
        <div class="form-group">
            <label for="qty">Quantity :</label>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <input type="text" readonly class="form-control" name="qty" id="qty" value="<?= $p['qty']; ?>">
                </li>
            </ul>
        </div>
        <div class="form-group">
            <label for="harga">Price :</label>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Rp. <input type="text" readonly class="form-control" name="harga" id="harga" value="<?= number_format($p['price'], 0, ',', '.'); ?>">
                </li>
            </ul>
        </div>
        <div class="form-group">
            <label for="subtotal">Sub-Total :</label>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    Rp. <input type="text" readonly class="form-control" name="subtotal" id="subtotal" value="<?= number_format($p['subtotal'], 0, ',', '.'); ?>">
                </li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>