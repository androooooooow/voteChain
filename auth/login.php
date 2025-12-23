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
        <label for="username" class="block text-sm font-serif text-black font-bold">Username</label>
        <input type="text" id="username" name="username" required  placeholder="Enter Username: " class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black font-bold">
      </div>
      <div>
        <label for="password" class="block text-sm font-serif  text-black font-bold">Password</label>
        <input type="password" id="password" name="password" required  placeholder="Enter Password:" class="mt-1 block w-full px-3 py-2 border border-black-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black font-bold">
      </div>
      

      
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-semibold">Log In</button>
      <p class="text-sm text-center text-black">Don't have an account? <a href="register.php" class="text-blue-600 hover:underline">Register</a></p>
    </form>
  </div>
</body>
</html>