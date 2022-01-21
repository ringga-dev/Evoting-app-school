<?= $this->extend('base_ui/ui_auth'); ?>
<?= $this->section('auth'); ?>

<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="" class="h1"><b>E-Voting </b>: Register</a>
    </div>
    <div class="card-body">

        <form action="<?= base_url('auth/regiter_api') ?>" method="post">
            <form action="<?= base_url('auth/user_auth?stts=register') ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="name" name="name" id="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-signature"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="nim" name="nim" id="nim">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-signature"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="email" name="email" id="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="phone" name="no_phone" id="no_phone">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="prodi" name="prodi" id="prodi">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <p class="mb-0">
                <a href="<?= base_url('auth/'); ?>" class="text-center">login</a>
            </p>
    </div>
    <!-- /.card-body -->
</div>

<?= $this->endSection(); ?>