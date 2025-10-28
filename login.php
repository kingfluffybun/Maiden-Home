<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="login-signup.css" />
  </head>
  <body>
    <nav></nav>
    <section class="login">
    <div class="container">
      <div class="login-box">
        <h2>Log In</h2>
        <form>
          <div class="input-group">
            <input
              type="text"
              id="username"
              name="username"
              required
              placeholder=" "
            />
            <label for="username">Email / Username</label>
          </div>
          <div class="input-group">
            <input
              type="password"
              id="password"
              name="password"
              required
              placeholder=" "
            />
            <label for="password">Password</label>
            <div class="forgot-password">
              <a href="forgotPassword.html">Forgot Password?</a>
            </div>
          </div>
          <button type="submit" class="login-btn">Log In</button>
        </form>
        <p class="create-account">
          New user? <a href="createAccount.html">Create New Account</a>
        </p>
      </div>
    </div>
    </section>
  </body>
</html>
