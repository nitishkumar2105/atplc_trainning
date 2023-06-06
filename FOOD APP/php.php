<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  
  // Validate form data
  $errors = array();
  if (empty($name)) {
    $errors[] = 'Please enter your name.';
  }
  if (empty($email)) {
    $errors[] = 'Please enter your email address.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
  }
  if (empty($password)) {
    $errors[] = 'Please enter a password.';
  } elseif (strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters long.';
  } elseif ($password != $confirm_password) {
    $errors[] = 'Passwords do not match.';
  }
  
  // If no errors, save data to database
  if (empty($errors)) {
    // Connect to database (replace 'username', 'password', and 'database_name' with your own database credentials)
    $mysqli = new mysqli('localhost', 'username', 'password', 'database_name');
    if ($mysqli->connect_error) {
      die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }
    
    // Escape special characters in data to prevent SQL injection
    $name = $mysqli->real_escape_string($name);
    $email = $mysqli->real_escape_string($email);
    $password = $mysqli->real_escape_string($password);
    
    // Hash password for security
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert data into database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($mysqli->query($sql) === TRUE) {
      // Redirect to success page
      header('Location: success.php');
      exit;
    } else {
      echo 'Error: ' . $sql . '<br>' . $mysqli->error;
    }
    
    // Close database connection
    $mysqli->close();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
</head>
<body>
  <h1>Registration Form</h1>
  
  <?php if (!empty($errors)): ?>
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  
  <form method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" required>
    
    <button type="submit">Register</button>
  </form>
</body>
</html>
