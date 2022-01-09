<?php
include 'partials/header.php';
require 'users.php';
include("connect.php");

if (!isset($_GET['isbn'])) {
    include "partials/not_found.php";
    exit;
}
$userId = $_GET['isbn'];

$query = $conn->prepare("SELECT * FROM crud_application WHERE isbn = ?");
    $query->execute(array($userId));
    $res=$query->fetch(PDO::FETCH_ASSOC);
if (!$res) {
    include "partials/not_found.php";
    exit;
}

?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View Book: <b><?php echo $res['title'] ?></b></h3>
        </div>
        <div class="card-body">
             
            <form style="display: inline-block" method="POST" action="delete.php">
                <input type="hidden" name="isbn" value="<?php echo $res['isbn'] ?>">
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th>Title:</th>
                <td><?php echo $res['title'] ?></td>
            </tr>
            <tr>
                <th>Author:</th>
                <td><?php echo $res['author'] ?></td>
            </tr>
            <tr>
                <th>Available:</th>
                <td><?php  
                    if( $res['available']==1 || $res['available']=='true')
                    echo "Available";
                    else
                    echo "Not Available"; ?></td>
            </tr>
            <tr>
                <th>Page:</th>
                <td><?php echo $res['pages'] ?></td>
            </tr>
            <tr>
                <th>ISBN:</th>
                <td>
                    <?php echo $res['isbn'] ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<?php include 'partials/footer.php' ?>
