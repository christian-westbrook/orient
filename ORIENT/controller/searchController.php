<?php
//==========| Class: searchController |==========
class searchController{
  private $conn;
  function __construct(){
    require_once('../database.php');
    $this->conn = $pdo;
  }
  //==========| Select2 Search |==========
  public function select2($value){
    $infoFinal = [];
    $infoSubject = $this->select2_subject($value);
    $infoCourse = $this->select2_course($value);
    $infoInstructor = $this->select2_instructor($value);
    $infoCRN = $this->select2_crn($value);
    array_push($infoFinal, $infoSubject, $infoCourse, $infoInstructor, $infoCRN);
    $this->select2_Results2JSON($infoFinal);
  }
  private function select2_subject($subject){
    $subject = "%".strtoupper(urldecode($subject))."%";
    $db = $this->conn;
    $sql = "SELECT CONCAT('SUBJECT:',SUBJECT_ID) AS 'id', NAME AS 'text' FROM SUBJECTS WHERE NAME LIKE :SUBJECT";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':SUBJECT', $subject);
    if($stmt->execute()){
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return sizeof($results) > 0 ? ['text'=>'Subject', 'children'=>$results] : [];
    }else{
      return false;
    }
  }
  private function select2_crn($crn){
    $crn = urldecode($crn)."%";
    $db = $this->conn;
    $sql = "SELECT CONCAT('CRN:',COURSE_ID) AS 'id', CONCAT(CRN, ' - ',TITLE) AS 'text' FROM COURSES WHERE CRN LIKE :CRN";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':CRN', $crn);
    if($stmt->execute()){
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return sizeof($results) > 0 ? ['text'=>'CRN', 'children'=>$results] : [];
    }else{
      return false;
    }
  }
  private function select2_course($course){
    $course = "%".strtolower(urldecode($course))."%";
    $db = $this->conn;
    $sql = "SELECT DISTINCT CONCAT('COURSE:',S.NAME,C.CRSNUM) AS 'id', CONCAT(S.NAME,C.CRSNUM,' - ',C.TITLE) AS 'text' FROM COURSES C JOIN SUBJECTS S ON C.SUBJ_ID = S.SUBJECT_ID WHERE LOWER(CONCAT(S.NAME,C.CRSNUM)) LIKE :COURSE OR LOWER(C.TITLE) LIKE :COURSE";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':COURSE', $course);
    if($stmt->execute()){
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return sizeof($results) > 0 ? ['text'=>'Course', 'children'=>$results] : [];
    }else{
      return false;
    }
  }
  private function select2_instructor($instructor){
    $course = "%".strtolower(urldecode($instructor))."%";
    $db = $this->conn;
    $sql = "SELECT CONCAT('INSTRUCTOR:',INSTRUCTOR_ID) AS 'id', CONCAT(FNAME,' ',LNAME) AS 'text' FROM INSTRUCTORS WHERE LOWER(FNAME) LIKE :INSTRUCTOR OR LOWER(LNAME) LIKE :INSTRUCTOR OR LOWER(CONCAT(FNAME,' ',LNAME)) LIKE :INSTRUCTOR";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':INSTRUCTOR', $instructor);
    if($stmt->execute()){
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return sizeof($results) > 0 ? ['text'=>'Instructor', 'children'=>$results] : [];
    }else{
      return false;
    }
  }
  private function select2_Results2JSON($array){
    header('Content-Type: application/json');
    echo json_encode(['results'=>$array, 'pagination'=>['more'=>false]], JSON_PRETTY_PRINT);
  }
  //==========| Extra |==========
  private function previewArray($array){
  	echo "<pre>"; var_dump($array); echo "</pre>";
  }
}
?>
