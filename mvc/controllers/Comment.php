<?php

class Comment extends Controller
{
	function __construct()
	{
		$this->comment = $this->model('CommentModel');
		$this->products = $this->model('ProductModel');
	}

	public function add_comment()
	{
		
		// show_array($_POST);
		if(isset($_POST['btn_submit']) && $_SESSION['user']) {
			$id_user = $_POST['id_user'];
			$id_pro = $_POST['id_pro'];
			$comment = $_POST['comment'];
			$rating = $_POST['stars'];
			$created_at = date("Y-m-d H:i:s");

			$idComment = $this->comment->insertComment($id_user, $id_pro, $comment, $rating, $created_at);

			// $arrTotalRating = $this->comment->avgTotalRating();
			// foreach($arrTotalRating as $item) {
			// 	$this->products->updateRating($item['id_pro'], round($item['total_rating'], 1));
			// }

			$avgTaring = $this->comment->avgTotalRatingOne($id_pro);
			// show_array($avgTaring);
			
			$this->products->updateRating($id_pro, round($avgTaring, 1));
			redirectTo("detailproduct/product/$id_pro");
		}
	}
}
