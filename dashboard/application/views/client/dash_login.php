
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default login-panel">
        <div class="panel-heading">
          <h3 class="panel-title">Login to your Account</h3>
        </div>
            <form class="login-form" action="/auth/login" method="post" accept-charset="utf-8">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="identity" id="email" placeholder="Email">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>

              <div class="form-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
              </div>

              <button type="submit" class="btn btn-primary">Login</button>
            </form>
      </div><!-- close panel-->
    </div>
  </div>
</div>
