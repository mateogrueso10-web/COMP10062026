<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';
include 'includes/header.php';

// Check if ID exists
if (!isset($_GET['id'])) {
    die("No member selected.");
}

$id = $_GET['id'];

// Fetch member
$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch();

if (!$member) {
    die("Member not found.");
}
?>
<!-- Edit Member Form -->
<div class="card">
  <div class="card-body">
    <h2 class="card-title mb-4">Edit Team Member</h2>

    <form action="update.php" method="POST">

      <!-- Hidden ID -->
      <input type="hidden" name="id" value="<?= $member['id'] ?>">
    
      <!-- Form fields pre-filled with member data -->
      <div class="mb-3">
        <label class="form-label">First Name</label>
        <input type="text" name="first_name" class="form-control"
          value="<?= htmlspecialchars($member['first_name']) ?>" required>
      </div>
        <!-- Repeat for other fields: last_name, position, phone, email, team_name -->
      <div class="mb-3">
        <label class="form-label">Last Name</label>
        <input type="text" name="last_name" class="form-control"
          value="<?= htmlspecialchars($member['last_name']) ?>" required>
      </div>
      <!-- Form fields for jersey number details -->
      <div class="mb-3">
        <label class="form-label">Jersey Number</label>
        <input type="number" name="jersey_number" class="form-control" min="1" max="99" 
          value="<?= htmlspecialchars($member['jersey_number']) ?>" required>
      </div>

      <div class="mb-3">
        <!-- Form fields for position details -->
        <select name="position" class="form-select" required>
        <!-- Dropdown for position selection with current value selected -->
        <option value="Goalkeeper" <?= $member['position']=='Goalkeeper'?'selected':'' ?>>Goalkeeper</option>
        <option value="Right Back" <?= $member['position']=='Right Back'?'selected':'' ?>>Right Back</option>
        <option value="Left Back" <?= $member['position']=='Left Back'?'selected':'' ?>>Left Back</option>
        <option value="Center Back" <?= $member['position']=='Center Back'?'selected':'' ?>>Center Back</option>
        <option value="Defensive Midfielder" <?= $member['position']=='Defensive Midfielder'?'selected':'' ?>>Defensive Midfielder</option>
        <option value="Central Midfielder" <?= $member['position']=='Central Midfielder'?'selected':'' ?>>Central Midfielder</option>
        <option value="Attacking Midfielder" <?= $member['position']=='Attacking Midfielder'?'selected':'' ?>>Attacking Midfielder</option>
        <option value="Right Winger" <?= $member['position']=='Right Winger'?'selected':'' ?>>Right Winger</option>
        <option value="Left Winger" <?= $member['position']=='Left Winger'?'selected':'' ?>>Left Winger</option>
        <option value="Striker" <?= $member['position']=='Striker'?'selected':'' ?>>Striker</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="tel" name="phone" class="form-control"
          value="<?= htmlspecialchars($member['phone']) ?>"
          pattern="[0-9]{10}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control"
          value="<?= htmlspecialchars($member['email']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Team Name</label>
        <input type="text" name="team_name" class="form-control"
          value="<?= htmlspecialchars($member['team_name']) ?>" required>
      </div>
        <!-- Submit and Cancel buttons -->
      <button type="submit" class="btn btn-success">Update Member</button>
      <a href="index.php" class="btn btn-secondary">Cancel</a>

    </form>
  </div>
</div>

<?php include 'includes/footer.php'; ?>