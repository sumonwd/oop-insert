<?php 
    require_once 'config.php';
    $db = new Database();
    // code fon insert
    $title = $description = $photo = "";
    $title_err = $description_err = $photo_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['title'])) {
            $title_err = "Title filed Required";
        } else {
            $title = $_POST['title'];
        }
        if (empty($_POST['description'])) {
            $description_err = "Description filed Required";
        } else {
            $description = $_POST['description'];
        }

        // code for file upload 
        $file = $_FILES['photo'];
        $filename = $file['name'];
        $filesize = $file['size'];
        $filetmp = $file['tmp_name'];
        $explode = explode('.', $filename);
        $ext = end($explode);
        $allowed = array('jpg', 'jpeg', 'png', 'gif');


        if (empty($file)) {
            $photo_err = "Photo filed Required";
        } else if (!in_array($ext, $allowed)) {
            $photo_err = "Please chooage only jpg, png, jpeg, gif";
        } else if ($filesize > 2097152) {
            $photo_err = "File size winth 2MB must !";
        } else {
            date_default_timezone_set('asia/dhaka');
            $gettime = rand(99) . date('dmyhis');
            $cre_name = $gettime . '.' . $ext;
        }

        $all_data = array(
            'title' => $title,
            'description' => $description,
            'photo' => $cre_name,
        );
        if (empty($title_err) && empty($description_err) && empty($photo_err)) {
            $upload_folder = 'uploads/' . $cre_name;
            $insert = $db->insert('try', $all_data);
            if ($insert == true) {
                move_uploaded_file($filetmp, $upload_folder);
                header('location: index.php');
            }
        }
    }

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
            <div class="col-md-6 mx-auto">
                <div class="card bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Add Product</h5>
                        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data"> 
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" class="form-control" type="text" name="title" value="<?php echo $title ?>">
                                <span class="text-danger"><?php echo $title_err ?></span>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input id="description" class="form-control" type="text" name="description" value="<?php echo $description ?>">
                                <span class="text-danger"><?php echo $description_err ?></span>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input id="photo" class="form-control-file" type="file" name="photo">
                                <span class="text-danger"><?php echo $photo_err ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <input type="submit" value="Insert" class="btn btn-info">
                                <p><a href="index.php" class="btn btn-info">View</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>