<!DOCTYPE html>
<html>
<head>
	<title>Excel Import</title>
	<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
	<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>	
	<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/excel_import.css');?>">
</head>

<body>
<div class="card text-center">
  <div  class="card-header">
  	<div class="row">
		<div class="col" align="center">
    <h5 class="card-title">Excel Import </h5>
    	</div>
    	<div class="col" align="center">
    <h5 class="card-title">Reports</h5>
    	</div>
  </div>
  <div class="card-header">
	<div class="row">
		<div id="container" class="col" align="center">
			<h5 class="card-title">Select Dump File</h5>
				<?php
					echo form_open_multipart('Excel_import/import'); 
					// echo form_upload('file');?>
					<input type="file" name="file" size="20" />
				<?php
					echo '<br/>';
					echo form_submit(null,'Upload',"class='big-button'");
					echo form_close();
				?>		
				<!-- <h4>Total data : <?php echo $table_data->num_rows(); ?></h4> -->  		
		</div>   	 	
    	<div id="container" class="col" align="center">
    		<a href="<?php echo base_url()."Report/index";?>">
    			<button class="big-button" data-action="submit" style="margin: 75px auto;">
    			Generate Report
    			</button>
    		</a>
		</div>
  	</div>

    
  </div>
</div>	
</body>
</html>