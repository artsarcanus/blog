<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="row">
    		<h3>Publications Bank</h3>
    		<p>
				<a href="admin/index.php" class="btn btn-success">Admin</a>
				<a href="post/index.php" class="btn btn-success">Post</a>
				<a href="user/index.php" class="btn btn-success">User</a>
					
			</p>
    	</div>
    </div>		
    <div class="container">
			<div class="row">
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Publication Bank</th>
		                  <th>Titles</th>
		                  <th>Summaries</th>
		                  <th>Contents</th>
		                  <th>Categories</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT articles.id, articles.title,articles.publicationDate, articles.summary, articles.content, categories.nombre from articles inner join categories on articles.categories_id=categories.id order by articles.publicationDate desc';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo "<tr>";
							   	echo "<td>". $row['publicationDate'] . "</td>";
							   	echo "<td><a  href='read.php?id=".$row['id']."' > ".$row['title'] ."</a></td>";
							   	echo '<td>'. $row['summary'] . '</td>';
							   	echo '<td>'. $row['content'] . '</td>';
							   	echo '<td>'. $row['nombre'] . '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>