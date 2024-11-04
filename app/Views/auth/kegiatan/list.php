<?= form_open('kegiatan/hapusall', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listkegiatan" class="table table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="centangSemua">
            </th>
            <th>#</th>
            <th>Judul Kegiatan</th>
            <th>Isi</th>
            <th>Tanggal</th>
            <!-- <th>User Posting</th> -->
            <th>Sampul</th>
            <!-- <th>Status</th> -->
            <th>Aksi</th>
        </tr>
    </thead>


    <tbody>
        <?php $nomor = 0;
        foreach ($list as $data) :
            $nomor++; ?>
            <tr>
                <td>
                    <input type="checkbox" name="kegiatan_id[]" class="centangkegiatanid" value="<?= $data['kegiatan_id'] ?>">
                </td>
                <td><?= $nomor ?></td>
                <td><?= esc($data['judul_kegiatan']) ?></td>
                <td><?= esc($data['slug_kegiatan']) ?></td>
                <td><?= date_indo($data['tgl_kegiatan']) ?></td>
                <td><?= esc($data['nama']) ?></td>
                <td class="text-center"><img onclick="gambar('<?= $data['kegiatan_id'] ?>')" src="<?= base_url('img/kegiatan/thumb/' . 'thumb_' . $data['gambar']) ?>" width="120px" class="img-thumbnail"></td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="edit('<?= $data['kegiatan_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $data['kegiatan_id'] ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" onclick="daftar('<?= $data['kegiatan_id'] ?>')">
                        Daftar
                    </button>


                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<?= form_close() ?>
<script>
    $(document).ready(function() {
        var table = $('#listkegiatan').DataTable({
            // Konfigurasi DataTables
            "processing": true,
            "serverside": true,
            "order": [],
            "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                },
                {
                    "targets": -1,
                    "orderable": false,
                },
            ],
            buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
            ],
            dom: "<'row'<'col-md-4'l><'col-md-4 text-center'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
        });

        table.buttons().container().appendTo('#listkegiatan_wrapper .col-md-4:eq(1)');

        // Sisa script untuk centangSemua, formhapus, edit, hapus, dan gambar
    });
</script>
<script>
    $(document).ready(function() {
        $('#listkegiatan').DataTable();

        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangkegiatanid').prop('checked', true);
            } else {
                $('.centangkegiatanid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangkegiatanid:checked');
            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops!',
                    text: 'Silahkan pilih data!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    title: 'Hapus data',
                    text: `Apakah anda yakin ingin menghapus sebanyak ${jmldata.length} data?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data berhasil dihapus!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                listkegiatan();
                            }
                        });
                    }
                })
            }
        });
    });


    function daftar(kegiatan_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('kegiatan/formdaftar') ?>",
            data: {
                kegiatan_id: kegiatan_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldaftar').modal('show');
                }
            }
        });
    }

    function edit(kegiatan_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('kegiatan/formedit') ?>",
            data: {
                kegiatan_id: kegiatan_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            }
        });
    }

    function hapus(kegiatan_id) {
        Swal.fire({
            title: 'Hapus data?',
            text: `Apakah anda yakin menghapus data?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('kegiatan/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        kegiatan_id: kegiatan_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.sukses,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            listkegiatan();
                        }
                    }
                });
            }
        })
    }

    function gambar(kegiatan_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('kegiatan/formupload') ?>",
            data: {
                kegiatan_id: kegiatan_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                }
            }
        });
    }
</script>