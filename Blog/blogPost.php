<?php 

    require "config.php";

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $selectAll = $conn->query("SELECT * FROM addblog WHERE id !='$id' ORDER BY RAND() LIMIT 3");
        $selectAll->execute();
        $bp = $selectAll->fetchAll(PDO::FETCH_OBJ);


        $select = $conn->query("SELECT * FROM addblog WHERE id='$id'");
        $select->execute();
        $row = $select->fetch(PDO::FETCH_OBJ);


        // add comment
        $name = "comment_name";
        $details = "comment";

        $name_error = "";
        $details_error = "";
    }


    function getThirdParagraph($text) {
        // Split the text into paragraphs using double line breaks as the delimiter
        $paragraphs = preg_split('/\n\s*\n/', $text);
        
        // Check if we have at least three paragraphs
        if (count($paragraphs) >= 3) {
            // Get the first three paragraphs and join them back together
            $thirdParagraph = implode("\n\n", array_slice($paragraphs, 0, 3));
            return $thirdParagraph;
        } else {
            // If there are less than three paragraphs, return the original text
            return $text;
        }
    }

    $meta_info = $row->description;
    $trimmed_metaInfo = getThirdParagraph($meta_info);
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $trimmed_metaInfo; ?>">
    <title>
        <?php 
            if ($row->category === "travel") {echo "travel - ". $row->title;}
            else if ($row->category === "general") {echo "general - ". $row->title;}
            else if ($row->category === "art_design") {echo "design - ". $row->title;}
            else if ($row->category === "beauty") {echo "beauty - ". $row->title;}
            else if ($row->category === "lifestyle") {echo "Lifestyle - ". $row->title;}
            else {echo "Idea Vault";}
        ?>
    </title>
    <!-- custom font: https://fontlibrary.org/en/font/fantasque-sans-mono -->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/fantasque-sans-mono" type="text/css"/>
    <!-- header/footer css -->
    <link rel="stylesheet" href="./components/css/header.css">
    <link rel="stylesheet" href="./components/css/footer.css">
    <link rel="stylesheet" href="./css/component.css">
    <!-- slider css -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- iconic icons:  -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <!-- jquery open nav  -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="./components/css/slide-out-panel.css" rel="stylesheet">
    <!-- main css  -->
    <link rel="stylesheet" href="./css/showBlog.css">
    <link rel="stylesheet" href="./css/showBlogmedia.css">
    <link rel="icon" type="image/x-icon" href="logo_dark.png">
    <style>
        .slide-out-panel-container {
        background-color: #fafafa;
        }
        .contents_o1 
        {
            width: 90%;
            margin: 100px auto;
        }
    </style>
