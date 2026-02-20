<?php
include 'includes/header.php';
?>

<div class="card">
  <div class="card-body">
    <h2 class="card-title mb-4">Add Team Member</h2>

    <form action="insert.php" method="POST">
      <div class="mb-3">
        <!-- Form fields for first name details -->
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control" required>
      </div>

      <div class="mb-3">
        <!-- Form fields for last name details -->
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" id="last_name" class="form-control" required>
      </div>

      <div class="mb-3">
        <!-- Form fields for position details -->
        <label for="position" class="form-label">Position</label>
        <input type="text" name="position" id="position" class="form-control" required>
      </div>

      <div class="mb-3">
        <!-- Form fields for phone details -->
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" name="phone" id="phone" class="form-control" pattern="[0-9]{10}" placeholder="1234567890" required>
      </div>

      <div class="mb-3">
        <!-- Form fields for email details -->
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <!-- Form fields for team name details -->
        <label for="team_name" class="form-label">Team Name</label>
        <input type="text" name="team_name" id="team_name" class="form-control" required>
      </div>

      <!-- Google reCAPTCHA placeholder -->
      <div class="mb-3">
        <div class="g-recaptcha" data-sitekey="6LdHbHIsAAAAAIuNp2JvsFN4oBUFmzVjWEdBuM7f"></div>
      </div>

      <button type="submit" class="btn btn-success">Add Member</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>

<!-- Google reCAPTCHA script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php
include 'includes/footer.php';
?>