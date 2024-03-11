<?php include_once "connect.php";

if(isset($_SESSION['account'])){
    echo "<script>windows.open('login.php','_self')</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News website</title>
    <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<header class="bg-blue-600 text-white p-4">
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


     <div class="flex-1 bg-slate-700 p-6">
     <div class="flex space-x-6">
    <div class="w-1/2 bg-white text-black shadow-md p-4 mb-8">
        <div class="w-64 mt-4">
            <a href="" class="block px-4 py-2 bg-red-500 text-white rounded mb-2">Insert news detail</a>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="block text-black"> Name</label>
                    <input type="text" id="name" name="name" class=" form-control w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-3">
                    <label for="discription" class="block text-black">Discription:</label>
                    <textarea rows="4" name="discription" id="discription" class="form-control w-full px-3 py-2 border rounded-lg"></textarea>
                </div>
                <div class="mb-3">
                    <label for="categories" class="block text-black">Categories:</label>
                    <select name="categories" id="categories" class="form-select w-full px-3 py-2 border rounded-lg">
                        <option value="">Select category here</option>
                        <?php
              $query=mysqli_query($connect,"select * from category");
              while($row = mysqli_fetch_array($query)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo"<option value='$cat_id'>$cat_title</option>"; 
              }
              ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cover_image" class="block text-black">Cover Image:</label>
                    <input type="file" id="cover_image" name="cover_image" class="form-control">
                </div>
                <div class="mb-3">
            <input type="submit" name="create" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600" value="Insert detail">
          </div>
            </form>
            <?php
            if(isset($_POST['create'])){
                $_name=$_POST['name'];
                $_discription=$_POST['discription'];
                $_categories=$_POST['categories'];
                $_cover_image=$_FILES['cover_image']['name']; 
              $_tmp_cover_image=$_FILES['cover_image']['tmp_name']; 

          move_uploaded_file($_tmp_cover_image,"images/$_cover_image");
          
          $query=mysqli_query($connect,"INSERT INTO news(name,discription,categories,cover_image)
          VALUE('$_name','$_discription','$_categories','$_cover_image')");
           if($query){
            echo"<script>window.open('index.php','_self')</script>";
          }
          else{
            echo"<script>alert('failed')</script>";
          }

            }
            ?>
        </div>
    </div>

    <div class="w-1/2 bg-white text-black shadow-md p-4 mb-8 ">
        
        <div class="w-64 mt-4">
            <a href="" class="block px-4 py-2 bg-red-500 text-white rounded mb-2">Insert category detail</a>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="cat_title" class="block text-black font-semibold">Category name:</label>
                    <input type="text" id="cat_title" name="cat_title" placeholder="Enter category name" class="form-control w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-3">
                    <input type="submit" name="create_category" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-600" value="Insert category">
                </div>
            </form>
            <?php
            if(isset($_POST['create_category'])){
             
                $cat_title = $_POST['cat_title'];

                $query = mysqli_query($connect,"INSERT INTO category(cat_title)VALUE('$cat_title')");
                if($query){
                  echo"<script>window.open('insert.php','_self')</script>";
                  }
                  else{
                    echo"<script>alert('failed')</script>";
                  }
        
                    }
            
            ?>
        </div>
    </div>
</div>
</div>
</body>
</html>