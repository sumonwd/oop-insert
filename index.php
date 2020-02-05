<?php 
    require_once 'config.php';
    $db = new Database();
    // View data
    $all_info = $db->view('try');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
            <p><a href="insert.php" class="btn btn-success btn-lg">Add</a></p>
                <table class="table table-dark table-bordered">
                    <thead class="">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_info as  $info): ?>
                        <tr>
                            <td><?php echo $info['id']; ?></td>
                            <td><?php echo $info['title']; ?></td>
                            <td><?php echo $info['description']; ?></td>
                            <td>
                                <img width="100" src="uploads/<?php echo $info['photo']; ?>" alt="">    
                            </td>
                            <td>
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $info['id']; ?>">Delete</a>
                                <a class="btn btn-info" href="edit.php?id=<?php echo $info['id']; ?>">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</body>
</html>