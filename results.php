<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "environment_survey");

$sql = "SELECT * FROM environment_survey";
$result = $conn->query($sql);

// Variabel untuk menyimpan data survei
$totalRespondents = 0;
$peduliYes = 0;
$peduliNo = 0;
$reducePlasticYes = 0;
$reducePlasticNo = 0;
$recycleYes = 0;
$recycleNo = 0;

// Menghitung jumlah responden untuk setiap kategori
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalRespondents++;
        
        // Menghitung jawaban untuk "Apakah Anda peduli dengan lingkungan?"
        if ($row["question1"] == "Yes") {
            $peduliYes++;
        } else {
            $peduliNo++;
        }

        // Menghitung jawaban untuk "Apakah Anda berusaha mengurangi plastik?"
        if ($row["question2"] == "Yes") {
            $reducePlasticYes++;
        } else {
            $reducePlasticNo++;
        }

        // Menghitung jawaban untuk "Apakah Anda mendaur ulang sampah?"
        if ($row["question3"] == "Yes") {
            $recycleYes++;
        } else {
            $recycleNo++;
        }
    }
} else {
    echo "Belum ada data survei.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Survei Kesadaran Lingkungan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .chart-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        canvas {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<h2>Hasil Survei Kesadaran Lingkungan</h2>

<div class="chart-container">
    <h3>Diagram Batang - Peduli Lingkungan</h3>
    <canvas id="barChart"></canvas>
</div>

<div class="chart-container">
    <h3>Diagram Pie - Pengurangan Plastik</h3>
    <canvas id="pieChart"></canvas>
</div>

<script>
// Data dari PHP ke JavaScript
const peduliYes = <?php echo $peduliYes; ?>;
const peduliNo = <?php echo $peduliNo; ?>;
const reducePlasticYes = <?php echo $reducePlasticYes; ?>;
const reducePlasticNo = <?php echo $reducePlasticNo; ?>;
const recycleYes = <?php echo $recycleYes; ?>;
const recycleNo = <?php echo $recycleNo; ?>;

// Diagram Batang untuk Peduli Lingkungan
const ctxBar = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: ['Peduli Lingkungan: Ya', 'Peduli Lingkungan: Tidak'],
        datasets: [{
            label: 'Jumlah Responden',
            data: [peduliYes, peduliNo],
            backgroundColor: ['#4CAF50', '#FF5733'],
            borderColor: ['#388E3C', '#C70039'],
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

// Diagram Pie untuk Pengurangan Plastik
const ctxPie = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: ['Mengurangi Plastik: Ya', 'Mengurangi Plastik: Tidak'],
        datasets: [{
            data: [reducePlasticYes, reducePlasticNo],
            backgroundColor: ['#4CAF50', '#FF5733'],
            borderColor: ['#388E3C', '#C70039'],
            borderWidth: 1
        }]
    }
});
</script>

</body>
</html>
