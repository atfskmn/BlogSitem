<?php

include_once __DIR__ . '/../database/db.php';
include_once __DIR__ . '/../helper.php';
include_once __DIR__ . '/header.php';

global $user,$db;
$post=get_posts(@$_GET['id']);
if(!isset($_GET['id']) || empty($_GET['id']) || empty($post)){
    header('Location: /admin/blog.php');
    die();
}
if($_POST){
    $error=[];
    $title= isset($_POST['title']) && !empty($_POST['title'])? htmlspecialchars(htmlentities($_POST['title'])):$post['title'];
    $read_minute=(int) isset($_POST['read_minute']) && !empty($_POST['read_minute'])? htmlspecialchars(htmlentities($_POST['read_minute'])):$post['read_minute'];
    $short_content= isset($_POST['short_content']) && !empty($_POST['short_content'])? htmlspecialchars(htmlentities($_POST['short_content'])):$post['short_content'];
    $content= isset($_POST['content']) && !empty($_POST['content'])? htmlspecialchars(htmlentities($_POST['content'])):$post['content'];

    if(empty($title)){
        $error['title']='Title is required';
    }
    if(empty($short_content)){
        $error['title']='Short Content is required';
    }
    if(empty($content)){
        $error['title']='Content is required';
    }
    if(empty($read_minute) ){
        $error['read_minute']='Read Minute is required';
    }
    if(count($error)<1){
        global $db;
        $fileName=$post['image'];;
        $target_dir = __DIR__."/../assets/uploads";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(isset($_FILES["image"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $error['image']= "File is not an image.";
                $uploadOk = 0;
            }
        }
        if ($uploadOk==1 && $_FILES["image"]["size"] > 5000000) {
            $error['image']= "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($uploadOk==1 && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $error['image']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }


        if ($uploadOk == 1) {
            $fileName=time().'.'.$imageFileType;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__.'/../assets/uploads/'.$fileName)) {

            } else {
                $error['image']= "Sorry, there was an error uploading your file.";
            }
        }
        if(!isset($error['image']) || empty($error['image'])){
            $id=get_last_post_id()+1;
            if($fileName!=$post['image']){
                $fileName='/assets/uploads/'.$fileName;
            }
            $db->exec("UPDATE posts SET image='$fileName',title='$title',short_content='$short_content',content='$content',created_date='".date('Y-m-d H:i:s')."',read_minute='$read_minute',user_id='".$user['id']."' where id=".$post['id']." ");
            header('Location: /admin/blog.php');
        }

    }


    if(count($error)>0){
        $error_message='Failed to save';
    }


}
?>
    <div class="about-wrapper">
        <div class="container mt-4">
            <div class="about-container">
                <div class="about-top-title">
                    Edit Blog
                </div>
                <div class="about-container-text">
                    <?= (isset($success) && !empty($success))? '<p style="color:green">'.$success.'</p>':''?>
                    <?= (isset($error_message) && !empty($error_message))? '<p style="color:red">'.$error_message.'</p>':''?>
                    <form action="/admin/edit-blog.php?id=<?= $post['id'] ?>" method="post" enctype="multipart/form-data">
                        <div class="fullname-input">
                            <input type="text" name="title" id="" placeholder="Title" value="<?= $post['title'] ?>">
                            <?= (isset($error['title']) && !empty($error['title']))? '<p style="color:red">'.$error['title'].'</p>':''?>
                        </div>
                        <div class="message-input">
                            <textarea name="short_content" id="" cols="60" rows="5" placeholder="Short Content"><?= $post['short_content'] ?></textarea>
                            <?= (isset($error['short_content']) && !empty($error['short_content']))? '<p style="color:red">'.$error['short_content'].'</p>':''?>
                        </div>
                        <div class="message-input">
                            <textarea name="content" id="" cols="60" rows="5" placeholder="Content"><?= $post['content'] ?></textarea>
                            <?= (isset($error['content']) && !empty($error['content']))? '<p style="color:red">'.$error['content'].'</p>':''?>
                        </div>
                        <div class="fullname-input">
                            <input type="text" name="read_minute" id="" placeholder="Read Minute" value="<?= $post['read_minute'] ?>">
                            <?= (isset($error['read_minute']) && !empty($error['read_minute']))? '<p style="color:red">'.$error['read_minute'].'</p>':''?>
                        </div>
                        <div class="fullname-input">
                            <label for="about_content">Image</label>
                            <img src="<?= $post['image'] ?>" style="width: 100px;height: 100px">
                            <input type="file" name="image" id="image">
                            <?= (isset($error['image']) && !empty($error['image']))? '<p style="color:red">'.$error['image'].'</p>':''?>
                        </div>
                        <div class="button-input">
                            <button type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

include_once __DIR__ . '/footer.php';