div class="container-fluid">
  <form action="index.php?ctd=after_register" method="post">
      <div class="form-group row form">
        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
        <div class="col-md-4">
          <input type="text" id="username" class="form-control" name="username" required autofocus>
        </div>
      </div>

      <div class="form-group row form">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
        <div class="col-md-4">
         <input type="password" id="password" class="form-control" name="password" required>
        </div>
      </div>

      <div class="form-group row form">
          <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
          <div class="col-md-4">
           <input type="email" id="email" class="form-control" name="email" required>
          </div>
      </div>

      <div class="form-group row form">
          <label for="fname" class="col-md-4 col-form-label text-md-right">First Name</label>
          <div class="col-md-4">
           <input type="text" id="fname" class="form-control" name="fname" required>
          </div>
      </div>

      <div class="form-group row form">
          <label for="lname" class="col-md-4 col-form-label text-md-right">Last Name</label>
          <div class="col-md-4">
           <input type="text" id="lname" class="form-control" name="lname" required>
          </div>
      </div>

      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-secondary ">Register</button>
        <a href="index.php?ctd=login" class="btn btn-link text-danger" target="_self">
            Back
        </a>
      </div>
  </form>
</div>