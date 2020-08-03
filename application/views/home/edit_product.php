<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart(); ?>

            <div class="form-group row">
                <input type="hidden" name="id" value="<?= $barang['id']; ?>">
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $barang['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">* ', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="desc" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="desc" name="desc"><?= $barang['description']; ?></textarea>
                    <?= form_error('desc', '<small class="text-danger pl-3">* ', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    Rp.<input type="number" class="form-control" id="price" name="price" value="<?= $barang['price']; ?>">
                    <?= form_error('price', '<small class="text-danger pl-3">* ', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="qnty" class="col-sm-2 col-form-label">Stock</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="qnty" name="qnty" value="<?= $barang['quantity']; ?>">
                    <?= form_error('qnty', '<small class="text-danger pl-3">* ', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/barang/') . $barang['image']; ?>" class="img-thumbnail">
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
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->