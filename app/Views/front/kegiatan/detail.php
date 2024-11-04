<?= $this->extend('front/layout/main') ?>
<?= $this->section('navbar') ?>
<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="<?= base_url() ?>">Home</a></li>
        <li><a href="<?= base_url() ?>#visimisi">Visi Misi</a></li>
        <li><a href="<?= base_url() ?>#pengurus">pengurus</a></li>
        <li class="active"><a href="<?= base_url() ?>#kegiatan">kegiatan</a></li>
        <li><a href="<?= base_url() ?>#gallery">Gallery</a></li>
        <li><a href="<?= base_url() ?>#footer">Contact</a></li>



    </ul>
</nav><!-- .nav-menu -->
<?= $this->endSection('navbar') ?>
<?= $this->section('isi') ?>
<!-- ======= Cource Details Section ======= -->
<section id="course-details" class="course-details">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-8">
                <img src="<?= base_url('img/kegiatan/' . $kegiatan->gambar) ?>" width="100%" class="img-fluid" alt="">
                <h3><?= $kegiatan->judul_kegiatan ?></h3>
                <p>
                    <?= $kegiatan->isi ?>
                </p>
            </div>
            <div class="col-lg-4">
            <div class="course-info d-flex justify-content-between align-items-center">
</div>
                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5>Tanggal</h5>
                    <p><a href="#"> <?= date_indo($kegiatan->tgl_kegiatan) ?></a></p>
                </div>

                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5>Kategori</h5>
                    <p> <?= $kegiatan->nama_kategori ?></p>
                </div>

                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5>Post By</h5>
                    <p> <?= $kegiatan->nama ?></p>
                </div>
                

                <div class="text-center">
                    <h5>Bagikan kegiatan</h5>
                    <a href="http://www.facebook.com/sharer.php?u=<?= base_url('home/detail_kegiatan/' . $kegiatan->slug_kegiatan) ?>" target="_blank" class="btn btn-primary"><i class="mdi mdi-facebook"></i> Facebook</a>
                    <a href="http://twitter.com/share?url=<?= base_url('home/detail_kegiatan/' . $kegiatan->slug_kegiatan) ?>" target="_blank" class="btn btn-info"><i class="mdi mdi-twitter"></i> Twitter</a>
                    <a href="whatsapp://send?text=<?= base_url('home/detail_kegiatan/' . $kegiatan->slug_kegiatan) ?>" target="_blank" data-action="share/whatsapp/share" class="btn btn-success"><i class="mdi mdi-whatsapp"></i> Whatsapp</a>
                </div>
            </div>
        </div>

    </div>
</section><!-- End Cource Details Section -->
</section><!-- End Cource Details Tabs Section -->
<?= $this->endSection('isi') ?>