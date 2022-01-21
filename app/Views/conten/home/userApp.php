<?= $this->extend('base_ui/ui_tamplate'); ?>
<?= $this->extend('base_ui/base_menu'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <a href="" class="badge badge-warning m-1" data-toggle="modal" data-target="#modal-xl-image"><i class="fas fa-camera-retro fa-2x"></i></i></a>
                        </div>
                    </div>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Nim</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Prodi</th>
                                <th>Image</th>
                                <th>Created_by</th>
                                <th>Login Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0;
                            foreach ($user as $u) :
                                $i++ ?>
                                <tr>
                                    <td class="text-center"><?= $u['name']; ?></td>
                                    <td class="text-center"><?= $u['nim']; ?></td>
                                    <td class="text-center"><?= $u['email']; ?></td>
                                    <td class="text-center"><?= $u['no_phone']; ?></td>
                                    <td class="text-center"><?= $u['prodi']; ?></td>
                                    <td class="text-center"><?= $u['image']; ?></td>
                                    <td class="text-center"><?= $u['created_by']; ?></td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" <?= cek_blok_userApp($u['id']) ?> onclick="userApp(<?= $u['id'] ?>)">
                                            </label>
                                        </div>
                                    </td>

                                    <td class="text-center">

                                        <a href="<?= base_url() ?>/admin/deleteUserApp/<?= $u['id']; ?>" class="badge badge-danger m-1 hapus"><i class="fas fa-trash-alt fa-2x"></i></a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Bet</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Devisi</th>
                                <th>Image</th>
                                <th>Created_by</th>
                                <th>Login Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<!-- modal barang image -->
<div class="modal fade bd-example-modal-lg" id="modal-xl-image">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengumuman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url() ?>/admin/upload_pengumuman" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="harga">title</label>
                                                <div>
                                                    <textarea class="summernote" name="title" id="title" cols="30" style="width: 100%;"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga">dec</label>
                                                <div>
                                                    <textarea class="summernote" name="dec" id="dec" cols="30" style="width: 100%;"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Example file input</label>
                                                <input type="file" class="form-control-file" id="pdf" name="pdf">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.col (RIGHT) -->
                            </div>
                        </div>

                    </div>
                    <!-- /.col (RIGHT) -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>


        </div>


    </div>
</div>


<script>
    function userApp(id) {

        // console.log(nik)
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>/admin/blok_akses_userapp",
            data: {
                'id': id,
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.stts == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Proses Berhasil...!',
                        text: `${response.msg}, Have a nice day...!`
                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Proses Berhasil...!',
                        text: `${response.msg}, Have a nice day...!`
                    })
                }
            },
            error: function(xhr, opsi, errors) {
                console.log(xhr.status + "\n" + xhr.responseText + "\n" + errors);
            }
        });
    }
</script>

<script>
    $.ajax({
        type: "post",
        url: "<?= base_url('globalview/devisi') ?>",
        dataType: "json",
        success: function(response) {
            console.log(response)
            response.forEach(function(data) {
                $('.devisi').append(`<option value="${data.privilege_name}">
                                   ${data.privilege_name}
                                  </option>`);
            })

        }
    });
</script>

<?= $this->endSection(); ?>