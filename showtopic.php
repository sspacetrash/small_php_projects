<?php
include "forum_include.php";
openDB();

//check for required info from the queruy string
if (!isset($_GET['topic_id'])){
	header("Location:topiclist.php");
	exit;

}

$curr_topic_id = $_GET['topic_id'];

//fetch topic title 
$topic_sql = "SELECT topic_title, post_owner, post_text FROM forum_topics WHERE topic_id = '".$curr_topic_id."'";
$topic_res = sqlsrv_query($conn, $topic_sql);

//get the topic title
while ($topic_info = sqlsrv_fetch_array($topic_res)){
	$topic_title = $topic_info['topic_title'];

}
	/* //create the display string
$displayblock1 .=<<<END_OF_TEXT
<p> Showing posts for the <strong>$topic_title</strong> topic:</p>
<table style ="border:1px solid black ; border-collapse: collapse;">
<tr>
<th>AUTHOR</th> 
<th>POST</th>
END_OF_TEXT; */


//gather the posts
$get_posts_sql = "SELECT post_id, post_text, post_owner FROM forum_posts WHERE topic_id = '".$curr_topic_id."'";
$get_posts_res = sqlsrv_query($conn, $get_posts_sql);



while ($posts_info = sqlsrv_fetch_array ($get_posts_res)){
	$post_id = $posts_info['post_id'];
	$post_text = $posts_info['post_text']; 
	$post_owner = $posts_info['post_owner']; 
	//add to display 
	$display_block .= <<<END_OF_TEXT
	<p>Showing posts for the <strong>$topic_title</strong> topic:</p>
<table style ="border:1px solid black ; border-collapse: collapse;">
<tr>
<th>AUTHOR</th> 
<th>POST</th>
	<tr>
	<td>$post_owner<br/></td>
	<td>$post_text<br/>
	<a href =" EXERCISE 8 LINK"> <strong> REPLY TO POST </strong></a> </td>
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
<title>Posts in the topic</title>
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
<h1>Posts in my topic</h1>
<?php
echo $display_block1; 
echo $display_block; 
?>
<p>Would you like to <a ADD YOUR CODE HERE</a>?</p>
</body>
</html>