<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('kegiatan/update', ['class' => 'formkegiatan']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="kegiatan_id" value="<?= $kegiatan_id ?>" name="kegiatan_id" readonly>
                    <label>Judul Kegiatan</label>
                    <input type="text" class="form-control" id="judul_kegiatan" value="<?= $judul_kegiatan ?>" name="judul_kegiatan">
                    <div class="invalid-feedback errorJudul">
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi</label>
                    <textarea type="text" class="form-control" id="isi" name="isi"> <?= $isi ?></textarea>
                    <div class="invalid-feedback errorIsi">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="published" <?php if ($status == 'published') echo "selected"; ?>>Published
                        </option>
                        <option value="archived" <?php if ($status == 'archived') echo "selected"; ?>>Archived</option>
                    </select>
                    <div class="invalid-feedback errorStatus">
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
        $('.formkegiatan').submit(function(e) {
            let title = $('input#judul_kegiatan').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    kegiatan_id: $('input#kegiatan_id').val(),
                    judul_kegiatan: $('input#judul_kegiatan').val(),
                    slug_kegiatan: title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(
                        /^-|-$/g, ''),
                    isi: $('textarea#isi').val(),
                    status: $('select#status').val(),
                    tgl_kegiatan: date,
                    user_id: user_id
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
                        if (response.error.judul_kegiatan) {
                            $('#judul_kegiatan').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul_kegiatan);
                        } else {
                            $('#judul_kegiatan').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }

                        if (response.error.isi) {
                            $('#isi').addClass('is-invalid');
                            $('.errorIsi').html(response.error.isi);
                        } else {
                            $('#isi').removeClass('is-invalid');
                            $('.errorIsi').html('');
                        }

                        if (response.error.status) {
                            $('#status').addClass('is-invalid');
                            $('.errorStatus').html(response.error.status);
                        } else {
                            $('#status').removeClass('is-invalid');
                            $('.errorStatus').html('');
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
                        listkegiatan();
                    }
                }
            });
        })
    });
</script>