<?php

include_once __DIR__ . '/database/db.php';
include_once __DIR__ . '/helper.php';

if($_POST){
    $fullName= isset($_POST['fullname']) && !empty($_POST['fullname'])? htmlspecialchars(htmlentities($_POST['fullname'])):null;
    $email= isset($_POST['email'])? htmlspecialchars(htmlentities($_POST['email'])):null;
    $subject= isset($_POST['subject'])? htmlspecialchars(htmlentities($_POST['subject'])):null;
    $message= isset($_POST['message'])? htmlspecialchars(htmlentities($_POST['message'])):null;
    $error=[];
    if(empty($fullName)){
        $error['fullname']='Full Name is required';
    }
    if(empty($email)){
        $error['email']='Email is required';
    }
    if(empty($subject)){
        $error['subject']='Subject is required';
    }
    if(empty($message)){
        $error['message']='Message is required';
    }
    if (!isset($error['email']) && empty($error['email']) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Invalid email format";
    }
    if(count($error)<1){
        global $db;
        $id=get_last_contact_id()+1;
        $ip=get_user_ip();
        $db->exec("INSERT INTO contacts(id,full_name,email,subject,message,ip,created_date) VALUES($id,'$fullName','$email','$subject','$message','$ip','".date('Y-m-d H:i:s')."')");
        $success='Your message has been sent';
    }
}

include_once __DIR__ . '/header.php';
?>

    <div class="contact-wrapper">
        <div class="container mt-4">
            <div class="contact-container">
                <div class="contact-top-title">
                    Contact Form
                </div>
                <div class="contact-form">
                    <?= (isset($success) && !empty($success))? '<p style="color:green">'.$success.'</p>':''?>
                    <form action="/contact.php" method="post">
                        <div class="fullname-input">
                            <input type="text" name="fullname" id="" placeholder="Full Name" >
                            <?= (isset($error['fullname']) && !empty($error['fullname']))? '<p style="color:red">'.$error['fullname'].'</p>':''?>
                        </div>
                        <div class="email-input">
                            <input type="email" name="email" id="" placeholder="Email Address">
                            <?= (isset($error['email']) && !empty($error['email']))? '<p style="color:red">'.$error['email'].'</p>':''?>
                        </div>
                        <div class="subject-input">
                            <input type="text" name="subject" id="" placeholder="Subject">
                            <?= (isset($error['subject']) && !empty($error['subject']))? '<p style="color:red">'.$error['subject'].'</p>':''?>
                        </div>
                        <div class="message-input">
                            <textarea name="message" id="" cols="60" rows="5" placeholder="Message"></textarea>
                            <?= (isset($error['message']) && !empty($error['message']))? '<p style="color:red">'.$error['message'].'</p>':''?>
                        </div>
                        <div class="button-input">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include_once __DIR__ . '/footer.php';