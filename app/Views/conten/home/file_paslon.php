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
                            foreach ($paslon as $u) :
                                $i++ ?>
                                <tr>
                                    <td class="text-center"><?= $u['nim_presiden']; ?></td>
                                    <td class="text-center"><?= $u['nama_presiden']; ?></td>
                                    <td class="text-center"><?= $u['nim_wakil']; ?></td>
                                    <td class="text-center"><?= $u['nama_wakil']; ?></td>
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
                                    <td class="text-center">
                                        <a href="" class="badge badge-warning m-1" data-toggle="modal" data-target="#modal-xl<?= $u['id'] ?>"><i class="fas fa-edit fa-2x"></i></a>
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

                                            <div class="col-12">
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h4 class="card-title">File User</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row text-center">
                                                            <?php foreach ($u['imagefile'] as $im) : ?>
                                                                <div class="col-lg-4 mb-5 bg-warning">
                                                                    <a href="<?= base_url("assets/file") ?>/<?= $im['file_name']; ?>?text=<?= $im['id']; ?>" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                                                                        <img src="<?= base_url("assets/file") ?>/<?= $im['file_name']; ?>?text=<?= $im['id']; ?>" class="img-fluid mb-2" alt="red sample">
                                                                        <a href="<?= base_url() ?>/admin/delete_image_paslon/<?= $im['id']; ?>" class="badge badge-danger m-1 hapus"><i class="fas fa-trash-alt fa-2x"></i></a>
                                                                    </a>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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