<?php
//==========| Class: resultsController |==========
class resultsController{
  private $conn;
  function __construct(){
    require_once('../database.php');
    $this->conn = $pdo;
  }
  public function results($category, $id){
    //echo "Category: $category<br>$category ID: $id<br>";
    $sql = $this->createSQL($category);
    $results = $this->getResults($sql, $id);
    if($results == false){
      return ['status'=>false, 'message'=>'Invalid Search Type.'];
    }else{
      $cleanResults = $this->cleanResults($results);
      return $cleanResults;
    }
  }
  private function createSQL($category){
    $base = "SELECT C.COURSE_ID, CONCAT(I.FNAME,' ',I.LNAME) AS INSTRUCTOR, S.NAME AS SUBJECT, C.STATUS, C.CRN, C.TITLE AS COURSE, C.CRSNUM, C.SEC, C.CRED, C.DAYS, C.TIME, C.ST_DATE, C.END_DATE, C.LOCATION, C.CAP, C.ACT, C.REM, C.WL, C.WEEKS FROM COURSES C JOIN INSTRUCTORS I ON C.INSTRUCTOR_ID = I.INSTRUCTOR_ID JOIN SUBJECTS S ON C.SUBJ_ID = S.SUBJECT_ID WHERE ";
    switch ($category){
      case 'SUBJECT':
      $where = "S.SUBJECT_ID = :ID";
      break;
      case 'COURSE':
      $where = "CONCAT(S.NAME,C.CRSNUM) = :ID";
      break;
      case 'INSTRUCTOR':
      $where = "I.INSTRUCTOR_ID = :ID";
      break;
      case 'CRN':
      $where = "C.COURSE_ID = :ID";
      break;
      default:
        return false;

    }
    return $base.$where;
  }
  private function getResults($sql, $id){
    $db = $this->conn;
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':ID', $id);
    if($stmt->execute()){
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
      return false;
    }
  }
  private function cleanResults($results){
    $sort1 = $this->sortByGradeLevel($results);
    $sort2 = $this->sortByCourse($sort1);
    $sort3 = $this->sortByInstructor($sort2);
    return $sort3;
  }
  //==========| Sort |==========
  private function sortByGradeLevel($results){
    $sortedArray = ['Freshman'=>[], 'Sophomore'=>[], 'Junior'=>[], 'Senior'=>[]];
    foreach ($results as $course){
      $courseNum = substr($course['CRSNUM'], 0, 1);
      if($courseNum == 1){
        array_push($sortedArray['Freshman'], $course);
      }elseif($courseNum == 2){
        array_push($sortedArray['Sophomore'], $course);
      }elseif($courseNum == 3){
        array_push($sortedArray['Junior'], $course);
      }elseif($courseNum == 4){
        array_push($sortedArray['Senior'], $course);
      }
    }
    return $sortedArray;
  }
  function sortByCourse($results){
    $sortedArray = ['Freshman'=>[], 'Sophomore'=>[], 'Junior'=>[], 'Senior'=>[]];
    foreach ($results as $gradeName => $courses){
      $temp = [];
      foreach ($courses as $course){
        $courseID = $course['SUBJECT'].$course['CRSNUM'].' - '.$course['COURSE'].' - '.$course['CRED'].' Credits';
        if(array_key_exists($courseID, $temp)){
          array_push($temp[$courseID], $course);
        }else{
          $temp[$courseID] = [];
          array_push($temp[$courseID], $course);
        }
      }
      $sortedArray[$gradeName] = $temp;
    }
    return $sortedArray;
  }
  function sortByInstructor($results){
    $sortedArray = ['Freshman'=>[], 'Sophomore'=>[], 'Junior'=>[], 'Senior'=>[]];
    foreach ($results as $gradeName => $courses){//sortByGrade
      //echo "+ Grade: $gradeName<br>";
      $abc = [];
      foreach ($courses as $courseID => $course){//sortByCourse

        //echo "++ Course ID: $courseID<br>";
        $temp = [$courseID=>[]];
        foreach ($course as $courseInfo){//sortByInstructor
          $instructor = $courseInfo['INSTRUCTOR'];
          if(array_key_exists($instructor, $temp[$courseID])){
            array_push($temp[$courseID][$instructor], $courseInfo);
          }else{
            $temp[$courseID][$instructor] = [];
            array_push($temp[$courseID][$instructor], $courseInfo);
          }
        }//[END] - sortByInstructor
        array_push($abc, $temp);
      }//[END] - sortByCourse
      $sortedArray[$gradeName] = $abc;
    }//[END] - sortByGrade
    return $sortedArray;
  }
  //==========| Extra |==========
  private function previewArray($array){
  	echo "<pre>"; var_dump($array); echo "</pre>";
  }
}
?>
