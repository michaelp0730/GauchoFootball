<?php
require '../_includes/handler-header.php';

if (!empty($_POST['wk1gm1']) && !empty($_POST['wk1gm2']) && !empty($_POST['wk1gm3']) &&
    !empty($_POST['wk1gm4']) && !empty($_POST['wk1gm5']) && !empty($_POST['wk1gm6']) &&
    !empty($_POST['wk1gm7']) && !empty($_POST['wk1gm8']) && !empty($_POST['wk1gm9']) &&
    !empty($_POST['wk1gm10']) && !empty($_POST['wk1gm11']) && !empty($_POST['wk1gm12']) &&
    !empty($_POST['wk1gm13']) && !empty($_POST['wk1gm14']) && !empty($_POST['wk1gm15']) &&
    !empty($_POST['wk1-tiebreaker']) && !empty($_SESSION['LoggedIn']) &&
    !empty($_SESSION['Username'])) {
    $username = $_SESSION['Username'];
    $wk1gm1 = mysql_real_escape_string($_POST['wk1gm1']);
    $wk1gm2 = mysql_real_escape_string($_POST['wk1gm2']);
    $wk1gm3 = mysql_real_escape_string($_POST['wk1gm3']);
    $wk1gm4 = mysql_real_escape_string($_POST['wk1gm4']);
    $wk1gm5 = mysql_real_escape_string($_POST['wk1gm5']);
    $wk1gm6 = mysql_real_escape_string($_POST['wk1gm6']);
    $wk1gm7 = mysql_real_escape_string($_POST['wk1gm7']);
    $wk1gm8 = mysql_real_escape_string($_POST['wk1gm8']);
    $wk1gm9 = mysql_real_escape_string($_POST['wk1gm9']);
    $wk1gm10 = mysql_real_escape_string($_POST['wk1gm10']);
    $wk1gm11 = mysql_real_escape_string($_POST['wk1gm11']);
    $wk1gm12 = mysql_real_escape_string($_POST['wk1gm12']);
    $wk1gm13 = mysql_real_escape_string($_POST['wk1gm13']);
    $wk1gm14 = mysql_real_escape_string($_POST['wk1gm14']);
    $wk1gm15 = mysql_real_escape_string($_POST['wk1gm15']);
    $tiebreaker = mysql_real_escape_string($_POST['wk1-tiebreaker']);
    $due_date = strtotime('2015-09-13T13:00:00-04:00');
    $submission_time = strtotime('now');
    $check_user_submission = mysql_query("SELECT wk1Complete FROM wk1 WHERE Username = '".$username."'");
    $submission_response_array = mysql_fetch_array($check_user_submission);

    if ($submission_response_array[0] == 1) {
        echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> You have already submitted your Week 1 picks. All submissions are final.</div>';
    } else if ($submission_time > $due_date) {
        echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> Your submission is too late. The first game of Week 1 has already started. Please try again next week.</div>';
    } else {
        $submit_wk1 = mysql_query("INSERT INTO wk1 (Username, wk1gm1, wk1gm2, wk1gm3, wk1gm4,
            wk1gm5, wk1gm6, wk1gm7, wk1gm8, wk1gm9, wk1gm10, wk1gm11, wk1gm12, wk1gm13, wk1gm14,
            wk1gm15, MondayTotalPoints, wk1Complete)
            VALUES('".$username."', '".$wk1gm1."', '".$wk1gm2."', '".$wk1gm3."', '".$wk1gm4."',
            '".$wk1gm5."', '".$wk1gm6."', '".$wk1gm7."', '".$wk1gm8."', '".$wk1gm9."',
            '".$wk1gm10."', '".$wk1gm11."', '".$wk1gm12."', '".$wk1gm13."', '".$wk1gm14."',
            '".$wk1gm15."', '".$tiebreaker."', true)");

        if ($submit_wk1) {
            echo '<div class="alert alert-success"><strong>Success!</strong> Your Week 1 picks have been recorded. <a href="../view-picks.php">Click here to view all picks.</a></div>';
        } else {
            echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> Your Week 1 submission has failed. <a href="../index.php">Please go back and try again.</a></div>';
        }
    }

} else {
    echo '<div class="alert alert-danger" role="alert"><strong>Error:</strong> Your selections for Week 1 are incomplete. <a href="../index.php">Please go back and try again.</a></div>';
}

include '../_includes/handler-footer.php';
