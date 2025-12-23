<?php
include("../auth/config.php");
session_start();

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Hardcoded admin checks (kept as is from original)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['Admin'] = 'admin';
        header('Location: /VoteChain/src/admin.php');
        exit;
    } elseif ($username === 'admin2' && $password === 'admin123') {
        $_SESSION['Admin'] = 'admin';
        header('Location: /VoteChain/src/admin.php');
        exit;
    }

    try {
      
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // Check if user exists
        if ($row1 = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Verify hashed password
            if (password_verify($password, $row1['password'])) {
                // Set session based on role
                if ($row1['role'] == 'voter') {
                    $_SESSION['Commuter'] = $row1['username'];
                    $_SESSION['uid'] = $row1['uid'];
                    $_SESSION['CommuterFullname'] = $row1['fullname'];
                    header('location:/VoteChain/src/voter_dashboard.php');
                    exit;
                } else if ($row1['role'] == 'candidate') {
                    $_SESSION['Driver'] = $row1['username'];
                    $_SESSION['uid'] = $row1['uid'];
                    $_SESSION['DriverFullname'] = $row1['fullname'];
                    header('Location: /VoteChain/src/candidate_dashboard.php');
                    exit;
                } else {
                    $msg = "Incorrect Username or Password";
                }
            } else {
                $msg = "Incorrect Username or Password";
            }
        } else {
            $msg = "Incorrect Username or Password";
        }
    } catch (PDOException $e) {
        // Handle database errors
        error_log("Login error: " . $e->getMessage());
        $msg = "System error. Please try again later.";
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
<body class="h-screen bg-center bg-no-repeat bg-cover flex items-center justify-center min-h-screen"
      style="background-image: url('../asset/bg1.png'); background-attachment: fixed; background-position: center; background-size: cover;">

  <div class="bg-white p-8 rounded shadow-md w-full max-w-md  border border-black rounded">
    <h1 class="text-2xl font-serif mb-6 text-center text-black">Log In</h1>
    <form action="login.php" method="POST" class="space-y-4">
      <div>
        <label for="email" class="block text-sm font-sans text-black font-bold">Email</label>
        <input type="text" id="email" name="email" required  placeholder="Enter Username: " class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black font-bold">
      </div>
      <div>
        <label for="password" class="block text-sm font-sans  text-black font-bold">Password</label>
        <input type="password" id="password" name="password" required  placeholder="Enter Password:" class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black font-bold">
      </div>
      

      
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-semibold">Log In</button>
      <p class="text-sm text-center text-black">Don't have an account? <a href="register.php" class="text-blue-600 hover:underline">Register</a></p>
    </form>
  </div>
</body>
</html>