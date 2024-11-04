<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Input Nilai</a></li>
        <li class="breadcrumb-item active">List Nilai</li>

    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<p class="sub-title"> <button type="button" class="btn btn-primary btn-sm   "><i class=" fa fa-plus-circle"></i> Masukan Nilai</button>
</p>
<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listnilai() {
        $.ajax({
            url: "<?= site_url('nilai/getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listnilai();
        $('.tambahnilai').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('nilai/formtambah') ?>",
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