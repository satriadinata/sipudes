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
	<div class="head" style="margin-top: -20px;" >
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
		<hr style="margin-top: -20px;" >
		<div style="text-align: left;margin-top: -10px;" >
			
			<p>No. Kode Desa <?php echo $profil['nama_desa']; ?><br>
				<?php echo $profil['kode_desa']; ?>
			</p>
		</div>

		<h3 style="text-decoration: underline;margin-top: -10px;" >SURAT KETERANGAN KELAHIRAN
		</h3>
		<p style="margin-top: -20px;" >Nomor: <?php echo $surat['nomor_surat']; ?></p>
		<div style="text-align: justify;margin-bottom: -20px;">
			<p>Yang bertanda tangan dibawah ini, menerangkan bahwa pada:</p>
		</div>
	</div>
	<div class="body">
		<table>
			<tr>
				<td>Hari</td>
				<td> : </td>
				<td><?php echo $surat['hari']; ?></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td> : </td>
				<td><?php echo $surat['tgl_lahir']; ?></td>
			</tr>
			<tr>
				<td>Pukul</td>
				<td> : </td>
				<td><?php echo $surat['pukul']; ?></td>
			</tr>
			<tr>
				<td>Tempat Kelahiran</td>
				<td> : </td>
				<td><?php echo $surat['tempat_lahir']; ?></td>
			</tr>
		</table>
		<p>
			Telah lahir seorang anak <?php echo $surat['jenis_kelamin']=='L' ? 'Laki-laki' :'Perempuan' ?> bernama: <span style="font-weight: bold;" ><?php echo $surat['nama']; ?></span>
		</p>
		<p style="font-weight: bold;" >Dari seorang ibu: </p>
		<table>
			<tr>
				<td>Nama lengkap</td>
				<td> : </td>
				<td><?php echo $ibu['nama_warga']; ?></td>
			</tr>
			<tr>
				<td>NIK</td>
				<td> : </td>
				<td><?php echo $ibu['nik_warga']; ?></td>
			</tr>
			<tr>
				<td>Umur</td>
				<td> : </td>
				<td><?php echo $umur_ibu; ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td> : </td>
				<td><?php echo $ibu['pekerjaan_warga']; ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$ibu['rt_warga'].' RW '.$ibu['rw_warga'] ?></td>
			</tr>
		</table>
		<p>
			<span style="font-weight: bold;" >Istri dari: </span>
		</p>
		<table>
			<tr>
				<td>Nama lengkap</td>
				<td> : </td>
				<td><?php echo $ayah['nama_warga']; ?></td>
			</tr>
			<tr>
				<td>NIK</td>
				<td> : </td>
				<td><?php echo $ayah['nik_warga']; ?></td>
			</tr>
			<tr>
				<td>Umur</td>
				<td> : </td>
				<td><?php echo $umur_ayah; ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td> : </td>
				<td><?php echo $ayah['pekerjaan_warga']; ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$ayah['rt_warga'].' RW '.$ayah['rw_warga'] ?></td>
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
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$pelapor['rt_warga'].' RW '.$pelapor['rw_warga']?></td>
			</tr>
			<tr>
				<td>Hubungan pelapor dengan bayi</td>
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
						<p style="margin-bottom: -5px;" ><?php echo $profil['nama_desa']; ?>, <?php echo date('d').' '.$bulan[date('m')-1].' '.date('Y'); ?></p>
						<p>Kepala Desa <?php echo $profil['nama_desa']; ?></p>
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