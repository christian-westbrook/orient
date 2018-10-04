<?php
//==========| Class: cartController |==========
class cartController{
  private $conn;
  function __construct(){
    require_once('../database.php');
    $this->conn = $pdo;
  }
	//==========| Public Functions |==========
	public function add($userID, $courseID){
		$insert = $this->addCourse($userID, $courseID);
		$results = ($insert != false) ? ['status'=>true, 'id'=>$insert] : ['status'=>false];
		$this->displayJSON($results);

	}
	public function remove($userID, $courseID){
		$results = $this->removeCourse($userID, $courseID) ? ['status'=>true] : ['status'=>false];
		$this->displayJSON($results);
	}
	public function list($userID){
		$courseList = $this->getCourseList($userID);
    $this->collectCourseInfo($courseList);
	}
  public function displayJSON($array){
		header('Content-Type: application/json');
	  echo json_encode($array, JSON_PRETTY_PRINT);
	}
	//==========| Private Functions |==========
	private function collectCourseInfo($courseList){
    $builtList = [];
    foreach($courseList as $course){
      $info = $this->getCourseInfo($course['COURSE_ID']);
      $this->previewArray($info);
    }
	}
	private function getCourseList($userID){
		$db = $this->conn;
		$stmt = $db->prepare('SELECT USER_ID, COURSE_ID FROM USERS_COURSES WHERE USER_ID = :USERID');
		$stmt->bindParam(':USERID', $userID);
		if($stmt->execute()){
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}
	private function getCourseInfo($courseID){
		$db = $this->conn;
		$stmt = $db->prepare('SELECT COURSE_ID, TITLE, DAYS, TIME, LOCATION FROM COURSES WHERE COURSE_ID = :COURSEID');
		$stmt->bindParam(':COURSEID', $courseID);
		if($stmt->execute()){
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}
	private function addCourse($userID, $courseID){
		$db = $this->conn;
		$stmt = $db->prepare('INSERT INTO USERS_COURSES (USER_ID, COURSE_ID) VALUES (:USERID, :COURSEID)');
		$stmt->bindParam(':USERID', $userID);
		$stmt->bindParam(':COURSEID', $courseID);
		if($stmt->execute()){
			return $db->lastInsertId();
		}else{
			return false;
		}
	}
	private function removeCourse($userID, $courseID){
		$db = $this->conn;
		$stmt = $db->prepare('DELETE FROM USERS_COURSES WHERE USER_ID = :USERID AND COURSE_ID = :COURSEID');
		$stmt->bindParam(':USERID', $userID);
		$stmt->bindParam(':COURSEID', $courseID);
		return $stmt->execute();
	}
  //==========| Extra |==========
  private function previewArray($array){
  	echo "<pre>"; var_dump($array); echo "</pre>";
  }
}
?>
