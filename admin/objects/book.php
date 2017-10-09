<?php
include_once '../objects/book.php';
class Book_Admin extends Book {

	// database connection and table name
//	private $conn;
	private $table_name = "books";

	// object properties
	public $id;
	public $title;
	public $link;
	public $content;
	public $cid;
	public $uid;
	public $views;
	public $author;
	public $sid;

	public function __construct() {
		parent::__construct();
	}

	// create product
	function create() {
		//write query
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					title = ?, link = ?, des = ?, genres = ?, author = ?, uid = ?, published = ?";

		$stmt = $this->conn->prepare($query);

		// posted values
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->code = htmlspecialchars(strip_tags($this->code));
		$this->des = content($this->des);

		// bind values
		$stmt->bindParam(1, $this->title);
		$stmt->bindParam(2, $this->link);
		$stmt->bindParam(3, $this->des);
		$stmt->bindParam(4, $this->genres);
		$stmt->bindParam(5, $this->author);
		$stmt->bindParam(6, $this->uid);
		$stmt->bindParam(7, $this->published);

		if ($stmt->execute())
			return true;
		else
			return false;

	}

	function readAll ($withU = -1, $all = false, $order = '', $page, $from_record_num, $records_per_page) {
        $lim = $con = '';
        if ($from_record_num) $lim = "LIMIT
					{$from_record_num}, {$records_per_page}";
					
		$con[] = 'authenticated = 1';
		$con[] = 'type = 0';
		if ($withU == 1) $con[] = 'uid != 0';
		if ($withU == 0) $con[] = 'uid = 0';
		if ($all) $con[] = "genres = {$all}";
		
		if ($con) $cond = 'WHERE '.implode(' AND ', $con);
					
		if (!$order) $order = "modified DESC, created DESC, id DESC";

		$query = "SELECT
					*
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
			
			// author
			if ($row['uid']) $row['author'] = $this->getUserInfo($row['uid']);
			else $row['author'] = array('name' => $row['author'], 'link' => $this->auLink.'/'.encodeURL($row['author']));
			
			$row['des'] = content(substr(htmlspecialchars(strip_tags($row['des'])), 0, 240)).'... <a href="'.$row['link'].'" class="small">See more</a>';

			// share list
			$row['shareNum'] = 0;
			$row['share'] = array();
			if ($row['share']) {
				$shareAr = explode(',', $row['share']);
				foreach ($shareAr as $oS) 
					$uShare[] = $this->getUserInfo($oS);
				$row['share'] = $uShare;
				$row['shareNum'] = count($shareAr);
			}

			// genres
			$gnr = explode(',', $row['genres']);
			$gAr = $gTxtAr = array();
			foreach ($gnr as $gno) {
				$gIn = $this->getGenre($gno);
				$gAr[] = $gIn;
				$gTxtAr[] = '<a href="'.$gIn['link'].'">'.$gIn['title'].'</a>';
			}
			$row['genres'] = $gAr;
			$row['genresText'] = implode(', ', $gTxtAr);
			
			// reviews
			$this->getReviews($row['id']);
			$row['averageRate'] = $this->averageRate;
			$row['totalReview'] = $this->totalReview;
			
			// status
			if ($row['type'] == 0) $row['sttText'] = ($row['status'] == 0) ? '<span class="text-success">Đang tiến hành</span>' : '<span class="text-danger">Đã hoàn thành</span>';
			else $row['sttText'] = ($row['status'] == 0) ? '<span class="text-success">Mở</span>' : '<span class="text-danger">Khóa</span>';

			// chapters num
			$row['chaptersNum'] = $this->countChapters($row['id']);
			
			$this->all_list[] = $row;
		}

