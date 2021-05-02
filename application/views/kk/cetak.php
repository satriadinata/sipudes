<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
</head>
<style type="text/css">
	body{
		font-family: arial;
		font-size: 14px;
	}
	li{
		list-style-type: none;
	}
	td{
		padding: 5px;
	}
</style>
<body>
	<div style="text-align: center;" >
		<h2>Kartu Keluarga</h2>
		<p>Nomor : <?php echo $calon['nomor_keluarga']; ?></p>
	</div>
	<div>
		<table>
			<tr>
				<td>Nama Kepala Keluarga</td>
				<td> : </td>
				<td><?php echo $kepala['nama_warga']; ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td> : </td>
				<td><?php echo $calon['alamat_keluarga'];?></td>
			</tr>
			<tr>
				<td>RT/RW</td>
				<td> : </td>
				<td><?php echo $calon['rt_keluarga'].'/'.$calon['rw_keluarga']; ?></td>
			</tr>
			<tr>
				<td>Kode Pos</td>
				<td> : </td>
				<td><?php echo $calon['kode_pos_keluarga']; ?></td>
			</tr>
		</table>
	</div>
	<table class="table table-bordered" >
		<thead>
			<th>No</th>
			<th>Nama Lengkap</th>
			<th>NIK</th>
			<th>Jenis Kelamin</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
			<th>Agama</th>
			<th>Pendidikan</th>
			<th>Jenis Pekerjaan</th>
		</thead>
		<tbody>
			<tr>
				<td><?php $no=1; echo $no; ?></td>
				<td><?php echo $kepala['nama_warga']; ?></td>
				<td><?php echo $kepala['nik_warga']; ?></td>
				<td><?php echo $kepala['jenis_kelamin_warga']; ?></td>
				<td><?php echo $kepala['tempat_lahir_warga']; ?></td>
				<td><?php echo $kepala['tanggal_lahir_warga']; ?></td>
				<td><?php echo $kepala['agama_warga']; ?></td>
				<td><?php echo $kepala['pendidikan_terakhir_warga']; ?></td>
				<td><?php echo $kepala['pekerjaan_warga']; $no++;?></td>
			</tr>
			<?php foreach ($anggota as $key => $value) :?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $value->nama_warga?></td>
					<td><?php echo $value->nik_warga?></td>
					<td><?php echo $value->jenis_kelamin_warga?></td>
					<td><?php echo $value->tempat_lahir_warga?></td>
					<td><?php echo $value->tanggal_lahir_warga?></td>
					<td><?php echo $value->agama_warga?></td>
					<td><?php echo $value->pendidikan_terakhir_warga?></td>
					<td><?php echo $value->pekerjaan_warga?></td>
				</tr>
				<?php $no++; endforeach ?>
			</tbody>
		</table>
		<div style="display: flex;justify-content: flex-end;width: 100%;float: right;">
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