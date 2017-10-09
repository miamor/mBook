<?php
class Crawler_Downloadsach extends Crawler {

	public function __construct() {
		parent::__construct();
	}
	
	function crawl_books_pages ($bookType, $genresID, $begin, $end = 0) {
		if ($end < $begin) {
			$url = 'https://downloadsach.com/category/'.$bookType;
			$books = $this->crawl_books($url, $genresID);
		} else {
			for ($i = $begin; $i <= $end; $i++) {
				if ($i == 1) $url = 'https://downloadsach.com/category/'.$bookType;
				else $url = 'https://downloadsach.com/category/'.$bookType.'/page/'.$i;
				$books = $this->crawl_books($url, $genresID);
			}
		}
	}
	
	function crawl_books ($url, $genresID) {
		$html = new simple_html_dom();
		$html->load_file($url);
		$imgAr = $txtAr = $titleAr = $authorAr = $lAr = array();
		// get title
		foreach ($html->find('.title_link') as $a) {
			$tAr[] 		= $title 		= $a->plaintext;
			$hrefAr[] 	= $original_url = $a->href;
			$link = encodeURL($title);
			// crawl data
			$checkBook = $this->countBooks($link);
			if ($checkBook <= 0) {
				$data = $this->crawl($a->href);
				$imgAr[] 	= $img 		= $data['img'];
				$lAr[] 		= $download = $data['download'];
				$txtAr[] 	= $text 		= content($data['txt']);
				$authorAr[] = $author 	= $data['author'];

				// post
				$query = "INSERT INTO
							" . $this->table_name . "
						SET
							title = ?, link = ?, des = ?, author = ?, download = ?, thumb = ?, genres = '{$genresID}', authenticated = 1, status = 1, published = 1, original_url = ?";
				echo 'Title: '.$title.'<br/>Link: '.$link.'<br/>Author: '.$author.'<br/>Download link: '.$download.'<br/>Thumb: '.$img.'<br/>Original URL: '.$original_url.'<pre>'.$text.'</pre><br/>';
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(1, $title);
				$stmt->bindParam(2, $link);
				$stmt->bindParam(3, $text);
				$stmt->bindParam(4, $author);
				$stmt->bindParam(5, $download);
				$stmt->bindParam(6, $img);
				$stmt->bindParam(7, $original_url);
				$post = $stmt->execute();
			}
		}
		$html->clear();
		unset($html);
		$data = array(
					'imgAr' => $imgAr, 
					'downloadLinkAr' => $lAr, 
					'titleAr' => $tAr, 
					'authorAr' => $authorAr,
					'hrefAr' => $hrefAr,
					'txtAr' => $txtAr
				);

		return $data;
	}
	function crawl ($url) {
		$url = str_replace('&amp;', '&', $url);
		$html = new simple_html_dom();
		$html->load_file($url);
		
		// get link download
		$downloadAr = array();
		foreach ($html->find('a[href*="drive.google.com"]') as $a) {
			$downloadAr[] = urldecode(explode('https://downloadsach.com/redirect?url=', $a->href)[1]);
		}
		$download_link = implode('|', $downloadAr);
		
		// get des 
		foreach ($html->find('.entry') as $div) {
			$txt = '';
			$start = false;
			$pTag = 0;
			$isAuthorTag = false;
			foreach ($div->find('div.divider,p') as $ele) {
				if ($ele->tag == 'p') {
					$pTag++;
					if ($pTag == 2) { // isAuthorTag
						foreach ($ele->find('strong,b') as $au) {
							$author_name = $au->plaintext;
						}
					}
					$text = $ele->plaintext;
					$txt .= $text.'<br/>';
				}
			}
		}
		$txtSplit = explode('REVIEW SÁCH<br/>', $txt);
		if (!$txtSplit[1]) {
			$txtSplit = explode('REVIEW SÁC<br/>', $txt);
		}
		$des = $txtSplit[1];
		
		// get img thumb
		foreach ($html->find('.entry') as $div) {
			$start = false;
			$pTag = 0;
			$isAuthorTag = false;
			foreach ($div->find('p') as $p) {
				$pTag++;
				if ($pTag == 1) { // get first p (contains img)
					foreach ($p->find('img') as $img) {
						$thumb = $img->src;
					}
				} else break;
			}
		}
		
		$html->clear();
		unset($html);
		
		$data = array(
					'download' => $download_link,
					'txt' => $des,
					'img' => $thumb,
					'author' => $author_name
				);
	//	print_r($data);
		return $data;
	}
	
	function updateDes () {
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE 
					thumb LIKE 'https://downloadsach.com%' ";

		
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$original_url = $row['original_url'];
			$data = $this->crawl($original_url);
			$des = $data['txt'];
			$this->updateBook($row['id'], "des = '{$des}' ");
		}
	}
	function updateBook ($id, $updateContent) {
		$query = "UPDATE
					" . $this->table_name . "
				SET 
					{$updateContent}
				WHERE
					id = {$id}";

		$stmt = $this->conn->prepare($query);

		// execute the query
		if ($stmt->execute()) return true; 
		else return false;
	}
}
?>