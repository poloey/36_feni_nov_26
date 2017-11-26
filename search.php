<?php

$sql = 'select * from people';
if (isset($_GET['nizam'])) {
  $q = $_GET['nizam'];
  $sql = "select * from people where name like '%$q%' or email like '%$q%' ";
}
$connection = new PDO('mysql:dbname=feni;host=localhost', 'root', '');
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);


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
      <div class="col-md-4 mx-auto mt-4">
        <form action="" method="get">
          <div class="input-group">
            <input name="nizam" type="text" class="form-control">
            <button type="submit" class="input-group-addon">search</button>
          </div>
        </form>
      </div>
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
      <?php else: ?>
      <h2>NO result found</h2>
      <?php endif; ?>
    </div>
  </div>
  
  </div>
</body>
</html>