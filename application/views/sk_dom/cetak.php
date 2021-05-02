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
		<h3>SURAT KETERANGAN DOMISILI</h3>
		<P>Nomor: <?php echo $calon['nomor_surat']; ?></P>
	</div>
	<div class="body">
		<div style="text-align: justify;" >
			<p>Yang bertanda tangan dibawah ini, Kepala Desa Desa....</p>
			<p>Kecamatan....Kabupaten...Menerangkan dengan sebenarnya bahwa:</p>
		</div>
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
				<td>Jenis Kelamin</td>
				<td> : </td>
				<td>
					<?php if($calon['jenis_kelamin_warga']=='P'){
						echo "Perempuan";
					}else{
						echo "Laki - laki";
					}  ?>
					
				</td>
			</tr>
			<tr>
				<td>Tempat/Tanggal Lahir</td>
				<td> : </td>
				<td><?php echo $calon['tempat_lahir_warga'].'/'.date('d M Y',strtotime($calon['tanggal_lahir_warga'])); ?></td>
			</tr>
			<tr>
				<td>Agama</td>
				<td> : </td>
				<td><?php echo $calon['agama_warga']; ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td> : </td>
				<td><?php echo $calon['pekerjaan_warga']; ?></td>
			</tr>
			<tr>
				<td>Alamat Domsili</td>
				<td> : </td>
				<td><?php echo $calon['alamat_warga']; ?></td>
			</tr>
		</table>
		<p>Adalah benar penduduk desa ...... Kecamatan.... Kabupaten ......</p>
		<p>Demikian surat keterangan ini kammu buat dengan sebenarnya agar dapat dipergunakan seperlunya</p>
	</div>
	<div style="display: flex;justify-content: flex-end;width: 100%;">
		<div>
			
		</div>
		<div>
			<p><?php echo date('d M Y'); ?></p>
			<p>Kepala Desa</p>
			<br>
			<br>
			<p>................</p>
		</div>
	</div>

</body>
</html>