<!-- Modal -->
<div class="modal fade" id="modaldaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('kegiatan/daftarkegiatan', ['class' => 'formdaftar']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="kegiatan_id" value="<?= $kegiatan_id ?>"
                        name="kegiatan_id" readonly>
                    <label>Kegiatan yang didaftar</label>
                    <input type="text" class="form-control" id="judul_kegiatan" value="<?= $judul_kegiatan ?>"
                        name="judul_kegiatan" readonly>
                    <div class="invalid-feedback errorJudul">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                        value="<?= session()->get('nama') ?>" readonly>
                    <div class="invalid-feedback errorNamaLengkap">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nomor HP</label>
                    <input type="number" class="form-control" id="no_hp" name="no_hp">
                    <div class="invalid-feedback errorNoHp">
                    </div>
                </div>

                <div class="form-group">
                    <label>Kelompok</label>
                    <select name="kelompok" id="kelompok" class="form-control">
                        <option value="">Jenis Kelompok
                        </option>
                        <option value="Alumni">Alumni
                        </option>
                        <option value="Santri Aktif">Santi Aktif</option>
                    </select>
                    <div class="invalid-feedback errorKelompok">
                    </div>
                </div>


                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option value="">Pilih Jenis Kelamin
                        </option>
                        <option value="Laki-laki">Laki-laki
                        </option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="invalid-feedback errorJenisKelamin">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i>
                    Simpan</button>
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
    $('textarea#isi').summernote({
        height: 250,
        minHeight: null,
        maxHeight: null,
        focus: true
    });
    $('.formdaftar').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: {
                kegiatan_id: $('input#kegiatan_id').val(),
                user_id: user_id,
                no_hp: $('input#no_hp').val(),
                kelompok: $('select#kelompok').val(),
                jenis_kelamin: $('select#jenis_kelamin').val(),
            },
            dataType: "json",
            beforeSend: function() {
                $('.btnsimpan').attr('disable', 'disable');
                $('.btnsimpan').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>'
                );
            },
            complete: function() {
                $('.btnsimpan').removeAttr('disable', 'disable');
                $('.btnsimpan').html('<i class="fa fa-share-square"></i>  Simpan');
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.no_hp) {
                        $('#no_hp').addClass('is-invalid');
                        $('.errorNoHp').html(response.error.no_hp);
                    } else {
                        $('#no_hp').removeClass('is-invalid');
                        $('.errorNoHp').html('');
                    }

                    if (response.error.kelompok) {
                        $('#kelompok').addClass('is-invalid');
                        $('.errorKelompok').html(response.error.kelompok);
                    } else {
                        $('#kelompok').removeClass('is-invalid');
                        $('.errorKelompok').html('');
                    }

                    if (response.error.jenis_kelamin) {
                        $('#jenis_kelamin').addClass('is-invalid');
                        $('.errorJenisKelamin').html(response.error.jenis_kelamin);
                    } else {
                        $('#jenis_kelamin').removeClass('is-invalid');
                        $('.errorJenisKelamin').html('');
                    }

                } else {
                    if (response.pesan) {
                        Swal.fire({
                            title: "Gagal!",
                            text: response.pesan,
                            icon: "error",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaldaftar').modal('hide');
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaldaftar').modal('hide');

                    }
                    listkegiatan();
                }
            }
        });
    })
});
</script>