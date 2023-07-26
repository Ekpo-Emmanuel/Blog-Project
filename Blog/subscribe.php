<?php require "config.php"; ?>
<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'email/src/Exception.php';
    require 'email/src/PHPMailer.php';
    require 'email/src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

?>
<?php  

    $name_name = "name";
    $email_name = "email";
    $subject_name = "subject";
    $message_name = "message";


    $name_error = "";
    $email_error = "";
    $subject_error = "";
    $message_error = "";
    $email_sent_error = "";

    if(isset($_POST["submit"])) {
        $naming = $_POST[$name_name];
        $email = $_POST[$email_name];
        $subject = $_POST[$subject_name];
        $messag = $_POST[$message_name];

        // email validation
        if(empty($email)) {
            $email_error = "Email is required!";
        } else{
            $email = trim($email);
            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                $email_error = "Enter a valid email";
            }
        }

        //Name validation
        if(empty($naming)) {
            $name_error = "Name is required!";
        } else {
            $naming = trim($naming);
            // $naming = htmlspecialchars($naming);
        }


        //subject validation
        if(empty($subject)) {
            $subject_error = "Subject is required!";
        } else {
            $subject = trim($subject);
            $subject = htmlspecialchars($subject);
        }

        //message validation
        if(empty($messag)) {
            $message_error = "Message is required!";
        } else {
            $messag = trim($messag);
            $messag = htmlspecialchars($messag);
        }

        //check is theres not error
        if(empty($email_error) AND empty($subject_error) AND empty($name_error) AND empty($message_error)) {

            try {       
        
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                     
                $mail->SMTPAuth   = true;                                 
                $mail->Username   = 'ekpoemmanuelsg@gmail.com';           
                $mail->Password   = 'alvdlsfyvuzjxbpb';                   
                $mail->Port       = 587;                                  
        
                //Recipients
                $mail->setFrom($email, $naming);
                $mail->addAddress('ekpoemmanuelsg@gmail.com', 'Emmanuel Ekpo');     
        
                //Content
                $mail->isHTML(true);          
                $mail->Subject = $subject;
                $mail->Body    = 'Name: '. $naming .'<p>Email: '.$email.'</p><p>'.$messag.'</p>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
                $mail->send();
                $email_sent_error = "Message Successfully Sent. I will get back to you as soon as possible";


                // Wait for 5 seconds
                // sleep(5);

                // Redirect to "index.php"
                // header("Location: index.php");
            } catch (Exception $e) {
                $email_sent_error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";                
            }
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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

    <link rel="stylesheet" href="./css/subscribe.css">
    <link rel="icon" type="image/x-icon" href="logo_dark.png">

    <style>
        .container { margin: 150px auto; }
        .slide-out-panel-container {
        background-color: #fafafa;
        }
        .contents_o1 
        {
            width: 80%;
            margin: 100px auto;  
            height: fit-content;
        }
    </style>
</head>
<body>
    <?php require "../Blog/components/header.php"; ?>

    <div class="contents_o1">
    <div class="add_blog_container">
        <div class="title">
            <span>Contact</span>
        <p style="opacity: .5; display: block; font-size: 14px; color: green;"><?php echo $email_sent_error; ?></p>
        </div>
        <form action="subscribe.php" method="POST" class="post_form">  
            <div class="pad email">
                <div class="dd">
                    <span class="val_error"><?php echo $name_error; ?></span>
                    <label for="">Your Name</label>
                    <input type="text" name="<?php echo $name_name; ?>" placeholder="Your Name..." value="<?php 
                        if (isset($_POST[$name_name])) {
                            echo $_POST[$name_name];
                        }; 
                    ?>">
                </div>
            </div>        
            <div class="pad email">
                <div class="dd">
                <span class="val_error"><?php echo $email_error; ?></span>
                <label for="">Your Email</label>
                <input type="text" name="<?php echo $email_name; ?>" placeholder="Your Email..." value="<?php 
                                if (isset($_POST[$email_name])) {
                                    echo $_POST[$email_name];
                                }; 
                        ?>">
                </div>
            </div>
            <div class="pad email">
                <div class="dd">
                <span class="val_error"><?php echo $subject_error; ?></span>
                <label for="">Subject</label>
                <input type="text" name="<?php echo $subject_name; ?>" placeholder="Subject..." value="<?php 
                                if (isset($_POST[$subject_name])) {
                                    echo $_POST[$subject_name];
                                }; 
                        ?>">
                </div>
            </div>
            <div class="pad email">
                <div class="dd">
                    <span class="val_error"> <?php echo $message_error; ?></span>
                    <label for="">Message</label>
                    <textarea id="" name="<?php echo $message_name; ?>" placeholder="Your message..." style="height:200px; text-align: left;" ></textarea>
                </div>
            </div>
            <input type="submit" value="Send Message" name="submit">
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

</body>
</html>




