<?php
  //two change in session
  //changepassword and header
  include 'backend/conn.php';
  include 'student_header.php';
  $login_details_query = $conn->query("SELECT * FROM  `login` WHERE username='".$user['groupname']."' ");
  $login = $login_details_query->fetch_assoc();
   $member_details_query = $conn->query("SELECT `member1`, `member2`, `member3` FROM `groups` WHERE groupname='".$user['groupname']."' ");
  $member = $member_details_query->fetch_assoc();

  $project_details_query = $conn->query("SELECT *  FROM `project` WHERE groupname='".$user['groupname']."' ");
  $flag=0;
  if($project_details_query->num_rows > 0)
  {
    $flag=1;
    $project = $project_details_query->fetch_assoc();
  }
  
  

  /* $sql = "SELECT *
  FROM groups
  INNER JOIN project ON groups.groupname = project.groupname"; 
  $inner_join = $conn->query($sql);
  $student_project = $inner_join->fetch_assoc();
  $member_array= array("member1"=>$student_project['member1'],"member2"=> $student_project['member2'],"member3"=> $student_project['member3']); */
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
  <link rel="stylesheet" href="css/starter.css">  
  <link rel="stylesheet" href="css/studentdashboard.css">
  
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

  <title>RAIT</title>
</head>
<body> 
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#"><i class="fas fa-qrcode"></i>Dashboard</a>
    <a href="#"><i class="fa fa-graduation-cap" aria-hidden="true" >Create Abstract</i></a>
    <a href="#"><i class="fa fa-graduation-cap" aria-hidden="true" >Update Abstract</i></a>
    
    <a href="#">Log out</a>
  </div>

  <div id="main">
    <a href="http://www.dypatil.edu/mumbai/rait"><img src="../assets/images/Rait_new_logo_png.png" class="top_logo"></a>
  <!--<img src="./Rait_new_logo_png.png" class="top_logo">-->
    <div class="chip">
      <img src="../assets/images/img_avatar.png" alt="Person" width="96" height="96">
      <?php echo $user['groupname'];?>
    </div>
    <nav class="navbar navbar-expand-lg primary_color navbar-dark">
      <a class="navbar-brand" href="#"><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        <li class="nav-item">
        <button type="button" class="btn btn-success" data-target="#myModal" data-toggle="modal">Change Password</button>
        </li>
        
      </ul>
      <a href="backend/logout.php"><button type="button" class="btn btn-success">Logout</button></a>
      
    </div>
  </nav>
  <div>
    
    <div class="change_password">
      <!-- Button HTML (to Trigger Modal) -->
      <!-- <button type="button" class="btn btn-lg btn-primary" data-target="#myModal" data-toggle="modal">Change Password</button> -->

      <!-- Modal HTML -->
      <div id="myModal" class="modal fade" data-backdrop="static" tabindex="-1">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Change Password</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form  action="backend/changepassword_backend.php" class= "changepassowrdform" method="POST">
                      <div class="form-group row">
                        <label for="new_password" class="change_password_text">Password</label>
                        <input type="password" name="new_password" id="new_password" Required class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                        <label for="confirm_password" class="change_password_text">Password</label>
                        <input type="password" name="confirm_password" Required  id="confirm_password" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="confirmbutton" data-dismiss="modal" >Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="validate()" id="confirmbutton" name="submit">Save password</button>
                      </div>
                    </form>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
  <!--group detail-->
  <div class="Student container">
      <table class="table table-hover table-bordered">
          <thead class="thead-dark">
              <tr>
                  <th>Roll No</th>
                  <th> Name</th>
                  <th>Email</th>
                  <th>Division</th>
              </tr>
          </thead>
          <tbody>
          <?php
            $department="";
            foreach($member as $x => $x_value) {
              $student_details_query  = $conn->query("SELECT * FROM `student` WHERE name='".$x_value."' ");
              $student = $student_details_query->fetch_assoc();
              $department = $student['department'];
              ?> 
              <tr>
              <td><?php echo $student['rollno'];?></td>
              <td><?php echo $student['name'];?></td>
              <td><?php echo $student['email'];?></td>
              <td><?php echo $student['division'];?></td>
              </tr> 
              <?php
              
            }
          ?>
                        
          </tbody>
      </table>
  </div>
    <br>
    <br>
  </div>
  <div class="project container">
    <table class="table table-hover">
        
        <tbody>
            <tr>
            <tr>
                <td>Department</td>
                <td><b><?php echo $department;?></b></td>
                
            </tr>
              
                <td>Abstract Submitted:</td>
                <td><b><?php  if(!$flag)
                {
                  echo "No";
                }
                else{
                  echo "Yes";
                }
                ?></b></td>

            </tr>
            <tr>
                <td>Status</td>
                <td><b><?php  if(!$flag)
                {
                  echo "No";
                }
                else{
                  echo ($project['status']);
                }
                ?></b></td>
                
            </tr>
            <tr>
                <td>Mentor Allocated:</td>
                <td><b><?php  
                if(!$flag)
                {
                  echo "No";
                }
                else{
                  if($project['mentor']=="")
                  {
                    echo "No";
                  }
                  else{
                    echo $project['mentor'];
                  }
                  
                }
                ?></b></td>

            </tr>
            
                       
        </tbody>
    </table>
    </div>
  <!--Footer-->
  <div class="jumbotron text-center" style="margin-bottom:0">
    <p class="footer-data">Footer</p>
  </div>
  <!--Footer Ends-->

  
  <!--Footer
  <div class="jumbotron text-center" style="margin-bottom:0">
    <p class="footer-data">Footer</p>
  </div>
  Footer Ends-->
  <script src="js/studentdashboard.js"></script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="../assets/bootstrap.min.js"></script>
  <?php
    //echo $login['change_password'];
   if($login['change_password']==0)
   {
     ?> 
     <script>
      
      $(document).ready(function(){
        $("#myModal").modal('show');
      });
    </script>
    
    <?php
   }
  ?>
  <script>
    
    function validate(){
      var user_id = $("#new_password").val();
      var group_password = $("#confirm_password").val();
      
      if(user_id!=group_password){
        alert("Password and Confirm password should match!");
        window.href.location='studentdashboard.php';
      }
    }

  </script>
</div>


   
</body>
</html> 