</head>
<body>
    <?php require "./components/header.php"; ?>
    
    <div class="contents_o1">
        <div class="each_post_container">
            <div class="back_to_home" onclick=window.history.go(-1);>
                    <ion-icon name="arrow-back"></ion-icon>
                    <span>Back</span>
            </div>
            <div class="sec1">
                <div class="title">
                    <p><?php echo $row->title; ?></p>
                    <div class="prate">
                        <span><?php echo $row->firstname . " " .$row->lastname;  ?></span>
                        <span><?php echo date('M', strtotime($row->created_at)) . ',' . date('d', strtotime($row->created_at)) . ' ' .  date('Y', strtotime($row->created_at)); ?></span>
                        <a class="category" href="
                        <?php 
                            if ($row->category === "travel") {echo "travel.php";}
                            else if ($row->category === "general") {echo "index.php";}
                            else if ($row->category === "art_design") {echo "artDesign.php";}
                            else if ($row->category === "beauty") {echo "beauty.php";}
                            else if ($row->category === "lifestyle") {echo "lifeStyle.php";}
                        ?>"><?php echo $row-> category; ?></a>
                    </div>
                </div>
                <div class="postless">
                    <p class="postless_p"><?php echo  $row->description; ?></p>
                    <span class="postless_thanks">thanks for reading :)</span>
                    <!-- <button class="readMoreBtn"><span>Read more</span></button> -->
                </div>
            </div>
            <div class="back_to_home" onclick=window.history.go(-1);>
                    <ion-icon name="arrow-back"></ion-icon>
                    <span>Go Back</span>
            </div>

            <div class="comment_section">
                <span class="comm_title">Comments</span>
                <div class="sec1">
                    <div class="user">
                    <ion-icon name="person"></ion-icon>
                    </div>
                    <form action="" method="POST">
                        <div>
                            <span class="error"><?php echo $name_error ?></span>
                            <input type="text" placeholder="Your Name" name="<?php echo $name ?>">
                        </div>
                        <div>
                            <textarea name="comment" id="" cols="30" rows="10" placeholder="Add a comment"></textarea>
                            <span class="error"><?php echo $name_error ?></span>
                        </div>
                        <!-- <input type="submit" name="<?php echo $details ?>" value="Post"> -->
                        <p >Post</p>
                    </form>
                </div>
                <div class="sec2">
                    <p class="comm_title">All comments (<span>0</span>)</p>
                </div>
            </div> 

            <div class="sec2">
                <div class="title">
                    <span>More articles</span>
                </div>
                <div class="s2">
                    <div class="grid-container">
                    <?php  foreach($bp as $i) :   ?>
                        <div class="item1 grid <?php 
                                if ($row->category === "travel") {echo "travel";}
                                else if ($row->category === "general") {echo "general";}
                                else if ($row->category === "art_design") {echo "design";}
                                else if ($row->category === "beauty") {echo "beauty";}
                                else if ($row->category === "lifstyle") {echo "style";}
                            ?>">
                            <div class="contss">
                                <div class="s1">
                                    <a class="db_category" href="<?php
                                    if ($row->category === "travel") {echo "travel.php";}
                                    else if ($row->category === "general") {echo "index.php";}
                                    else if ($row->category === "art_design") {echo "artDesign.php";}
                                    else if ($row->category === "beauty") {echo "beauty.php";}
                                    else if ($row->category === "lifstyle") {echo "lifeStyle.php";}
                                ?>"><?php echo $i->category;  ?></a>
                                </div>
                                <div class="db_details">
                                    <p class="db_title"><a href="blogPost.php?id=<?php echo $i->id; ?>"><?php echo $i->title;  ?></a></p>
                                    <div class="db_det1">
                                        <p class="to_off"><span><?php echo $i->firstname . " " .$i->lastname  ?></span></p>
                                        <span class="to_date"><?php echo date('M', strtotime($i->created_at)) . ',' . date('d', strtotime($i->created_at)) . ' ' .  date('Y', strtotime($i->created_at)); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>     
                    <?php  endforeach;  ?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <button onclick="topFunction()" class="scroll_up" title="Go to top"><ion-icon name="arrow-up"></ion-icon></button>

    <?php require "../Blog/components/footer.php"; ?>





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

        const all_title = document.querySelectorAll(".each_post_container .sec2 .s2 .grid-container .grid .contss .db_details .db_title a");
        const maxLength = 40;
        all_title.forEach(item => {
            if (item.textContent.length > maxLength) {
                item.textContent = item.textContent.slice(0, maxLength) + "...";
                console.log(item.length )
            }
        });

        //scroll to top
        let scrollBtn = document.querySelector(".scroll_up");
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                scrollBtn.style.display = "block";
            } else {
                scrollBtn.style.display = "none";
            }
        }
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        function getCurrentDateTime() {
            const currentDate = new Date();

            const dayOfWeek = currentDate.getDay();
            const dayOfMonth = currentDate.getDate();
            const month = currentDate.getMonth();
            const year = currentDate.getFullYear();

            const day = dayOfMonth < 10 ? '0' + dayOfMonth : dayOfMonth;
            const formattedMonth = (month + 1) < 10 ? '0' + (month + 1) : (month + 1);

            const currentTime = currentDate.toLocaleTimeString();
            
            return {
                time: currentTime,
                dayOfWeek: dayOfWeek,
                dayOfMonth: day,
                month: formattedMonth,
                year: year
            };
        }

        //add comment
        var commentCounter = 0;
        let addCmtBtn = document.querySelector(".each_post_container .comment_section .sec1 form p");

        addCmtBtn.addEventListener("click", ()=> {
            //get data from fields 
            let name = document.querySelector(".each_post_container .comment_section .sec1 form input");

            const randomID = generateRandomID(4);
            
            if (name.value === "") {
                name.value = "User"+randomID;

            }
            let details = document.querySelector(".each_post_container .comment_section .sec1 form textarea");
            if (details.value === "") {
                details.value = "Well done";
            }

            //create element 
            let display_cc = document.createElement("div");
            display_cc.classList.add("display_cc");
            // display_cc.textContent = name.value;

            var sec2 = document.querySelector(".each_post_container .comment_section .sec2");
            sec2.appendChild(display_cc);

            let user = document.createElement("user");
            user.classList.add("user");
            user.innerHTML = '<ion-icon name="person"></ion-icon>';
            display_cc.appendChild(user);

            let content = document.createElement("div");
            content.classList.add("content");
            display_cc.appendChild(content);

            let p = document.createElement("p");
            content.classList.add("name");
            p.textContent = name.value;
            content.appendChild(p);

            let span = document.createElement("span");
            span.classList.add("comment_details");
            span.textContent = details.value;
            content.appendChild(span);

            const currentDateTime = getCurrentDateTime();
            let small = document.createElement("small");
            small.classList.add("comment_date");
            small.textContent = currentDateTime.time + " " + currentDateTime.dayOfWeek + "/" + currentDateTime.month + "/" + currentDateTime.year;
            content.appendChild(small);
            


            console.log("Current time:", currentDateTime.time);
            console.log("Day of the week:", currentDateTime.dayOfWeek);
            console.log("Day of the month:", currentDateTime.dayOfMonth);
            console.log("Month:", currentDateTime.month);
            console.log("Year:", currentDateTime.year);
        

            

            commentCounter++;

            // Update the counter value in the HTML
            var counterElement = document.querySelector(".each_post_container .comment_section .sec2 p span");
            counterElement.textContent = commentCounter;
        })

        function generateRandomID(length) {
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let id = '';
            for (let i = 0; i < length; i++) {
                let randomIndex = Math.floor(Math.random() * characters.length);
                id += characters.charAt(randomIndex);
            }
            return id;
        }
    </script>
</body>
</html>