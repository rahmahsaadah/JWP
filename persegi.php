<?php
    include 'koneksi.php'; //memanggil file koneksi_basisdata.php untuk menghubungkan basis data
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Menghitung Luas</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Start Bootstrap</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                </li>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#!">Settings</a>
                    <a class="dropdown-item" href="#!">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Beranda
                            </a>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="segitiga.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Segitiga
                            </a>
                            <a class="nav-link" href="persegi.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Persegi
                            </a>
                            <a class="nav-link" href="lingkaran.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Lingkaran
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Hitung Luas Persegi</h1>
                        <div class="card mb-4">
                        <div class="card-header">
                        <form method="post" action="">
                            <div class="row mt-1">  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5><label class="small mb-1" for="">Sisi</label></h5>
                                    <input class="form-control py-4" name="sisi" id="" type="number" placeholder="Masukkan Sisi Persegi" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="simpan" class="btn btn-info">
                                    Hitung
                                </button>
                                <input type="button" value="Refresh" class="btn btn-info" onclick="window.location.href='persegi.php'"/>
                            </div>
                            </div>
                        </form>
                        <?php 
                                        if (isset($_POST['simpan'])){ //melakukan pengecekan klik tombol simpan atau tidak
                                            $sisi = $_POST['sisi']; // menyimpan masukan nilai alas segitiga ke dalam variabel

                                            $tanggal = date('Y-m-d'); //menyimpan tanggal saat ini pada variabel tanggal
                                            $jam = date('h:i:s'); // menyimpan waktu (timestamp) pada variabel jam
                                        

                                        //fungsi untuk menghitung luas segitiga
                                        function luas_persegi($sisi) { //nama function serat menangkap nilai pada kedua variabel yaitu pada nilai alas dan tinggi
                                            $luas = ($sisi * $sisi);//rumus luas persegi yaitu sisi dikali sisi
                                            return $luas; //mengembalikan nilai perhitungan luas
                                        }

                                        //menyimpan perhitungan luas segitiga pada file TXT
                                        $file = fopen("luas_persegi.txt","w");

                                            fwrite($file, //proses penulisan pada file txt
                                            '=============================================================================
                                                            HASIL PERHITUNGAN LUAS PERSEGI ANDA
                                            ==============================================================================
                                            Tanggal Perhitungan     : '. $tanggal.' 
                                            Jam Perhitungan         : '. $jam. ' 
                                            Nilai Alas Segitiga     : '. $sisi. ' 
                                            Rumus Luas Segitiga     : Sisi x Sisi
                                                                    '. $sisi. ' x '. $sisi. '
                                            Luas Segitiga           : '. luas_persegi($sisi));
                                            fclose($file);

                                            $querypilihpersegi = mysqli_query($koneksi, "SELECT * FROM bangun_datar WHERE bangun_datar='persegi'") or die(mysqli_connect_error()); //query menampilkan bangun_ruang: persegi
                                            $data = mysqli_fetch_array($querypilihpersegi); //variable data berisikan mysqli array
                                            $persegi = $data['jumlah']; //mengambil data jumlah 
                                            $qty = $persegi + 1; //data jumlah+1 pada qty
    
                                            mysqli_query($koneksi, "UPDATE bangun_datar SET jumlah='$qty' WHERE bangun_datar='persegi'") or die(mysqli_connect_error()); //query update qty
                                        ?>
                        </div>

                            <div class="card-body">
                            <div class="card-header">Hasil Perhitungan</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2" name="luas"><?php echo luas_persegi($sisi)?></h3> <!-- Hasil Perhitungan Luas Persegi-->
                                        </div>
                                        <hr>
                                    </div>
                                <?php } ?>
                            </div>
                                
                            </div>
                        </div>
                    </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
