<?php
include 'partials/header.php';
require 'users.php';
include("connect.php");


 
 
if (isset($_POST['isbn'])) {
    $id = $_POST['isbn'];
    $checkid = $conn->prepare("select * from crud_application where isbn = '" . $id . "'"); // to check id
    $checkid->execute();
    if ($checkid->rowCount() > 0) {
		$insert_query = $conn->prepare("delete from crud_application where isbn = :id"); //to insert data
        try {
            $conn->beginTransaction();
			$insert_query->bindParam(":id", $id);
            $count = $insert_query->execute();
			
            if ($count> 0) {
                header("Location: index.php?message=Record has been Deleted successfully"); //success data insertion
            } else {
                header("Location: index.php?message=Failed to Delete"); //failure data insertion
            }
            $conn->commit();
        }
        catch (PDOExecption $e) {
            $dbh->rollback();
            print "Error!: " . $conn->getMessage() . "</br>"; //exception
        }
        
    } else {
        header("Location: index.php?message=Invalid Request");
    }
}

?>
