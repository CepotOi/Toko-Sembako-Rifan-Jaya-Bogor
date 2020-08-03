<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- If falifation not valid show errors -->
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>

    <!-- show flashdata after you success logout -->
    <?= $this->session->flashdata('msg'); ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->userdata('role_id') == 1) : ?>
        <a href="" class="btn btn-primary float-left" data-toggle="modal" data-target="#newBarangModal">+ Add Product</a>
    <?php endif; ?>

    <!-- IF USER HASN'T LOGIN -->
    <?php foreach ($barang as $b) : ?>
        <?php if ($this->session->userdata('role_id') == 0) : ?>
            <div class="card float-left mt-5 mr-4 mb-4" style="width: 18rem; height: 40rem;">
                <img src="<?= base_url('assets/img/barang/') . $b['image']; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><b><?= $b['name']; ?></b></h5>
                    <p class="card-text"><?= $b['description']; ?></p>
                    <p class="card-text badge badge-pill badge-success">Rp.<?= number_format($b['price'], 0, ',', '.'); ?></p>
                    <p class="card-text">Stock: <?= $b['quantity']; ?></p>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('auth'); ?>" class="btn btn-primary" onclick="return confirm('Harap login terlebih dahulu')">Add to cart</a>
                </div>
            </div>

            <!-- IF LOGIN AS ADMIN  -->
        <?php elseif ($this->session->userdata('role_id') == 1) : ?>
            <div class="card float-left mt-5 mr-4 mb-4" style="width: 18rem; height: 40rem;">
                <img src="<?= base_url('assets/img/barang/') . $b['image']; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><b><?= $b['name']; ?></b></h5>
                    <p class="card-text"><?= $b['description']; ?></p>
                    <p class="card-text badge badge-pill badge-success">Rp.<?= number_format($b['price'], 0, ',', '.'); ?></p>
                    <p class="card-text">Stock: <?= $b['quantity']; ?></p>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('home/edit/') . $b['id']; ?>" class="btn btn-success">Edit</a>
                    <a href="<?= base_url('home/delete/') . $b['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin?')">Delete</a>
                </div>
            </div>

            <!-- IF LOGIN AS USER -->
        <?php elseif ($this->session->userdata('role_id') == 2) : ?>
            <div class="card float-left mt-4 mr-4 mb-1" style="width: 18rem; height: 40rem;">
                <img src="<?= base_url('assets/img/barang/') . $b['image']; ?>" class="card-img-top">
                <div class="card-body" align="center">
                    <h5 class="card-title"><b><?= $b['name']; ?></b></h5>
                    <p class="card-text"><?= $b['description']; ?></p>
                    <p class="card-text badge badge-pill badge-success">Rp.<?= number_format($b['price'], 0, ',', '.'); ?></p>
                    <p class="card-text">Stock: <?= $b['quantity']; ?></p>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('home/addToCart/') . $b['id']; ?>" class="btn btn-primary">Add to Cart</a>
                    <!-- <?= anchor('home/addToCart/' . $b['id'], '<div class="btn btn-primary">Add to cart</div>'); ?> -->
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- MODAL -->
    <!-- Button trigger modal -->

    <!-- MODAL ADD PRODUCT-->
    <div class="modal fade" id="newBarangModal" tabindex="-1" role="dialog" aria-labelledby="newBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newBarangModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?= form_open_multipart('home'); ?>

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Picture:</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="#" id="img" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="desc" name="desc" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="price" name="price" placeholder="Price Rp.">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="qnty" name="qnty" placeholder="Stock">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->