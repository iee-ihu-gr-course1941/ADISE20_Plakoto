<div class="container-fluid">
  <form action="index.php?ctd=my_account_up" method="post">
      <div class="form-group row form">
        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
        <div class="col-md-4">
          <input type="text" id="username" class="form-control" name="username" placeholder="<?php echo $_SESSION['username'] ?>"  autofocus>
        </div>
      </div>

      <div class="form-group row form">
          <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
          <div class="col-md-4">
           <input type="email" id="email" class="form-control" name="email" placeholder="<?php echo $_SESSION['email'] ?>" >
          </div>
      </div>

      <div class="form-group row form">
          <label for="fname" class="col-md-4 col-form-label text-md-right">First Name</label>
          <div class="col-md-4">
           <input type="text" id="fname" class="form-control" name="fname" placeholder="<?php echo $_SESSION['fname'] ?>" >
          </div>
      </div>

      <div class="form-group row form">
          <label for="lname" class="col-md-4 col-form-label text-md-right">Last Name</label>
          <div class="col-md-4">
           <input type="text" id="lname" class="form-control" name="lname" placeholder="<?php echo $_SESSION['lname'] ?>" >
          </div>
      </div>

      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-secondary ">Update User Info</button>
        <a href="index.php?ctd=show_main" class="btn btn-link text-danger" target="_self">
            Back
        </a>
      </div>
  </form>
  <div class="d-flex justify-content-center ">
    <button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#pwd">Change Password</button>
  </div>
  <br>
    <form action="index.php?ctd=pwd_up" method="post" id="pwd">
        <div class="form-group row form">
          <label for="p_password" class="col-md-4 col-form-label text-md-right">Previous Password</label>
          <div class="col-md-4">
            <input type="password" id="p_password" class="form-control" name="p_password" autofocus>
          </div>
        </div>
        <div class="form-group row form">
          <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
          <div class="col-md-4">
            <input type="password" id="password" class="form-control" name="password" autofocus>
          </div>
        </div>
        <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="You are required to log in again if you choose to change your password" >Update Password</button>
    </form>
  </div>

  <script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
