<?php

include_once __DIR__ . '/../database/db.php';
include_once __DIR__ . '/../helper.php';
include_once __DIR__ . '/header.php';

global $user;
?>

    <div class="about-wrapper">
        <div class="container mt-4">
            <div class="about-container">
                <div class="about-top-title">
                    Home
                </div>
                <div class="about-container-text">
                    <div class="about-text-title">
                        Hello <?= $user['full_name'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include_once __DIR__ . '/footer.php';