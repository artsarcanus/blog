<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <h3>Publications Bank</h3>
      <a class="btn" href="index.php">Home</a>
      <a class="btn" href="create.php">Create</a>    
      </div>
    </div>  

         <div class="container">
      <div class="page-header">
        <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Publication Date</th>
                      <th>Titles</th>
                      <th>Summaries</th>
                      <th>Contents</th>
                      <th>Categories</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
             include '../database.php';
             $pdo = Database::connect();
             $sql = 'SELECT articles.id, articles.title,articles.publicationDate, articles.summary, articles.content, categories.nombre from articles inner join categories on articles.categories_id=categories.id order by articles.publicationDate desc';
             foreach ($pdo->query($sql) as $row) {
                  echo "<tr>";
                  echo "<td>". $row['publicationDate'] . "</td>";
                  echo "<td><a  href='read.php?id=".$row['id']."' > ".$row['title'] ."</a></td>";
                  echo '<td>'. $row['summary'] . '</td>';
                  echo '<td>'. $row['content'] . '</td>';
                  echo '<td>'. $row['nombre'] . '</td>';
                  echo '<td width=250>';
                  echo '&nbsp;';
                  echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                  echo '&nbsp;';
                  echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                  echo '</td>';
                  echo '</tr>';
             }
             Database::disconnect();
            ?>
              </tbody>
              </table>
      </div>
    </div> <!-- /container -->
    <div id="footer">
      <div class="container">
        <p class="muted credit">Aqui sera un footer.</p>
      </div>
    </div>
  </body>
</html>