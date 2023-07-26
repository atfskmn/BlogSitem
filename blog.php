<?php

include_once __DIR__ . '/database/db.php';
include_once __DIR__ . '/helper.php';


include_once __DIR__ . '/header.php';
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $post=get_posts($_REQUEST['id']);
    if(is_null($post) || $post==False){
        header('Location: /blog.php');
        die();
    }
    ?>

    <div class="blog-wrapper">
        <div class="container mt-4">
            <div class="blog-container">
                <div class="blog-top-title">
                    Blog
                </div>
                <div class="blog-container-text">
                    <div class="blog-text-meta-info">
                        <ul>
                            <li>
                                <div class="blog-text-date">
                                    <?= date('d M Y' ,strtotime($post['created_date'])) ?>
                                </div>
                                <div class="blog-text-meta-dot">
                                    ·
                                </div>
                                <div class="blog-text-reading-time">
                                    <?= $post['read_minute'] ?> minute
                                </div>
                                <div class="blog-text-meta-dot">
                                    ·
                                </div>
                                <div class="blog-text-author">
                                    <?= get_user($post['user_id'])['full_name'] ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="blog-text-title">
                        <?= $post['content'] ?>
                    </div>
                    <div class="blog-text">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php

}
else {
    ?>

    <div class="blog-post-wrapper">
        <div class="container mt-4">
            <div class="blog-post-container">
                <div class="blog-post-top-title">
                    Blog
                </div>
                <div class="blog-post-row">
                    <div class="row">
                        <?php
                        foreach (get_posts() as $post) {

                            ?>
                            <div class="blog-post col-md-6">
                                <a href="/blog.php?id=<?= $post['id'] ?>">
                                    <div class="blog-post-thumbnail">
                                        <img src="<?= $post['image'] ?>" alt="" srcset="">
                                    </div>
                                    <div class="blog-post-text">
                                        <div class="blog-post-title">
                                            <?= $post['title'] ?>
                                        </div>
                                        <div class="blog-post-description">
                                            <?= $post['short_content'] ?>
                                        </div>
                                        <div class="blog-post-meta-info">
                                            <ul>
                                                <li>
                                                    <div class="blog-post-date">
                                                        <?= date('d M Y' ,strtotime($post['created_date'])) ?>
                                                    </div>
                                                    <div class="blog-post-meta-dot">
                                                        ·
                                                    </div>
                                                    <div class="blog-post-reading-time">
                                                        <?= $post['read_minute'] ?> minute
                                                    </div>
                                                    <div class="blog-post-meta-dot">
                                                        ·
                                                    </div>
                                                    <div class="blog-post-author">
                                                        <?= get_user($post['user_id'])['full_name'] ?>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>


                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
}
?>
<?php

include_once __DIR__ . '/footer.php';