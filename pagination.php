<?php
$post_per_page = 3;
$offset = 0;
$page = 1;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $offset = $page * $post_per_page - $post_per_page;
}
$sql = "select * from people limit $post_per_page offset $offset ";
$connection = new PDO('mysql:dbname=feni;host=localhost', 'root', '');
$statement = $connection->prepare($sql);
$statement->execute();


$statement2 = $connection->query('select * from people');
$statement2->execute();
$total = $statement2->rowCount();

$people = $statement->fetchAll(PDO::FETCH_OBJ);
$total_page = ceil($total / $post_per_page) ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
</head>
<body class="bg-info">
  <div class="container">

  <div class="card my-5">
    <div class="card-header">
      <h2>
        <a href="/" class="btn btn-link">All people</a>
      </h2>
    </div>
    <div class="row">
    </div>
    <div class="card-body">
      <?php if (count($people)): ?>
      <table class="table table-bordered">
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
        </tr>
        <?php foreach( $people as $person): ?>
          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->name; ?></td>
            <td><?= $person->email; ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item <?php echo $page < 2 ? 'disabled' : '' ?>"><a class="page-link" href="/?page=<?= $page - 1 ?>">Previous</a></li>
          <?php for($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?php echo $page == $i ? 'active': ''  ?>"><a class="page-link" href="/?page=<?= $i ?>"><?= $i ?></a></li>
          <?php endfor; ?>
          <li class="page-item <?php echo $page > 3 ? 'disabled': '' ?> "><a class="page-link" href="/?page=<?= $page + 1 ?>">Next</a></li>
        </ul>
      </nav>
      <?php else: ?>
      <h2>NO result found</h2>
      <?php endif; ?>
    </div>
  </div>
  
  </div>
</body>
</html>