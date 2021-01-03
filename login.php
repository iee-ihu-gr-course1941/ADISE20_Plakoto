<div class="container-fluid">
  <form action="index.php?ctd=main_page" method="post">
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

      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-secondary">Login</button>
        <a href="index.php?ctd=register" class="btn btn-link text-danger" target="_self">
            Not Registered?
        </a>
      </div>
  </form>
</div>
