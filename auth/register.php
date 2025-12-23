<?php
include("../auth/config.php");
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $raw_password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = isset($_POST['Role']) ? $_POST['Role'] : ''; // FIXED: Changed 'Roles' to 'Role'
    $fullname = isset($_POST['Fullname']) ? trim($_POST['Fullname']) : '';

    $firstname_max_length = 50;
    $lastname_max_length = 50;
    $fullname_max_length = 100;
    $email_max_length = 50;
    $password_min_length = 8;
    $password_max_length = 50;

    // Validation checks
    if (empty($firstname) || empty($lastname) || empty($email) || empty($raw_password) || empty($role) || empty($fullname)) {
        $msg = "All fields are required and cannot be empty or contain only spaces.";
    }
    elseif (preg_match('/^\s*$/', $email) || preg_match('/^\s*$/', $raw_password) || preg_match('/^\s*$/', $fullname)) {
        $msg = "Fields cannot contain only whitespace.";
    }
    elseif (strlen($firstname) > $firstname_max_length) {
        $msg = "Firstname cannot exceed $firstname_max_length characters."; 
    }
    elseif (strlen($lastname) > $lastname_max_length) {
        $msg = "Lastname cannot exceed $lastname_max_length characters.";
    }
    elseif (strlen($fullname) > $fullname_max_length) {
        $msg = "Full name cannot exceed $fullname_max_length characters.";
    }
    elseif (strlen($email) > $email_max_length) {
        $msg = "Email cannot exceed $email_max_length characters.";
    }
    elseif (strlen($raw_password) < $password_min_length) {
        $msg = "Password must be at least $password_min_length characters long.";
    }
    elseif (strlen($raw_password) > $password_max_length) {
        $msg = "Password cannot exceed $password_max_length characters.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Please enter a valid email address.";
    }
    else {
        // Convert role to lowercase for consistency
        $role = strtolower($role);

        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $msg = "Email already exists";
        } else {
            // Hash the password before storing
            $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
            
            // FIXED: Removed 'select_route' from columns (not in form) and corrected number of placeholders
            $insert = $conn->prepare("INSERT INTO user (firstname, lastname, email, password, fullname, role) VALUES (?, ?, ?, ?, ?, ?)");
            $insert->bind_param("ssssss", $firstname, $lastname, $email, $hashed_password, $fullname, $role); // FIXED: Changed $Roles to $role
            
            if ($insert->execute()) {
                header('location:login.php');
                exit;
            } else {
                $msg = "Registration failed. Please try again. Error: " . $conn->error;
            }
        }
    }
}
?>


<!Doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-black-1000 flex items-center justify-center min-h-screen"
style="background-image: url('../asset/bg1.png'); background-attachment: fixed; background-position: center; background-size: cover;">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Sign Up</h1>
    <form action="register.php" method="POST" class="space-y-4">
      <div>
        <label for="firstname" class="block text-sm font-serif font-medium text-black-700">Firstname</label>
        <input type="text" id="firstname" name="firstname" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>">
      </div>
      <div>
        <label for="lastname" class="block text-sm font-serif font-medium text-black-700">Lastname</label>
        <input type="text" id="lastname" name="lastname" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>">
      </div>
      <div>
        <label for="Fullname" class="block text-sm font-serif font-medium text-black-700">Full Name</label>
        <input type="text" id="Fullname" name="Fullname" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo isset($_POST['Fullname']) ? htmlspecialchars($_POST['Fullname']) : ''; ?>">
      </div>
      <div>
        <label for="email" class="block text-sm font-serif font-medium text-black-700">Email</label>
        <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
      </div>
      <div>
        <label for="Role" class="block text-sm font-serif font-medium text-black-700">Role</label>
        <select id="Role" name="Role" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Select Role</option>
          <option value="voter" <?php echo (isset($_POST['Role']) && $_POST['Role'] == 'voter') ? 'selected' : ''; ?>>Voter</option>
          <option value="candidate" <?php echo (isset($_POST['Role']) && $_POST['Role'] == 'candidate') ? 'selected' : ''; ?>>Candidate</option>
        </select>
      </div>
      <div>
        <label for="password" class="block text-sm font-serif font-medium text-black-700">Password</label>
        <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      
      <?php if ($msg): ?>
        <div class="text-red-500 text-center p-2 bg-red-50 rounded">
          <?php echo htmlspecialchars($msg); ?>
        </div>
      <?php endif; ?>
      
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-semibold">Register</button>
      <p class="text-sm text-center text-gray-600">Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Login</a></p>
    </form>
  </div>
</body>
</html>