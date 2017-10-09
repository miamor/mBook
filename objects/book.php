<?php
class Book extends BookWrite {

	public function __construct() {
		parent::__construct();
	}

	// create product
	function create() {
		//write query
			$query = "INSERT INTO
					" . $this->table_name . "
				SET
					title = ?, link = ?, des = ?, genres = ?, author = ?, published = ?, download_link = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->des = content($this->des);

		// bind values
		$stmt->bindParam(1, $this->title);
		$stmt->bindParam(2, $this->link);
		$stmt->bindParam(3, $this->des);
		$stmt->bindParam(4, $this->genres);
		$stmt->bindParam(5, $this->author);
		$stmt->bindParam(6, $this->published);
		$stmt->bindParam(7, $this->download_link);

		if ($stmt->execute()) {
			return true;
		} else
			return false;
	}

	function readAll ($withU = -1, $genresAr = null, $authorAr = null, $order = '', $from_record_num = 0, $records_per_page = 24, $keyword = null) {
		$lim = '';
		$con = array();

		if ($records_per_page > 0) 
			$lim = "LIMIT {$from_record_num}, {$records_per_page}";
		
		$con[] = 'authenticated = 1';
		$con[] = 'type = 0';
		if ($withU == 1) $con[] = 'uid != 0';
		if ($withU == 0) $con[] = 'uid = 0';
		
		if ($keyword) {
			$con[] = "INSTR(`title`, '{$keyword}') > 0";
		}
		
		if ($genresAr) {
			$conGenAr = array();
			foreach ($genresAr as $gO) {
//				$conAr[] = "\"*[{$gO}]*\"";
//				$conAr[] = '"*['.$gO.']*"';
//				$conAr[] = '"'.$gO.'"';
//				$conAr[] = $gO;
//				$conAr[] = 'genres LIKE "['.$gO.']"';
				$conGenAr[] = "INSTR(`genres`, '[{$gO}]') > 0";
			}
		//	$con[] = "CONTAINS (genres, '".implode(' OR ', $conAr)."')";
			$con[] = '('.implode(' OR ', $conGenAr).')';
		}
		if ($authorAr) {
			$conAuAr = array();
			foreach ($authorAr as $aO) {
				$conAuAr[] = "`author` = '{$aO}' ";
			}
			$con[] = '('.implode(' OR ', $conAuAr).')';
		}
		$con[] = '`show` = 1';
		if ($con) $cond = 'WHERE '.implode(' AND ', $con);

		if (!$order) $order = "title ASC, modified DESC, created DESC, id DESC";

		$query = "SELECT
					title,link,id,type,published,status,thumb,genres,created,modified,uid,author
				FROM
					" . $this->table_name . "
				{$cond}
				ORDER BY
					{$order}
				{$lim}";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		$this->all_list = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$row['link'] = $this->bLink.'/'.$row['link'];
			
			$row['uid'] = (int)$row['uid'];
			// author
			if ($row['uid']) $row['author'] = $this->getUserInfo($row['uid']);
			else $row['author'] = array('name' => $row['author'], 'link' => $this->auLink.'/'.encodeURL($row['author']));
			
//			$row['des'] = content(substr(htmlspecialchars(strip_tags($row['des'])), 0, 240)).'... <a href="'.$row['link'].'" class="small">See more</a>';

			// share list
/*			$row['shareNum'] = 0;
		//	$row['share'] = array();
			if ($row['share']) {
				$shareAr = explode(',', $row['share']);
				foreach ($shareAr as $oS) 
					$uShare[] = $this->getUserInfo($oS);
				$row['share'] = $uShare;
				$row['shareNum'] = count($shareAr);
			}
*/
			// genres
			if ($row['genres']) {
				$gnr = explode(',', $row['genres']);
				$gAr = $gTxtAr = array();
				foreach ($gnr as $gno) {
					$gIn = $this->getGenre($gno);
					if (isset($gIn['id'])) {
						$gAr[] = $gIn;
						$gTxtAr[] = '<a href="'.$gIn['link'].'">'.$gIn['title'].'</a>';
					}
				}
				if (count($gAr) > 0) {
					$row['genres'] = $gAr;
					$row['genresText'] = implode(', ', $gTxtAr);
				}
			} 
			if (!isset($row['genresText'])) {
				$row['genres'] = array();
				$row['genresText'] = '';
			}
			
			// reviews
			$this->getReviews($row['id']);
			$row['averageRate'] = $this->averageRate;
			$row['totalReview'] = $this->totalReview;
			
			// status
			$row['sttText'] = ($row['status'] == 0) ? '<span class="text-success">Đang tiến hành</span>' : '<span class="text-danger">Đã hoàn thành</span>';
			$row['sttTextIcon'] = ($row['status'] == 0) ? '<span class="text-success fa fa-refresh"></span>' : '<span class="text-danger fa fa-check hidden"></span>';

			// chapters num
			$row['chaptersNum'] = $this->countChapters($row['id']);
			
			$this->all_list[] = $row;
		}

