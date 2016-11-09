<?php 
	require 'database.php';
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
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
					    <div class="form-actions">
						  <a class="btn" href="index.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>