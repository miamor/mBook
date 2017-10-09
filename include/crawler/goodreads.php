<?php
class Crawler_Goodreads extends Crawler {
	
	public function __construct() {
		parent::__construct();
	}
	
	function countRv ($author) {
		$query = "SELECT id FROM books_reviews_goodreads WHERE author = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $author);
		$stmt->execute();
		$num = $stmt->rowCount();

		return $num;
	}

	function crawl ($url) {
		$url = str_replace('&amp;', '&', $url);
		$html = new simple_html_dom();
		$html->load_file($url);
		
//		echo $html;

		foreach ($html->find('.gr_review_container') as $gr_review_container) {
			foreach ($gr_review_container->find('.gr_review_text') as $gr_text) {
				$cont = trim($gr_text->plaintext);
				foreach ($gr_text->find('.gr_more_link') as $gr_more) {
					$moreLink = $gr_more->href;
				}
				$content = substr($cont, 0, -7).'<a href="'.$moreLink.'">...more</a>';
			}
			foreach ($gr_review_container->find('.gr_rating') as $gr_rating) {
				$rate = substr_count($gr_rating->plaintext, "★");
			}
			foreach ($gr_review_container->find('.gr_review_by') as $gr_author) {
				$author = explode('By ', $gr_author->plaintext)[1];
			}
			echo 'Author: '.$author.'<br/>Rate: '.$rate.'<div>'.$content.'</div><br/>';
			if (isVn($content)) { // is vietnamese, add to database
				// check if available in database
				if ($this->countRv($author) <= 0) {
					$query = "INSERT INTO
								books_reviews_goodreads
							SET
								author = ?, content = ?, rate = ?, iid = ?";
					$stmt = $this->conn->prepare($query);
					$stmt->bindParam(1, $author);
					$stmt->bindParam(2, $content);
					$stmt->bindParam(3, $rate);
					$stmt->bindParam(4, $this->bID);
					$post = $stmt->execute();
					echo '<b>ADD TO DATABASE</b>';
				} else echo '<b>AVAILABLE IN DATABASE</b>';
			}
			echo '<hr/>';
		}
	}
	
}