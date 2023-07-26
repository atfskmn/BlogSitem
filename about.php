<?php

include_once __DIR__ . '/database/db.php';
include_once __DIR__ . '/helper.php';


include_once __DIR__ . '/header.php';
?>
    <div class="about-wrapper">
        <div class="container mt-4">
            <div class="about-container">
                <div class="about-top-title">
                    About
                </div>
                <div class="about-container-text">
                    <div class="about-text-title">
                        <?= get_setting('about_title') ?>
                    </div>
                    <div class="about-text">
                        <?= get_setting('about_content') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include_once __DIR__ . '/footer.php';