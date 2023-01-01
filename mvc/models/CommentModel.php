<?php

class CommentModel extends DB
{
	function insertComment($id_user, $id_pro, $comment, $rating, $created_at)
	{
		$sql = "INSERT INTO comments(id_user, id_pro, comment, rating, created_at) VALUES('$id_user', '$id_pro', '$comment', '$rating', '$created_at')";
		return $this->pdo_execute_lastInsertID($sql);
	}

	function getAllComment($id_pro)
	{
		$select = "SELECT users.name, users.avatar, comments.id, comments.id_user, comments.id_pro, comments.comment, comments.rating, comments.created_at FROM comments JOIN users ON comments.id_user = users.id WHERE comments.id_pro = '$id_pro' order by created_at desc";
		return $this->pdo_query($select);
	}

	function getOneComment($id)
	{
		$select = "SELECT * FROM comments WHERE id = '$id' ";
		return $this->pdo_query_one($select);
	}

	function getComment($id_user, $id_pro)
	{
		$select = "SELECT * FROM comments WHERE 1 ";
		if ($id_user > 0) {
			$select .= " AND id_user = '$id_user' ";
		}
		if ($id_pro > 0) {
			$select .= " AND id_pro = '$id_pro' ";
		}
		return $this->pdo_query($select);
	}

	function avgTotalRating() {
		$sql = "SELECT id_pro, avg(rating) as total_rating FROM `comments` GROUP BY id_pro";
		return $this->pdo_query($sql);
	}

	function avgTotalRatingOne($id_pro) {
		$sql = "SELECT avg(rating) as total_rating FROM `comments` WHERE id_pro = '$id_pro'";
		return $this->pdo_query_value($sql);
	}
}
