<?php
if (!isset($_SESSION)) {
  session_start();
}
define('TITLE', 'Courses');
define('PAGE', 'courses');
include('./adminInclude/header.php'); // including admin/header.php file
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) 
{
  $adminEmail = $_SESSION['adminLogEmail'];
} 
else 
{
  echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="col-sm-9 mt-5">
  <!--Here making the table for the list of courses-->
<!------------------------------------------------------------------------------------------------------------------->
  <p class=" bg-dark text-white p-2">List of Courses</p>
  <?php
  $sql = "SELECT * FROM course";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) 
  {
    echo '<table class="table">
       <thead>
        <tr>
         <th scope="col">Course ID</th>
         <th scope="col">Name</th>
         <th scope="col">Author</th>
         <th scope="col">Action</th>
        </tr>
       </thead>
       <tbody>';
    while ($row = $result->fetch_assoc()) 
    {
      echo '<tr>';
      echo '<th scope="row">' . $row["course_id"] . '</th>';
      echo '<td>' . $row["course_name"] . '</td>';
      echo '<td>' . $row["course_author"] . '</td>';
     
      echo '<td>    <!--This form is used for the "Edit" of the course-->
                    <form action="editcourse.php" method="POST" class="d-inline">      
                      <input type="hidden" name="id" value=' . $row["course_id"] . '>
                      <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                       <i class="fas fa-pen"></i>
                      </button>
                   </form>  
                  
                   <!--This form is used for deleting of the code-->
                   <form action="" method="POST" class="d-inline">
                        <input type="hidden" name="id" value=' . $row["course_id"] . '>
                        <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                          <i class="far fa-trash-alt"></i>
                        </button>
                   </form>
              </td>
         </tr>';
    }

    echo '</tbody>
        </table>';
  } 
  else 
  {
    echo "0 Result";
  }

  // ---------------------------------------------------------------------------------------------------------------
  //This code is for deleting the course from the database
  if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM course WHERE course_id = {$_REQUEST['id']}";
    if ($conn->query($sql) === TRUE) {
      // echo "Record Deleted Successfully";
      // below code will refresh the page after deleting the record
      echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
  ?>
  <!-------------------------------------------------------------------------------------------------------------------->
</div>
</div> <!-- div Row close from header -->

<!------------------------------------------------------------------------------------------------------->
<!--This is the plus button added at the bottom left corner of the courses page 
    to add the new courses and css for this is written in the admin css file-->
<div>
  <a class="btn btn-danger box" href="./addCourse.php">
        <i class="fas fa-plus fa-2x"></i>
  </a>
</div>
<!--------------------------------------------------------------------------------------------------------->

</div> <!-- div Conatiner-fluid close from header -->
<?php
include('./adminInclude/footer.php');
?>