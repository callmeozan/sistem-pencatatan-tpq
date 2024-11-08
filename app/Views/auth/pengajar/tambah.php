<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pengajar/simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="invalid-feedback errorNama">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select name="jekel" id="jekel" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorPerempuan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir">
                        <div class="invalid-feedback errorTmp_lahir">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                        <div class="invalid-feedback errorTgl_lahir">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nik Pengajar</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nik_ustadz" name="nik_ustadz">
                        <div class="invalid-feedback errorSkp">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="alamat" name="alamat">
                        <div class="invalid-feedback errorAlamat">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Pendidikan</label>
                    <div class="col-sm-8">
                        <select name="pendidikan" id="pendidikan" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="DIII">DIII</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>

                        </select>
                        <div class="invalid-feedback errorPendidikan">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tahun Masuk Tugas</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk">
                        <div class="invalid-feedback errorSkp">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jabatan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                        <div class="invalid-feedback errorJabatan">

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                        <select name="keterangan" id="keterangan" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="Baru">Baru</option>
                            <option value="Lama">Lama</option>
                        </select>
                        <div class="invalid-feedback errorPerempuan">
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
        $('.formtambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    nama: $('input#nama').val(),
                    jekel: $('select#jekel').val(),
                    tmp_lahir: $('input#tmp_lahir').val(),
                    tgl_lahir: $('input#tgl_lahir').val(),
                    nik_ustadz: $('input#nik_ustadz').val(),
                    alamat: $('input#alamat').val(),
                    pendidikan: $('select#pendidikan').val(),
                    tahun_masuk: $('input#tahun_masuk').val(),
                    jabatan: $('input#jabatan').val(),
                },
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
                            $('#nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }
                        if (response.error.jekel) {
                            $('#jekel').addClass('is-invalid');
                            $('.errorJekel').html(response.error.jekel);
                        } else {
                            $('#jekel').removeClass('is-invalid');
                            $('.errorJekel').html('');
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
                        if (response.error.nik_ustadz) {
                            $('#nik_ustadz').addClass('is-invalid');
                            $('.errorNik_ustadz').html(response.error.nik_ustadz);
                        } else {
                            $('#nik_ustadz').removeClass('is-invalid');
                            $('.errorNik_ustadz').html('');
                        }

                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('.errorAlamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('.errorAlamat').html('');
                        }

                        if (response.error.pendidikan) {
                            $('#pendidikan').addClass('is-invalid');
                            $('.errorPendidikan').html(response.error.pendidikan);
                        } else {
                            $('#pendidikan').removeClass('is-invalid');
                            $('.errorPendidikan').html('');
                        }
                        if (response.error.tahun_masuk) {
                            $('#tahun_masuk').addClass('is-invalid');
                            $('.errorTahun_masuk').html(response.error.tahun_masuk);
                        } else {
                            $('#tahun_masuk').removeClass('is-invalid');
                            $('.errorTahun_masuk').html('');
                        }

                        if (response.error.jabatan) {
                            $('#jabatan').addClass('is-invalid');
                            $('.errorJabatan').html(response.error.jabatan);
                        } else {
                            $('#jabatan').removeClass('is-invalid');
                            $('.errorJabatan').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaltambah').modal('hide');
                        listpengajar();
                    }
                }
            });
        })
    });
</script>