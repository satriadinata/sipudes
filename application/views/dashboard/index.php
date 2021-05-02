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
						<h3><?php echo $kk; ?></span></h3>

						<p>Kartu Keluarga</p>
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
						<h3><?php echo $total_warga; ?></h3>
						<p>Penduduk</p>
					</div>
					<div class="icon">
						<i class="fas fa-user"></i>
					</div>
					<a href="<?php echo site_url('warga') ?>" class="small-box-footer"><i class="fas fa-user"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?php echo $rt; ?></h3>

						<p>Akun RT</p>
					</div>
					<div class="icon">
						<i class="fas fa-arrow-circle-right"></i>
					</div>
					<a href="<?php echo site_url('akun') ?>" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3><?php echo $rw; ?></h3>

						<p>Akun RW</p>
					</div>
					<div class="icon">
						<i class="fas fa-arrow-circle-left"></i>
					</div>
					<a href="<?php echo site_url('akun') ?>" class="small-box-footer"><i class="fas fa-arrow-circle-left"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row (main row) -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
<?php $this->load->view('layouts/footer.php') ?>