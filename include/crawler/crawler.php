<?php
class Crawler extends Config {

	protected $dom;
	protected $table_name = "books";

	public function __construct() {
		parent::__construct();
		require_once(MAIN_PATH.'/include/html_dom.php');
	}

	function checkEvent ($eIn) {
		$query = "SELECT id FROM events WHERE fb_id = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $eIn['id']);
		$stmt->execute();
		$num = $stmt->rowCount();

		return $num;
	}

	function addEvent ($eIn) {
		if ($this->checkEvent($eIn) <= 0) {
			$link = encodeURL($eIn['name']);
			$place = json_encode($eIn['place']);
			$start_time = $eIn['start_time']->format('Y-m-d H:i:s');
			$end_time = $eIn['end_time']->format('Y-m-d H:i:s');
			$des = content($eIn['description']);
			$query = "INSERT INTO events SET title = ?, link = ?, des = ?, start_time = ?, end_time = ?, fb_id = ?, place = ?";
//			echo $eIn['name'].'~'.$link.'~'.$des.'~'.$start_time.'~'.$end_time.'~'.$eIn['id'].'~'.$place;
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $eIn['name']);
			$stmt->bindParam(2, $link);
			$stmt->bindParam(3, $des);
			$stmt->bindParam(4, $start_time);
			$stmt->bindParam(5, $end_time);
			$stmt->bindParam(6, $eIn['id']);
			$stmt->bindParam(7, $place);
			if ($stmt->execute()) {
				return true;
			}
			return false;
		}
		return false;
	}


	function countBooks ($link) {
		$query = "SELECT id FROM " . $this->table_name . " WHERE link = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $link);
		$stmt->execute();
		$num = $stmt->rowCount();

		return $num;
	}

	function getStores ($url) {
		$query = "SELECT id FROM stores WHERE url = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $url);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
/*	function addStores ($sData) {
		$query = "INSERT INTO stores SET title = ?, url = ?, thumb = ?, hotline = ?, address = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $url);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
*/	function countBooksBuy ($url, $bid) {
		$query = "SELECT id FROM books_buy_online WHERE slink = ? AND bid = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $url);
		$stmt->bindParam(2, $bid);
		$stmt->execute();
		$num = $stmt->rowCount();
		return $num;
	}
	function sore () {
		$html = new simple_html_dom();
/*		if (!$url) $url = 'https://www.sore.vn/s/chuyen-o-nong-trai';
		if (!$this->bid) $this->bid = 1;
*/
		$query = "SELECT id,link,title FROM books WHERE id = 57";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		while ($book = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$this->bid = $book['id'];
			echo '<h2>#'.$this->bid.'</h2>';
			$url = 'https://www.sore.vn/s/'.encodeURL($book['title']).'?cat=110000&curfilter=cat';
			$html->load_file($url);
//			echo $book['title'].'<hr/>'.$url;
			$imgAr = $vatAr = $titleAr = $priceAr = $merchantAr = array();
			foreach ($html->find('.main-inf') as $mi) {
//				echo $mi.'<hr/>';
				foreach ($mi->find('span.img') as $img) {
					$imgAr[] = $img;
				}
				foreach ($mi->find('a.prod-name') as $a) {
					$txt = rtrim($a->plaintext);
//					if (check($txt, $book['title'])) {
					if (mb_strtolower($txt) == mb_strtolower($book['title'])) {
//					if (encodeURL($txt) == encodeURL($book['title'])) {
//						echo mb_strtolower($txt).' - '.mb_strtolower($book['title']).'<hr/>';
						$sData = $this->soreOne($a->href);
					}
				}
//				break;
			}
			$html->clear();
		}
	}
	
	function soreOne ($url = null) {
		$html = new simple_html_dom();
		if (!$url) $url = 'https://www.sore.vn/chuyen-o-nong-trai-p1106512';
		$html->load_file($url);
//		echo $url.'<hr/>'.$html;
		$imgAr = $hrefAr = $vatAr = $titleAr = $priceAr = $nameAr = $sLogoAr = $storeDetailsAr = array();
		foreach ($html->find('.row-c') as $row) {
			$thumb = $sName = $logo = $pri = '';
			$storeDetails = array();
			foreach ($row->find('.box-name a.img img') as $img) {
				$imgAr[] = $thumb = $img->src;
			}
			foreach ($row->find('.box-address .s-adr') as $store) {
				$nameAr[] = $sName = str_replace('www.', '', $store->plaintext);
				$sLogoAr[] = $logo = "https://image.sore.vn/logo/{$sName}.png";
			}
			foreach ($row->find('.box-status') as $stt) {
				$status = $stt->plaintext;
			}
			foreach ($row->find('.box-price strong') as $price) {
				$priceAr[] = $pri = str_replace(array('.', 'đ'), array('', ''), $price->plaintext);
				//$priceAr[] = $pri = preg_replace('.|đ', '', $price->plaintext);
			}
			// store details 
			foreach ($row->find('.popover-content') as $pop) {
				foreach ($pop->find('p:eq(2) .ad') as $ad) {
					$storeDetails['address'][] = $ad->plaintext;
				}
/*				foreach ($pop->find('p:eq(1)') as $phone) {
//					$storeDetails['phone'][] = str_replace('Hotline:', '', $phone->plaintext);
					$storeDetails['phone'][] = $phone->plaintext;
				}
*/			}
			echo "<img src='{$thumb}'/><br/>{$sName}<br/><img src='{$logo}'/><br/>{$pri}";
			print_r($storeDetails);
			$sIn = $this->getStores($sName);
			echo '<br/>Store info: ';
			print_r($sIn);
			if (!$sIn['id']) {
				$addr = rtrim(implode('|', $storeDetails['address']));
				// insert store
				$query = "INSERT INTO stores SET title = ?, url = ?, thumb = ?, address = ?";
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(1, $sName);
				$stmt->bindParam(2, $sName);
				$stmt->bindParam(3, $logo);
//				$stmt->bindParam(4, implode('|', $storeDetails['phone']));
				$stmt->bindParam(4, $addr);
				$stmt->execute();
				if ($stmt->fetch(PDO::FETCH_ASSOC)) echo '<b>store added</b><br/>';
			}
			$bbIn = $this->countBooksBuy($sName, $this->bid);
			if ($bbIn <= 0) {
				// insert books_buy_online
				$quer = "INSERT INTO books_buy_online SET bid = ?, slink = ?, thumb = ?, price = ?, status = ?";
				$stm = $this->conn->prepare($quer);
				$stm->bindParam(1, $this->bid);
				$stm->bindParam(2, $sName);
				$stm->bindParam(3, $thumb);
				$stm->bindParam(4, $pri);
				$stm->bindParam(5, $status);
				$stm->execute();
				if ($stm->fetch(PDO::FETCH_ASSOC)) echo '<b>books_buy_online</b> added<br/>';
			}
			echo "<hr/>";
		}
		$html->clear();
		unset($html);
		$data = array(
					'imgAr' => $imgAr, 
					'priceAr' => $priceAr, 
					'storeAr' => $nameAr, 
					'sLogoAr' => $sLogoAr
				);
		return $data;
	}

	function websosanh ($url = null) {
		$html = new simple_html_dom();
/*
$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_URL, "https://whatismyip.com");
curl_setopt($curl, CURLOPT_REFERER, "https://whatismyip.com");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201');
$str = curl_exec($curl);
curl_close($curl);

    $html->load_file("https://whatismyip.com");
    $element=$html->find("table");
*/
		if (!$url) $url = 'https://m.websosanh.vn/s/Ai+cũng+giao+tiếp+nhưng+mấy+người+kết+nối.htm';
		$context = stream_context_create(array(
			'http' => array(
				'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
			),
		));
//		$html = file_get_contents('http://whatismyip.com/', false, $context);
		$html->load_file($url);
//		$html = file_get_contents($url, false, $context);
		$imgAr = $vatAr = $titleAr = $priceAr = $merchantAr = array();
		// get title
		foreach ($html->find('.product-item') as $product) {
			foreach ($product->find('.product-img') as $pimg) {
				foreach ($pimg->find('img') as $img) {
					$imgAr[] 	= $img->src;
				}
			}
			foreach ($product->find('h3') as $h3) {
				foreach ($h3->find('a') as $a) {
					$tAr[] 		= $title 				= $a->plaintext;
					$hrefAr[] 	= $original_url 	= $a->href;
				}
			}
			foreach ($product->find('.price') as $price) {
				foreach ($price->find('strong') as $strong) {
					$priceAr[] 	= $strong->plaintext;
				}
				foreach ($price->find('.vat') as $vat) {
					$vatAr[] 	= $vat->plaintext;
				}
			}
			foreach ($product->find('.merchant-name') as $merchant) {
				$merchantAr[] = $merchant->plaintext;
				$link = encodeURL($merchant->plaintext);
			}
		}
		foreach ($tAr as $k => $tO) {
			echo $tO.'<br/>'.$merchantAr[$k].'<br/>'.$priceAr[$k].' - '.$vatAr[$k].'<hr/>';
		}
	}

	function checkAuthor ($author) {
		$query = "SELECT id FROM authors WHERE name = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $author);
		$stmt->execute();
		$num = $stmt->rowCount();

		return $num;
	}

	function addAuthor ($author, $des) {
		$query = "INSERT INTO
					authors
				SET
					name = ?, link = ?, des = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
		// get content from vi.wikipedia
		// eg: https://vi.wikipedia.org/w/api.php?action=query&prop=revisions&rvprop=content&rvsection=0&titles=George%20Orwell
		//$des = 

		$author = trim($author, " ");
		$link = encodeURL($author);

		// bind values
		$stmt->bindParam(1, $author);
		$stmt->bindParam(2, $link);
		$stmt->bindParam(3, content($des));

		$add = $stmt->execute();
		return $add;
	}
	
	function getAuthors () {
		$query = "SELECT
					author
				FROM
					" . $this->table_name . "
				WHERE 
					id > 10";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		$auList = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$auList[] = $row['author'];
/*			if ($this->checkAuthor($author) <= 0) {
				//$this->addAuthor($author);
				$auList[] = $author;
			}
*/		}
		return $auList;
	}
	
	function updateAuthors () {
		$query = "SELECT
					id,name,link
				FROM
					authors";

		
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		$auList = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$name = rtrim($row['name']);
			$link = encodeURL($name);
			$this->updateAuth($row['id'], "name = '{$name}' AND link = '{$link}' ");
		}
		return $auList;
	}
	
	function updateAuth ($id, $updateContent) {
		$query = "UPDATE
					authors
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
