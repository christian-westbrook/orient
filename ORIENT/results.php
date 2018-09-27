<?php
session_start();

if(!isset($_SESSION["logIn"]) && empty( $_SESSION["logIn"])){
	header("Locaation:  index.php");
}
include('home.php');
$info = thing();
$sort1 = lvlOneAccordion_Sort($info);
$sort2 = lvlTwoAccordion_Sort($sort1);
?>
<div class="container-fluid m-0 p-3">
  <div class="row justify-content-center">
    <?php displayAccordion($sort2); ?>
  </div>
</div>




<?php
include('view/footer.php');

function displayAccordion($results){
  foreach ($results as $gradeLevel => $courses){
    $gradeTitle = level2Title($gradeLevel);
    echo "
    <div class='col-12' id='accordionLvl1'>
      <div class='card mb-3'><!-- $gradeTitle -->
        <div class='card-header p-0' id='".$gradeTitle."Header'><button class='p-0 m-3 btn btn-link text-dark' data-toggle='collapse' data-target='#".$gradeTitle."Content' aria-expanded='false'><span class='h3 font-weight-light'>$gradeLevel - $gradeTitle</span></button></div>
        <div class='collapse' id='".$gradeTitle."Content' data-parent='#accordionLvl1'>
          <div class='card-body' id='accordionLvl2'><!-- Accordion Level 2 -->";
          level2Accordion($courses);
          echo "</div><!-- [END] Accordion Level 2 -->
        </div>
      </div><!-- [END] - $gradeTitle -->
    </div>";
  }
}

function level2Accordion($courses){
  foreach ($courses as $courseName => $course) {
      $courseSubjectAndNumber = explode(' - ', $courseName)[0];
      echo "
      <div class='card mb-2'><!-- $courseSubjectAndNumber -->
      <div class='card-header p-0' id='".$courseSubjectAndNumber."Header'><button class='p-0 m-3 btn btn-link text-dark' data-toggle='collapse' data-target='#".$courseSubjectAndNumber."Content' aria-expanded='false'><span class='h5 font-weight-light'>$courseName</span></button></div>
      <div class='collapse' id='".$courseSubjectAndNumber."Content' data-parent='#accordionLvl2'>
      <div class='card-body'>";
        level2Table($course);
      echo "</div>
      </div>
      </div><!-- [END] - $courseSubjectAndNumber -->
      ";
  }
}

function level2Table($course){
  echo "
  <table class='table table-bordered table-striped table-sm'>
    <thead><th>Status</th><th>CRN</th><th>Instructor</th><th>RMP Rating</th><th>Sec</th><th>Days</th><th>Time</th><th>Start Date</th><th>End Date</th><th>Location</th><th>Cap</th><th>Actual</th><th>Remaining</th><th>Waitlist</th><th>Duration</th></thead>
    <tbody>";
    foreach ($course as $info) {
      echo "<tr class=".status2Class($info['STATUS']).">
      <td>".$info['STATUS']."</td>
      <td>".$info['CRN']."</td>
      <td>".lnamefname2fnamelname($info['INSTRUCTOR'])."</td>
      <td>".getRMPRating(lnamefname2fnamelname($info['INSTRUCTOR']))."</td>
      <td>".$info['SEC']."</td>
      <td>".$info['DAYS']."</td>
      <td>".$info['TIME']."</td>
      <td>".$info['START_DATE']."</td>
      <td>".$info['END_DATE']."</td>
      <td>".$info['LOCATION']."</td>
      <td>".$info['CAP']."</td>
      <td>".$info['ACTUAL']."</td>
      <td>".$info['REMAINING']."</td>
      <td>".($info['WAIT_LIST'] == 1 ? 'Y' : 'N')."</td>
      <td>".$info['DURATION']."</td>
      </tr>";
    }
    echo "</tbody>
  </table>
  ";
}
function level2Title($level){
  switch ($level) {
    case '1000':
    return 'Freshman';
    case '2000':
    return 'Sophomore';
    case '3000':
    return 'Junior';
    case '4000':
    return 'Senior';
  }
}

function status2Class($status){
  switch (strtoupper($status)) {
    case 'IN PROGRESS':
    return 'table-primary';
    case 'OPEN':
    return 'table-success';
    case 'CLOSED':
    return 'table-danger';
    case 'RESTRICTED':
    return 'table-danger';
    default:
    return '';
  }
}

