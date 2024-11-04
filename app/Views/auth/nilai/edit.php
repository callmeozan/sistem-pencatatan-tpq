<!-- Modal -->
<div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('nilai/updateData', ['class' => 'formupdate']) ?>
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
 
</script>