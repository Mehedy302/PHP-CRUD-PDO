<?php
include 'partials/header.php';
require 'users.php';
include("connect.php");


$user = [
    'title' => '',
    'author' => '',
    'available' => '',
    'pages' => '',
    'isbn' => '',
     
];

$errors = [
    'title' => '',
    'author' => '',
    'available' => '',
    'pages' => '',
    'isbn' => '',
];
$isValid = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = array_merge($user, $_POST);
    $title = $user['title']; 
    $author = $user['author'];
    $available = $user['available'];
    $pages = $user['pages'];
    $isbn = $user['isbn'];

    $isValid = validateUser($user, $errors);

    if ($isValid) {
        $insert_query = $conn->prepare("insert into crud_application (title, author, available,pages,isbn) values (:title,:author,:available,:pages,:isbn)"); //to insert data
        try {
            $conn->beginTransaction();
            $insert_query->bindParam(":title", $title);
            $insert_query->bindParam(":author", $author);
            $insert_query->bindParam(":available", $available);
            $insert_query->bindParam(":pages", $pages);
            $insert_query->bindParam(":isbn", $isbn);
            
            $insert_query->execute();
            if ($conn->lastInsertId() > 0) {
                header("Location: index.php?message=Record has been inserted successfully"); //success data insertion
            } else {
                header("Location: index.php?message=Failed to insert"); //failure data insertion
            }
            $conn->commit();
        }
        catch (PDOExecption $e) {
            $dbh->rollback();
            print "Error!: " . $conn->getMessage() . "</br>"; //exception
        }
         

        header("Location: index.php");
    }
}

?>

<?php include '_form.php' ?>

