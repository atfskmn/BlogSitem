<?php
if (!function_exists('get_setting')) {
    function get_setting($key, $first = True)
    {
        global $db;
        $result = $db->query("SELECT * FROM settings WHERE meta_key='$key'");
        if ($first) {
            $firstData = $result->fetch();
            if ($firstData) {
                return $firstData['meta_value'];
            }
            return '';
        }
        return $result->fetchAll() ?? [];
    }
}

if (!function_exists('get_posts')) {
    function get_posts($id = null)
    {
        global $db;
        if (!empty($id)) {
            $id = (int)$id;
            $result = $db->query("SELECT * FROM posts WHERE id=$id");
            return $result->fetch();
        } else {
            $result = $db->query("SELECT * FROM posts");
            return $result->fetchAll() ?? [];
        }


    }
}
if (!function_exists('get_user')) {
    function get_user($id)
    {
        global $db;
        return $db->query("SELECT * FROM users WHERE id=$id")->fetch();
    }
}

if (!function_exists('is_page')) {
    function is_page($page_key)
    {
        $url = $_SERVER['REQUEST_URI'];
        $page = str_replace('.php', '', $url);
        $page = str_replace('/', '', $page);
        return $page == $page_key || ($page_key == 'home' && ($page == '' || $page == 'index')) || ($page_key == 'adminhome' && ($page == 'admin' || $page == 'adminindex'));
    }
}
if (!function_exists('get_last_contact_id')) {
    function get_last_contact_id()
    {
        global $db;
        $result = $db->query("SELECT * FROM contacts ORDER BY id DESC")->fetch();
        if (!empty($result) && $result != False) {
            return $result['id'];
        }
        return 0;
    }
}
if (!function_exists('get_user_by_email_and_password')) {
    function get_user_by_email_and_password($email, $password)
    {
        global $db;
        $password = md5($password);
        $result = $db->query("SELECT * FROM users WHERE email='$email' AND password='$password'")->fetch();
        if (!empty($result) && $result != False) {
            return $result;
        }
        return null;
    }
}
if (!function_exists('get_user_by_session')) {
    function get_user_by_session()
    {
        global $db;
        $user_id = @$_SESSION['user_id'];
        if (!empty($user_id) && $user_id > 0) {
            $result = $db->query("SELECT * FROM users WHERE id='$user_id'")->fetch();
            if (!empty($result) && $result != False) {
                return $result;
            }
        }
        return null;
    }
}
if (!function_exists('get_user_by_email')) {
    function get_user_by_email($email)
    {
        global $db;

        if (!empty($email)) {
            $result = $db->query("SELECT * FROM users WHERE email='$email'")->fetch();
            if (!empty($result) && $result != False) {
                return $result;
            }
        }
        return null;
    }
}
if (!function_exists('get_last_user_id')) {
    function get_last_user_id()
    {
        global $db;
        $result = $db->query("SELECT * FROM users ORDER BY id DESC")->fetch();
        if (!empty($result) && $result != False) {
            return $result['id'];
        }
        return 0;
    }
}
if (!function_exists('get_last_post_id')) {
    function get_last_post_id()
    {
        global $db;
        $result = $db->query("SELECT * FROM posts ORDER BY id DESC")->fetch();
        if (!empty($result) && $result != False) {
            return $result['id'];
        }
        return 0;
    }
}
if (!function_exists('get_last_setting_id')) {
    function get_last_setting_id()
    {
        global $db;
        $result = $db->query("SELECT * FROM settings ORDER BY id DESC")->fetch();
        if (!empty($result) && $result != False) {
            return $result['id'];
        }
        return 0;
    }
}
if (!function_exists('get_user_ip')) {
    function get_user_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
if (!function_exists('get_contacts')) {
    function get_contacts($id = null)
    {
        global $db;
        if (!empty($id)) {
            $id = (int)$id;
            $result = $db->query("SELECT * FROM contacts WHERE id=$id");
            return $result->fetch();
        } else {
            $result = $db->query("SELECT * FROM contacts");
            return $result->fetchAll() ?? [];
        }


    }
}
if (!function_exists('get_setting')) {
    function get_setting($key, $first = True)
    {
        global $db;
        $result = $db->query("SELECT * FROM settings WHERE meta_key='$key'");
        if ($first) {
            $firstData = $result->fetch();
            if ($firstData) {
                return $firstData['meta_value'];
            }
            return '';
        }
        return $result->fetchAll() ?? [];
    }
}

global $user;
$user = get_user_by_session();