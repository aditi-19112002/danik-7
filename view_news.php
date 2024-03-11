<?php include_once "connect.php";?>
<?php include "header.php";?>
        
        <!-- <h1 class="text-3xl font-semibold mt-20 ml-6">Latest News</h1> -->
        <div class="h-full bg-cover bg-center p-16"
  style="background-image: url('https://ichef-1.bbci.co.uk/news/320/cpsprodpb/22AC/production/_98667880_online_2015v2-nc.png');">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mx-auto max-w-screen-lg p-4 mt-16">
        <?php
        $news_id = $_GET['news_id'];

        $query = mysqli_query($connect, "Select * from news JOIN category ON news.categories=category.cat_id WHERE id='$news_id'");
        $data = mysqli_fetch_array($query);
        ?>
        <div class="bg-white p-4 rounded-lg shadow-md border border-gray-300">
            <img src="<?= "images/" . $data['cover_image']; ?>" alt="Featured Article" class="w-full h-48 object-cover rounded-md">
            <p class="text-black mt-2 font-bold text-xl">Category: <?=$data['cat_title'];?></p>
            <p class="text-black mt-2 text-xl font-bold">Description: <?=$data['discription'];?></p>
        </div>
    </div>
</div>



</body>
</html>
