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
                                <th>visi</th>
                                <th>misi</th>
                                <th>image</th>
                                <th>stts</th>
                                <th>urutan</th>
                                <th>create</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0;
                            foreach ($paslon as $u) :
                                $i++ ?>
                                <tr>
                                    <td class="text-center"><?= $u['nim_presiden']; ?></td>
                                    <td class="text-center"><?= $u['nama_presiden']; ?></td>
                                    <td class="text-center"><?= $u['nim_wakil']; ?></td>
                                    <td class="text-center"><?= $u['nama_wakil']; ?></td>
                                    <td class="text-center"><?= $u['visi']; ?></td>
                                    <td class="text-center"><?= $u['misi']; ?></td>
                                    <td class="text-center">
                                        <img class="ok-download" height="400px" src="<?= base_url() ?>/assets/image/<?= $u['image']; ?>" />
                                    </td>
                                    <?php
                                    if ($u['stts'] == "Di Tolak") {
                                        $color = "background-color: #ff0000";
                                    } elseif ($u['stts'] == "Pemeriksaan File") {
                                        $color = "background-color: #918e89;";
                                    } elseif ($u['stts'] == "DI Terima") {
                                        $color = "background-color: #04ff00;";
                                    } elseif ($u['stts'] == "Uji Kelayakan") {
                                        $color = "background-color: #ff9900;";
                                    } elseif ($u['stts'] == "Panding") {
                                        $color = "background-color: #fcf003;";
                                    } else {
                                        $color = "";
                                    }

                                    ?>
                                    <td class="text-center" style="<?= $color ?>"><?= $u['stts']; ?></td>
                                    <td class=" text-center"><?= $u['urutan']; ?></td>
                                    <td class="text-center"><?= $u['create']; ?></td>

                                    <td class="text-center">
                                        <a href="" class="badge badge-warning m-1" data-toggle="modal" data-target="#modal-xl-image<?= $u['id'] ?>"><i class="fas fa-camera-retro fa-2x"></i></i></a>
                                        <a href="" class="badge badge-warning m-1" data-toggle="modal" data-target="#modal-xl<?= $u['id'] ?>"><i class="fas fa-edit fa-2x"></i></a>
                                        <a href="<?= base_url() ?>/admin/hapus_paslon/<?= $u['id']; ?>" class="badge badge-danger m-1 hapus"><i class="fas fa-trash-alt fa-2x"></i></a>
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

                                            <form action="<?= base_url() ?>/admin/stts_paslon?id=<?= $u['id'] ?>" method="POST" enctype="multipart/form-data">
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
                                                                                    <option style="background-color: #04ff00;">DI Terima</option>
                                                                                    <option style="background-color: #ff0000;">Di Tolak</option>
                                                                                    <option style="background-color: #918e89;">Pemeriksaan File</option>
                                                                                    <option style="background-color: #ff9900;">Uji Kelayakan</option>
                                                                                    <option style="background-color: #fcf003;">Panding</option>
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

                                <!-- modal barang image -->
                                <div class="modal fade" id="modal-xl-image<?= $u['id'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Photo</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="<?= base_url() ?>/admin/upload_image_paslon?id=<?= $u['id'] ?>" method="POST" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card-body">

                                                                            <div class="form-group">
                                                                                <label for="exampleFormControlFile1">Example file input</label>
                                                                                <input type="file" class="form-control-file" id="image" name="image">
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
            <form action="<?= base_url() ?>/admin/daftar_paslon" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Presiden</label>
                                    <select type="text" style="" class="custom-select rounded-0" id="presiden" name="presiden">
                                        <option value="">Pilih</option>
                                        <?php foreach ($user as $u) : ?>
                                            <option value="<?= $u['name']; ?>:<?= $u['nim']; ?>"> Nama : <?= $u['name']; ?> (<?= $u['nim']; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>wakil</label>
                                    <select type="text" style="" class="custom-select rounded-0" id="wakil" name="wakil">
                                        <option value="">Pilih</option>
                                        <?php foreach ($user as $u) : ?>
                                            <option value="<?= $u['name']; ?>:<?= $u['nim']; ?>">Nama : <?= $u['name']; ?> (<?= $u['nim']; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Visi</label>
                                    <div>
                                        <textarea class="summernote" name="visi" id="visi" cols="30" style="width: 100%;"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Misi</label>
                                    <div>
                                        <textarea class="summernote" name="misi" id="misi" cols="30" style="width: 100%;"></textarea>
                                    </div>
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