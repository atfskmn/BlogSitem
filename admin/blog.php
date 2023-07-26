<?php

include_once __DIR__ . '/../database/db.php';
include_once __DIR__ . '/../helper.php';
include_once __DIR__ . '/header.php';

global $db,$user;
$success='';
if(@$_POST && isset($_POST['id']) && !empty($_POST['id'])){
    $id=(int)$_POST['id'];
    $post=get_posts($id);
    if($post['user_id']==$user['id']){
        $db->exec("DELETE FROM posts WHERE id=$id");
        $success="Deleted";
    }else{
        $error="Sorry, Unauthorized transaction.";
    }

}
?>
    <div class="about-wrapper">
        <div class="container mt-4">
            <div class="about-container">
                <div class="about-top-title">
                    Blog List
                    <?= isset($success) && !empty($success)? '<p style="color:green;">'.$success.'</p>':'' ?>
                    <?= isset($error) && !empty($error)? '<p style="color:red;">'.$error.'</p>':'' ?>
                </div>
                <div class="about-container-text">
                    <button onclick="window.location.href='/admin/new-blog.php'">Post Oluştur</button>

                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Read Minute</th>
                            <th>User</th>
                            <th>Created Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach (get_posts() as $post) {
                            ?>
                            <tr>
                                <td><?= $post['id'] ?></td>
                                <td><?= $post['title'] ?></td>
                                <td><?= $post['read_minute'] ?></td>
                                <td>  <?= get_user($post['user_id'])['full_name'] ?></td>
                                <td><?= date('d M Y H:i:s',strtotime($post['created_date'])) ?></td>
                                <td>
                                    <?php
                                    if($post['user_id']==$user['id']){
                                    ?>
                                    <button onclick="window.location.href='/admin/edit-blog.php?id=<?= $post['id'] ?>'">Düzenle</button>
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                        <button type="submit">Sil</button>
                                    </form>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload=function(){
            new DataTable('#example');
        }


    </script>

<?php

include_once __DIR__ . '/footer.php';