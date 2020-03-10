<?php
include "forum_include.php";
openDB();

$get_topics_sql = "SELECT topic_id, topic_title, topic_owner FROM forum_topics";
$get_topics_res = sqlsrv_query ($conn, $get_topics_sql);

//create the display string
$display_block1 .= <<<END_OF_TEXT
<table style ="border:1px solid black ; border-collapse: collapse;">
<tr>
<th>TOPIC TITLE</th>
<th># of POSTS</th>
</tr>
END_OF_TEXT;

while ($topic_info = sqlsrv_fetch_array($get_topics_res))
{
	$topic_id = $topic_info['topic_id'];
	$topic_title = $topic_info['topic_title'];
	$topic_owner = $topic_info['topic_owner'];
	
	//get no. of posts
	$get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM forum_posts WHERE topic_id = '".$topic_id."'";
	$get_num_posts_res = sqlsrv_query($conn, $get_num_posts_sql);
	
	while ($posts_info = sqlsrv_fetch_array ($get_num_posts_res)){
		$num_posts = $posts_info['post_count'];
	}
	//add to display
	$display_block .= <<<END_OF_TEXT
	<tr>
	<td> <a href="showtopic.php?topic_id=$topic_id"><strong>$topic_title</strong></a><br/>
	Created by $topic_owner </td>
	<td class="num_posts_col">$num_posts</td>
	</tr>
END_OF_TEXT;
	
}
	//free results 
	sqlsrv_free_stmt ($get_topics_res);
	sqlsrv_free_stmt ($get_num_posts_res);
	
	//close connection to MySQL
	sqlsrv_close($conn);
	
	//close up the table 
	$display_block .= "</table>";

?>
	
<!DOCTYPE html>
<html>
<head>
<title>Topics in My Forum</title>
<style type="text/css">
	table {
		border: 1px solid black;
		border-collapse: collapse;
	}
	th {
		border: 1px solid black;
		padding: 6px;
		font-weight: bold;
		background: #ccc;
	}
	td {
		border: 1px solid black;
		padding: 6px;
	}
	.num_posts_col { text-align: center; }
</style>
</head>
<body>
<h1>Topics in My Forum</h1>
<?php echo $display_block1;
echo $display_block; ?>
<p>Would you like to <a ADD YOUR CODE HERE</a>?</p>
</body>
</html>
