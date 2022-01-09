<?php
include 'partials/header.php';
require 'users.php';
include("connect.php");

if (!isset($_POST['isbn'])) {
    include "partials/not_found.php";
    exit;
}
$userId = $_POST['isbn'];

$query = $conn->prepare("SELECT * FROM crud_application WHERE isbn = ?");
    $query->execute(array($userId));
    $user=$query->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    include "partials/not_found.php";
    exit;
}

?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View Book: <b><?php echo $user['title'] ?></b></h3>
        </div>
        <div class="card-body">
             
            <form style="display: inline-block" method="POST" action="delete.php">
                <input type="hidden" name="isbn" value="<?php echo $user['isbn'] ?>">
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th>Title:</th>
                <td><?php echo $user['title'] ?></td>
            </tr>
            <tr>
                <th>Author:</th>
                <td><?php echo $user['author'] ?></td>
            </tr>
            <tr>
                <th>Available:</th>
                <td><?php  
                    if( $user['available']==1)
                    echo "Available";
                    else
                    echo "Not Available"; ?></td>
            </tr>
            <tr>
                <th>Page:</th>
                <td><?php echo $user['pages'] ?></td>
            </tr>
            <tr>
                <th>ISBN:</th>
                <td>
                    <?php echo $user['isbn'] ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<?php include 'partials/footer.php' ?>
