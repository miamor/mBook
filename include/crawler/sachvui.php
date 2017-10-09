<?php
class Crawler_Sachvui extends Crawler {

	public function __construct() {
		parent::__construct();
	}
	
	function crawl_books_pages ($bookType, $genresID, $begin, $end = 0) {
		if ($end < $begin) {
			$url = 'http://sachvui.com/the-loai/'.$bookType.'.html';
			$books = $this->crawl_books($url, $genresID);
		} else {
			for ($i = $begin; $i <= $end; $i++) {
				if ($i == 1) $url = 'http://sachvui.com/the-loai/'.$bookType.'.html';
				else $url = 'http://sachvui.com/the-loai/'.$bookType.'.html/trang-'.$i;
				$books = $this->crawl_books($url, $genresID);
			}
		}
	}
	
	function crawl_books ($url, $genresID) {
		$html = new simple_html_dom();
		$html->load_file($url);
		$imgAr = $txtAr = $titleAr = $authorAr = $lAr = array();
		// get title
/*		foreach ($html->find('.title_link') as $a) {
			$tAr[] = $a->plaintext;
			$hrefAr[] = $a->href;
			// crawl data
			$data = $this->crawl($a->href);
			$imgAr[] = $data['img'];
			$lAr[] = $data['download'];
			$txtAr[] = $data['txt'];
			$authorAr[] = $data['author'];
		}
*/		foreach ($html->find('.ebook') as $ebook) {
			$tAr[] = $ebook->plaintext;
			foreach ($ebook->find('h1') as $h1) {
				foreach ($h1->find('a') as $a) {
					$data = array();
					$link = encodeURL($title);
					$hrefAr[] = $href = $original_url = 'http://sachvui.com'.$a->href;
					// crawl data
					$checkBook = $this->countBooks($link);
					if ($checkBook <= 0) {
						$data 		= $this->crawl($href);
						$imgAr[] 	= $img 		= $data['img'];
						$lAr[] 		= $download = $data['download'];
						$txtAr[] 	= $text 	= content($data['txt']);
						$authorAr[] = $author 	= $data['author'];

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
//		if ($stmt->execute()) return $data;
//		return false;
	}
	function crawl ($url) {
		$url = str_replace('&amp;', '&', $url);
		$html = new simple_html_dom();
		$html->load_file($url);
		
		// get link download
		foreach ($html->find('.tai_sach') as $div) {
			$downloadAr = array();
			foreach ($div->find('.download_button') as $d) {
				$downloadAr[] = 'http://sachvui.com'.$d->href;
			}
			$download_link = implode('|', $downloadAr);
		}
		// get des 
		foreach ($html->find('.noidung_gioithieu') as $gt) {
			$text = $gt->plaintext;
		}
		// get img thumb
		foreach ($html->find('.cover') as $cover) {
			foreach ($cover->find('img') as $img) {
				$thumb = $img->src;
			}
		}
		// get author
		foreach ($html->find('.tacgia') as $div) {
			foreach ($div->find('h2') as $h2) {
				$author_name = explode(': ', $h2->plaintext)[1];
			}
		}
		
		$html->clear();
		unset($html);
		
		$data = array(
					'download' => $download_link,
					'txt' => $text,
					'img' => $thumb,
					'author' => $author_name
				);
	//	print_r($data);
		return $data;
	}
	
	function getBooks () {
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE 
					id >= 13 AND id <= 159"; // 159

		
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		$this->all_list = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$this->all_list[] = $row;
			$original_url = $row['original_url'];
			$data = $this->crawl($original_url);
			$download = $data['download'];
			echo $original_url.'<br/>';
			echo $download.'<hr/>';
			$this->updateBook($row['id'], "download = '{$download}' ");
		}

		return $this->all_list;
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

