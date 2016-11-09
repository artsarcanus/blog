    <div class="container">
      <div class="page-header">
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