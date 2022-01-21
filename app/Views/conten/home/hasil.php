<?= $this->extend('base_ui/ui_tamplate'); ?>
<?= $this->extend('base_ui/base_menu'); ?>
<?= $this->section('content'); ?>

<style>
    .chart-wrap {
        margin-left: 50px;
        font-family: sans-serif;
        width: 80%;
    }

    .chart-wrap .title {
        font-weight: bold;
        font-size: 1.62em;
        padding: 0.5em 0 1.8em 0;
        text-align: center;
        white-space: nowrap;
    }

    .chart-wrap .grid {
        position: relative;
        padding: 5px 0 5px 0;
        height: 100%;
        width: 100%;
        border-left: 2px solid #aaa;
        background: repeating-linear-gradient(90deg, transparent, transparent 19.5%, rgba(170, 170, 170, 0.7) 20%);
    }

    .chart-wrap .grid::before {
        font-size: 0.8em;
        font-weight: bold;
        content: '0%';
        position: absolute;
        left: -0.5em;
        top: -1.5em;
    }

    .chart-wrap .grid::after {
        font-size: 0.8em;
        font-weight: bold;
        content: '100%';
        position: absolute;
        right: -1.5em;
        top: -1.5em;
    }

    .chart-wrap .bar {
        width: var(--bar-value);
        height: 50px;
        margin: 30px 0;
        background-color: #F16335;
        border-radius: 0 3px 3px 0;
    }

    .chart-wrap .bar:hover {
        opacity: 0.7;
    }

    .chart-wrap .bar::after {
        content: attr(data-name);
        margin-left: 100%;
        padding: 10px;
        display: inline-block;
        white-space: nowrap;
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-2">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <h2 class="title mb-5">Bar Chart HTML Example: Using Only HTML And CSS</h2>
                        <div class="chart-wrap vertical">
                            <div class="grid">
                                <div class="bar" style="--bar-value:85%;" data-name="Your Blog 85%" title="Your Blog : 85%"></div>
                                <div class="bar" style="--bar-value:23%;" data-name="Medium 23%" title="Medium 23%"></div>
                                <div class="bar" style="--bar-value:7%;" data-name="Tumblr 7%" title="Tumblr 7%"></div>
                                <div class="bar" style="--bar-value:38%;" data-name="Facebook 38%" title="Facebook 38%"></div>
                                <script>
                                    $('.bar').on('click', function(e) {
                                        e.preventDefault();
                                        const url = $(this).attr('href');

                                        Swal.fire({
                                            title: this.dataset.name,
                                            text: this.dataset.name,
                                            icon: 'succes',
                                            showCancelButton: true,
                                            cancelButtonColor: '#d33',
                                        })
                                    })
                                </script>
                            </div>
                        </div>
                    </div>

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


<?= $this->endSection(); ?>