<?php

include_once __DIR__ . '/../database/db.php';
include_once __DIR__ . '/../helper.php';
include_once __DIR__ . '/header.php';

if($_POST){
    $error=[];
    $site_title= isset($_POST['site_title']) && !empty($_POST['site_title'])? htmlspecialchars(htmlentities($_POST['site_title'])):'';
    $job_title= isset($_POST['job_title']) && !empty($_POST['job_title'])? htmlspecialchars(htmlentities($_POST['job_title'])):'';
    $full_name= isset($_POST['full_name']) && !empty($_POST['full_name'])? htmlspecialchars(htmlentities($_POST['full_name'])):'';
    $short_about= isset($_POST['short_about']) && !empty($_POST['short_about'])? htmlspecialchars(htmlentities($_POST['short_about'])):'';
    $about_title= isset($_POST['about_title']) && !empty($_POST['about_title'])? htmlspecialchars(htmlentities($_POST['about_title'])):'';
    $about_content= isset($_POST['about_content']) && !empty($_POST['about_content'])? htmlspecialchars(htmlentities($_POST['about_content'])):'';
    $social_urls=isset($_POST['social_urls']) && !empty($_POST['social_urls'])? $_POST['social_urls']:[];

    global $db;
    $db->exec("UPDATE settings SET meta_value='$site_title' where meta_key='site_title' ");
    $db->exec("UPDATE settings SET meta_value='$job_title' where meta_key='job_title' ");
    $db->exec("UPDATE settings SET meta_value='$full_name' where meta_key='full_name' ");
    $db->exec("UPDATE settings SET meta_value='$short_about' where meta_key='short_about' ");
    $db->exec("UPDATE settings SET meta_value='$about_title' where meta_key='about_title' ");
    $db->exec("UPDATE settings SET meta_value='$about_content' where meta_key='about_content' ");

    if(count($social_urls)>0){
        $db->exec("DELETE FROM settings WHERE meta_key='social_urls'");
        foreach ($social_urls as $key=>$social_url) {
            $meta_value=json_encode($social_url);
            $id=get_last_setting_id()+1;
            $db->exec("INSERT INTO settings(id,meta_key,meta_value,meta_description) VALUES($id,'social_urls','$meta_value','Social Accounts')");
        }
    }
    $target_dir = __DIR__."/../assets/uploads";
    $target_file = $target_dir . basename($_FILES["person_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_FILES["person_image"])) {
        $check = getimagesize($_FILES["person_image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $error['person_image']= "File is not an image.";
            $uploadOk = 0;
        }
    }


    if ($uploadOk==1 && $_FILES["person_image"]["size"] > 500000) {
        $error['person_image']= "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($uploadOk==1 && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $error['person_image']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }


    if ($uploadOk == 1) {
        $fileName=time().'.'.$imageFileType;
        if (move_uploaded_file($_FILES["person_image"]["tmp_name"], __DIR__.'/../assets/uploads/'.$fileName)) {
            $db->exec("UPDATE settings SET meta_value='/assets/uploads/$fileName' where meta_key='person_image' ");

        } else {
            $error['person_image']= "Sorry, there was an error uploading your file.";
        }
    }
    if(count($error)>0){
        $error='Failed to save';
    }else{
        $success='Successfully Saved';
    }


}
?>
    <div class="about-wrapper">
        <div class="container mt-4">
            <div class="about-container">
                <div class="about-top-title">
                    Settings List
                    <?= isset($success) && !empty($success)? '<p style="color:green;">'.$success.'</p>':'' ?>
                    <?= isset($error) && !empty($error)? '<p style="color:red;">'.$error.'</p>':'' ?>
                </div>
                <div class="about-container-text">
                    <form action="/admin/setting.php" method="post" enctype="multipart/form-data">
                        <div class="fullname-input">
                            <label for="site_title">Site Title</label>
                            <input type="text" name="site_title" id="" placeholder="Site Title" value="<?= get_setting('site_title') ?>">
                            <?= (isset($error['site_title']) && !empty($error['site_title']))? '<p style="color:red">'.$error['site_title'].'</p>':''?>
                        </div>
                        <div class="fullname-input">
                            <label for="job_title">Job Title</label>
                            <input type="text" name="job_title" id="" placeholder="Job Title" value="<?= get_setting('job_title') ?>">
                            <?= (isset($error['job_title']) && !empty($error['job_title']))? '<p style="color:red">'.$error['job_title'].'</p>':''?>
                        </div>
                        <div class="fullname-input">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" id="" placeholder="Full Name" value="<?= get_setting('full_name') ?>">
                            <?= (isset($error['full_name']) && !empty($error['full_name']))? '<p style="color:red">'.$error['full_name'].'</p>':''?>
                        </div>
                        <div class="fullname-input">
                            <label for="short_about">Short About</label>
                            <textarea name="short_about" id="short_about" cols="30" rows="10"><?= get_setting('full_name') ?></textarea>
                            <?= (isset($error['short_about']) && !empty($error['short_about']))? '<p style="color:red">'.$error['short_about'].'</p>':''?>
                        </div>
                        <div class="fullname-input">
                            <label for="about_title">About Title</label>
                            <input type="text" name="about_title" id="" placeholder="About Title" value="<?= get_setting('about_title') ?>">
                            <?= (isset($error['about_title']) && !empty($error['about_title']))? '<p style="color:red">'.$error['about_title'].'</p>':''?>
                        </div>
                        <div class="fullname-input">
                            <label for="about_content">About Content</label>
                            <textarea name="about_content" id="about_content" cols="30" rows="10"><?= get_setting('about_content') ?></textarea>
                            <?= (isset($error['about_content']) && !empty($error['about_content']))? '<p style="color:red">'.$error['about_content'].'</p>':''?>
                        </div>
                        <div class="fullname-input">
                            <label for="about_content">Person Image</label>
                            <img src="<?= get_setting('person_image') ?>" style="width: 50px;height: 50px">
                            <input type="file" name="person_image" id="person_image">
                            <?= (isset($error['person_image']) && !empty($error['person_image']))? '<p style="color:red">'.$error['person_image'].'</p>':''?>
                        </div>
                        <?php
                        foreach (get_setting('social_urls', false) as $row) {

                            $data = json_decode($row['meta_value'], true, 512, JSON_THROW_ON_ERROR);
                            ?>
                            <div class="fullname-input">
                                <label for="about_content">Link</label>
                                <input type="text" name="social_urls[<?= $row['id']?>][link]" id="" placeholder="Link" value="<?= $data['link'] ?>">
                                <label for="about_content">İcons</label>
                                <input type="text" name="social_urls[<?= $row['id']?>][icon]" id="" placeholder="İcon" value="<?= $data['icon'] ?>">
                            </div>
                            <?php
                        }
                        ?>
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