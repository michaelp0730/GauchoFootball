<?php

function get_user($id) {
    $sql = "SELECT Username, EmailAddress FROM users WHERE UserID = '$id'";
    $result = mysql_query($sql);

    while ($data = mysql_fetch_assoc($result)) {
        $user_data[] = $data;
    }

    return $user_data;
}

function add_post($userid, $body) {
    $sql = "insert into posts (user_id, body, stamp)
            values ($userid, '". mysql_real_escape_string($body). "',now())";
    $result = mysql_query($sql);
}

function show_user_posts($userid) {
    $posts = array();
    $sql = "SELECT body, stamp FROM posts WHERE user_id = '$userid' ORDER BY stamp DESC";
    $result = mysql_query($sql);

    while ($data = mysql_fetch_object($result)) {
        $posts = array(
            'stamp' => $data->stamp,
            'userid' => $userid,
            'body' => $data->body
        );
    }

    return $posts;
}

function get_all_posts() {
    $sql = "SELECT * FROM posts ORDER BY stamp DESC";
    $result = mysql_query($sql);

    while ($data = mysql_fetch_assoc($result)) {
        $posts[] = $data;
    }

    return $posts;
}

?>
