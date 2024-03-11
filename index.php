<?php include_once "connect.php";?>


<?php include_once "header.php";?>
<div class="h-96 bg-cover bg-center mt-16"
style="background-image: url('https://tse2.mm.bing.net/th?id=OIP.DC7U1avUpo81AHPv1xiF9wHaEd&pid=Api&P=0&h=180');">
<div class="flex flex-col items-end space-y-4">
            <form method="GET" action="" class="flex items-center bg-gray-200 border border-pink-500 rounded-full px-1 mt-1 mr-1">
                <input type="search" name="search" placeholder="Search" size="35" class="rounded-full py-1 px-1 flex-1" style="background-color: transparent; border: none; font-size: 14px;">
                <button type="submit" name="find"class="bg-transparent text-black py-1 px-1 rounded-full" style="font-size: 14px;">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            <div class="w-64 mr-6">
                <a href="#" class="block px-4 py-2 bg-blue-800 text-white rounded mb-2">News</a>
                <?php
                $query = mysqli_query($connect, "select * from category");
                while($row = mysqli_fetch_array($query)) :
                ?>
                    <a href="index.php?cat_id=<?=$row['cat_id'];?>" class="block px-4 py-2 bg-gray-100 text-black rounded mb-2"><?= $row['cat_title']; ?></a>
                <?php endwhile; ?>
            </div>
        </div>
         </div>
        <h1 class="text-3xl font-semibold mt-4 ml-6">Latest News</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <?php
        if(isset($_GET['find'])){
            $search = $_GET['search'];
            $query = mysqli_query($connect, "SELECT * FROM news JOIN category ON news.categories=category.cat_id WHERE cat_title LIKE '%$search%'");
            if (!$query) {
                die("Error in SQL query: " . mysqli_error($connect));
            }
            
        }
        else{
            if (isset($_GET['cat_id'])){
                $cat_id = $_GET['cat_id'];
                $query = mysqli_query($connect, "select * from news JOIN category ON news.categories=category.cat_id where cat_id='$cat_id'"); 
            }
            else{
                $query = mysqli_query($connect, "select * from news JOIN category ON news.categories=category.cat_id");   
            }
          
        }
        $count=mysqli_num_rows($query);

        if($count < 1){
          echo "<h1 class=text-4xl> Not avaible that news<h1>";
        }
        
        while($data = mysqli_fetch_array($query)):
            ?>
            <div class="bg-white p-4 rounded-lg shadow-md ml-4">
                <img src="<?= "images/" . $data['cover_image']; ?>" alt="Featured Article" class="w-full h-48 object-cover rounded-md">
                <h2 class="text-xl font-semibold mt-4"><?= $data['name']; ?></h2>
                <p class="text-black mt-2">Category: <?=$data['cat_title'];?></p>
                <a href="view_news.php?news_id=<?=$data['id'];?>" class="bg-blue-900 text-white py-2 px-4 rounded-md inline-block mt-2 mr-3">Read More</a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <div class="flex">
        <div class="w-2/3 p-6">
            <div class="bg-white rounded-lg shadow-md">
            <?php
          $query = mysqli_query($connect, "SELECT * FROM comment");
             ?>

          <h1 class="text-2xl font-bold mb-4">Comments</h1>

        <?php
        while ($data = mysqli_fetch_array($query)) {
          $name = $data['name'];
         $comment = $data['comments'];
         ?>

    <div class="bg-gray-200 rounded p-4 mb-4">
        <div class="text-gray-600 font-semibold"><?php echo $name; ?></div>
        <p><?php echo $comment; ?></p>
    </div>

       <?php
        }
      ?>
            </div>
        </div>
    
        <div class="w-1/3 p-6">
            <div class="bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4 ml-2">Add a Comment</h2>
                <form class="mt-2" method="POST">
                    <div class="mb-4 ml-2 mr-2">
                        <label for="name" class="block text-gray-600 font-semibold ">Name</label>
                        <input type="text" id="name" name="name" class="w-full rounded border p-2 focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div class="mb-4 ml-2 mr-2">
                        <label for="comment" class="block text-gray-600 font-semibold">Comment</label>
                        <textarea id="comment" name="comments" class="w-full rounded border p-2 focus:outline-none focus:ring focus:border-blue-300"></textarea>
                    </div>
                    <button type="submit"name="create" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 ml-2 mb-2"> Post Comment <i class="bi bi-send-fill"></i></button>
                </form>
                <?php
                if(isset($_POST['create'])){
                   $name = $_POST['name'];
                   $comments = $_POST['comments'];

                   $query = mysqli_query($connect,"INSERT INTO comment(name,comments) VALUE ('$name','$comments')");
                   if($query){
                      echo "<script> window.open('index.php','_self')</script>";
                   }
                   else{
                    echo "<script>alert('failed')</script>";
                   }

                }
                ?>
                
            </div>
        </div>
    </div>
    
</body>
</html>

      