<!DOCTYPE html>
<html>
<head>
	<title>Excel Import</title>
	<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
	<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>	
</head>

<body>
	<h1>Excel Import</h1>
	<?php
	echo form_open_multipart('Excel_import/import');
	echo form_upload('file');
	echo '<br/>';
	echo form_submit(null, 'Upload');
	echo form_close();
	?>		
	<!-- <h4>Total data : <?php echo $table_data->num_rows(); ?></h4> -->
	<br>
	<br>
	<a class="btn btn-primary"href="<?php echo base_url()."Report/index";?>">Genrate Report</a>
</body>
</html>