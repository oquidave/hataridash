
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default login-panel">
        <div class="panel-heading">
          <h3 class="panel-title">Forgot password</h3>
        </div>
            <form class="login-form" action="/forgot_password" method="post" accept-charset="utf-8">
              <div class="form-group forgot_password_error" style="display: <?php echo ($message)?'display':'none'; ?>" >
                <span ><?php echo $message; ?> </span>
              </div>
              <div class="form-group">
                <label for="email">Please enter your Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="dave@example.com">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
      </div><!-- close panel-->
    </div>
  </div>
</div>
