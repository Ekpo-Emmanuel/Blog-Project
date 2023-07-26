<?php

    require "config.php";
	$data = $conn->query("SELECT * FROM addblog ORDER BY id DESC"); 
?>
<?php 

$meta_info = "IdeaVault is a cutting-edge article site where users worldwide can publish and share their diverse perspectives. Embracing inclusivity, the platform ensures high-quality content through advanced moderation. With a multilingual interface, it fosters cross-cultural dialogues, offering a supportive community for writers to connect and grow. Privacy and data security are paramount, making IdeaVault a trusted platform for free expression and knowledge exchange.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo $meta_info; ?>">
    <title>Idea Vault</title>
    <!-- custom font: https://fontlibrary.org/en/font/fantasque-sans-mono -->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/fantasque-sans-mono" type="text/css"/>
    <!-- header/footer css -->
    <link rel="stylesheet" href="./components/css/header.css">
    <link rel="stylesheet" href="./components/css/footer.css">
    <link rel="stylesheet" href="./css/component.css">
    <!-- slider css -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- font awesome icon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- iconic icons:  -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <!-- jquery open nav  -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="./components/css/slide-out-panel.css" rel="stylesheet">

    <!-- main get blog css -->
    <link rel="stylesheet" href="./css/getblog.css">
    <link rel="icon" type="image/x-icon" href="./components/logo_dark.png">


    <style>
        .container { margin: 150px auto; }
        img { width: 100%; }
        .slide-out-panel-container {
        background-color: #fafafa;
        }
        .contents_o1 
        {
            margin-top: 100px;
            width: 90%;
            margin: 100px auto;
        }
        
    </style>
</head>
<body>
    <?php require "../Blog/components/header.php"; ?>

    <div class="contents_o1">
        <div class="next01">
            <span>Home</span>
            <small>/ Articles</small>
        </div>

        <div class="grid-container">
            <?php  while($rows = $data->fetch(PDO::FETCH_OBJ)) :?>
                <div class="item1 grid">
                    <div class="contss">
                        <div class="s1">
                            <a class="db_category" href="<?php
                                if ($rows->category === "travel") {echo "travel.php";}
                                else if ($rows->category === "general") {echo "index.php";}
                                else if ($rows->category === "art_design") {echo "artDesign.php";}
                                else if ($rows->category === "beauty") {echo "beauty.php";}
                                else if ($rows->category === "lifestyle" || $rows->category === "lifstyle") {echo "lifeStyle.php";}
                                else if ($rows->category === "select") {echo "index.php";}
                            ?>"><?php echo $rows->category;?></a>
                        </div>
                        <div class="db_details">
                            <p class="db_title"><a href="blogPost.php?id=<?php echo $rows->id; ?>"><?php echo $rows->title;  ?></a></p>
                            <div class="db_det1">
                                <p><span><?php echo $rows->firstname . " " .$rows->lastname  ?></span></p>
                                <span><?php echo date('M', strtotime($rows->created_at)) . ',' . date('d', strtotime($rows->created_at)) . ' ' .  date('Y', strtotime($rows->created_at)); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                    
            <?php  endwhile;  ?>
        </div>
    </div>
    <button onclick="topFunction()" class="scroll_up" title="Go to top"><ion-icon name="arrow-up"></ion-icon></button>

    <?php require "../Blog/components/footer.php"; ?>


    <!-- open menu -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="./components/js/slide-out-panel.js"></script>
    <!-- header js -->
    <script src="./components/js/index.js"></script>
  <script  src="./js/script.js"></script>
  <script>
    var category = document.querySelectorAll(".grid-container .grid .contss .s1 .db_category");
    for (let i = 0; i < category.length; i++) {
        if (category[i].textContent  === "general") {
            category[i].style.backgroundColor = "rgb(4,24,28)";
        } else if (category[i].textContent  === "art&design") {
            category[i].style.backgroundColor = "#4E0A1D";
        } else if (category[i].textContent  === "travel") {
            category[i].style.backgroundColor = "#38086E";
        } else if (category[i].textContent  === "beauty") {
            category[i].style.backgroundColor = "purple";
        } else {
            category[i].style.backgroundColor = "#4E0A1D";   
        }
    }

    // trim usage:
    const all_title = document.querySelectorAll(".grid-container .grid .contss .db_details .db_title a");
    const maxLength = 45;
    all_title.forEach(item => {
        if (item.textContent.length > maxLength) {
            item.textContent = item.textContent.slice(0, maxLength) + "...";
            console.log(item.length )
        }
    });
    let scrollBtn = document.querySelector(".scroll_up");
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                scrollBtn.style.display = "block";
            } else {
                scrollBtn.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
  </script>
</body>
</html>


