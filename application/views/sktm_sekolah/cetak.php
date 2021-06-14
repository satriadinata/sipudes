<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.head{
			text-align: center;
		}
	</style>
</head>
<body>
	<!-- <pre>
		<?php echo base_url(''); ?>
		<?php print_r($calon) ?>
	</pre> -->
	<div class="head">
		<table style="width: 80%" >
			<tr>
				<td><img width="70" src="<?php echo base_url('assets/kab_pati.jpg') ?>"></td>
				<td style="text-align: center;" >
					<h3>
						PEMERINTAH KABUPATEN <?php echo $profil['kab_desa']; ?> <br>
						KECAMATAN <?php echo $profil['kec_desa']; ?> <br>
						DESA <?php echo $profil['nama_desa']; ?>
					</h3>
				</td>
			</tr>
		</table>
		<hr>
		<div style="text-align: left;" >
			
			<p>No. Kode Desa <?php echo $profil['nama_desa']; ?><br>
				<?php echo $profil['kode_desa']; ?>
			</p>
		</div>

		<h3 style="text-decoration: underline;" >SURAT KETERANGAN</h3>
		<P>Nomor: <?php echo $surat['no_surat']; ?></P>
		<div style="text-align: left;" >
			
		<p>Yang bertanda tangan dibawah ini, Kepala Desa <?php echo $profil['nama_desa']; ?> Kecamatan <?php echo $profil['kec_desa']; ?> Kabupaten <?php echo $profil['kab_desa']; ?>, dengan ini menerangkan bahwa:</p>
		</div>
	</div>
	<div class="body">
		<table>
			<tr>
				<td>Nama Lembaga</td>
				<td> : </td>
				<td><?php echo $surat['nama_lembaga']; ?></td>
			</tr>
			<tr>
				<td>Alamat Lembaga</td>
				<td> : </td>
				<td><?php echo $surat['alamat_lembaga']; ?></td>
			</tr>
			<tr>
				<td>Penyelenggara</td>
				<td> : </td>
				<td><?php echo $surat['penyelenggara']; ?></td>
			</tr>
			<tr>
				<td>NPSN</td>
				<td> : </td>
				<td><?php echo $surat['npsn']?></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td> : </td>
				<td><?php echo $surat['keterangan']; ?></td>
			</tr>
		</table>
		<p>
			Berhubungan dengan maksud yang bersangkutan, di minta agar Dinas/Instansi terkait dapat memberikan bantuan fasilitas seperlunya karena kurang mampu.
		</p>
		<p>
			Demikian surat keterangan ini dibuat untuk digunakan seperlunya.
		</p>
	</div>
	<div>
		<?php 
		$bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','November','Desember'];
		 ?>
		<div style="position: relative;" ></div>
		<div style="position: absolute; right: 0; " >
			<table>
				<tr>
					<td>
						<p><?php echo $profil['nama_desa']; ?>, <?php echo date('d').' '.$bulan[date('m')-1].' '.date('Y'); ?></p>
						<p>Kepala Desa <?php echo $profil['nama_desa']; ?></p>
						<br>
						<br>
						<br>
					</td>
				</tr>
				<tr>
					<td style="text-align: center;" >
						<p><?php echo $kepdes['nama_warga']; ?></p>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>