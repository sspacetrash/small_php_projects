<?php
//connect
include 'forum_include.php';
openDB(); 


if ((!$_POST['topic_owner']) || (!$_POST['topic_title']) || (!$_POST['post_text'])){
	 header("Location: addtopic.html");
    exit;
}
$curr_topic_title = $_POST['topic_title'];
$curr_topic_owner = $_POST['topic_owner'];


$add_topic_sql = "INSERT INTO forum_topics (topic_title, topic_owner)
VALUES ('$curr_topic_title', '$curr_topic_owner')
";

$add_topic_res = sqlsrv_query($conn, $add_topic_sql);

if ($add_topic_res == false)
{
echo "Unable to add values.</br>";
die(print_r(sqlsrv_errors(), true));
}


$sql = "SELECT TOP 1 topic_id FROM forum_topics";
$getTopic = sqlsrv_query($conn, $sql);
$curr_post_text = $_POST['post_text'];
$row = sqlsrv_fetch_array ($getTopic);
$topic_id = $row['topic_id'];

$add_post_sql = "INSERT INTO forum_posts (post_text, post_owner)
VALUES ('$curr_post_text', '$curr_topic_owner')
";
$get_topic2 = sqlsrv_query($conn, $add_post_sql);

if ($get_topic2 == false)
{
echo "Unable to add values to posts.</br>";
die(print_r(sqlsrv_errors(), true));
}

sqlsrv_free_stmt($get_topic2);

sqlsrv_close($conn);


 $displayblock = "<p> The <strong>". $curr_topic_title . " topic has been created"; 
?>

<!DOCTYPE html>
<html>
<head>
<title>New Topic Added</title>
</head>
<body>
<h1>New Topic Added</h1>
<?php echo $displayblock; ?>
<p>Would you like to view all topics?</p>
</body>
</html>

