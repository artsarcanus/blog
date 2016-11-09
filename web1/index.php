<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Free Crocodile Iphone, Android & Smartphone Mobile Website Template | Home :: w3layouts</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div class="header">
    <div class="wrap">
            <div class="logo"><a href="index.php"><img src="images/logo.png" alt="crocodile" /></a></div>
            <div class="headerbox">
                <div class="login">
                    <ul>
                        <li><a href="#">Sign in</a></li> |
                        <li><a href="single.php">Register</a></li>
                    </ul>
                </div>
                <div class="search">
                    <form>
                        <input type="text" value="Search" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Search';}">
                        <input type="submit" value="Go" />
                    </form>
                </div>
            </div>
        <div class="clear"></div>
    </div>
</div>
<div class="wrap">
    <div class="main">
        <div class="nav">
        <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="clear"></div>
    </div>
        <div class="content">
         <?php 
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT articles.id, articles.title,articles.publicationDate, articles.summary, articles.content, categories.nombre from articles inner join categories on articles.categories_id=categories.id order by articles.publicationDate desc limit 0,5';
                       foreach ($pdo->query($sql) as $row) {          
                                echo '<td>'.$row['title'] .'</td>';
                                echo '<h6>'. $row['publicationDate'] .'</h6>';
                                echo '<h6>'. $row['summary'] . '</h6>';
                                echo '<h6>'. $row['nombre'] . '</h6>';
                                echo '<p>'. $row['content'] . '</p>';
                                echo '<a  href="read.php?id='.$row['id'].'" >Read More</a><br><br>';
                       }
                       Database::disconnect();
                      ?>
        </div>  
        <div class="sidebar">
            <div class="recent">
                <h3>Recent Posts...</h3>
                <ul><?php
                       $pdo = Database::connect();
                       $sql = 'SELECT id, title from cms1.articles  order by publicationDate desc limit 0,5';
                       foreach ($pdo->query($sql) as $row) {
                                echo "<li><a  href='read.php?id=".$row['id']."' > ".$row['title'] ."</a></li>";
                       }
                       Database::disconnect();
                      ?>
                </ul>
            </div>
            <h3>Blog Categories</h3>
                <ul><?php
                       $pdo = Database::connect();
                       $sql = 'SELECT id,nombre, publicaciones from cms1.categories  order by nombre ';
                       foreach ($pdo->query($sql) as $row) {
                                echo "<li><a  href='read_categories.php?id=".$row['id']."' > ".$row['nombre'] ." (".$row['publicaciones'].")</a></li>";
                       }
                       Database::disconnect();
                      ?>
        
                </ul>
            <div class="add">
                <a href="#"><img src="images/add.png" align="300x250" /></a>
            </div>
        </div>
     <div class="clear"></div>
   </div>
<div class="f-menu">
    <ul>
        <h4>Our Sponcers</h4>
        <li><a href="index.html">simply dummy text of the printing</a></li>
        <li><a href="#">simply dummy text of the printing</a></li>
        <li><a href="#">simply dummy text of the printing</a></li>
    </ul>
    <ul>
        <h4>Follow on</h4>
        <li><a href="index.html">simply dummy text of the printing</a></li>
        <li><a href="#">simply dummy text of the printing</a></li>
        <li><a href="#">simply dummy text of the printing</a></li>
    </ul>
    <ul>
        <h4>Contact</h4>
        <li><input type="text" value=""  /></li>
        <li><textarea></textarea></li>
        <li><input type="submit" value="Send" /></li>
    </ul>
        <div class="clear"></div>
    <div class="copy">� 2012 All rights reserved. Designed by <a href="http://w3layouts.com">W3Layouts</a> Powered by <a href="http://bigw3.com">Bigw3</a></div>
</div>
</div>
</body>
</html>
