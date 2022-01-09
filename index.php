<?php
require 'users.php';
include("connect.php");

$users = getUsers();

include 'partials/header.php';
?>


<div class="container">
<table class="table">
<tr><td>
    <p>
        <a class="btn btn-success" href="create.php">Save a book</a>
    </p> 
    </td>
    <td>
     
    <form method="POST" action="search.php">
                        <input type="text" name="isbn" placeholder="Search book using ISBN">
                        <button class="btn btn-sm btn-outline-danger">Search</button>
                    </form>
    
    </td>
 </tr>
</table>    

    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Available</th>
            <th>Pages</th>
            <th>ISBN</th>
             
        </tr>
        </thead>
        <tbody>
        <?php $get_datas = $conn->prepare("select * from crud_application"); 
          $get_datas->execute();
        if($get_datas->rowCount()>0){
	$i=1;
	while($res=$get_datas->fetch(PDO::FETCH_ASSOC)){
	?>
	
	<tr>
                 
                <td><?php echo $res['title'] ?></td>
                <td><?php echo $res['author'] ?></td>
                <td><?php  
                    if( $res['available']==1 || $res['available']=='true')
                    echo "Available";
                    else
                    echo "Not Available"; ?></td>
                <td><?php echo $res['pages'] ?></td>
                <td><?php echo $res['isbn'] ?></td>
                
                 
                
                <td>
                    <a href="view.php?isbn=<?php echo $res['isbn'] ?>" class="btn btn-sm btn-outline-info">Read</a>
                     
                    <form method="POST" action="delete.php">
                        <input type="hidden" name="isbn" value="<?php echo $res['isbn'] ?>">
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
	
	 <?php } }else{
echo "<tr><td colspan='5'>Records not found</td></tr>";
} ?>
           
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php' ?>

