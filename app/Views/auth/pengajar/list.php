<?= form_open('pengajar/hapusall', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listpengajar" class="table table-striped dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="centangSemua">
            </th>
            <th>#</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tempat & Tgl Lahir</th>
            <th>NIK Pengajar</th>
            <th>Alamat</th>
            <th>Pendidikan</th>
            <th>Tahun Masuk Tugas</th>
            <th>Jabatan</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data akan dimuat melalui DataTables AJAX -->
    </tbody>
</table>
<?= form_close() ?>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        var table = $('#listpengajar').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('pengajar/getdata') ?>", // URL untuk mendapatkan data
                "type": "POST"
            },
            "columns": [
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `<input type="checkbox" class="centangPengajarid" name="pengajar_id[]" value="${row.id}">`;
                    }
                },
                {"data": "nomor"},
                {"data": "nama"},
                {"data": "jekel"},
                {"data": "tmp_lahir"},
                {"data": "nik_ustadz"},
                {"data": "alamat"},
                {"data": "pendidikan"},
                {"data": "tahun_masuk"},
                {"data": "jabatan"},
                {"data": "keterangan"}
                {"data": "aksi"}
            ],
            "order": [],
            "columnDefs": [
                {
                    "targets": [0, -1],
                    "orderable": false
                }
            ],
            "dom": "<'row'<'col-md-4'l><'col-md-4 text-center'B><'col-md-4'f>>" +
                   "<'row'<'col-md-12'tr>>" +
                   "<'row'<'col-md-5'i><'col-md-7'p>>",
            "buttons": [
                { extend: 'excel', exportOptions: { columns: ':visible' } },
                { extend: 'print', orientation: 'landscape', exportOptions: { columns: ':visible' } },
                { extend: 'pdf', orientation: 'landscape', exportOptions: { columns: ':visible' } }
            ]
        });

        table.buttons().container().appendTo('#listpengajar_wrapper .col-md-4:eq(1)');

        // Mengatur centang semua checkbox
        $('#centangSemua').click(function() {
            $('.centangPengajarid').prop('checked', $(this).is(':checked'));
        });

        // Menghandle pengiriman form untuk hapus data
        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let checkedData = $('.centangPengajarid:checked');
            if (checkedData.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops!',
                    text: 'Silahkan pilih data!',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    title: 'Hapus data',
                    text: `Apakah anda yakin ingin menghapus sebanyak ${checkedData.length} data?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Data berhasil dihapus!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    table.ajax.reload(); // Reload data setelah penghapusan
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan',
                                    text: 'Terjadi kesalahan saat menghapus data!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                    }
                });
            }
        });
    });

    // Fungsi untuk edit data pengajar
    function edit(pengajar_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pengajar/formedit') ?>",
            data: { pengajar_id: pengajar_id },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            }
        });
    }

    // Fungsi untuk hapus satu data pengajar
    function hapus(pengajar_id) {
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
                    url: "<?= site_url('pengajar/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: { pengajar_id: pengajar_id },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.sukses,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#listpengajar').DataTable().ajax.reload();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
    }

    // Fungsi untuk menampilkan gambar pengajar
    function gambar(pengajar_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pengajar/formupload') ?>",
            data: { pengajar_id: pengajar_id },
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
