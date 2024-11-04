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
            <?= form_open('pengumuman/updatekelulusan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="kelulusan_id" value="<?= $kelulusan_id ?>" name="kelulusan_id" readonly>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nis</label>
                    <div class="col-sm-8">
                        <select name="santri_id" id="santri_id" class="js-example-basic-single">
                            <option Disabled=true Selected=true> </option>
                            <?php foreach ($santri as $key => $data) { ?>
                                <option value="<?= $data['santri_id'] ?>" <?php if ($data['santri_id'] == $santri_id) echo "selected"; ?>><?= $data['nis'] ?> (<?= $data['nama'] ?> | <?= $data['nama_kelas'] ?>)</option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorsantri">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Nomor Ujian</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_ujian" value="<?= $no_ujian ?>" name="no_ujian">
                        <div class="invalid-feedback errorNoujian">
                        </div>
                    </div>
                </div>

        
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                        <select name="keterangan" id="keterangan" class="form-control">
                            <option value="LULUS" <?php if ($keterangan == 'LULUS') echo "selected"; ?>>LULUS</option>
                            <option value="TIDAK LULUS" <?php if ($keterangan == 'TIDAK LULUS') echo "selected"; ?>>TIDAK LULUS</option>
                            <option value="TUNDA" <?php if ($keterangan == 'TUNDA') echo "selected"; ?>>TUNDA</option>
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
            theme: "bootstrap4",
        }).prop('disabled', true);
        $('.formtambah').submit(function(e) {
            e.preventDefault();
            $('.js-example-basic-single').select2({
                theme: "bootstrap4",
            }).prop('disabled', false);
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
                        if (response.error.santri_id) {
                            $('#santri_id').addClass('is-invalid');
                            $('.errorSantri').html(response.error.santri_id);
                        } else {
                            $('#santri_id').removeClass('is-invalid');
                            $('.errorSantri').html('');
                        }

                        if (response.error.no_ujian) {
                            $('#no_ujian').addClass('is-invalid');
                            $('.errorNoujian').html(response.error.no_ujian);
                        } else {
                            $('#no_ujian').removeClass('is-invalid');
                            $('.errorNoujian').html('');
                        }

                        if (response.error.jurusan) {
                            $('#jurusan').addClass('is-invalid');
                            $('.errorJurusan').html(response.error.jurusan);
                        } else {
                            $('#jurusan').removeClass('is-invalid');
                            $('.errorJurusan').html('');
                        }

                        if (response.error.mapel) {
                            $('#mapel').addClass('is-invalid');
                            $('.errorMapel').html(response.error.mapel);
                        } else {
                            $('#mapel').removeClass('is-invalid');
                            $('.errorMapel').html('');
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
                        listkelulusan();
                    }
                }
            });
        })
    });
</script>