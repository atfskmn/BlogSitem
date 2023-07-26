<?php

include_once __DIR__ . '/database/db.php';
include_once __DIR__ . '/helper.php';


include_once __DIR__ . '/header.php';
if($_POST){
    $full_name= isset($_POST['full_name'])? htmlspecialchars(htmlentities($_POST['full_name'])):null;
    $email= isset($_POST['email'])? htmlspecialchars(htmlentities($_POST['email'])):null;
    $password= isset($_POST['password'])? $_POST['password']:null;
    $error=[];
    if(empty($full_name)){
        $error['full_name']='Full Name is required';
    }
    if(empty($email)){
        $error['email']='Email is required';
    }
    if(empty($password)){
        $error['password']='Password is required';
    }
    if (!isset($error['email']) && empty($error['email']) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Invalid email format";
    }

    if(count($error)<1){
        $user=get_user_by_email($email);
        if(empty($user)){
            global $db;
            $password=md5($password);
            $id=get_last_user_id()+1;
            $db->exec("INSERT INTO users(id,full_name,email,password) VALUES($id,'$full_name','$email','$password')");
            header('Location: /login.php');
            die();
        }else{
            $error['email'] = "Such an Email Address Has Been Registeredr";
        }
    }
}

?>

    <div class="contact-wrapper">
        <div class="container mt-4">
            <div class="contact-container">
                <div class="contact-top-title">
                    Register Form
                </div>
                <div class="contact-form">
                    <?= (isset($success) && !empty($success))? '<p style="color:green">'.$success.'</p>':''?>
                    <form action="/register.php" method="post">
                        <div class="email-input">
                            <input type="text" name="full_name" id="" placeholder="Full Name">
                            <?= (isset($error['full_name']) && !empty($error['full_name']))? '<p style="color:red">'.$error['full_name'].'</p>':''?>
                        </div>
                        <div class="email-input">
                            <input type="email" name="email" id="" placeholder="Email Address">
                            <?= (isset($error['email']) && !empty($error['email']))? '<p style="color:red">'.$error['email'].'</p>':''?>
                        </div>
                        <div class="subject-input">
                            <input type="password" name="password" id="" placeholder="">
                            <?= (isset($error['password']) && !empty($error['password']))? '<p style="color:red">'.$error['password'].'</p>':''?>
                        </div>

                        <div class="button-input">
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include_once __DIR__ . '/footer.php';