<?php
  session_start();
  if(!isset ($_SESSION['username']) && !isset ($_SESSION['password'])){ //initialize the username/password
    $_SESSION['username'] = "";
    $_SESSION['password'] = "";
  }

  require_once "dbconnect2.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Plakoto</title>
    <meta charset="utf-8">
    <link rel="icon" href="./Images/tavli_board.png" type="image/icon type">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="external.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="jumbotron logo bg-dark"></div>

    <div class="container-fluid main d-flex flex-column h-100 " >
      <div class="row flex-fill">
       <div class="col-12">
         <br>
         <?php
           if( ! isset($_REQUEST['ctd'])) {
             $_REQUEST['ctd']='login';
           }
           switch ($_REQUEST['ctd']){
           case "show_main" :  require "main_page.php"; //in case we need to show the main menu without authentication
                     break;
           case "login" :		require "login.php";
                     break;
           case "logout" :
                 session_unset();
                 require "login.php";
                 echo "<br><br><div class='d-flex justify-content-center'>
                          <div class='alert alert-info alert-dismissible col-md-4 d-flex justify-content-center fade show'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>Successfully Logged Out
                          </div>
                       </div>";
                     break;
           case "register" :		require "register.php";
                     break;
           case "after_register" :
                 $sql = "SELECT COUNT(*) AS ok FROM users WHERE uname=?"; //check if username is taken
                 if( $stmt = $mysqli->prepare($sql) ) {
                   $stmt->bind_param("s", $_POST['username']);
                   $stmt->execute();
                   $result = $stmt->get_result();
                   $row = $result->fetch_assoc();
                 }
                 if( $row['ok'] == '1'){ //if it is taken inform the user
                   require "register.php";
                   echo "<br><br><div class='d-flex justify-content-center'>
                            <div class='alert alert-danger alert-dismissible col-md-4 d-flex justify-content-center fade show'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>Username is already taken
                            </div>
                         </div>";
                 }
                 else{ //if it is not add the user in the database and procced to login
                  
                   $sql = "INSERT INTO `users`( `uname`, `pwd`, `email`, `fname`, `lname` ) VALUES (?,?,?,?,?)";
                     if( $stmt = $mysqli->prepare($sql) ) {
                       $stmt->bind_param("sssss", $_POST['username'], $_POST['password'], $_POST['email'], $_POST['fname'], $_POST['lname']);
                      $stmt->execute();
                   }
                   require "login.php";
                   echo "<br><br><div class='d-flex justify-content-center'>
                            <div class='alert alert-info alert-dismissible col-md-4 d-flex justify-content-center fade show'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>Successfully Registered
                            </div>
                         </div>";
                 }
                     break;
          case "main_page" : //check credentials and procced to main page
               $sql = "SELECT COUNT(*) AS ok FROM users WHERE uname=? AND pwd=?";
               if( $stmt = $mysqli->prepare($sql) ) {
                 $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
                 $stmt->execute();
                 $result = $stmt->get_result();
                 $row = $result->fetch_assoc();
               }
                 if($row['ok'] == '1'){
                   $sql = "SELECT * FROM users WHERE uname=? AND pwd=?";
             			if( $stmt = $mysqli->prepare($sql) ) {
             				$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
             				$stmt->execute();
             				$result = $stmt->get_result();
             				$row = $result->fetch_assoc();

             				$_SESSION['username']=$row['uname'];
                    $_SESSION['password']=$row['pwd'];
             				$_SESSION['fname']=$row['fname'];
             				$_SESSION['lname']=$row['lname'];
             				$_SESSION['email']=$row['email'];
                   }

                  require "main_page.php";
                  echo "<br><br><div class='d-flex justify-content-center'>
                           <div class='alert alert-info alert-dismissible col-md-4 d-flex justify-content-center fade show'>
                             <button type='button' class='close' data-dismiss='alert'>&times;</button>Welcome {$_SESSION['username']}
                           </div>
                        </div>";
                }
                else{
                  require "login.php";
                  echo "<br><br><div class='d-flex justify-content-center'>
                           <div class='alert alert-danger alert-dismissible col-md-4 d-flex justify-content-center fade show'>
                             <button type='button' class='close' data-dismiss='alert'>&times;</button>Wrong Username or Password
                           </div>
                        </div>";
                }
                     break;
          case "my_account" : require "my_account.php";
                     break;
          case "my_account_up" :
            $prev_uname = $_SESSION['username'];
            if($_POST['username'] != ''){
              $_SESSION['username']=$_POST['username'];
            }
            if($_POST['email'] != ''){
              $_SESSION['email']=$_POST['email'];
            }
            if($_POST['fname'] != ''){
              $_SESSION['fname']=$_POST['fname'];
            }
            if($_POST['lname'] != ''){
              $_SESSION['lname']=$_POST['lname'];
            }

            $sql = "UPDATE users SET uname=?, email=?, fname=?, lname=?  WHERE uname=?";
            if( $stmt = $mysqli->prepare($sql) ) {
              $stmt->bind_param("sssss",$_SESSION['username'],$_SESSION['email'],$_SESSION['fname'],$_SESSION['lname'],$prev_uname );
              $stmt->execute();
            }
              require "main_page.php";
              echo "<br><br><div class='d-flex justify-content-center'>
                       <div class='alert alert-info alert-dismissible col-md-4 d-flex justify-content-center fade show'>
                         <button type='button' class='close' data-dismiss='alert'>&times;</button>User Info Updated
                       </div>
                    </div>";
            break;
              case "pwd_up" :
                    if($_SESSION['password'] == $_POST['p_password']){
                      $_SESSION['password'] = $_POST['password'];
                      $sql = "UPDATE users SET pwd=? WHERE uname=?";
                      if( $stmt = $mysqli->prepare($sql) ) {
                        $stmt->bind_param("ss",$_SESSION['password'],$_SESSION['username'] );
                        $stmt->execute();
                      }
                      $_REQUEST['ctd'] = 'login';
                      require "login.php";
                      echo "<br><br><div class='d-flex justify-content-center'>
                               <div class='alert alert-info alert-dismissible col-md-4 d-flex justify-content-center fade show'>
                                 <button type='button' class='close' data-dismiss='alert'>&times;</button>Password Successfully Updated
                               </div>
                            </div>";
                    }
                    else{
                      require "my_account.php";
                      echo "<br><br><div class='d-flex justify-content-center'>
                               <div class='alert alert-danger alert-dismissible col-md-4 d-flex justify-content-center fade show'>
                                 <button type='button' class='close' data-dismiss='alert'>&times;</button>Incorrect Old Password
                               </div>
                            </div>";
                    }
                    break;
              case "game" :
                  require "game.php";
                break;
           default:
             print "ERROR 404";
          }
        ?>
       </div>
     </div>
     <footer class="container-fluid bg-dark footer">
         <p>ADISE 2020- Antoniou Spiros - Kiosses Vasileios</p>
     </footer>
    </div>

  </body>
</html>
