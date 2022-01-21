<?= $this->extend('base_ui/ui_tamplate'); ?>
<?= $this->extend('base_ui/base_menu'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-2">
                    <div class="card-header mb-4">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="<?= base_url('AdminControl/produc') ?>" method="POST" class="col-md-12  text-right">
                        <a href="" class="btn btn-info mr-2 center" data-toggle="modal" data-target="#modal-xl"><i class="fas fa-plus-square fa-2x"></i></a>
                    </form>

                    <table id="example2" class="table table-bordered table-hover mt-4">
                        <thead>
                            <tr>
                                <th>Nim</th>
                                <th>Presiden</th>
                                <th>Nim</th>
                                <th>Wakil</th>
                                <th>image</th>
                                <th>stts</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0;
                            foreach ($stts as $u) :
                                $i++ ?>
                                <tr>
                                    <td class="text-center"><?= $u['nim_presiden']; ?></td>
                                    <td class="text-center"><?= $u['nama_presiden']; ?></td>
                                    <td class="text-center"><?= $u['nim_wakil']; ?></td>
                                    <td class="text-center"><?= $u['nama_wakil']; ?></td>
                                    <?php if ($u['stts'] == "true") {
                                        $color = "style='background-color: #04ff00;'";
                                    } else {
                                        $color = "style='background-color: #ff0000;'";
                                    } ?>
                                    <td class="text-center" <?= $color; ?>><?= $u['stts']; ?></td>
                                    <td class="text-center">
                                        <img class="ok-download" height="400px" src="<?= base_url() ?>/assets/image/<?= $u['image']; ?>" />
                                    </td>


                                    <td class="text-center">
                                        <a href="" class="badge badge-warning m-1" data-toggle="modal" data-target="#modal-xl<?= $u['id'] ?>"><i class="fas fa-edit fa-2x"></i></a>
                                        <a href="<?= base_url() ?>/admin/delete_ques_on/<?= $u['id']; ?>" class="badge badge-danger m-1 hapus"><i class="fas fa-trash-alt fa-2x"></i></a>
                                    </td>
                                </tr>
                                <!-- modal barang edit -->
                                <div class="modal fade" id="modal-xl<?= $u['id'] ?>">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Form</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="<?= base_url() ?>/admin/stts_ques?id=<?= $u['id'] ?>" method="POST" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card-body">
                                                                            <div class="form-group">
                                                                                <label for="exampleFormControlSelect1">Status</label>
                                                                                <select class="form-control" id="stts" name="stts">
                                                                                    <option>Pilih</option>
                                                                                    <option style="background-color: #04ff00;">true</option>
                                                                                    <option style="background-color: #ff0000;">false</option>

                                                                                </select>
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
                            <?php endforeach; ?>
                        </tbody>

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
<!-- modal userapp add -->
<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ADD Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- class="was-validated" -->
            <form action="<?= base_url() ?>/admin/add_ques_on" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Presiden</label>
                                    <select type="text" style="" class="custom-select rounded-0" id="id" name="id">
                                        <option value="">Pilih</option>
                                        <?php foreach ($paslon as $u) : ?>
                                            <option value="<?= $u['id']; ?>"><?= $u['nim_presiden']; ?>(<?= $u['nama_presiden']; ?>) : <?= $u['nim_wakil']; ?>(<?= $u['nama_wakil']; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


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
    $(function() {
        // Summernote
        $('.summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
    document.getElementById("myImg").src = "hackanm.gif";
</script>
<?= $this->endSection(); ?>