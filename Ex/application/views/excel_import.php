<html>
<head>
	<title>Excel Import</title>
</head>
<body>
	<h1>Excel Import</h1>
	<?php
	echo form_open_multipart('excel-import/import-data');
	echo form_upload('file');
	echo '<br/>';
	echo form_submit(null, 'Upload');
	echo form_close();
	?>
	<h4>Total data : <?php echo $num_rows;?></h4>
</body>
</html>