<?php 
	require '../database.php';
	$id = 0;
	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql2 = "UPDATE cms1.categories  set publicaciones = publicaciones-1 WHERE id =?";
		$q2 = $pdo->prepare($sql2);
		$q2->execute(array($id));
		$sql1 = "DELETE FROM cms1.coment  WHERE articles_id = ?";
		$q1 = $pdo->prepare($sql1);
		$q1->execute(array($id));
		$sql = "DELETE FROM cms1.articles  WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		Database::disconnect();
		header("Location: index.php");		
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
		    			<h3>
		    			<?php
					    $pdo = Database::connect();
					   $sql = 'SELECT title FROM cms1.articles WHERE id='.$id.'';
	 				   foreach ($pdo->query($sql) as $row){
	 				   echo 'Delete Aticle '.$row['title'].'';	
	 				   }
					   Database::disconnect();  
					    ?>
					    	
					    </h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="delete.php" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Are you sure to delete the publication<br>and all the coments?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="index.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>