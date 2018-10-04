<?php
class resultsView{
  public function view($results){
    //$this->previewArray($results);
    echo "
    <div class='container'>
    	<hr class='my-2'>
    	<div class='row justify-content-center'>
    		<div class='col-12'>
    ";
    foreach ($results as $grade => $courses){//Splits by Grade
      if(sizeof($courses) > 0){
        $this->gradeAccordion($grade, $courses);
      }
    }
    echo '</div></div></div>';
  }

  //==========| Create Accordion Levels |==========
  private function gradeAccordion($gradeLevel, $courses){
    $accordion = $gradeLevel.'Accordion';
    $content = $gradeLevel.'Content';
    echo "
    <div class='card mb-3' id='$accordion'><!-- $accordion -->
      <div class='card-header h4 font-weight-normal' style='cursor:pointer;' data-toggle='collapse' data-target='#$content' aria-expanded='true' aria-controls='$content'>$gradeLevel<span class='float-right oi oi-chevron-bottom'></span></div>
      <div class='card-body pt-2 pb-0 px-2 collapse show' id='$content' data-parent='#$accordion'><!--- $accordion -->";
      foreach ($courses as $courses2){//Does something. IDK and IDC.
        foreach ($courses2 as $courseID => $instructors){//Splits by Course ID
          $this->courseAccordion($courseID, $instructors);
        }
      }
    echo  "</div><!--- [END] - $content -->
    </div><!-- [END] - $accordion -->
    ";
  }
  private function courseAccordion($courseID, $instructors){
    $titleInfo = explode(' - ',$courseID);
    $course = $titleInfo[0];
    $title = $titleInfo[1];
    $credits = $titleInfo[2];
    $accordion = $course.'Accordion';
    $content = $course.'Content';
    echo "
    <div class='card mb-2' id='$accordion'><!-- $accordion -->
      <div class='card-header h5 font-weight-normal' style='cursor:pointer;' data-toggle='collapse' data-target='#$content' aria-expanded='false' aria-controls='$content'>$course&nbsp;<span class='d-none d-md-inline-block'>-&nbsp;$title&nbsp;</span>-&nbsp;$credits<span class='float-right oi oi-chevron-top'></span></div>
      <div class='card-body p-2 collapse' id='$content' data-parent='#$content'><!-- $accordion -->
			<span class='d-sm-block d-md-none'>$title</span>";
      foreach ($instructors as $instructorName => $courseInfo){//Splits by Instructor
        $this->instructorAccordion($instructorName, $courseInfo);
      }
      echo "</div><!-- [END] - $content -->
    </div><!-- [END] - $accordion -->
    ";
  }
  private function instructorAccordion($instructor, $courseInfo){
    $rmpRating = $this->getRMPRating($instructor);
    $nameNoSpaces = preg_replace('/\s+/', '', $instructor);
    $accordion = $nameNoSpaces.'Accordion';
    $content = $nameNoSpaces.'Content';
    echo "
    <div class='card mb-2' id='$accordion'><!-- $accordion -->
      <div class='card-header p font-weight-normal' style='cursor:pointer;' data-toggle='collapse' data-target='#$content' aria-expanded='true' aria-controls='$content'>$instructor".($rmpRating != 'N/A' ? " - RMP: $rmpRating/5.0" : "") ."<span class='float-right oi oi-chevron-bottom'></span></div>
      <div class='card-body p-2 collapse show' id='$content' data-parent='#$accordion'><!-- $content -->";
      $this->courseInfoTable($courseInfo);
      $this->courseInfoCards($courseInfo);
      echo "</div><!-- [END] - $content -->
    </div><!-- [END] - $accordion -->
    ";
  }
  private function courseInfoTable($courseInfo){
    echo "
      <table class='d-none d-md-table text-center mb-0 table table-bordered'><!-- View on PCs & Tablets -->
        <thead>
          <tr>
            <th width='1'><span class='oi oi-star'></span></th>
            <th>Status</th>
            <th>CRN</th>
            <th>Day(s)</th>
            <th>Time</th>
            <th>Start Day</th>
            <th>End Day</th>
          </tr>
        </thead>
        <tbody>";
        foreach ($courseInfo as $course){
          $userID = $_SESSION['ID'];
					$courseID = $course['COURSE_ID'];
          $status = $course['STATUS'];
          $crn = $course['CRN'];
          $days = $course['DAYS'];
          $time = $course['TIME'];
          $startDate = $course['ST_DATE'];
          $endDate = $course['END_DATE'];
          echo "<tr>
            <td width='1'><span class='addToCart oi oi-star' onclick='addToCart($userID, $courseID)'></span></td>
            <td>$status</td>
            <td>$crn</td>
            <td>$days</td>
            <td>$time</td>
            <td>$startDate</td>
            <td>$endDate</td>
          </tr>";
        }
        echo "</tbody>
      </table><!-- [END] - View on PCs & Tablets -->
    ";
  }
  private function courseInfoCards($courseInfo){
    echo "<div class='d-sm-block d-md-none'><!-- View on Phones -->";
    foreach ($courseInfo as $course){
      $status = $course['STATUS'];
      $crn = $course['CRN'];
      $days = $course['DAYS'];
      $time = $course['TIME'];
      $startDate = $course['ST_DATE'];
      $endDate = $course['END_DATE'];
      echo "<div class='card mb-2'><!-- CRN$crn -->
        <div class='card-body'>
          <h5 class='card-title'>CRN: $crn<span class='addToCart float-right oi oi-star' onclick='addToCart($userID, $courseID)'></span></h5>
          <h6 class='card-subtitle mb-2'>Status: $status</h6>
          <ul>
            <li>Day(s): $days</li>
            <li>Time: $time</li>
            <li>Start Date: $startDate</li>
            <li>End Date: $endDate</li>
          </ul>
        </div>
      </div><!-- [END] - CRN$crn -->";
    }
    echo "</div><!-- [END] - View on Phones -->";
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
  //==========| Extra |==========
  private function previewArray($array){
  	echo "<pre>"; var_dump($array); echo "</pre>";
  }
}
?>
