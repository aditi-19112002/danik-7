<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <header class="bg-blue-600 text-white p-4 fixed top-0 z-0 w-full">
        <div class="container mx-auto">
            <nav class="flex items-center justify-between">
                <a href="#" class="text-2xl font-semibold">DANIK 7</a>
                <ul class="flex space-x-4"> 
                    <li><a href="insert.php" class="hover:text-yellow-400"><i class="bi bi-house-door-fill"></i> Home</a></li>
                   <?php if(isset($_SESSION['accounts'])):?>
                    <li><a href="index.php" class="hover:text-yellow-400"><i class="bi bi-info-circle-fill"></i> Logout</a></li>
                    <?php else:?>
                    <li><a href="login.php" class="hover:text-yellow-400"><i class="bi bi-newspaper"></i> Login  News</a></li>
                    <li><a href="register.php" class="hover:text-yellow-400"><i class="bi bi-telephone-fill"></i> Create an account</a></li>
                    <?php endif;?>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>
