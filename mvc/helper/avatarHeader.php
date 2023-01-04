<?php
function avatarHeader() {
	if(isset($_SESSION['user'])) {
		$avt = "<img class=' rounded-circle' src='";
		if($_SESSION['user']['avatar']) {
			$path = $_SESSION['user']['avatar'];
			$avt .= _WEB_ROOT . "/upload/avt/$path";
		} else {
			$avt .= _PATH_IMG_PUBLIC . "/profile.jpg";
		}
		$avt .= "' alt='' style='width: 30px; height: 30px; max-width: 100%; object-fit: cover; object-position: center; margin-bottom: 5px;'>";
	} else {
		$avt = "<i class='fa-solid fa-user'></i>";
	}
	return $avt;
}

