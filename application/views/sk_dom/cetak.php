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

		<h3>SURAT KETERANGAN PENGANTAR</h3>
		<P>Nomor: <?php echo $surat['nomor_surat']; ?></P>
		<p>Yang bertanda tangan dibawah ini, menerangkan bahwa:</p>
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
				<td>Kewarganegaraan / Agama</td>
				<td> : </td>
				<td><?php echo $calon['negara_warga'].' / '.strtoupper($calon['agama_warga']); ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td> : </td>
				<td><?php echo $calon['pekerjaan_warga']; ?></td>
			</tr>
			<tr>
				<td>Tempat Tinggal</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$calon['rt_warga'].' RW '.$calon['rw_warga']; ?></td>
			</tr>
			<tr>
				<td>Kabupaten</td>
				<td> : </td>
				<td>PROVINSI <?php echo $calon['provinsi_warga']; ?></td>
			</tr>
			<tr>
				<td>Surat Bukti Diri</td>
				<td> : </td>
				<td><?php echo $surat['surat_bukti_diri']; ?></td>
			</tr>
			<tr>
				<td>Keperluan</td>
				<td> : </td>
				<td><?php echo strtoupper($surat['keperluan']); ?></td>
			</tr>
			<tr>
				<td>Berlaku Mulai</td>
				<td> : </td>
				<td><?php echo date('d-m-Y').' s/d SEPERLUNYA'; ?></td>
			</tr>
			<tr>
				<td>Keterangan lain-lain</td>
				<td> : </td>
				<td><?php echo strtoupper($surat['keterangan_lain']); ?></td>
			</tr>
		</table>
		<div style="text-align: center;" >
			<p>Demikian untuk menjadikan maklum bagi yang berkepentingan</p>
			<div style="padding-left: 30%;" >
				<table>
					<tr>
						<td>Nomor</td>
						<td> : </td>
						<td></td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td> : </td>
						<td><?php echo date('d-m-Y'); ?></td>
					</tr>
					<tr>
						<td>Mengetahui</td>
						<td> : </td>
						<td></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<table style="padding:10px;width: 100%;" >
		<tr>
			<td>Tanda Tangan Pemegang</td>
			<td>Camat <?php echo $profil['kec_desa']; ?></td>
			<td>Kepala Desa <?php echo $profil['nama_desa']; ?></td>
		</tr>
		<tr>
			<td>
				<br>
				<br>
				<br>
				<br>
				<br>
			</td>
			<td>
				<br>
				<br>
				<br>
				<br>
				<br>
			</td>
			<td>
				<br>
				<br>
				<br>
				<br>
				<br>
			</td>
		</tr>
		<tr>
			<td><?php echo $calon['nama_warga']; ?></td>
			<td>.....................</td>
			<td><?php echo $kepdes['nama_warga']; ?></td>
		</tr>
	</table>
</body>
</html>