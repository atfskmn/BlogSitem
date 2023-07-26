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
                    Contact List
                </div>
                <div class="about-container-text">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>IP</th>
                            <th>Created Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach (get_contacts() as $contact) {
                            ?>
                            <tr>
                                <td><?= $contact['id'] ?></td>
                                <td><?= $contact['full_name'] ?></td>
                                <td><?= $contact['email'] ?></td>
                                <td><?= $contact['subject'] ?></td>
                                <td><?= $contact['message'] ?></td>
                                <td><?= $contact['ip'] ?></td>
                                <td><?= date('d M Y H:i:s',strtotime($contact['created_date'])) ?></td>
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