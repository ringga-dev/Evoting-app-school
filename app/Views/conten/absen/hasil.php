<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hasil</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url('tamplate/undian'); ?>/css/styles.css" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('tamplate/admin'); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- SweetAlert2 -->
    <script src="<?= base_url('tamplate/admin'); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>

    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg  text-uppercase fixed-top" id="mainNav" style="background-color: #F98404;">
        <div class="container">
            <a class="navbar-brand">E-VOTING</a>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead text-white text-center" style="background-color: #F9B208; height: 90%;">
        <div class="container d-flex align-items-center flex-column">

            <div class="col-lg-12 mb-5 mb-lg-0">
                <div class="card p-3 m-2 text-center col-12" style=" background-color: #99C961;">
                    <div class="form-group">
                        <canvas id="myChart"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-secondary m-0 p-0" style="background-color: #F98404;">
        <div class="container"><small>Copyright &copy; Your Website 2021</small></div>
    </div>


    <!-- Core theme JS-->
    <script type="text/javascript" src="<?= base_url(); ?>/assest/js/jquery.js"></script>
    <script src="<?= base_url(); ?>/assest/js/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            let calon = [];
            let hasil = [];

            $.ajax({
                type: "get",
                url: "<?= base_url('GlobalView/get_voting') ?>",
                dataType: "json",
                success: function(response) {
                    // console.log(response)

                    response.forEach(myFunction)

                    function myFunction(item, index, arr) {
                        calon.push(`${arr[index].nama_presiden} / ${arr[index].nama_presiden}`)
                        hasil.push(arr[index].suara)
                    }

                    new Chart("myChart", {
                        type: "bar",
                        data: {
                            labels: calon,
                            datasets: [{
                                backgroundColor: ["red", "green", "blue", "orange", "brown"],
                                data: hasil
                            }]
                        },
                        options: {

                        }
                    });

                }
            });

        });
    </script>
</body>

</html>