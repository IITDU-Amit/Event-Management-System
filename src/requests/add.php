<?php
	include("../System/System.php");
    $system = new System();
    if($system->userTypeLoggedIn() != "admin"){
        $system->redirectToHomePage();
        die();
    }
    $email = $_GET['email'];
    $name = $system->getPropertyByEmailInTable($email,"requests","name");
    $roll = $system->getPropertyByEmailInTable($email,"requests","roll");
    $password = $system->getPropertyByEmailInTable($email,"requests","password");
    $system->addStudent($name,$roll,$email,$password);
    $system->removeUserWithEmailInTable($email,"requests");
    $email = $system->clean($email);
    $sql = "CREATE TABLE $email(
                url varchar(30)
            )";
    $system->executeNotificationQuery($sql);
    header("refresh:0; url=http://localhost/mis/studentList");
?>
