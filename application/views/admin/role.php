<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-8">

            <!-- If form validation false show Error alert -->
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <!-- If form validation true show Success -->
            <?= $this->session->flashdata('msg'); ?>

            <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#newRoleModal">+ Add New Role</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $r) : ?>

                        <?php if ($r['id'] <= 2) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $r['role']; ?></td>
                                <td>
                                    <!-- This is to configuration role -->
                                    <a href="<?= base_url('admin/roleAccess/') . $r['id']; ?>" class="badge badge-primary">access</a>
                                    <!-- When button edit is press, get id the role you want to edit and send it to method editRole in controller Admin -->
                                    <a href="<?= base_url('admin/editRole/') . $r['id']; ?>" class="badge badge-success">edit</a>
                                </td>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $r['role']; ?></td>
                                <td>
                                    <!-- This is to configuration role -->
                                    <a href="<?= base_url('admin/roleAccess/') . $r['id']; ?>" class="badge badge-primary">access</a>
                                    <!-- When button edit is press, get id the role you want to edit and send it to method editRole in controller Admin -->
                                    <a href="<?= base_url('admin/editRole/') . $r['id']; ?>" class="badge badge-success">edit</a>

                                    <!-- When button delete is press, get name the role you want to delete and send it to method deleteRole in controller Admin -->
                                    <a href="<?= base_url('admin/deleteRole/') . $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure?')">delete</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- MODAL -->
<!-- Button trigger modal -->

<!-- MODAL ADD NEW ROLE-->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="<?= base_url('admin/role'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name...">
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