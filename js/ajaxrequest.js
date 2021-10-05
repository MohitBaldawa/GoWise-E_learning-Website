$(document).ready(function () {
  // Ajax Call for Already Exists Email Verification

  /* Here by using "keypress blur" we are checking for everytime when the user 
  press the key for adding the email is it in the database or not*/
  $("#stuemail").on("keypress blur", function () {
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var stuemail = $("#stuemail").val();      // using (#stuemail) we are taking value coming from stuemail field of sign up form and giving it to stuemail variable
    $.ajax({                                  // using ajax to transfer the data to addstudent.php in student folder
      url: "Student/addstudent.php",
      type: "post",
      data: {
        checkemail: "checkmail",
        stuemail: stuemail
      },
      success: function (data) {
        console.log(data);
        if (data != 0)            // here checking if number of rows are not zero means email is already exist
        {
          $("#statusMsg2").html(  // here targeting the StatusMsg2 which is in studentRegistration.php and printing the message in red color
            '<small style="color:red;"> Email ID Already Registered ! </small>'
          );
          $("#signup").attr("disabled", true); // here targeting the signup button id which is in studentRegistration.php and disabling it
        }
        else if (data == 0 && reg.test(stuemail)) // If the number of rows is zero then 
        {
          $("#statusMsg2").html(
            '<small style="color:green;"> There you go ! </small>' // print this message
          );
          $("#signup").attr("disabled", false);
        }
        else if (!reg.test(stuemail))    // Checking for the email should be in proper format 
        {
          $("#statusMsg2").html(
            '<small style="color:red;"> Please Enter Valid Email e.g. example@mail.com </small>'
          );
          $("#signup").attr("disabled", false);
        }
        if (stuemail == "")      // Here checking if the value is null or what 
        {
          $("#statusMsg2").html(
            '<small style="color:red;"> Please Enter Email ! </small>'  // if null then print
          );
        }
      }
    });
  });

  // Checking name on keypress
  $("#stuname").keypress(function () {
    var stuname = $("#stuname").val();
    if (stuname !== "") {
      $("#statusMsg1").html("");
    }
  });
  // Checking Password on keypress
  $("#stupass").keypress(function () {
    var stupass = $("#stupass").val();
    if (stupass !== "") {
      $("#statusMsg3").html("");
    }
  });
});

// Ajax Call for Adding New Student
function addStu() {
  var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

  /* Here capturing the name, email, and password of student from the 
  form in studentRegistration.php and storing it in the variables*/
  var stuname = $("#stuname").val();
  var stuemail = $("#stuemail").val();
  var stupass = $("#stupass").val();

  //********************************************************************************************************************************************** */
  // checking fields on form submission

  if (stuname.trim() == "")             // from here validation start
  {                                     // here checkig name should not be empty
    $("#statusMsg1").html(
      '<small style="color:red;"> Please Enter Name ! </small>'
    );
    $("#stuname").focus();
    return false;
  }

  // here checking if the mail is null then
  else if (stuemail.trim() == "") {
    $("#statusMsg2").html(
      '<small style="color:red;"> Please Enter Email ! </small>'
    );
    $("#stuemail").focus();
    return false;
  }
  // here we are checking if the inputed email is in the proper format or not
  else if (stuemail.trim() != "" && !reg.test(stuemail)) {
    $("#statusMsg2").html(
      '<small style="color:red;"> Please Enter Valid Email e.g. example@mail.com </small>'
    );
    $("#stuemail").focus();
    return false;
  }
  // here checking if the password is empty then
  else if (stupass.trim() == "") {
    $("#statusMsg3").html(
      '<small style="color:red;"> Please Enter Password ! </small>'
    );
    $("#stupass").focus();
    return false;
  }
  else  // if everything is in proper format then here sending the data to the database
  {
//******************************************************************************************************************************************* */
    /* Now here using the ajax to send the captured data to the addstudent.php file*/
    $.ajax(
      {
        url: "Student/addstudent.php",
        type: "post", /* Here using the post method (raher using "Method" here using "type" we can use anything) */
        data:
        {
          // assigned stusignup value just to check all iz well
          stusignup: "stusignup",
          stuname: stuname,
          stuemail: stuemail,
          stupass: stupass
        },
        success: function (data) {
          console.log(data);
          if (data == "OK") {
            $("#successMsg").html(
              '<span class="alert alert-success"> Registration Successful ! </span>'
            );
            // making field empty after signup
            clearStuRegField();
          }
          else if (data == "Failed") {
            $("#successMsg").html(
              '<span class="alert alert-danger"> Unable to Register ! </span>'
            );
          }
        }
      });
  }
}
//****************************************************************************************************************************************** */
// Empty All Fields and Status Msg
function clearStuRegField() {
  $("#stuRegForm").trigger("reset");
  $("#statusMsg1").html(" ");
  $("#statusMsg2").html(" ");
  $("#statusMsg3").html(" ");
}

function clearAllStuReg() {
  $("#successMsg").html(" ");
  clearStuRegField();
}

//*************************************************************************************************************************************************** */
// Ajax Call for Student Login Verification
function checkStuLogin()        // function for when the login button gets clicked in loginor signup.php
{
  var stuLogEmail = $("#stuLogEmail").val();  // Take the value from the email field of login form
  var stuLogPass = $("#stuLogPass").val();    // Take the value from the password field of login form
  $.ajax(                                     // Giving the fetched value to the addstudent.php
    {
      url: "Student/addstudent.php",
      type: "post",
      data: {
        checkLogemail: "checklogmail",
        stuLogEmail: stuLogEmail,
        stuLogPass: stuLogPass
      },
      success: function (data) {
        console.log(data);
        if (data == 0) {
          $("#statusLogMsg").html(
            '<small class="alert alert-danger"> Invalid Email ID or Password ! </small>'
          );
        }
        else if (data == 1) {
          $("#statusLogMsg").html(
            '<div class="spinner-border text-success" role="status"></div>' // This is bootstrap class used for the spin
          );
          // Empty Login Fields
          clearStuLoginField();               //This will clere the login field 
          setTimeout(() => {                  // This function will redirect us to index.php page if the login is successfull also this will stop the spin animation
            window.location.href = "index.php";
          }, 1000);
        }
      }
    });
}
//***************************************************************************************************************************************************************************** */
// Empty Login Fields
function clearStuLoginField() {
  $("#stuLoginForm").trigger("reset");
}

// Empty Login Fields and Status Msg
function clearStuLoginWithStatus() {
  $("#statusLogMsg").html(" ");
  clearStuLoginField();
}
