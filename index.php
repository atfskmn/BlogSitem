<?php

include_once __DIR__ . '/database/db.php';
include_once __DIR__ . '/helper.php';


include_once __DIR__ . '/header.php';
?>
    <div class="person-info-wrapper">
        <div class="container">
            <div class="person-info-container">
                <div class="row">
                    <div class="person-photo col-md-5">
                        <img src="<?= get_setting('person_image') ?>" alt="" srcset="">
                    </div>
                    <div class="person-info-text col-md-7">
                        <div class="person-job">
                            <?= get_setting('job_title') ?>
                        </div>
                        <div class="person-name">
                            <h1><?= get_setting('full_name') ?></h1>
                        </div>
                        <div class="person-text">
                            <?= get_setting('short_about') ?>
                        </div>
                        <div class="person-social-link">
                            <ul>
                                <?php
                                foreach (get_setting('social_urls', false) as $row) {

                                    $data = json_decode($row['meta_value'], true, 512, JSON_THROW_ON_ERROR);
                                    ?>
                                    <li>
                                        <a href="<?= $data['link'] ?>"><i class="<?= $data['icon'] ?>"></i></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-post-wrapper">
        <div class="container">
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

include_once __DIR__ . '/footer.php';