<?php include 'config.php'; include 'auth_check.php'; include 'header.php'; ?>
<div class="card p-4 text-center card h-full">
    <h2>Welcome, <?php echo $_SESSION['username']; ?> 🎉</h2>
    <p>You are logged in to the Library System.</p>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
<?php include 'footer.php'; ?>
