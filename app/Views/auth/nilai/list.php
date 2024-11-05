<button type="submit" class="btn btn-danger btn-sm">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listnilai" class="table table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <!-- <th>
                <input type="checkbox" id="centangSemua">
            </th> -->
            <th>No</th>
            <th>Nama</th>
            <th>Pengajar</th>
            <th>Halaman</th>
            <th>Surah</th>
            <th>Kelancaran</th>
            <th>Kefasihan</th>
            <th>Grade</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    </tbody>
</table>

<script>
    function getnilai() {
        var table = $('#listnilai').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= site_url('nilai/getnilai') ?>",
                "type": "POST",
                "dataSrc": function(json) {
                    console.log(json); // debugging
                    return json.data; // untuk mengembalikan data
                }
            },
            "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                    "searchable": false
                },
                {
                    "targets": -1,
                    "orderable": false,
                    "searchable": false
                },
            ],
            "buttons": [{
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
                }
            ],
            "dom": "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center py-2'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
        });

        table.buttons().container().appendTo('#listnilai_wrapper .col-md-5:eq(0)');
    }

    $(document).ready(function() {
        getnilai();

        // Script Delete Data
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            // Ambil nilai ID dari database
            var nilai_id = $(this).data('id');
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
                    // Jika pengguna mengkonfirmasi, redirect ke URL delete dengan ID
                    window.location.href = '/nilai/delete/' + nilai_id;
                }
            });
        });
    });


    $(document).on('click', '.btn-update', function(e) {
    e.preventDefault();

    // Ambil ID dari tombol update
    var nilai_id = $(this).data('id');
    console.log("Button clicked, nilai_id:", nilai_id); // Debug: cek apakah ID terdeteksi

    // Lakukan AJAX untuk mengambil data berdasarkan nilai_id
    $.ajax({
        url: '/nilai/getNilaiById', // Pastikan URL sesuai dengan route di CodeIgniter
        type: 'POST',
        data: {
            nilai_id: nilai_id
        },
        dataType: 'json',
        success: function(response) {
            console.log("Response:", response); // Debug: cek respon dari server

            // Fungsi untuk parsing data
            function parseData(obj) {
                return {
                    nilaiId: obj.nilai_id,
                    santriId: obj.santri_id,
                    pengajarId: obj.pengajar_id,
                    jilidHal: obj.jilid_hal,
                    surat: obj.surat,
                    kefasihan: parseInt(obj.kefasihan), // mengubah ke angka
                    kelancaran: parseInt(obj.kelancaran), // mengubah ke angka
                    nilai: obj.nilai,
                    paraf: obj.paraf
                };
            }

            // Menggunakan fungsi untuk parsing
            const parsedData = parseData(response);

            // Pastikan response ada
            if (response) {
                // AJAX untuk mengambil form edit dan menampilkan modal
                $.ajax({
                    url: "<?= site_url('nilai/formEdit') ?>",
                    dataType: "json",
                    success: function(response) {
                        $('.viewmodal').html(response.data).show();
                        $('#modalupdate').modal('show');

                        // Isi form dengan data yang diambil dari parsedData
                        $('#id').val(parsedData.nilaiId);
                        $('#nama').val(parsedData.santriId);
                        $('#pengajar').val(parsedData.pengajarId);
                        $('#halaman').val(parsedData.jilidHal);
                        $('#surah').val(parsedData.surat);
                        $('#kelancaran').val(parsedData.kelancaran);
                        $('#kefasihan').val(parsedData.kefasihan);
                        $('#keterangan').val(parsedData.paraf);
                    }
                });
            } else {
                console.error("Data not found for nilai_id:", nilai_id);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", error);
        }
    });
});
</script>
