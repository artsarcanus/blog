<?php 
	require '../database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM cms1.articles where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}

	if ( !empty($_POST)) {
		// keep track validation errors
		$PublicationDateError = null;
		$titleError = null;
		$summaryError = null;
		$contentError = null;
		$categories_id_Error = null;
		
		// keep track post values
		$coment = $_POST['coment'];
		$aux=mysql_real_escape_string($_POST['comentDate']);
		$comentDate= date('Y-m-d',strtotime(str_replace('-', '/', $aux)));

		// validate input
		$valid = true;
		if (empty($comentDate)) {
			$comentDateError = 'Please enter a valid Date';
			$valid = false;
		}	

		$valid = true;
		if (empty($coment)) {
			$comentError = 'Please enter a valid Title';
			$valid = false;
		}
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO cms1.coment (publicationDate_c,content_c,articles_id) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($comentDate,$coment,$id));
			Database::disconnect();
			header("Location:read.php");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3><?php echo $data['title'];?></h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >

					  <div class="control-group">
					    <label class="control-label">Publication Date: </label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['publicationDate'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Summary</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['summary'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Content: </label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['content'];?>
						    </label>
					    </div>
					  </div>
					  <div class="form-horizontal" class="span10 offset1">
		              <?php 
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM cms1.coment WHERE articles_id='.$id.' ORDER BY publicationDate_c DESC';
	 				   foreach ($pdo->query($sql) as $row) {
	 				   	echo "".$row['publicationDate_c']."<br>";
	 				   	echo "".$row['content_c']."<br>";
							   	echo '<a class="btn btn-danger btn-sm" href="delete.php?id='.$row['id'].'">Delete</a><br>';
					   }
					   Database::disconnect();
					  ?></div>
					  <form class="form-horizontal" action="" method="post">
					  
					  <div class="control-group <?php echo !empty($comentDateError)?'error':'';?>">
					    <label class="control-label">Comentary Date</label>
					    <div class="controls">
					      	<input name="comentDate" type="date" maxlength="10" placeholder="YYYY-MM-DD" value="<?php echo !empty($comentDateError)?$comentError:'';?>">
					      	<?php if (!empty($comentDateError)): ?>
					      		<span class="help-inline"><?php echo $comentDateError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($comentError)?'error':'';?>">
					    <label class="control-label">Comentary</label>
					    <div class="controls">
					      	<input name="coment" type="text" placeholder="Your Comentary" value="<?php echo !empty($coment)?$title:'';?>">
					      	<?php if (!empty($comentError)): ?>
					      		<span class="help-inline"><?php echo $comentError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Add Comentary</button>
						  <a class="btn" href="index.php">Back</a>
					</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>