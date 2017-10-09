<?php
class Crawler_Taisachhay extends Crawler {

	public function __construct() {
		parent::__construct();
	}
	
	function crawl_books_pages ($bookType, $genresID, $begin, $end = 0) {
		if ($end < $begin) {
			$url = 'http://www.taisachhay.com/'.$bookType;
			$books = $this->crawl_books($url, $genresID);
		} else {
			for ($i = $begin; $i <= $end; $i++) {
				if ($i == 1) $url = 'http://www.taisachhay.com/'.$bookType;
				else $url = 'http://www.taisachhay.com/'.$bookType.'/page/'.$i;
				$books = $this->crawl_books($url, $genresID);
			}
		}
	}
	
	function crawl_books ($url, $genresID) {
//		$url = 'http://www.taisachhay.com/ky-nang-song';
//		$url = 'http://www.taisachhay.com/ky-nang-song/page/8';
		$html = new simple_html_dom();
		$html->load_file($url);
		$imgAr = $txtAr = $titleAr = $authorAr = $lAr = array();
		foreach ($html->find('article') as $article) {
			// get img thumb
			foreach ($article->find('img') as $img) {
				$src = $img->src;
				$imgAr[] = $src;
			}
			// get title
			foreach ($article->find('h2') as $h2) {
				$tAr[] = $h2->plaintext;
				foreach ($h2->find('a') as $a) {
					$hrefAr[] = $a->href;
					// crawl
					$data = $this->crawl($a->href);
					$lAr[] = $data['download'];
					$txtAr[] = $data['txt'];
					$authorAr[] = $data['author'];
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
		foreach ($tAr as $k => $title) {
			$img = $imgAr[$k];
			$download = $lAr[$k];
			$author = $authorAr[$k];
			$text = content($txtAr[$k]);
			$link = encodeURL($title);
			$original_url = $hrefAr[$k];
			
			if ($this->countBooks($link) <= 0) {
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
			} else { // update
			$query = "UPDATE
						" . $this->table_name . "
					SET
						title = ?, des = ?, author = ?, download = ?, thumb = ?, genres = '{$genresID}', authenticated = 1, status = 1, published = 1, original_url = ?
					WHERE link = ?";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $title);
			$stmt->bindParam(2, $text);
			$stmt->bindParam(3, $author);
			$stmt->bindParam(4, $download);
			$stmt->bindParam(5, $img);
			$stmt->bindParam(6, $original_url);
			$stmt->bindParam(7, $link);
			$post = $stmt->execute();
			}
		}

		return $data;
//		if ($stmt->execute()) return $data;
//		return false;
	}
	function crawl_link_download ($url) {
		$html = new simple_html_dom();
		$html->load_file($url);
		
		// get link download
		$downloadAr = array();
		foreach ($html->find('a.btn-primary') as $a) {
			$downloadAr[] = $a->href;
		}
		$download_link = implode('|', $downloadAr);
		return $download_link;
	}
	function crawl ($url) {
		$url = str_replace('&amp;', '&', $url);
		$html = new simple_html_dom();
		$html->load_file($url);
		
		// get link download
		foreach ($html->find('.btn_download') as $a) {
			$download_link = $this->crawl_link_download($a->href);
		}
		// get des 
		foreach ($html->find('.post_content') as $div) {
			$txt = '';
			foreach ($div->find('p') as $p) {
				$text = $p->plaintext;
				if ( !strpos($text, 'tải miễn phí') && !strpos($text, 'tải sách') && !strpos($text, 'Tải sách') && !strpos($text, 'ebook PDF/PRC/EPUB/MOBI') )
					$txt .= $text.'<br/>';
			}
		}
		// get author 
		foreach ($html->find('span[itemprop="name"]') as $span) {
			foreach ($span->find('a') as $a) {
				$author_name = $a->plaintext;
			}
		}
		
		$html->clear();
		unset($html);
		
		$data = array(
					'download' => $download_link,
					'txt' => $txt,
					'author' => $author_name
				);
		
		return $data;
	}
	
}

