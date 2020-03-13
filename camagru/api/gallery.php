<?php

include_once("config/database.php");
include_once("HandleDb.php");

$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$handleDb = new HandleDb($conn->conn);

function getUserGallery($id, $db)
{
	$result = $db->selectData("SELECT * from post WHERE user_id = $id ORDER BY id DESC");
	if(!$result)
		return (0);
	return ($result);
}

function getAllUsers($db, $initial)
{
	$result = $db->selectData("SELECT * from post ORDER BY id DESC LIMIT $initial, 5");
	if(!$result)
		return(0);	
	if(!count($result))
		return (0);
	return ($result);
}

function printImages($result)
{
	foreach($result as $key => $post) {
			$id = $post['id'];
			echo "<div class='col-md-12 col-xs-12 the-gallery' post-id=$id>";
				echo "<img class='picture-gallery' src=" . $post['src'] . "/>";
				echo "<a href='#' class='gallery-item remove-gallery' post-id=$id> Remove image </a>";
			echo "</div>";
	}
}

function getLikes()
{
	$result = $db->selectData("SELECT likes from post");
	if(!count($result))
		return (0);
	return ($result);
}

function checkUserIdPost($db, $id)
{
	$result = $db->selectData("SELECT user_id from post WHERE id = $id");
	if(!$result)
		return (0);
	return ($result[0]);
}

function printImages_half($result, $db)
{
	foreach($result as $key => $post) {
			$likes = $post['likes'];
			$deslikes = $post['deslikes'];
			$id = $post['id'];

			echo "<div class='col-md-8 col-xs-12 main-gallery-c' post-id=$id>";
				echo "<img class='picture-gallery' src=" . $post['src'] . "/>";
				echo "<i class='fa fa-thumbs-up add-like' value=$likes post-id=$id>" . $likes . "</i>";
				echo "<i class='fa fa-thumbs-down remove-like' value=$likes post-id=$id>" . $deslikes . "</i>";
				echo "<div class='comments-table'>";
					echo "<strong class='comments-start'> Comments </strong>";
					$comments = getComments($id, $db);
					if($comments)
					{
						foreach($comments as $c) {
							echo "<p class='comment'>" . $c['name'] . ' - ' . $c['comment'] .  "</p>";
						}
					}
				echo "</div>";
				echo "<textarea placeholder='add comment' class='add-comment'> </textarea>";
				echo "<br>";
				echo "<button class='btn btn-success send-comment'> Send </button>";
			echo "</div>";
	}
}

function getComments($id, $db)
{
	$result = $db->selectData("SELECT name, comment from comment LEFT JOIN user ON comment.user_id = user.id WHERE post_id = $id");
	if(!$result)
		return (0);
	return ($result);
}