		return $stmt;
	}

	function readOne () {
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE
					(id = ? OR link = ? OR title = ?)
					AND authenticated = 1
				LIMIT
					0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->id);
		$stmt->bindParam(3, $this->title);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		
		if ($row['id']) {
			$this->link = $row['link'] = $this->bLink.'/'.$row['link'];
			$this->title = $row['title'];
			
			// des
			$row['des'] = content($row['des']);

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
			if ($row['share']) {
				$shareAr = explode(',', $row['share']);
				$uShare = array();
				foreach ($shareAr as $oS) 
					$uShare[] = $this->getUserInfo($oS);
				$row['share'] = $uShare;
				$row['shareNum'] = count($shareAr);
			}
			
			// author
			if ($row['uid']) $row['author'] = $this->getUserInfo($row['uid']);
			else $row['author'] = array('name' => $row['author'], 'link' => $this->auLink.'/'.encodeURL($row['author']));
			
			// genres
			$gnr = explode(',', $row['genres']);
			$gAr = $gTxtAr = array();
			foreach ($gnr as $gno) {
				$gIn = $this->getGenre($gno);
				$gAr[] = $gIn;
				$gTxtAr[] = '<a href="'.$gIn['link'].'">'.$gIn['title'].'</a>';
			}
			$row['genres'] = $gAr;
			$row['genresText'] = implode(', ', $gTxtAr);

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
	
	function getGenre ($g) {
		$query = "SELECT
					*
				FROM
					genres
				WHERE
					(id = ? OR link = ? OR title = ?)
				LIMIT
					0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $g);
		$stmt->bindParam(2, $g);
		$stmt->bindParam(3, $g);

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$row['link'] = $this->gnLink.'/'.$row['link'];
		
		return $row;
	}
	
	public function countChapters ($iid) {
		if (!$iid) $iid = $this->id;
		$query = "SELECT id FROM " . $this->table_name . "_chapters WHERE iid = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $iid);
		$stmt->execute();
		$num = $stmt->rowCount();

		return $num;
	}


	function getReviews ($id) {
		if (!$order) $order = "modified DESC, created DESC, id DESC";
		if (!$id) $id = $this->id;
		
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "_reviews
				WHERE 
					iid = ?
				ORDER BY
					{$order}";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $id);

		$stmt->execute();

		$totalReview = 0;
		$totalRates = 0;
		$this->ratingsList = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['link'] = $this->rLink.'/'.$row['id'];
			$row['author'] = $this->getUserInfo($row['uid']);
			
			$row['content'] = content(substr($row['content'], 0, 1200)).'... <a href="'.$row['link'].'" id="'.$row['id'].'" class="book-rv-read gensmall">See more</a>';
			$row['short_content'] = content(substr(htmlspecialchars(strip_tags($row['content'])), 0, 280)).'... <a href="'.$row['link'].'" id="'.$row['id'].'" class="book-rv-read gensmall">See more</a>';
			
			$totalReview++;
			$totalRates += $row['rate'];

			$row['ratingsList'] = $this->getReviewsRatings($row['id']);
			$row['ratingsNum'] = count($row['ratingsList']);
			$row['average'] = $this->rAverage;
			$row['total'] = $this->rTotal;
						
			// share list
			$row['shareNum'] = 0;
			$row['share'] = array();
			if ($row['share']) {
				$shareAr = explode(',', $row['share']);
				foreach ($shareAr as $oS) 
					$uShare[] = $this->getUserInfo($oS);
				$row['share'] = $uShare;
				$row['shareNum'] = count($shareAr);
			}

			// coins for this review
			$row['coins'] = $this->rCoins;
			
			$this->ratingsList[] = $row;
		}

		if ($totalReview == 0) $averageRate = 0;
		else $averageRate = $totalRates/$totalReview;
		if (($averageRate - floor($averageRate)) >= 0.5) $averageRate = floor($averageRate) + 0.5;
		else $averageRate = floor($averageRate);

		$this->averageRate = number_format($averageRate, 1);
		$this->totalReview = $totalReview;
		
		return $stmt;
	}

	function getReviewsRatings ($id) {
		if (!$order) $order = "modified DESC, created DESC, id DESC";
		
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "_reviews_ratings
				WHERE 
					iid = ?
				ORDER BY
					{$order}";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $id);

		$stmt->execute();

		$totalReview = 0;
		$totalRates = 0;
		$ratingsList = array();
		$this->rCoins = 0;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//$row['link'] = $this->rLink.'/'.$row['id'];
			$row['author'] = $this->getUserInfo($row['uid']);

			$row['content'] = content($row['content'], 0, 310);

			$totalReview++;
			$totalRates += $row['rate'];
			
			// set coins for review got rated
			$row['coins'] = 5;
			$this->rCoins += $row['coins'];

			$ratingsList[] = $row;
		}

		if ($totalReview == 0) $averageRate = 0;
		else $averageRate = $totalRates/$totalReview;
		if (($averageRate - floor($averageRate)) >= 0.5) $averageRate = floor($averageRate) + 0.5;
		else $averageRate = floor($averageRate);

		$this->rAverage = number_format($averageRate, 1);
		$this->rTotal = $totalReview;
		
		return $ratingsList;
	}

	
	function bPublished ($id) {
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


	
	function update() {

		$query = "UPDATE
					" . $this->table_name . "
				SET
					name = :name,
					price = :price,
					description = :description,
					category_id  = :category_id
				WHERE
					id = :id";

		$stmt = $this->conn->prepare($query);

		// posted values
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->id=htmlspecialchars(strip_tags($this->id));

		// bind parameters
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':category_id', $this->category_id);
		$stmt->bindParam(':id', $this->id);

		// execute the query
		if ($stmt->execute()) return true; 
		else return false;
	}

	// delete the product
	function delete() {

		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if ($result = $stmt->execute()) return true;
		else return false;
	}

}
?>
