<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sertakan library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<body>
    <!-- Bagian Grafik Pendidikan Pengurus -->
    <section id="grafikPendidikan" class="section-bg">
        <div class="container">
            <div class="section-title">
                <h2>Grafik Pendidikan Pengurus</h2>
            </div>
            <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </section>

    <script>
        <?php if (isset($pendidikan)): ?>
            var ctx = document.getElementById('myChart').getContext('2d');
            var data = <?= json_encode($pendidikan); ?>;
        
            var labels = data.map(function(item) {
                return item.pendidikan;
            });
            var values = data.map(function(item) {
                return item.jumlah;
            });

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Pengurus',
                        data: values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        <?php else: ?>
            console.log("Data pendidikan tidak tersedia");
        <?php endif; ?>
    </script>
</body>
<?= $this->endSection('isi') ?>
