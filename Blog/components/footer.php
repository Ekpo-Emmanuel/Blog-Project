<?php

$navLinks = array (
    array( "name"=>"Art & Design", 
            "url"=>"../Blog/artDesign.php"),
    array( "name"=>"Beauty", 
            "url"=>"../Blog/beauty.php"),
    array( "name"=>"Lifestyle", 
            "url"=>"../Blog/lifeStyle.php"),
    array( "name"=>"Travel", 
            "url"=>"../Blog/travel.php"),
);

$blog_url = "../Blog/postBlog.php";
$subscribe_url = "../Blog/subscribe.php";

$b_slinks = array (
    array( "name"=>"Linkedin", 
            "icon" => "<ion-icon name='logo-Linkedin' class='twitter'></ion-icon>",
            "url"=>"https://www.linkedin.com/in/emmanuel-ekpo-a2973420b/",
        ),
    array( "name"=>"Github", 
            "icon" => "<ion-icon name='logo-github' class='github'></ion-icon>",
            "url"=>"https://github.com/Ekpo-Emmanuel",
        ),
    array( "name"=>"contact",
            "icon" => '<ion-icon name="mail-open" class="instagram"></ion-icon> ',
            "url"=>$subscribe_url,
        ),
);
?>
<footer class="footer">
        <form action="">
            <span class="stl">Stay in the Loop</span>
            <label for="email">Hire the developer</label>
            <!-- <div class="email_container">
                <input type="email" name="email" id="email_id" placeholder="Your email address"/>
                <button type="submit" name="submit">Sign up</button>
            </div> -->
            <div class="slinks">
                <?php foreach ($b_slinks as $i) { ?>
                    <li>
                        <a href="<?php echo $i['url']; ?>" target="<?php 
                                if ($i['name'] === "contact") {
                                    echo "_self";
                                } else {echo "_blank";}
                            ?>">
                            <?php echo $i['icon']; ?>
                        </a>
                    </li>
                <?php } ?>
            </div>
        </form>
        <div class="sec2">
            <div class="name">
                <!-- <img src="logo_light.png" alt="showed" height="200px"  > -->
                <span>#Blog Project by Emmanuel Ekpo</span> 
            </div>
            <ul>
                <?php foreach ($navLinks as $i) { ?>
                    <li><a href="<?php echo $i['url']; ?>"><?php echo $i['name'];?></a></li>
                <?php } ?>
            </ul>
        </div>
</footer>