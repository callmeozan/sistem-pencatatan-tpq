<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('santri/update', ['class' => 'formsantri']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
            <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" value="<?= $nama ?>" name="nama">
                        <div class="invalid-feedback errorNama">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="santri_id" value="<?= $santri_id ?>" name="santri_id" readonly>
                    <label for="" class="col-sm-4 col-form-label">NISM</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nism" value="<?= $nism ?>" name="nism" readonly>
                        <div class="invalid-feedback errorNism">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="santri_id" value="<?= $santri_id ?>" name="santri_id" readonly>
                    <label for="" class="col-sm-4 col-form-label">NISN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nisn" value="<?= $nisn ?>" name="nisn" readonly>
                        <div class="invalid-feedback errorNisn">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tahun Masuk</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tahun_masuk" value="<?= $nama ?>" name="tahun_masuk">
                        <div class="invalid-feedback errorNama">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="santri_id" value="<?= $santri_id ?>" name="santri_id" readonly>
                    <label for="" class="col-sm-4 col-form-label">NIK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nik" value="<?= $nik ?>" name="nik" readonly>
                        <div class="invalid-feedback errorNik">

                        </div>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Kelas</label>
                    <div class="col-sm-8">
                        <select name="kelas_id" id="kelas_id" class="js-example-basic-single">
                            <?php foreach ($kelas as $key => $data) { ?>
                                <option value="<?= $data['kelas_id'] ?>" <?php if ($data['kelas_id'] == $kelas_id) echo "selected"; ?>><?= $data['nama_kelas'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorKelas">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tmp_lahir" value="<?= $tmp_lahir ?>" name="tmp_lahir">
                        <div class="invalid-feedback errorTmp_lahir">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_lahir" value="<?= $tgl_lahir ?>" name="tgl_lahir">
                        <div class="invalid-feedback errorTgl_lahir">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select name="jenkel" id="jenkel" class="form-control">
                            <option value="Laki-Laki" <?php if ($jenkel == 'Laki-Laki') echo "selected"; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php if ($jenkel == 'Perempuan') echo "selected"; ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorJenkel">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="santri_id" value="<?= $santri_id ?>" name="santri_id" readonly>
                    <label for="" class="col-sm-4 col-form-label">Anak Ke</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="anake" value="<?= $anake ?>" name="anake" readonly>
                        <div class="invalid-feedback errorAnake">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jumlah Saudara</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jml_saudara" value="<?= $nama ?>" name="jml_saudara">
                        <div class="invalid-feedback errorNama">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Ibu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_ibu" value="<?= $nama ?>" name="nama_ibu">
                        <div class="invalid-feedback errorNama">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                        <select name="keterangan" id="keterangan" class="form-control">
                            <option value="Baru" <?php if ($jenkel == 'Baru') echo "selected"; ?>>Baru</option>
                            <option value="Lama" <?php if ($jenkel == 'Lama') echo "selected"; ?>>Lama</option>
                            <option value="Lulus" <?php if ($jenkel == 'Lulus') echo "selected"; ?>>Lulus</option>
                        </select>
                        <div class="invalid-feedback errorKeterangan">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });
        $('.formsantri').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nama) {
                            $('#nism').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }
                        if (response.error.nism) {
                            $('#nism').addClass('is-invalid');
                            $('.errorNism').html(response.error.nism);
                        } else {
                            $('#nism').removeClass('is-invalid');
                            $('.errorNism').html('');
                        }
                        if (response.error.nisn) {
                            $('#nisn').addClass('is-invalid');
                            $('.errorNisn').html(response.error.nisn);
                        } else {
                            $('#nisn').removeClass('is-invalid');
                            $('.errorNisn').html('');
                        }
                        if (response.error.tahun_masuk) {
                            $('#tahun_masuk').addClass('is-invalid');
                            $('.errorTahun_masuk').html(response.error.tahun_masuk);
                        } else {
                            $('#tahun_masuk').removeClass('is-invalid');
                            $('.errorTahun_masuk').html('');
                        }
                        if (response.error.nik) {
                            $('#nik').addClass('is-invalid');
                            $('.errorNik').html(response.error.nik);
                        } else {
                            $('#nik').removeClass('is-invalid');
                            $('.errorNik').html('');
                        }
                        if (response.error.kelas_id) {
                            $('#kelas_id').addClass('is-invalid');
                            $('.errorKelas').html(response.error.kelas_id);
                        } else {
                            $('#kelas_id').removeClass('is-invalid');
                            $('.errorKelas').html('');
                        }
                        if (response.error.tmp_lahir) {
                            $('#tmp_lahir').addClass('is-invalid');
                            $('.errorTmp_lahir').html(response.error.tmp_lahir);
                        } else {
                            $('#tmp_lahir').removeClass('is-invalid');
                            $('.errorTmp_lahir').html('');
                        }

                        if (response.error.tgl_lahir) {
                            $('#tgl_lahir').addClass('is-invalid');
                            $('.errorTgl_lahir').html(response.error.tgl_lahir);
                        } else {
                            $('#tgl_lahir').removeClass('is-invalid');
                            $('.errorTgl_lahir').html('');
                        }

                        if (response.error.jenkel) {
                            $('#jenkel').addClass('is-invalid');
                            $('.errorJenkel').html(response.error.jenkel);
                        } else {
                            $('#jenkel').removeClass('is-invalid');
                            $('.errorJenkel').html('');
                        }
                        if (response.error.anake) {
                            $('#anake').addClass('is-invalid');
                            $('.errorAnake').html(response.error.anake);
                        } else {
                            $('#anake').removeClass('is-invalid');
                            $('.errorAnake').html('');
                        }
                        if (response.error.jml_saudara) {
                            $('#jml_saudara').addClass('is-invalid');
                            $('.errorJml_saudara').html(response.error.jml_saudara);
                        } else {
                            $('#jml_saudara').removeClass('is-invalid');
                            $('.errorJml_saudara').html('');
                        }
                        if (response.error.nama_ibu) {
                            $('#nama_ibu').addClass('is-invalid');
                            $('.errorNama_ibu').html(response.error.nama_ibu);
                        } else {
                            $('#nama_ibu').removeClass('is-invalid');
                            $('.errorNama_ibu').html('');
                        }
                        if (response.error.keterangan) {
                            $('#keterangan').addClass('is-invalid');
                            $('.errorKeterangan').html(response.error.keterangan);
                        } else {
                            $('#keterangan').removeClass('is-invalid');
                            $('.errorKeterangan').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaledit').modal('hide');
                        listsantri();
                    }
                }
            });
        })
    });
</script>