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
		<div style="position: relative;" ></div>
		<div style="position: absolute;right: 10;top: -30;"  >
			<table>
				<td style="border:2px solid black; padding-left: 10;padding-right: 10;padding-bottom: 2;padding-top: 1;">
					<h3>F-1.35</h3>
				</td>
			</table>
		</div>
		<table style="width: 100%" >
			<tr>
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

		<h3>SURAT PENGANTAR PINDAH <br><span style="text-decoration: underline;" >ANTAR KABUPATEN/KOTA ATAU ANTAR PROVINSI</span>
		</h3>
		<P>Nomor: <?php echo $surat['nomor_surat']; ?></P>
		<div style="text-align: justify;">
			<p>Yang bertanda tangan dibawah ini, menerangkan Permohonan Pindah Penduduk WNI dengan data sebagai berikut:</p>
		</div>
	</div>
	<div class="body">
		<table>
			<tr>
				<td>NIK</td>
				<td> : </td>
				<td><?php echo $calon['nik_warga']; ?></td>
			</tr>
			<tr>
				<td>Nama Lengkap</td>
				<td> : </td>
				<td><?php echo $calon['nama_warga']; ?></td>
			</tr>
			<tr>
				<td>Nomor Kartu Keluarga</td>
				<td> : </td>
				<td><?php echo $calon['no_kk_warga']; ?></td>
			</tr>
			<tr>
				<td>Nama Kepala Keluarga</td>
				<td> : </td>
				<td><?php echo $kep_kel['nama_warga']?></td>
			</tr>
			<tr>
				<td>Alamat Sekarang</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$calon['rt_warga'].' RW '.$calon['rw_warga'].' KECAMATAN '.$profil['kec_desa'].' PROVINSI '.$profil['prov_desa'] ?></td>
			</tr>
			<tr>
				<td>Alamat Tujuan Pindah</td>
				<td> : </td>
				<td><?php echo strtoupper($surat['alamat_tujuan']); ?></td>
			</tr>
			<tr>
				<td>Jumlah Keluarga yang Pindah</td>
				<td> : </td>
				<td><?php echo $surat['jmlh_org']; ?> Orang</td>
			</tr>
		</table>
		<p>
			Adapun Permohonan Pindah Penduduk WNI yang bersangkutan sebagaimana terlampir.
		</p>
		<p>
			Demikian Surat Pengantar Pindah ini dibuat agar digunakan sebagaimana mestinya.
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