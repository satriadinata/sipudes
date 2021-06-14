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

		<h3 style="text-decoration: underline;" >SURAT KETERANGAN USAHA</h3>
		<P>Nomor: <?php echo $surat['nomor_surat']; ?></P>
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
				<td>NIK</td>
				<td> : </td>
				<td><?php echo $calon['nik_warga']; ?></td>
			</tr>
			<tr>
				<td>NO KK</td>
				<td> : </td>
				<td><?php echo $calon['no_kk_warga']; ?></td>
			</tr>
			<tr>
				<td>Tempat Tanggal Lahir</td>
				<td> : </td>
				<td><?php echo $calon['tempat_lahir_warga'].', '.date('d-m-Y',strtotime($calon['tanggal_lahir_warga'])); ?></td>
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
				<td>Alamat</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$calon['rt_warga'].' RW '.$calon['rw_warga'].' KECAMATAN '.$profil['kec_desa']; ?></td>
			</tr>
		</table>
		<p>
			Nama yang tersebut diatas adalah benar penduduk yang berdomisili di Desa <?php echo $profil['nama_desa']; ?> Kecamatan <?php echo $profil['kec_desa']; ?>.<br>
			Berdasarkan perngamatan kami bahwa nama tersebut diatas adalah benar memiliki usaha <span style="font-weight: bold;" ><?php echo $surat['nama_usaha']; ?></span> di wilayah <?php echo 'Desa '.$profil['nama_desa'].' RT '.$calon['rt_warga'].' RW '.$calon['rw_warga'].' KECAMATAN '.$profil['kec_desa']; ?> dan sudah berjalan selama <span style="font-weight: bold;" ><?php echo $surat['lama_usaha']; ?></span> bulan.
		</p>
		<p>
			Demikian Surat Keterangan Usaha ini dibuat, untuk dapat dipergunakan sebagaimana mestinya.
		</p>
		<div style="text-align: center;" >
			<div>
				<table>
					<tr>
						<td>DIKELUARKAN DI</td>
						<td> : </td>
						<td><?php echo $profil['nama_desa']; ?></td>
					</tr>
					<tr>
						<td>PADA TANGGAL</td>
						<td> : </td>
						<td><?php echo date('d-m-Y'); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div>
		<p>Kepala Desa <?php echo $profil['nama_desa']; ?></p>
		<br>
		<br>
		<br>
		<p><?php echo $kepdes['nama_warga']; ?></p>
	</div>
</body>
</html>