<?php  require "config.php"; ?>
<?php  

    $fnameError = "";
    $lnameError = "";
    $titleError = "";
    $descError = "";
    $catError = "";

    if(isset($_POST["submit"])) {
        $fname = $_POST["firstName"];
        $lname = $_POST["lastName"];
        $title = $_POST["title"];
        $desc = $_POST["description"];
        $category = $_POST["category"];


        // name validation
        if(empty($fname)) {
            $fnameError = "First name is required!";
        } elseif (strlen($fname) < 2) {
            $fnameError = "First name too short!";
        } elseif (str_word_count($fname) > 1) {
            $fnameError = "Enter 1 name";
        } else{
            $fname = trim($fname);
            $fname = htmlspecialchars($fname);
            if (!preg_match("/^[A-Za-z]+$/", $fname)) {
                $fnameError = "Name cannot contain numbers and characters";
            }
        }
        if(empty($lname)) {
            $lnameError = "Last name is required!";
        } elseif (strlen($lname) < 2) {
            $lnameError = "Last name too short!";
        } elseif (str_word_count($lname) > 1) {
            $lnameError = "Enter 1 name";
        } else {
            $lname = trim($lname);
            $lname = htmlspecialchars($lname);
            if (!preg_match("/^[A-Za-z]+$/", $lname)) {
                $lnameError = "Name cannot contain numbers and characters";
            }
        }

        //title validation
        if(empty($title)) {
            $titleError = "Title is required!";
        } elseif (strlen($title) < 2) {
            $titleError = "Title too short!";
        } else {
            $title = trim($title);
            $title = htmlspecialchars($title);
        }

        //blog validation
        if(empty($desc)) {
            $descError = "Blog is required";
        } elseif (strlen($desc) < 50) {
            $descError = "too short. Minimum of 50 characters";
        } else {
            $desc = htmlspecialchars($desc);
        }


        if ($category == "select") {
            $catError = "please select a category!";
        }

        //check is theres not error
        if(empty($fnameError) AND empty($lnameError) AND empty($titleError) AND empty($descError) AND empty($catError)) {
            $insert = $conn->prepare("INSERT INTO addblog (firstname, lastname, title, category, description) VALUES (:firstname, :lastname, :title, :category, :description)");
            $insert -> execute([
                ":firstname" => $fname,
                ":lastname" => $lname,
                ":title" => $title,
                ":category" => $category,
                ":description" => $desc,
            ]);
            header("location: index.php"); 
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post an Article</title>
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
    <!-- form validation -->
    <link rel="Stylesheet" href="./css/validin.css" type="text/css" media="all" />
    <!-- main css  -->
    <link rel="stylesheet" href="./css/validin.css">
    <link rel="icon" type="image/x-icon" href="logo_dark.png">

    <style>
        .slide-out-panel-container { background-color: #fafafa; }
        .contents_o1 
        {
            margin-top: 100px;
            width: 90%;
            margin: 100px auto;
            z-index: -200000;
        }
    </style>
</head>
<body>
    <?php require "./components/header.php"; ?>
    <div class="contents_o1">
        <div class="add_blog_container">
            <div class="title">
                <span>Post an Article</span>
            </div>
            <form action="postBlog.php" method="POST" enctype="multipart/form-data" class="post_form">          
                <div class="pad">
                    <label for="">Your Name</label>
                    <div class="s1">
                        <div class="dd">
                            <span class="val_error"><?php echo $fnameError; ?></span>
                            <input type="text" name="firstName" placeholder="First name" validate="alpha" value="<?php 
                                    if (isset($_POST["firstName"])) {
                                        echo $_POST["firstName"];
                                    }; 
                            ?>">
                        </div>
                        <div class="dd">
                            <span class="val_error"><?php echo $lnameError; ?></span>
                            <input type="text" name="lastName" placeholder="Last name" value="<?php 
                                    if (isset($_POST["lastName"])) {
                                        echo $_POST["lastName"];
                                    }; 
                            ?>">
                        </div>
                    </div>
                </div>
                <div class="pad email ">
                    <div class="dd">
                        <span class="val_error"><?php echo $catError; ?></span>
                        <label for="">Category</label>
                    <select name="category" id="category" class="category">
                        <option value="select" selected>Please Select</option>
                        <option value="art_design" >Art and Design</option>
                        <option value="beauty">Beauty</option>
                        <option value="lifestyle">Life Style</option>
                        <option value="travel">Travel</option>
                        <option value="general">General</option>
                    </select>
                    </div>
                </div>
                <div class="pad email">
                    <div class="dd">
                    <span class="val_error"><?php echo $titleError; ?></span>
                    <label for="">Blog Title</label>
                    <input type="text" name="title" placeholder="title" value="<?php 
                                    if (isset($_POST["title"])) {
                                        echo $_POST["title"];
                                    }; 
                            ?>">
                    </div>
                </div>
                <div class="pad email">
                    <div class="dd">
                    <span class="val_error"><?php echo $descError; ?></span>
                    <textarea id="" name="description" placeholder="Type or paste here..." style="height:200px"><?php      if (isset($_POST["description"])) {
                                        echo $_POST["description"];
                                    };  ?></textarea>
                    </div>
                </div>
                <input type="submit" value="Post blog" name="submit">
                <!-- <?php require "./Pages/blogForm.php"; ?> -->
            </form>
        </div>
    </div>
    <?php require "../Blog/components/footer.php"; ?>


    <!-- open menu -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="./components/js/slide-out-panel.js"></script>
    <!-- header js -->
    <script src="./components/js/index.js"></script>
  <script  src="./js/script.js"></script>

    <script>

        // image uploader
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }}
    </script>
</body>
</html>




