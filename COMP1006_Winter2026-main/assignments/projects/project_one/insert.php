<?php
include 'db.php';
include 'includes/header.php';

// Fetch all members
$stmt = $pdo->query("SELECT * FROM members ORDER BY created_at DESC");
$members = $stmt->fetchAll();
?>

<a href="add.php" class="btn btn-primary mb-3">Add New Member</a>

<table class="table table-striped">
    <thead>
        <tr>
            <!-- Table headers -->
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Team Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($members as $member): ?>
            <!-- Display member data in table rows -->
        <tr>
            <td><?= htmlspecialchars($member['first_name']) ?></td>
            <td><?= htmlspecialchars($member['last_name']) ?></td>
            <td><?= htmlspecialchars($member['position']) ?></td>
            <td><?= htmlspecialchars($member['phone']) ?></td>
            <td><?= htmlspecialchars($member['email']) ?></td>
            <td><?= htmlspecialchars($member['team_name']) ?></td>
            <td>
                <!-- Edit and Delete buttons -->
                <a href="edit.php?id=<?= $member['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $member['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- Include footer -->
<?php include 'includes/footer.php'; ?>