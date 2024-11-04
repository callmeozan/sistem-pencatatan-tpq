<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title">Dashboard</h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <div id="clock"></div>
    </ol>
</div>
<script type="text/javascript">
    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        if (curr_hour < 12) {
            a_p = "AM";
        } else {
            a_p = "PM";
        }
        if (curr_hour == 0) {
            curr_hour = 12;
        }
        if (curr_hour > 12) {
            curr_hour = curr_hour - 12;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
        document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);
</script>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <i class="mdi mdi-account-multiple-outline"></i>
    <?php if (session()->get('level') == 1) { ?>
        <strong>Selamat datang!</strong> Anda login sebagai author.
    <?php } ?>
    <?php if (session()->get('level') == 2) { ?>
        <strong>Selamat datang!</strong> Anda login sebagai admin.
    <?php } ?>
</div>
<div class="row">
    <?php if (session()->get('level') == 2) { ?>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-account-star-outline bg-primary  text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">pengajar</h5>
                    </div>
                    <h3 class="mt-4"><?= $pengajar['pengajar_id'] ?></h3>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-account-badge-horizontal bg-secondary text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Santri</h5>
                    </div>
                    <h3 class="mt-4"><?= $santri['santri_id'] ?></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-menu-open bg-info text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Kelas</h5>
                    </div>
                    <h3 class="mt-4"><?= $kelas['kelas_id'] ?></h3>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-folder-image bg-danger text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Gallery</h5>
                </div>
                <h3 class="mt-4"><?= $gallery['gallery_id'] ?></h3>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-newspaper bg-warning text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Kegiatan</h5>
                </div>
                <h3 class="mt-4"><?= $kegiatan['kegiatan_id'] ?></h3>
            </div>
        </div>
    </div>
<!-- Tempat lain dalam bagian isi Anda -->
<div class="row">
    <!-- Bagian untuk Grafik -->
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sertakan library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
    <div class="col-12">
        <canvas id="myChart">
        <style>
    #myChart {
        max-width: 1000px;
        max-height: 400px;
    }
</style>
        </canvas>
    </div>
    <!-- Sisanya dari kode Anda -->
</div>

<script>
    // Menyiapkan data untuk grafik
    var data = {
        labels: ['Pengajar','Santri', 'Kelas', 'Gallery', 'Kegiatan'],
        datasets: [{
            label: 'Jumlah',
            data: [<?= $pengajar['pengajar_id'] ?>, <?= $santri['santri_id'] ?>, <?= $kelas['kelas_id'] ?>, <?= $gallery['gallery_id'] ?>, <?= $kegiatan['kegiatan_id'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(199, 199, 199, 0.2)',
                'rgba(83, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(159, 159, 159, 1)',
                'rgba(83, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Inisialisasi grafik
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?= $this->endSection('isi') ?>