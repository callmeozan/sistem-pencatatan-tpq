<?= form_open('santri/hapusallinfaq', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listinfaq" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="centangSemua">
            </th>
            <th>#</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
    </thead>


    <tbody>

    </tbody>
</table>
<?= form_close() ?>
<script>
    function getdatainfaq() {
        var table = $('#listinfaq').DataTable({
            "processing": true,
            "serverside": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('santri/getdatainfaq') ?>",
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
        });
    }
    $(document).ready(function() {
        getdatainfaq();

        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangInfaqid').prop('checked', true);
            } else {
                $('.centangInfaqid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangInfaqid:checked');
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
                                listinfaq();
                            }
                        });
                    }
                })
            }
        });
    });




    function edit(infaq_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('santri/formeditinfaq') ?>",
            data: {
                infaq_id: infaq_id
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

    function hapus(infaq_id) {
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
                    url: "<?= site_url('santri/hapusinfaq') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        infaq_id: infaq_id
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
                            listinfaq();
                        }
                    }
                });
            }
        })
    }
</script>