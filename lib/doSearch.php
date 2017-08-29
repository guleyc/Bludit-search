<?php 

	if(!empty($_POST['query']) && strlen($_POST['query']) > 2) {

		$query = $_POST['query'];

		$linkRoot = $_POST['postlink'];

		doSearch($query, $linkRoot);

	} else {
		echo false;
	}

	function doSearch($query, $linkRoot) {
		define('BLUDIT', true);
		$root = str_replace('bl-plugins/search/lib', '', getcwd());
		$dbPosts = $root.'bl-content/databases/posts.php';
		$contentPosts = $root.'bl-content/posts/';

		ob_start();
		include($dbPosts);
		$res = ob_get_contents();
		ob_end_clean();

		$posts = json_decode($res, true);

		$results = array();

		foreach($posts as $title => $post) {

			$searchQuery = explode(' ', $query);
			$postContent = file_get_contents($contentPosts.$title.'/index.txt');

			foreach($searchQuery as $searchWord) {
				if(preg_match("/$searchWord/i", $postContent) && !array_key_exists($title, $results)) {
					$postTitle = getPostTitle($postContent);
					$results[$title] = '<div class="searchResult"><a href="'.$linkRoot.$title.'">'.$postTitle.'</a></div>';
				}
			}
			
		}

		$postsCount = count($results);

		$postsCount === 1 ? $resultTitle = '1 post found' : $resultTitle = $postsCount.' posts found';

		echo '<h4 class="resultsTitle">'.$resultTitle.'</h4>';

		foreach($results as $result) {
			echo $result;
		}


	}

	function getPostTitle($post) {
		return str_replace('Title: ', '', strtok($post, "\n"));
	}
