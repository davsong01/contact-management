<?php
include 'functions.php';
if(empty($_GET['action'])){
    $message[] = 'SUCESS: False';
    $message[]= 'Sorry, you did not define an action to perform';
    echo json_encode($message);
    
}
else{

//Done
$action = $_GET['action'];
switch ($action) {
    case 'add':
    if(empty($_POST['phone']) || empty($_POST['name']) ||is_numeric($_POST['name']) || !is_numeric($_POST['phone'])){
        $message[] = 'SUCESS: False';
        $message[]= 'Invalid format for phone number, Name is empty!';
        echo json_encode($message);
    }
    else{
        $phone = $_POST['phone'];
        $name = ucfirst($_POST['name']);
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $gender = $_POST['gender'];

        addContact($name, $phone, $email, $bio, $gender);
        //echo json_encode(addContact($name, $phone, $email, $bio));
        savePhonebook();
    }
        break;

    //done
    case 'delete':
    if(empty($_POST['id'])){
        $message[] = 'SUCESS: False';
        $message[]= 'Contact Identification is invalid';
        echo json_encode($message); 
    }

    else{
        $contact = $_POST['id'];
        deleteContact($contact);
        $message[] = 'SUCESS: True';
        echo json_encode($message);
        savePhonebook();
    }  
        break;
   //done
    case 'view':
        echo json_encode(viewContact());
        break;

        
    case 'update':
        if((($_POST['id']=='') && ((empty($_POST['name']) || empty($_POST['phone']))|| empty($_POST['bio']) || empty($_POST['email'])))){
            $message[] = 'SUCESS: False';
            $message[]= 'id, name, phone is invalid';
            echo json_encode($message);
        }
        else{
            $id = $_POST['id'];
            $newName = ucfirst($_POST['name']);
            $newPhone = $_POST['phone'];
            $email=$_POST['email'];
            $bio=$_POST['bio'];
            
            echo json_encode(editContact($id, $newName, $newPhone, $email, $bio)); 
            savePhonebook();
        }
        break;

    case 'search':
    $n = ucfirst($_POST['keyword']);
            echo json_encode(searchContact($n));
        break;
    default:
        echo 'There is an error, please check inputs';
        break;

    case 'deleteall';
        echo Json_encode(deleteAll());
}} 
?>
