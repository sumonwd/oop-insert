<?php 
    require_once 'config.php';
    $db = new Database();
    $get_id = $_GET['id'];
    
    // select image 
    $image = $db->select_id('try', $get_id);
    $delete = 'uploads/' . $image['photo'];
    unlink($delete);

    // delete from all data
    $all_delete = $db->delete('try', $get_id);
    if ($all_delete == true) {
        header('location: index.php');
    }

?>