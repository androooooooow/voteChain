<?php
include("../auth/config.php");
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']) ? $_POST['username'] : '';
    $raw_password = isset($_POST['password']) ? $_POST['password'] : '';
    $Role = isset($_POST['Role']) ? $_POST['Role'] : '';
    $select_route = isset($_POST ['select_route']) ? $_POST['select_route']: '';
    $fullname = isset($_POST['Fullname']) ? $_POST['Fullname'] : '';

    $username_max_length = 50;
    $fullname_max_length = 100;
    $password_min_length = 8;
    $password_max_length = 255;

    if (empty(trim($username)) || empty(trim($raw_password)) || empty(trim($Role)) || empty(trim($fullname))) {
        $msg = "All fields are required and cannot be empty or contain only spaces.";
    }

    elseif (preg_match('/^\s*$/', $username) || preg_match('/^\s*$/', $raw_password) || preg_match('/^\s*$/', $fullname)) {
        $msg = "Fields cannot contain only whitespace.";
    }

    elseif (strlen($username) > $username_max_length) {
        $msg = "Username cannot exceed $username_max_length characters.";
    }
    elseif (strlen($fullname) > $fullname_max_length) {
        $msg = "Full name cannot exceed $fullname_max_length characters.";
    }
    elseif (strlen($raw_password) < $password_min_length) {
        $msg = "Password must be at least $password_min_length characters long.";
    }
    elseif (strlen($raw_password) > $password_max_length) {
        $msg = "Password cannot exceed $password_max_length characters.";
    }
    else {
        $Role = strtolower($Role);

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $msg = "User already exists";
        } else {
            // Hash the password before storing
            $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
            
            $insert = $conn->prepare("INSERT INTO user (username, password, fullname, role, select_route) VALUES (?, ?, ?, ?, ?)");
            $insert->bind_param("sssss", $username, $hashed_password, $fullname, $Role, $select_route);
            if ($insert->execute()) {
                header('location:login.php');
                exit;
            } else {
                $msg = "Registration failed. Please try again.";
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
        <input type="text" id="firstname" name="firstname" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <label for="lastname" class="block text-sm font-serif font-medium text-black-700">Lastname</label>
        <input type="text" id="lastname" name="lastname" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <label for="Fullname" class="block text-sm font-serif font-medium text-black-700">Full Name</label>
        <input type="text" id="Fullname" name="Fullname" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <label for="Roles" class="block text-sm font-serif font-medium text-black-700">Roles</label>
        <select id="Roles" name="Role" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="Voter">Voter</option>
          <option value="Candidate">Candidate</option>
        </select>
      </div>
      

      <div>
        <label for="password" class="block text-sm font-serif font-medium text-black-700">Password</label>
        <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <p class="text-red-500 text-center"><?php echo $msg; ?></p>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-semibold">Register</button>
      <p class="text-sm text-center text-gray-600">Already have an account? <a href="login.php" class="text-blue-600 hover:underline">Login</a></p>
    </form>
  </div>
</body>
</html>