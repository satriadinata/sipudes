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
					<h3>F-2.16</h3>
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

		<h3 style="text-decoration: underline;" >SURAT KETERANGAN KEMATIAN
		</h3>
		<P>Nomor: <?php echo $surat['no_surat']; ?></P>
		<div style="text-align: justify;">
			<p>Yang bertanda tangan dibawah ini, menerangkan bahwa:</p>
		</div>
	</div>
	<div class="body">
		<table>
			<tr>
				<td>Nama Lengkap</td>
				<td> : </td>
				<td><?php echo $calon['nama_warga']; ?></td>
			</tr>
			<tr>
				<td>NIK</td>
				<td> : </td>
				<td><?php echo $calon['nik_warga']; ?></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td> : </td>
				<td><?php echo $calon['jenis_kelamin_warga']=='L' ? 'Laki-laki' :'Perempuan' ?></td>
			</tr>
			<tr>
				<td>Tanggal Lahir/Umur</td>
				<td> : </td>
				<td><?php echo $umur?></td>
			</tr>
			<tr>
				<td>Agama</td>
				<td> : </td>
				<td><?php echo strtoupper($calon['agama_warga']); ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$calon['rt_warga'].' RW '.$calon['rw_warga'].' KECAMATAN '.$profil['kec_desa'].' PROVINSI '.$profil['prov_desa'] ?></td>
			</tr>
		</table>
		<p>
			Telah meninggal Dunia pada:
		</p>
		<table>
			<tr>
				<td>Hari</td>
				<td> : </td>
				<td><?php echo $surat['hari']; ?>, <?php echo date('d-m-Y',strtotime($surat['tgl_kematian']))  ?></td>
			</tr>
			<tr>
				<td>Bertempat di</td>
				<td> : </td>
				<td><?php echo $surat['tempat']; ?></td>
			</tr>
			<tr>
				<td>Penyebab</td>
				<td> : </td>
				<td><?php echo $surat['penyebab']; ?></td>
			</tr>
		</table>
		<p>
			Surat keterangan ini berdasarkan keterangan pelapor:
		</p>
		<table>
			<tr>
				<td>Nama Lengkap</td>
				<td> : </td>
				<td><?php echo $pelapor['nama_warga'] ?></td>
			</tr>
			<tr>
				<td>NIK</td>
				<td> : </td>
				<td><?php echo $pelapor['nik_warga']; ?></td>
			</tr>
			<tr>
				<td>Umur</td>
				<td> : </td>
				<td><?php echo $umur_pelapor; ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td> : </td>
				<td><?php echo $pelapor['pekerjaan_warga']?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$pelapor['rt_warga'].' RW '.$pelapor['rw_warga'].' KECAMATAN '.$profil['kec_desa'].' PROVINSI '.$profil['prov_desa'] ?></td>
			</tr>
			<tr>
				<td>Hubungan pelapor dengan yang mati</td>
				<td> : </td>
				<td><?php echo $surat['hubungan_pelapor'] ?></td>
			</tr>
		</table>
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