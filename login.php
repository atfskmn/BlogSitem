<?php

include_once __DIR__ . '/database/db.php';
include_once __DIR__ . '/helper.php';


include_once __DIR__ . '/header.php';
if($_POST){
    $email= isset($_POST['email'])? $_POST['email']:null;
    $password= isset($_POST['password'])? $_POST['password']:null;
    $error=[];
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
        $user=get_user_by_email_and_password($email,$password);
        if(!empty($user)){
            $_SESSION['user_id']=$user['id'];
            header('Location: /admin/');
            die();
        }else{
            $error['email'] = "Please submit your login information";
        }
    }
}

?>

    <div class="contact-wrapper">
        <div class="container mt-4">
            <div class="contact-container">
                <div class="contact-top-title">
                    Login Form
                </div>
                <div class="contact-form">
                    <?= (isset($success) && !empty($success))? '<p style="color:green">'.$success.'</p>':''?>
                    <form action="/login.php" method="post">
                        <div class="email-input">
                            <input type="email" name="email" id="" placeholder="Email Address">
                            <?= (isset($error['email']) && !empty($error['email']))? '<p style="color:red">'.$error['email'].'</p>':''?>
                        </div>
                        <div class="subject-input">
                            <input type="password" name="password" id="" placeholder="">
                            <?= (isset($error['password']) && !empty($error['password']))? '<p style="color:red">'.$error['password'].'</p>':''?>
                        </div>

                        <div class="button-input">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include_once __DIR__ . '/footer.php';