<?= $this->extend('front/layout/main') ?>
<?= $this->section('navbar') ?>
<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li class="active"><a href="#hero">Home</a></li>
        <li><a href="#visimisi">Visi Misi</a></li>
        <li><a href="#pengajar">Pengajar</a></li>
        <li><a href="#kegiatan">kegiatan</a></li>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#footer">Contact</a></li>
        <li> <button onclick="window.location.href='<?= base_url('auth/login/') ?>'" class="btn btn-primary">Login</button></li>


    </ul>
</nav><!-- .nav-menu -->
<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>

<!-- ======= Counts Section ======= -->
<section id="counts" class="counts section-bg">
    <div class="container">

        <div class="row counters">

            <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up"><?= $pengajar['pengajar_id'] ?></span>
                <p>Pengajar</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up"><?= $kelas['kelas_id'] ?></span>
                <p>Kelas</p>
            </div>

            <div class="col-lg-3 col-6 text-center">
                <span data-toggle="counter-up"><?= $santri['santri_id'] ?></span>
                <p>Santri</p>
            </div>

        </div>

    </div>
    <div class="container">
    <canvas id="myChart">
    <style>
    #myChart {
        max-width: 1000px;
        max-height: 400px;
    }
    </style>
    </canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Menyiapkan data untuk grafik
    var data = {
        labels: ['Pengajar', 'Kelas', 'Santri'],
        datasets: [{
            label: 'Jumlah',
            data: [<?= $pengajar['pengajar_id'] ?>,<?= $santri['santri_id'] ?>, <?= $kelas['kelas_id'] ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
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
</section>
<!-- ======= About Section ======= -->
<section id="visimisi" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Visi & Misi</h2>
        </div>

        <div class="row">

            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                <h5>Visi</h5>
                <p class="font-italic">
                    <?= $konfigurasi['visi'] ?>
                </p>
                <h5>Misi</h5>
                <p class="font-italic">
                    <?= $konfigurasi['misi'] ?>
                </p>
            </div>
        </div>

    </div>
</section><!-- End About Section -->


<section id="pengurus" class="trainers">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Pengajar</h2>
        </div>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php
            foreach ($list_pengajar as $data) :
            ?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="member">
                        <div class="member-content">
                            <h4><?= $data['nama'] ?></h4>
                            <span><?= $data['jabatan'] ?></span>
                            <p>
                                <?= $data['alamat'] ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- End Grafik Section -->
<section id="kegiatan" class="courses">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Kegiatan</h2>
        </div>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            <?php
            foreach ($kegiatan as $data) :
            ?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <img src="<?= base_url('img/kegiatan/thumb/' . 'thumb_' . $data['gambar']) ?>" width="100%" class="img-fluid" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                            </div>
                            <h6><?= date_indo($data['tgl_kegiatan']) ?></h6>
                            <h3><a href="<?= base_url('home/detail_kegiatan/' . $data['slug_kegiatan']) ?>"><?= $data['judul_kegiatan'] ?></a></h3>
                            <p> <?= substr(strip_tags($data['isi']), 0, 150) ?>...</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="<?= base_url('img/user/thumb/' . 'thumb_' . $data['foto']) ?>" class="img-fluid" alt="">
                                    <span><?= $data['nama'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Course Item-->
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ======= Events Section ======= -->

<section id="gallery" class="events">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Gallery</h2>
        </div>
        <div class="row">
            <?php
            foreach ($gallery as $data) :
            ?>
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= base_url('img/sampul/thumb/' . 'thumb_' . $data['sampul']) ?>" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?= base_url('home/detail_gallery/' . $data['gallery_id']) ?>"><?= $data['nama_gallery'] ?></a></h5>
                            <p class="font-italic text-center"><?= date_indo($data['tgl_gallery']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section><!-- End Events Section -->


<?= $this->endSection('isi') ?>