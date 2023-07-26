<?php


$blog_url = "../Blog/postBlog.php";
$subscribe_url = "../Blog/subscribe.php";
$navLinks = array (
    array( "name"=>"Home", 
            "url"=>"../Blog/index.php",
        ),
    array( "name"=>"Art & Design", 
            "url"=>"../Blog/artDesign.php",
        ),
    array( "name"=>"Beauty", 
            "url"=>"../Blog/beauty.php",
        ),
    array( "name"=>"Lifestyle", 
            "url"=>"../Blog/lifeStyle.php",
            "title" => "twitter"),
    array( "name"=>"Travel", 
            "url"=>"../Blog/travel.php",
        ),
);

$socLinks = array (
    array( "name"=>"Post an Article", 
            "icon" => "<ion-icon name='add'></ion-icon>",
            "url"=> $blog_url,
            "title" => "blog"
        ),
    array( "name"=>"Linkedin", 
            "icon" => "<ion-icon name='logo-linkedin'></ion-icon>",
            "url"=>"https://www.linkedin.com/in/emmanuel-ekpo-a2973420b/",
            "title" => "twitter"
        ),
    array( "name"=>"Github", 
            "icon" => "<ion-icon name='logo-github'></ion-icon>",
            "url"=>"https://github.com/Ekpo-Emmanuel",
            "title" => "github"
        ),
    array( "name"=>"contact",
            "icon" => '<ion-icon name="mail-open"></ion-icon>',
            "url"=>$subscribe_url,
            "title" => "instagram"
        ),
);
?>
<nav class="nav">
    <div class="menu open_nav1">
        <div class="bar_cont">
            <span class="bar1 bars"></span>
            <span class="bar2 bars"></span>
            <span class="bar3 bars"></span>
        </div>
        <p class="logo">Menu</p>
        <!-- <a href="../Pages/artDesign.php"></a> -->
    </div>
    <div class="links">
        <div class="n_logo"><a href="<?php echo $navLinks[0]['url']; ?>">ruki</a></div>
        <ul>
            <?php foreach ($navLinks as $i) { ?>
                <li><a href="<?php echo $i['url']; ?>"><?php echo $i['name'];?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="search">
        <a href="<?php echo $subscribe_url; ?>" class="sub"><ion-icon name="mail-unread"></ion-icon>
        <span>Contact</span></a>
        <a href="<?php echo $blog_url; ?>">Post</a>
    </div>
</nav>

    <div id="slide-out-panel" class="slide-out-panel">
        <header>
            <a href="<?php echo $navLinks[0]['url']; ?>"><p>ruki</p></a>
        </header>
        <section class="side_ud">
            <div class="details">
                <ul class="side_links">
                    <?php foreach ($navLinks as $i) { ?>
                        <li><a href="<?php echo $i['url']; ?>"><?php echo $i['name'];?></a></li>
                    <?php } ?>
                </ul>
                <ul class="side_socials">
                    <?php foreach ($socLinks as $i) { ?>
                        <li>
                            <a 
                            href="<?php echo $i['url'] ?>" 
                            class="<?php echo $i['title'] ?>"
                            target="<?php 
                                if ($i['title'] === "blog") {
                                    echo "_self";
                                } else {echo "_blank";}
                            ?>"
                            >
                                <?php echo $i['icon'] ?>
                                <span><?php echo $i['name'] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                        <span>By Emmanuel Ekpo</span>
                    </a></li>
                </ul>                
            </div>
        </section>
    </div>


        <!-- open menu -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="../components/js/slide-out-panel.js"></script>
    <!-- header js -->
    <script src="../components/js/index.js"></script>