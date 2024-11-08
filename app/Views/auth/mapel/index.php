<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title">Mapel</h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Ustadz</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('auth/ustadz') ?>">List Ustadz</a></li>
        <li class="breadcrumb-item active">Mapel</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<p class="sub-title"> <button type="button" class="btn btn-primary btn-sm tambahmapel"><i class=" fa fa-plus-circle"></i> Tambah Mapel</button>
</p>
<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listmapel() {
        $.ajax({
            url: "<?= site_url('ustadz/getmapel') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listmapel();
        $('.tambahmapel').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('ustadz/formmapel') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();

                    $('#modaltambah').modal('show');
                }
            });
        });
    });
</script>
<?= $this->endSection('isi') ?>