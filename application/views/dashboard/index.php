<?php $this->load->view('layouts/header.php') ?>
<!-- Main content -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0"><?php echo $title; ?></h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<!-- <ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Dashboard v1</li>
				</ol> -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3>1/<span style="font-weight: normal; font-size: 20px" >a</span></h3>

						<p>Tahun Ajar</p>
					</div>
					<div class="icon">
						<i class="ion ion-calendar"></i>
					</div>
					<a href="<?php echo site_url('adminku/ta') ?>" class="small-box-footer"><i class="fas fa-calendar"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3><sup style="font-size: 20px">siswa</sup></h3>

						<p>Pendaftar</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="<?php echo site_url('adminku/pendaftaran') ?>" class="small-box-footer"><i class="ion ion-person-add"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3></h3>

						<p>Jurusan</p>
					</div>
					<div class="icon">
						<i class="fas fa-arrow-circle-left"></i>
					</div>
					<a href="<?php echo site_url('adminku/jurusan') ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3></h3>

						<p>Users</p>
					</div>
					<div class="icon">
						<i class="fas fa-user"></i>
					</div>
					<a href="<?php echo site_url('adminku/user') ?>" class="small-box-footer"><i class="fas fa-user"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row (main row) -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
	/* chart.js chart examples */

// chart colors
var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

/* large line chart */
var chLine = document.getElementById("chLine");
var chartData = {
	labels: [<?php foreach ($allTahun as $value) {
		echo "'".$value->tahun."',";
	} ?>],
	datasets: [
	{
		data: [
		<?php foreach ($allTahun as $value) {
			$tot=0; 
			foreach ($calon as $v) {
				if ($v->ta==$value->tahun) {
					$tot+=1;
				}
			};
			echo "'".$tot."',";
		} ?>
		],
		backgroundColor: colors[3],
		borderColor: colors[1],
		borderWidth: 4,
		pointBackgroundColor: colors[1]
	}]
};

if (chLine) {
	new Chart(chLine, {
		type: 'line',
		data: chartData,
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: false
					}
				}]
			},
			legend: {
				display: false
			}
		}
	});
}
</script>
<?php $this->load->view('layouts/footer.php') ?>