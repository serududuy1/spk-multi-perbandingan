<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1, 2)); ?>

<?php
$judul_page = 'List karyawan';
require_once('template-parts/header.php');
?>

<div class="main-content-row">
    <div class="container clearfix">

        <?php include_once('template-parts/sidebar-karyawan.php'); ?>

        <div class="main-content the-content">

            <?php
			$status = isset($_GET['status']) ? $_GET['status'] : '';
			$msg = '';
			switch($status):
				case 'sukses-baru':
					$msg = 'Data karyawan baru berhasil ditambahkan';
					break;
				case 'sukses-hapus':
					$msg = 'karyawan behasil dihapus';
					break;
				case 'sukses-edit':
					$msg = 'karyawan behasil diedit';
					break;
			endswitch;
			
			if($msg):
				echo '<div class="msg-box msg-box-full">';
				echo '<p><span class="fa fa-bullhorn"></span> &nbsp; '.$msg.'</p>';
				echo '</div>';
			endif;
			?>

            <h1>List karyawan</h1>

            <?php
			$query = $pdo->prepare('SELECT * FROM karyawan');			
			$query->execute();
			// menampilkan berupa nama field
			$query->setFetchMode(PDO::FETCH_ASSOC);
			
			if($query->rowCount() > 0):
			?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No. Kalung</th>
                        <th>Ciri Khas</th>
                        <th>Detail</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($hasil = $query->fetch()): ?>
                    <tr>
                        <td><?php echo $hasil['no_kalung']; ?></td>
                        <td><?php echo $hasil['ciri_khas']; ?></td>
                        <td><a href="single-karyawan.php?id=<?php echo $hasil['id_karyawan']; ?>"><span
                                    class="fa fa-eye"></span> Detail</a></td>
                        <td><a href="edit-karyawan.php?id=<?php echo $hasil['id_karyawan']; ?>"><span
                                    class="fa fa-pencil"></span> Edit</a></td>
                        <td><a href="hapus-karyawan.php?id=<?php echo $hasil['id_karyawan']; ?>"
                                class="red yaqin-hapus"><span class="fa fa-times"></span> Hapus</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>


            <!-- STEP 1. Matriks Keputusan(X) ==================== -->
            <?php
			// Fetch semua kriteria
			$query = $pdo->prepare('SELECT id_kriteria, nama, type, bobot FROM kriteria
				ORDER BY urutan_order ASC');
			$query->execute();			
			$kriterias = $query->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_UNIQUE);
			
			// Fetch semua karyawan
			$query2 = $pdo->prepare('SELECT id_karyawan, no_kalung FROM karyawan');
			$query2->execute();			
			$query2->setFetchMode(PDO::FETCH_ASSOC);
			$karyawans = $query2->fetchAll();			
			?>

            <h3>Matriks Keputusan (X)</h3>
            <table class="table table-striped">
                <thead>
                    <tr class="super-top">
                        <th rowspan="2" class="super-top-left">No. karyawan</th>
                        <th colspan="<?php echo count($kriterias); ?>">Kriteria</th>
                    </tr>
                    <tr>
                        <?php foreach($kriterias as $kriteria ): ?>
                        <th><?php echo $kriteria['nama']; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($karyawans as $karyawan): ?>
                    <tr>
                        <td><?php echo $karyawan['no_kalung']; ?></td>
                        <?php
							// Ambil Nilai
							$query3 = $pdo->prepare('SELECT id_kriteria, nilai FROM nilai_karyawan
								WHERE id_karyawan = :id_karyawan');
							$query3->execute(array(
								'id_karyawan' => $karyawan['id_karyawan']
							));			
							$query3->setFetchMode(PDO::FETCH_ASSOC);
							$nilais = $query3->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_UNIQUE);
							
							foreach($kriterias as $id_kriteria => $values):
								echo '<td>';
								if(isset($nilais[$id_kriteria])) {
									echo $nilais[$id_kriteria]['nilai'];
									$kriterias[$id_kriteria]['nilai'][$karyawan['id_karyawan']] = $nilais[$id_kriteria]['nilai'];
								} else {
									echo 0;
									$kriterias[$id_kriteria]['nilai'][$karyawan['id_karyawan']] = 0;
								}
								
								if(isset($kriterias[$id_kriteria]['tn_kuadrat'])){
									$kriterias[$id_kriteria]['tn_kuadrat'] += pow($kriterias[$id_kriteria]['nilai'][$karyawan['id_karyawan']], 2);
								} else {
									$kriterias[$id_kriteria]['tn_kuadrat'] = pow($kriterias[$id_kriteria]['nilai'][$karyawan['id_karyawan']], 2);
								}
								echo '</td>';
							endforeach;
							?>
                        </pre>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php else: ?>
            <p>Maaf, belum ada data untuk karyawan.</p>
            <?php endif; ?>
        </div>

    </div><!-- .container -->
</div><!-- .main-content-row -->

<?php
require_once('template-parts/footer.php');