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

		<h3 style="text-decoration: underline;" >SURAT KETERANGAN PERJALANAN MERANTAU</h3>
		<P>Nomor: <?php echo $surat['no_surat']; ?></P>
		<p>Yang bertanda tangan dibawah ini, Kepala Desa <?php echo $profil['nama_desa']; ?> Kecamatan <?php echo $profil['kec_desa']; ?> Kabupaten <?php echo $profil['kab_desa']; ?>, dengan ini menerangkan bahwa:</p>
	</div>
	<div class="body">
		<table>
			<tr>
				<td>Nama</td>
				<td> : </td>
				<td><?php echo $calon['nama_warga']; ?></td>
			</tr>
			<tr>
				<td>Tempat Tanggal Lahir</td>
				<td> : </td>
				<td><?php echo $calon['tempat_lahir_warga'].', '.date('d-m-Y',strtotime($calon['tanggal_lahir_warga'])); ?></td>
			</tr>
			<tr>
				<td>Kewarganegaraan</td>
				<td> : </td>
				<td><?php echo $calon['negara_warga']?></td>
			</tr>
			<tr>
				<td>Agama</td>
				<td> : </td>
				<td><?php echo strtoupper($calon['agama_warga']); ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td> : </td>
				<td><?php echo $calon['pekerjaan_warga']; ?></td>
			</tr>
			<tr>
				<td>Tempat tinggal</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$calon['rt_warga'].' RW '.$calon['rw_warga'].' KECAMATAN '.$profil['kec_desa']; ?></td>
			</tr>
			<tr>
				<td>Keperluan</td>
				<td> : </td>
				<td><?php echo $surat['keperluan']?></td>
			</tr>

			<tr>
				<td>Surat bukti diri</td>
				<td> : </td>
				<td><?php echo $surat['surat_bukti_diri']?></td>
			</tr>
			<tr>
				<td>Berlaku mulai</td>
				<td> : </td>
				<td><?php echo date('d-m-Y')?> s/d seperlunya</td>
			</tr>
			<tr>
				<td>Keterangan lain-lain</td>
				<td> : </td>
				<td><?php echo $surat['keterangan_lain']?></td>
			</tr>
		</table>
		<p>
			Demikian untuk menjadikan maklum bagi yang berkepentingan
		</p>
	</div>
	<div>
		<?php 
		$bulan=['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','November','Desember'];
		?>
		<div >
			<table style="width: 100%;" >
				<tr>
					<td style="text-align: center;" >
						<p></p>
						<p>Tanda tangan pemegang</p>
						<br>
						<br>
						<br>
					</td>
					<td style="text-align: center;" >
						<p><?php echo $profil['nama_desa']; ?>, <?php echo date('d').' '.$bulan[date('m')-1].' '.date('Y'); ?></p>
						<p>Kepala Desa <?php echo $profil['nama_desa']; ?></p>
						<br>
						<br>
						<br>
					</td>
				</tr>
				<tr>
					<td style="text-align: center;" >
						<p><?php echo $calon['nama_warga']; ?></p>
					</td>
					<td style="text-align: center;" >
						<p><?php echo $kepdes['nama_warga']; ?></p>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>