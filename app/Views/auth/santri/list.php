<?= form_open('santri/hapusall', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listsantri" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="centangSemua">
            </th>
            <th>#</th>
            <th>Nama</th>
            <th>NISM</th>
            <th>NISN</th>
            <th>Tahun Masuk</th>
            <th>NIK</th>
            <th>Kelas</th>
            <th>Tempat & Tgl Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Anak Ke</th>
            <th>Jumlah Saudara</th>
            <th>Nama Ibu</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<?= form_close() ?>
<script>
    function getdatasantri() {
        var table = $('#listsantri').DataTable({
            "processing": true,
            "serverside": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('santri/getdatasantri') ?>",
                "type": "POST"
            },
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
            columnDefs: [{
                targets: -1,
                visible: false
            }],
            dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center py-2'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            columnDefs: [{
                targets: -1,
                orderable: false,
                searchable: false
            }],
        });
        table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');

    }

    $(document).ready(function() {
        getdatasantri();
        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangSantriid').prop('checked', true);
            } else {
                $('.centangSantriid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangSantriid:checked');
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
                                listsantri();
                            }
                        });
                    }
                })
            }
        });
    });




    function edit(santri_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('santri/formedit') ?>",
            data: {
                santri_id: santri_id
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

    function hapus(santri_id) {
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
                    url: "<?= site_url('santri/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        santri_id: santri_id
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
                            listsantri();
                        }
                    }
                });
            }
        })
    }
</script>