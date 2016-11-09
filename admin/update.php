<?php 
	
	require '../database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$PublicationDateError = null;
		$titleError = null;
		$summaryError = null;
		$contentError = null;
		$categories_id_Error = null;
		
		// keep track post values
		$title = $_POST['title'];
		$summary = $_POST['summary'];
		$content = $_POST['content'];
		$categories_id = $_POST['categories_id'];
		$aux=mysql_real_escape_string($_POST['publicationDate']);
		$publicationDate= date('Y-m-d',strtotime(str_replace('-', '/', $aux)));

		
		/// validate input
		$valid = true;
		if (empty($publicationDate)) {
			$PublicationDateError = 'Please enter a valid Date';
			$valid = false;
		}	

		$valid = true;
		if (empty($title)) {
			$titleError = 'Please enter a valid Title';
			$valid = false;
		}

		$valid = true;
		if (empty($summary)) {
			$summaryError = 'Please enter a valid Summary';
			$valid = false;
		}
		
		
		if (empty($content)) {
			$contentError = 'Please enter a valid Content';
			$valid = false;
		}

		if (empty($categories_id)) {
			$categories_id_Error = 'Please enter a valid Categorie';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE cms1.articles  set publicationDate = ?, title = ?, summary =? , content =? , categories_id =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($publicationDate,$title,$summary,$content,$categories_id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT articles.id, articles.title,articles.publicationDate, articles.summary, articles.content, categories.nombre from articles inner join categories on articles.categories_id=categories.id  WHERE categories_id=? order by articles.publicationDate desc';
		//$sql = "SELECT * FROM cms1.articles where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$title = $data['title'];
		$publicationDate = $data['publicationDate'];
		$summary = $data['summary'];
		$content = $data['content'];
		$categories_id = $data['categories_id'];
		Database::disconnect();
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
	 				   echo 'Update Aticle '.$row['title'].'';	
	 				   }
					   Database::disconnect();  
					    ?>
					    	
					    </h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  
	    				
					  <div class="control-group <?php echo !empty($PublicationDateError)?'error':'';?>">
					    <label class="control-label">Publication Date</label>
					    <div class="controls">
					      	<input name="publicationDate" type="date" maxlength="10" placeholder="YYYY-MM-DD" value="<?php echo !empty($publicationDate)?$publicationDate:'';?>">
					      	<?php if (!empty($PublicationDateError)): ?>
					      		<span class="help-inline"><?php echo $PublicationDateError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($titleError)?'error':'';?>">
					    <label class="control-label">Title</label>
					    <div class="controls">
					      	<input name="title" type="text" placeholder="Title of Publication" value="<?php echo !empty($title)?$title:'';?>">
					      	<?php if (!empty($titleError)): ?>
					      		<span class="help-inline"><?php echo $titleError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($summaryError)?'error':'';?>">
					    <label class="control-label">Summary</label>
					    <div class="controls">
					      	<input name="summary" type="text" placeholder="Summary of Publication" value="<?php echo !empty($summary)?$summary:'';?>">
					      	<?php if (!empty($summaryError)): ?>
					      		<span class="help-inline"><?php echo $summaryError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($contentError)?'error':'';?>">
					    <label class="control-label">Content</label>
					    <div class="controls">
					      	<input name="content" type="text"  required maxlength="100000" style="height: 20em;" placeholder="Content of Publication" value="<?php echo !empty($content)?$content:'';?>">
					      	<?php if (!empty($contentError)): ?>
					      		<span class="help-inline"><?php echo $contentError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <label class="control-label <?php echo !empty($categories_id_Error)?'error':'';?>">Categories Id </label>
					  <select class="selectpicker " name="categories_id" placeholder="Pick One Categorie" value="<?php echo !empty($summary)?$summary:'';?>"><option selected="">Select a Categorie</option>
					    <?php
					    $pdo = Database::connect();
					   $sql = 'SELECT id,nombre FROM cms1.categories ORDER BY id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
	 				   	echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
					   }
					   Database::disconnect();  
					    ?>
					    <div class="controls">
					      		<?php if (!empty($summaryError)): ?>
					      		<span class="help-inline"><?php echo $summaryError;?></span>
					      		
					      	<?php endif;?>
					    </div>
					  </select>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>