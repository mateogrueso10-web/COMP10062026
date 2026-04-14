<?php
session_start();
include 'db.php';
include 'includes/header.php';
?>

<div class="card shadow">
  <div class="card-body">
    <h3 class="mb-4">Create Account</h3>

    <form action="register_process.php" method="POST">

      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required minlength="6">
      </div>

      <!-- reCAPTCHA -->
      <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="6LdJs7csAAAAABE24Mi9XLEdargwaZWifngjMyHw"></div>
      </div>

      <button type="submit" class="btn btn-success w-100">
        Register ⚽
      </button>

      <p class="mt-3 text-center">
        Already have an account? <a href="login.php">Login</a>
      </p>

    </form>
  </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php include 'includes/footer.php'; ?>