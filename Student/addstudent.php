<?php 
if(!isset($_SESSION))    // Here checking for session is started or not, if not started then will start the session
{ 
  session_start();       // Starting the session
}
include_once('../dbConnection.php');

// setting header type to json, We'll be outputting a Json data
header('Content-type: application/json');

//********************************************************************************************************************************************************************************** */
// Checking Email already Registered
if(isset($_POST['stuemail']) && isset($_POST['checkemail'])){   // checking for value should not be empty
  $stuemail = $_POST['stuemail'];                               
  $sql = "SELECT stu_email FROM student WHERE stu_email='".$stuemail."'"; 
  $result = $conn->query($sql);                       // here just executing the query and whatever value comes in sql variable is transfered to result variable
  $row = $result->num_rows;                           // here checking how many number of rows are there with the same email
  echo json_encode($row);                             // giving the rows value return to the ajax success function 
  }

 //********************************************************************************************************************************************************************************************** */
  // Inserting or Adding New Student

  /* Here in if statement isset is used for checking values should not be empty if true move forward*/
  if(isset($_POST['stusignup']) && isset($_POST['stuname']) && isset($_POST['stuemail']) && isset($_POST['stupass'])){
    $stuname = $_POST['stuname']; /* Here using "$_POST['stuname']" to give the value of the stuname which is come from the ajaxreques.js to the &stuname  */
    $stuemail = $_POST['stuemail'];
    $stupass = $_POST['stupass'];
    $sql = "INSERT INTO student(stu_name, stu_email, stu_pass) VALUES ('$stuname', '$stuemail', '$stupass')";
    /* Here for executing the above query we are using connection object $con and then passing the $sql to the mehtod query and checking if its true then printing message */
    if($conn->query($sql) == TRUE){
      echo json_encode("OK"); /* This will give the message as the responce to the ajaxrequest.js file where the success method is writen */
    } else {
      echo json_encode("Failed");
    }
  }
//*************************************************************************************************************************************************************************************************** */

//******************************************************************************************************************************************* */
  // Student Login Verification

  if(!isset($_SESSION['is_login'])) // here this condition means, following code will only work if the user is not already logged in
  {
    if(isset($_POST['checkLogemail']) && isset($_POST['stuLogEmail']) && isset($_POST['stuLogPass']))
    {
      $stuLogEmail = $_POST['stuLogEmail'];
      $stuLogPass = $_POST['stuLogPass'];
      $sql = "SELECT stu_email, stu_pass FROM student WHERE stu_email='".$stuLogEmail."' AND stu_pass='".$stuLogPass."'"; //when we want to check for any value which is in the variable we will write it in the '".$variable."'
      $result = $conn->query($sql);  //Firing the sql query using conn object and saving the result in result variable
      $row = $result->num_rows;      // checking the number of rows the data comes in the database
      
      if($row === 1)     // here checking row should exactly equal to 1 
      {
        $_SESSION['is_login'] = true;             // this is used to check if the session of the user is continued or not
        $_SESSION['stuLogEmail'] = $stuLogEmail;  // Here saving the email to the session variable 
        echo json_encode($row);    // it will transfer the value of row to the success function 
      } 
      else if($row === 0) 
      {
        echo json_encode($row);
      }
    }
  }
  /*********************************************************************************************************************************************/ 

?>