<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>


<style type="text/css">
body {
    font-family: roboto;
}

table {
    margin: 0px auto;
}
</style>


<center>
    <h2>MEMBUAT GRAFIK DARI DATABASE MYSQL DENGAN PHP DAN CHART.JS<br />- www.malasngoding.com -</h2>
</center>



<div style="width: 1800px;margin: 0px auto;">
    <canvas id="myChart"></canvas>
</div>

<br />
<br />
<?php
        $query3 = $pdo->prepare('SELECT * FROM karyawan');
		$query3->execute();			
		$query3->setFetchMode(PDO::FETCH_ASSOC);
			
			if($query3->rowCount() > 0):
			?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Ciri Khas</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php while($hasil = $query3->fetch()): ?>
        <tr>
            <td><?php echo $hasil['no_kalung']; ?></td>
            <td><?php echo $hasil['ciri_khas']; ?></td>
            <td><a href="single-karyawan.php?id=<?php echo $hasil['id_karyawan']; ?>"><span class="fa fa-eye"></span>
                    Detail</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>


<!-- <table border="1"> -->
<!-- <thead>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>kriteria</th>
        </tr>
    </thead>
    <tbody>
        <?php 
			$no = 1;
			$data = mysqli_query($koneksi,"select * from mahasiswa");
			while($d=mysqli_fetch_array($data)){
				?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nama']; ?></td>
            <td><?php echo $d['nim']; ?></td>
            <td><?php echo $d['kriteria']; ?></td>
        </tr>
        <?php 
			}
			?>
    </tbody>
</table> -->
<?php else: ?>
<p>Maaf, belum ada data untuk karyawan.</p>
<?php endif; ?>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["C1", "C2", "C3", "C4"],
        datasets: [{
            label: '',
            data: [
                <?php 
					$jumlah_teknik = mysqli_query($koneksi,"select * from nilai_karyawan where id_kriteria='11'");
					echo mysqli_num_rows($jumlah_teknik);
					?>,
                <?php 
					$jumlah_ekonomi = mysqli_query($koneksi,"select * from nilai_karyawan where id_kriteria='12'");
					echo mysqli_num_rows($jumlah_ekonomi);
					?>,
                <?php 
					$jumlah_fisip = mysqli_query($koneksi,"select * from nilai_karyawan where id_kriteria='13'");
					echo mysqli_num_rows($jumlah_fisip);
					?>,
                <?php 
					$jumlah_pertanian = mysqli_query($koneksi,"select * from nilai_karyawan where id_kriteria='14'");
					echo mysqli_num_rows($jumlah_pertanian);
					?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>