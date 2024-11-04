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
            <?= form_open('nilai/saveData', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="invalid-feedback errorNama"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pengajar" class="col-sm-4 col-form-label">Pengajar</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="pengajar" name="pengajar">
                        <div class="invalid-feedback errorPengajar"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="halaman" class="col-sm-4 col-form-label">Halaman</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="halaman" name="halaman">
                        <div class="invalid-feedback errorHalaman"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surah" class="col-sm-4 col-form-label">Surah</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="surah" name="surah">
                        <div class="invalid-feedback errorSurah"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelancaran" class="col-sm-4 col-form-label">Kelancaran</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="kelancaran" name="kelancaran">
                        <div class="invalid-feedback errorKelancaran"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kefasihan" class="col-sm-4 col-form-label">Kefasihan</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="kefasihan" name="kefasihan">
                        <div class="invalid-feedback errorKefasihan"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="keterangan" name="keterangan">
                            <option value="">Pilih Status</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                        <div class="invalid-feedback errorKeterangan"></div>
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
                type: "POST",
                url: $(this).attr('action'), // Memastikan action URL sudah benar
                data: {
                    santri_id: $('#nama').val(),
                    pengajar_id: $('#pengajar').val(),
                    jilid_hal: $('#halaman').val(),
                    surat: $('#surah').val(),
                    kelancaran: $('#kelancaran').val(),
                    kefasihan: $('#kefasihan').val(),
                    paraf: $('#keterangan').val(),
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>' // CSRF token
                },
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disabled').html('<i class="fa fa-share-square"></i> Simpan');
                },
                success: function(response) {
                    // Cek respons di sini
                    if (response.success) {
                        $('#modaltambah').modal('hide');
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message || 'Data berhasil disimpan.',
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response.error || 'Terjadi kesalahan saat menyimpan data.',
                            icon: "error",
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Tampilkan error di konsol jika ada masalah
                }
            });
        });
    });
</script>