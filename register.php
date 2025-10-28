<html>
  <head>
    <title>Create Account</title>
    <link rel="stylesheet" href="login-signup.css" />
  </head>
  <nav></nav>
  <body>
  <section class="login">
    <div class="container">
      <div class="login-box">
        <h2>Create Account</h2>
        <form>
          <div class="input-group">
            <input
              type="text"
              id="username"
              name="username"
              required
              placeholder=" "
            />
            <label for="username">Username</label>
          </div>

          <div class="input-group">
            <input
              type="email"
              id="email"
              name="email"
              required
              placeholder=" "
            />
            <label for="email">Email</label>
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
          </div>

          <div class="input-group">
            <input
              type="password"
              id="confirm-password"
              name="confirm-password"
              required
              placeholder=" "
            />
            <label for="confirm-password">Confirm Password</label>
          </div>

          <button type="submit" class="login-btn">Create Account</button>
        </form>

        <p class="create-account">
          Already have an account? <a href="login.html">Log In</a>
        </p>
      </div>
    </div>
    </section>
  </body>
</html>
