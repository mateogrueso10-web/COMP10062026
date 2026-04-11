<?php
session_start();
include 'includes/header.php';
?>

<div class="card shadow">
  <div class="card-body">
    <h3 class="mb-4">Login</h3>

    <form action="login_process.php" method="POST">

      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success w-100">
        Login ⚽
      </button>

      <p class="mt-3 text-center">
        Don’t have an account? <a href="register.php">Register</a>
      </p>

    </form>
  </div>
</div>

<?php include 'includes/footer.php'; ?>