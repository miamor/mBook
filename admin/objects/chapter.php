<?php
include_once '../objects/chapter.php';
class Chapter_Admin extends Chapter {

	// database connection and table name
//	private $conn;
	private $table_name = "books_chapters";

	public $coins = 0;
	
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

	public function countAll(){
		$query = "SELECT id FROM " . $this->table_name . "";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		$num = $stmt->rowCount();

		return $num;
	}

	function readAll () {
		if (!$order) $order = "modified DESC, created DESC, id DESC";

		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE 
					iid = ?
				ORDER BY
					{$order}";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->bid);

		$stmt->execute();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['link'] = $this->bookLink.'/chapters/'.$row['link'];
			if ($row['uid']) $row['author'] = $this->getUserInfo($row['uid']);
			
			$row['content'] = content($row['content']);

			$row['coins'] = $this->getCoins($row['id']);
			$this->bChapters[] = $row;
		}

		return $stmt;
	}
	
	function readOne () {
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "
				WHERE 
					(n = ? OR link = ?) AND iid = ?
				LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->id);
		$stmt->bindParam(3, $this->bid);

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];
		if ($row['id']) {
			$row['link'] = $this->bookLink.'/chapters/'.$row['link'];
			
			// author
			if ($row['uid']) $row['author'] = $this->getUserInfo($row['uid']);
			
			// content
			$row['content'] = content($row['content']);
			$row['content_feed'] = (strlen($row['content']) > 1500) ? content(substr(htmlspecialchars(strip_tags($row['content'])), 0, 1500)).'... <a href="'.$row['link'].'" id="'.$row['id'].'" class="book-rv-read gensmall">See more</a>' : $row['content'];
			
			// ratings
			$this->getRatings();
			$row['ratingsList'] = $this->ratingsList;
			$row['ratingsNum'] = count($this->ratingsList);
			
			$row['coins'] = $this->coins;
		}
		return $row;
	}
	
	function getRatings ($id) {
		if (!$order) $order = "modified DESC, created DESC, id DESC";
		if (!$id) $id = $this->id;
		
		$query = "SELECT
					*
				FROM
					" . $this->table_name . "_reviews
				WHERE 
					bid = ? AND cid = ?
				ORDER BY
					{$order}";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->bid);
		$stmt->bindParam(2, $id);

		$stmt->execute();

		$totalReview = 0;
		$totalRates = 0;
		$this->ratingsList = array();
		$this->coins = 0;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //$row['link'] = $this->rLink.'/'.$row['id'];
			$row['author'] = $this->getUserInfo($row['uid']);
			$totalReview++;
			$totalRates += $row['rate'];
			
			$row['content'] = content($row['content']);
			
			// set coins
			$row['coins'] = 5;
			$this->coins += $row['coins'];
			
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

	
	function getCoins ($id) {
		if (!$id) $id = $this->id;
		
		$query = "SELECT
					rate,uid
				FROM
					" . $this->table_name . "_reviews
				WHERE 
					bid = ? AND cid = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->bid);
		$stmt->bindParam(2, $id);

		$stmt->execute();

		$cCoins = 0;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			// set coins
			$row['coins'] = 5;
			
			// add coins to the chapter
			$cCoins += $row['coins'];
		}
		
		return $cCoins;
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
