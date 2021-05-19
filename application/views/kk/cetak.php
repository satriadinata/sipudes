<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css"> -->
</head>
<style type="text/css">
	body{
		font-family: Arial, sans-serif;
		font-size: 12px;
	}
	table{
		border-collapse: collapse;
	}
	li{
		list-style-type: none;
	}
	.table td, .table th{
		padding: 1px;
		border-style: solid;
		border-width: 2px;
		border-color: black;
	}
	.table th{
		text-align:center;
		align-items: center;
	}
</style>
<body>
	<div style="text-align: center;" >
		<h1>PEMUTAKHIRAN DATA KARTU KELUARGA</h1>
		<h2>No. <?php echo $calon['nomor_keluarga']; ?></h2>
	</div>
	<div class="row" style="position: relative; height: 100px; " >
		<table style="position: absolute;left: 15;" >
			<tr>
				<td>Nama Kepala Keluarga</td>
				<td style="padding-left: 8px;padding-right: 8px;" > : </td>
				<td><?php echo $kepala['nama_warga']; ?></td>


			</tr>
			<tr>
				<td>Alamat</td>
				<td style="padding-left: 8px;padding-right: 8px;" > : </td>
				<td><?php echo $calon['alamat_keluarga'];?></td>


			</tr>
			<tr>
				<td>RT/RW</td>
				<td style="padding-left: 8px;padding-right: 8px;" > : </td>
				<td><?php echo $calon['rt_keluarga'].'/'.$calon['rw_keluarga']; ?></td>

			</tr>
			<tr>
				<td>Desa/Kelurahan</td>
				<td style="padding-left: 8px;padding-right: 8px;" > : </td>
				<td><?php echo $calon['desa_kelurahan_keluarga']; ?></td>

			</tr>
		</table>

		<table style="position: absolute;right: 200;" >
			<tr>

				<td>Kecamatan</td>
				<td style="padding-left: 8px;padding-right: 8px;" > : </td>
				<td><?php echo $calon['kecamatan_keluarga']; ?></td>
			</tr>
			<tr>

				<td>Kabupaten/Kota</td>
				<td style="padding-left: 8px;padding-right: 8px;" > : </td>
				<td><?php echo $calon['kabupaten_kota_keluarga'];?></td>
			</tr>
			<tr>

				<td>Kode Pos</td>
				<td style="padding-left: 8px;padding-right: 8px;" > : </td>
				<td><?php echo $calon['kode_pos_keluarga']?></td>
			</tr>
			<tr>

				<td>Provinsi</td>
				<td style="padding-left: 8px;padding-right: 8px;" > : </td>
				<td><?php echo $calon['provinsi_keluarga']; ?></td>
			</tr>
		</table>
	</div>
	<div class="body" style="height: 300;">
		<table style="width: 100%;" class="table table-bordered">
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
				<tr style="text-align: center;background:rgba(0,0,0,.1);" >
					<td></td>
					<td>(1)</td>
					<td>(2)</td>
					<td>(3)</td>
					<td>(4)</td>
					<td>(5)</td>
					<td>(6)</td>
					<td>(7)</td>
					<td>(8)</td>
				</tr>
			<!-- <tr>
				<td><?php $no=1; echo $no; ?></td>
				<td><?php echo $kepala['nama_warga']; ?></td>
				<td><?php echo $kepala['nik_warga']; ?></td>
				<td><?php echo $kepala['jenis_kelamin_warga']; ?></td>
				<td><?php echo $kepala['tempat_lahir_warga']; ?></td>
				<td><?php echo $kepala['tanggal_lahir_warga']; ?></td>
				<td><?php echo $kepala['agama_warga']; ?></td>
				<td><?php echo $kepala['pendidikan_terakhir_warga']; ?></td>
				<td><?php echo $kepala['pekerjaan_warga']; $no++;?></td>
			</tr> -->
			<?php $no=1;foreach ($anggota as $key => $value) :?>
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
	<br>
	<br>
	<table style="width: 100%;" class="table table-bordered">
		<thead>
			<th rowspan="2" >No</th>
			<th rowspan="2" >Status Pernikahan</th>
			<th rowspan="2" >Status Hubungan Dalam Keluarga</th>
			<th rowspan="2" >Kewarganegaraan</th>
			<th colspan="2" >Dokumen Imigrasi</th>
			<th colspan="2" >Nama Orang Tua</th>
		</thead>
		<thead>
		<!-- 	<th></th>
			<th></th>
			<th></th>
			<th></th> -->
			<th>No. Paspor</th>
			<th>No. KIT AS/KIT AP</th>
			<th>Ayah</th>
			<th>Ibu</th>
		</thead>
		<tbody>
			<tr style="text-align: center;background:rgba(0,0,0,.1);" >
				<td></td>
				<td>(9)</td>
				<td>(10)</td>
				<td>(11)</td>
				<td>(12)</td>
				<td>(13)</td>
				<td>(14)</td>
				<td>(15)</td>
			</tr>
		<!-- 	<tr>
				<td><?php $no=1; echo $no; ?></td>
				<td><?php echo $kepala['nama_warga']; ?></td>
				<td><?php echo $kepala['nik_warga']; ?></td>
				<td><?php echo $kepala['jenis_kelamin_warga']; ?></td>
				<td><?php echo $kepala['tempat_lahir_warga']; ?></td>
				<td><?php echo $kepala['tanggal_lahir_warga']; ?></td>
				<td><?php echo $kepala['agama_warga']; ?></td>
				<td><?php echo $kepala['pendidikan_terakhir_warga']; $no++;?></td>
			</tr> -->
			<?php $no=1;foreach ($anggota as $key => $value) :?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $value->status_perkawinan_warga?></td>
				<td><?php echo $value->shdk?></td>
				<td><?php echo ($value->negara_warga=='Indonesia'||$value->negara_warga=='indonesia'||$value->negara_warga=='INDONESIA') ? 'WNI' :'WNA' ?></td>
				<td><?php echo $value->no_paspor?></td>
				<td><?php echo $value->no_kit_as_ap?></td>
				<td><?php echo $value->ayah?></td>
				<td><?php echo $value->ibu?></td>
			</tr>
			<?php $no++; endforeach ?>
		</tbody>
	</table>
</div>
<div style="position: relative;width: 100%;">
	<div style="position: absolute;right: -760;text-align: center;" >
		<p>KEPALA KELUARGA</p>
		<br>
		<br>
		<h4 style="text-decoration: underline;margin-bottom: -6px;" ><?php echo $kepala['nama_warga']; ?></h4>
		<p>Tanda Tangan/Cap Jempol</p>
	</div>
</div>
</body>
</html>