//Temporary
function thing(){
  include('database.php');
  $sql = "SELECT I.INSTRUCTOR_ID, I.FNAME, I.LNAME, S.SUBJECT_ID, S.NAME, C.STATUS, C.CRN, C.TITLE, C.CRSNUM, C.SEC, C.CRED, C.DAYS, C.TIME, C.ST_DATE, C.END_DATE, C.LOCATION, C.CAP, C.ACT, C.REM, C.WL, C.WEEKS FROM COURSES C JOIN INSTRUCTORS I ON C.INSTRUCTOR_ID = I.INSTRUCTOR_ID JOIN SUBJECTS S ON C.SUBJ_ID = S.SUBJECT_ID WHERE I.FNAME LIKE '%" . $_POST['search'] ."%' OR I.LNAME LIKE '%" . $_POST['search'] . "%' OR S.NAME LIKE '%" . $_POST['search'] . "%' OR C.CRN LIKE '%" . $_POST['search'] . "%' OR C.TITLE LIKE '%" . $_POST['search'] . "%' OR C.CRSNUM LIKE '%" . $_POST['search'] . "%' OR C.DAYS='" . $_POST['search'] . "'";
	$stmt = $pdo->query($sql);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $results;
}

function lvlOneAccordion_Sort($array){
  $sortedArray = ['1000'=>[], '2000'=>[], '3000'=>[], '4000'=>[]];
  foreach ($array as $course){
    $courseNum = substr($course['CRSNUM'], 0, 1);
    if($courseNum == 1){
      array_push($sortedArray['1000'], $course);
    }elseif($courseNum == 2){
      array_push($sortedArray['2000'], $course);
    }elseif($courseNum == 3){
      array_push($sortedArray['3000'], $course);
    }elseif($courseNum == 4){
      array_push($sortedArray['4000'], $course);
    }
  }
  return $sortedArray;
}

function lvlTwoAccordion_Sort($array){
  $sortedArray = ['1000'=>[], '2000'=>[], '3000'=>[], '4000'=>[]];
  foreach ($array as $courseNumber => $courses){
    $temp = [];
    foreach ($courses as $course){
      $level2 = buildLvlTwoArrayTitle($course);
      if(array_key_exists($level2, $temp)){
        array_push($temp[$level2], buildLvlTwoArray($course));
      }else {
        $temp[$level2] = [];
        array_push($temp[$level2], buildLvlTwoArray($course));
      }
    }
    $sortedArray[$courseNumber] = $temp;
  }
  return $sortedArray;
}

function buildLvlTwoArrayTitle($course){
  return $course['NAME'] . $course['CRSNUM'] . ' - ' . $course['TITLE'] . ' - ' . $course['CRED'] . ' Credits';
}

function buildLvlTwoArray($course){
  $name = $course['LNAME'].', '.$course['FNAME'];
  $status = $course['STATUS'];
  $crn = $course['CRN'];
  $sec = $course['SEC'];
  $days = $course['DAYS'];
  $time = $course['TIME'];
  $startDate = $course['ST_DATE'];
  $endDate = $course['END_DATE'];
  $location = $course['LOCATION'];
  $cap = $course['CAP'];
  $actual = $course['ACT'];
  $remaining = $course['REM'];
  $waitList = $course['WL'];
  $weeks = $course['WEEKS'];
  return ['INSTRUCTOR'=>$name, 'STATUS'=>$status, 'CRN'=>$crn, 'SEC'=>$sec, 'DAYS'=>$days, 'TIME'=>$time, 'START_DATE'=>$startDate, 'END_DATE'=>$endDate, 'LOCATION'=>$location, 'CAP'=>$cap, 'ACTUAL'=>$actual, 'REMAINING'=>$remaining, 'WAIT_LIST'=>$waitList, 'DURATION'=>$weeks];
}

function lvlThreeAccordion_Sort($array){
	$sortedArray = ['1000'=>[], '2000'=>[], '3000'=>[], '4000'=>[]];
	foreach ($array as $courseNumber => $levelOneList){//echo "+$courseNumber<br>";
		foreach ($levelOneList as $courseName => $levelTwoList) {//echo "++$courseName<br>";
			foreach ($levelTwoList as $levelThreeList) {
				$instructor = lnamefname2fnamelname($levelThreeList['INSTRUCTOR']);// echo "+++$instructor<br>";
				$rmpRating = getRMPRating($instructor); //echo "+++$rmpRating<br>";
			}
		}
	}
	return $sortedArray;
}

function buildLvlThreeArray($course){
	array_shift($course);
	return $course;
}

function getRMPRating($instructor){
	if(trim($instructor) != "Staff"){
		$university = urlencode("University of Arkansas at Fort Smith");
		$results = json_decode(file_get_contents("http://code.cis.uafs.edu/~iot3/controller/rmp-api.php?university=$university&professor=".urlencode($instructor)), true);
		if($results['status'] != false){
			if(!is_null($results['results'])){
				return strlen($results['results']['overallQuality']) != 0 ? $results['results']['overallQuality'] : "N/A";
			}else {
				return "N/A";
			}
		}else{
			return "N/A";
		}
	}else{
		return "N/A";
	}
}

function lnamefname2fnamelname($string){
	$split = explode(', ', $string);
	return $split[1].' '.$split[0];
}

function previewArray($array){
	echo "<pre>"; var_dump($array); echo "</pre>";
}

?>
