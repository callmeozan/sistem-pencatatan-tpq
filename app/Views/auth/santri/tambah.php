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
            <?= form_open('santri/simpan', ['class' => 'formtambah']) ?>
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
                    <label for="" class="col-sm-4 col-form-label">NISM</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nism" name="nism">
                        <div class="invalid-feedback errorNis">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NISN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nisn" name="nisn">
                        <div class="invalid-feedback errorNis">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tahun Masuk</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk">
                        <div class="invalid-feedback errorNama">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">NIK</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nik" name="nik">
                        <div class="invalid-feedback errorNis">

                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Kelas</label>
                    <div class="col-sm-8">
                        <select name="kelas_id" id="kelas_id" class="js-example-basic-single">
                            <option Disabled=true Selected=true> </option>
                            <?php foreach ($kelas as $key => $data) { ?>
                                <option value="<?= $data['kelas_id'] ?>"><?= $data['nama_kelas'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorKelas">

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
                    <label for="" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select name="jenkel" id="jenkel" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorJenkel">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Anak Ke</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="anake" name="anake">
                        <div class="invalid-feedback errorNis">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jumlah Saudara</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="jml_saudara" name="jml_saudara">
                        <div class="invalid-feedback errorNama">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nama Ibu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                        <div class="invalid-feedback errorNama">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                        <select name="jenkel" id="jenkel" class="form-control">
                            <option Disabled=true Selected=true>Pilih</option>
                            <option value="Baru">Baru</option>
                            <option value="Lama">Lama</option>
                            <option value="Lulus">Lulus</option>
                        </select>
                        <div class="invalid-feedback errorJenkel">
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
        $('.formtambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    nama: $('input#nama').val(),
                    nism: $('input#nism').val(),
                    nisn: $('input#nisn').val(),
                    tahun_masuk: $('input#tahun_masuk').val(),
                    nik: $('input#nik').val(),
                    kelas_id: $('select#kelas_id').val(),
                    tmp_lahir: $('input#tmp_lahir').val(),
                    tgl_lahir: $('input#tgl_lahir').val(),
                    jenkel: $('select#jenkel').val(),
                    anake: $('input#anake').val(),
                    jml_saudara: $('input#jml_saudara').val(),
                    nama_ibu: $('input#nama_ibu').val(),
                    keterangan: $('select#keterangan').val(),
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
                        $('#modaltambah').modal('hide');
                        listsantri();
                    }
                }
            });
        })
    });
</script>