		return $stmt;
	}

	function countAll ($withU = -1, $genresAr = null, $authorAr = null, $keyword) {
		$lim = '';
		$con = array();
		
		$con[] = 'authenticated = 1';
		$con[] = 'type = 0';
		if ($withU == 1) $con[] = 'uid != 0';
		if ($withU == 0) $con[] = 'uid = 0';
		
		if ($genresAr) {
			$conGenAr = array();
			foreach ($genresAr as $gO) {
				$conGenAr[] = "INSTR(`genres`, '[{$gO}]') > 0";
			}
			$con[] = '('.implode(' OR ', $conGenAr).')';
		}
		if ($authorAr) {
			$conAuAr = array();
			foreach ($authorAr as $aO) {
				$conAuAr[] = "`author` = '{$aO}' ";
			}
			$con[] = '('.implode(' OR ', $conAu).')';
		}
		$con[] = '`show` = 1';

		if ($keyword) {
			$con[] = "INSTR(`title`, '{$keyword}') > 0";
		}
		
		if ($con) $cond = 'WHERE '.implode(' AND ', $con);
		

		$query = "SELECT
					id
				FROM
					" . $this->table_name . "
				{$cond}";
		
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->rowCount();
	}

	function readOne () {
		preg_match('!\d+!', $this->id, $matches);
		if ($this->id == $matches[0]) {
			$query = "SELECT * FROM " . $this->table_name . "
				WHERE
					`show` = 1 AND authenticated = 1
					AND id = ?
				LIMIT 0,1";
			$val = $this->id;
		} else if ($this->id) {
			$query = "SELECT * FROM " . $this->table_name . "
				WHERE
					`show` = 1 AND authenticated = 1
					AND link = ?
				LIMIT 0,1";
			$val = $this->id;
		} else if ($this->title) {
			$query = "SELECT * FROM " . $this->table_name . "
				WHERE
					`show` = 1 AND authenticated = 1
					AND title = ?
				LIMIT 0,1";
			$val = $this->title;
		}
/*		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE
					`show` = 1
					AND authenticated = 1
					AND (id = ? OR link = ? OR title = ?)
				LIMIT
					0,1";
*/
//		echo $this->id;
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $val);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		
		if ($row['id']) {
			$this->link = $row['link'] = $this->bLink.'/'.$row['link'];
			$this->title = $row['title'];
			$this->type = $row['type'];
			
			// des
			$row['des'] = content($row['des']);
			$row['download'] = explode('|', str_replace('&amp;', '&', $row['download']));
			
			// is published
			if ($row['published'] == 1) {
				$row['publishedList'] = $this->bPublished();
			} else { // not published, get requests
				$rq = explode(',', $row['requests']);
				foreach ($rq as $ro) 
					$rqAr[] = $this->getUserInfo($ro);
				$row['requests'] = $rqAr;
			}

			// share list
			$row['shareNum'] = 0;
			$row['share'] = array();
/*			if ($row['share']) {
				$shareAr = explode(',', $row['share']);
				$uShare = array();
				foreach ($shareAr as $oS) 
					$uShare[] = $this->getUserInfo($oS);
				$row['share'] = $uShare;
				$row['shareNum'] = count($shareAr);
			}
*/			
			// author
			$row['uid'] = (int)$row['uid'];
			if ($row['uid']) $row['author'] = $this->getUserInfo($row['uid']);
			else $row['author'] = array('name' => $row['author'], 'link' => $this->auLink.'/'.encodeURL($row['author']));
			
			// genres
			if ($row['genres']) {
				$gnr = explode(',', $row['genres']);
				$gAr = $gTxtAr = array();
				foreach ($gnr as $gno) {
					$gIn = $this->getGenre($gno);
					if (isset($gIn['id'])) {
						$gAr[] = $gIn;
						$gTxtAr[] = '<a href="'.$gIn['link'].'">'.$gIn['title'].'</a>';
					}
				}
				if (count($gAr) > 0) {
					$row['genres'] = $gAr;
					$row['genresText'] = implode(', ', $gTxtAr);
				}
			} 
			if (!isset($row['genresText'])) {
				$row['genres'] = array();
				$row['genresText'] = '';
			}

			// status
			if ($row['type'] == 0) $row['sttText'] = ($row['status'] == 0) ? '<span class="text-success">Đang tiến hành</span>' : '<span class="text-danger">Đã hoàn thành</span>';
			else $row['sttText'] = ($row['status'] == 0) ? '<span class="text-success">Mở</span>' : '<span class="text-danger">Khóa</span>';

			// quotes
			$row['quotesNum'] = 0;
			$row['quotesAr'] = array();
			if ($row['quotes']) {
				$row['quotesAr'] = explode('[!#!]', content($row['quotes']));
				$row['quotesNum'] = count($row['quotesAr']);
			}
			
			// ratings
			$this->getReviews();
			$row['ratingsList'] = $this->ratingsList;
			$row['ratingsNum'] = count($this->ratingsList);
		}

		return $row;
	}
	

	
	function bPublished ($id = '', $order = '') {
		if (!$order) $order = "published_day DESC, id DESC";
		if (!$id) $id = $this->id;
		
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "_published
				WHERE 
					iid = ?
				ORDER BY
					{$order}";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $id);

		$stmt->execute();

		$bPublished = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$row['author'] = $this->getUserInfo($row['pid']);
			$row['link'] = $row['author']['link'].'/published/'.$row['id'];
			$row['des'] = content(substr(htmlspecialchars(strip_tags($row['des'])), 0, 140)).'...';
			$bPublished[] = $row;
		}
		
		return $bPublished;
	}

}
?>
