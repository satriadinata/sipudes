<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.head{
			text-align: center;
		}
		.tab {
            display: inline-block;
            margin-left: 40px;
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

		<h3 style="text-decoration: underline;" >SURAT PERNYATAAN</h3>
		<P>Nomor: <?php echo $surat['no_surat']; ?></P>
		<p style="text-align: left;" ><span class="tab"></span>Yang bertanda tangan dibawah ini, Kepala Desa <?php echo $profil['nama_desa']; ?> Kecamatan <?php echo $profil['kec_desa']; ?> Kabupaten <?php echo $profil['kab_desa']; ?>, dengan ini menyatakan bahwa:</p>
	</div>
	<div class="body">
		<table>
			<tr>
				<td>Nama</td>
				<td> : </td>
				<td><?php echo $calon['nama_warga']; ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td> : </td>
				<td><?php echo 'DESA '.$profil['nama_desa'].' RT '.$calon['rt_warga'].' RW '.$calon['rw_warga'].' KECAMATAN '.$profil['kec_desa']; ?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td> : </td>
				<td><?php echo $calon['pekerjaan_warga']; ?></td>
			</tr>
		</table>
		<p>
			<span class="tab"></span><?php echo $surat['ket_bawah']; ?>
		</p>
		<p>
			Sewaktu-waktu bersedia untuk dievaluasi/dicek kebenarannya. <br><br><span class="tab"></span>Demikian Surat pernyataan ini saya buat, apabila terdapat kesalahan saya bersedia untuk dituntut di Pengadilan.
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