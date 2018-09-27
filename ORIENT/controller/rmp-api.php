<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//=====| THE BUSINESS END |=====
$university = isset($_REQUEST['university']) ? $_REQUEST['university'] : null;
$professor = isset($_REQUEST['professor']) ? $_REQUEST['professor'] : null;
if(!is_null($university) && is_null($professor)){
  getUniversity($university);
}elseif(is_null($university) && !is_null($professor)){
  getProfessor($professor);
}elseif(!is_null($university) && !is_null($professor)){
  getProfessorRating($university, $professor);
}else{
  http_response_code(400);
}
//=====| FUNCTIONS |=====
function getUniversity($university){//Gets University listings
  $source = getWebPage("http://www.ratemyprofessors.com/search.jsp?queryBy=schoolName&query=".urlencode(strtolower($university)));
  $regex = '/<li class="listing SCHOOL">.*?<a href="(.*?)".*?<span class="main">(.*?)<.*?<span class="sub">(.*?)<.*?<\/li>/ms';
  $listings = parseWebPage($regex, $source);
  $newListings = createUniverityListingArray($listings);
  displayJSON($newListings);
}
function getProfessor($professor){//Gets Professor listings
  $source = getWebPage("http://www.ratemyprofessors.com/search.jsp?queryBy=teacherName&query=".urlencode(strtolower($professor)));
  $regex = '/<li class="listing PROFESSOR">.*?<a href="(.*?)".*?<span class="main">(.*?)<.*?<span class="sub">(.*?)<.*?<\/li>/ms';
  $listings = parseWebPage($regex, $source);
  $newListings = createProfessorListingArray($listings);
  displayJSON($newListings);
}
function getProfessorRating($university, $professor){//Gets Professor Rating
  //Get Professors
  $source = getWebPage("http://www.ratemyprofessors.com/search.jsp?queryBy=teacherName&query=".urlencode(strtolower($professor)));
  $regex = '/<li class="listing PROFESSOR">.*?<a href="(.*?)".*?<span class="main">(.*?)<.*?<span class="sub">(.*?)<.*?<\/li>/ms';
  $listings = parseWebPage($regex, $source);
  $newListings = createProfessorListingArray($listings);
  $matchID;
  if($newListings['status'] == true){
    foreach ($newListings['results'] as $newListingID => $newListing){
      $nameArray = explode(', ', $newListing['name']);
      $name = trim($nameArray[1]).' '.trim($nameArray[0]);
      $location = explode(',', $newListing['location'])[0];
      if((urldecode(strtolower($university)) == strtolower($location)) && (urldecode(strtolower($professor)) == strtolower($name))){
        $matchID = $newListingID;
        break;
      }
    }
    $matchedArray = $newListings['results'][$matchID];
    $nameArray = explode(', ', $matchedArray['name']);
    $name = trim($nameArray[1]).' '.trim($nameArray[0]);
    $locationArray = explode(',', $newListing['location']);
    $location = trim($locationArray[0]);
    $department = trim($locationArray[1]);
    $professorRatingURL = "http://www.ratemyprofessors.com".$matchedArray['url'];
    $professorRatingSource = getWebPage($professorRatingURL);
    $prRegex = '/Overall Quality.*?class="grade".*?>(.*?)<.*?Would Take Again.*?class="grade".*?>(.*?)<.*? Level of Difficulty.*?class="grade.*?>(.*?)<\/div>/ms';
    $prListings = parseWebPage($prRegex, $professorRatingSource)[0];
    $prArray = ['url'=>$matchedArray['url'], 'name'=>$name, 'university'=>$location, 'department'=>$department, 'overallQuality'=>trim($prListings[1]), 'wouldTakeAlong'=>trim($prListings[2]), 'difficulty'=>trim($prListings[3])];
    $displayRating = createProfessorRatingArray($prArray);
    displayJSON($displayRating);
  }else{
    displayJSON(['status'=>false]);
  }
}
//-----||-----
function createUniverityListingArray($listings){//Creates array for University listing that will displayed as JSON
  $newListings = ['status'=>true, 'results'=>[]];
  if(sizeof($listings) > 0){
    foreach($listings as $listing){
      $temp = ['url'=>$listing[1], 'name'=>$listing[2], 'location'=>$listing[3]];
      array_push($newListings['results'], $temp);
    }
    return $newListings;
  }else {
    return ['status'=>false];
  }
}
function createProfessorListingArray($listings){//Creates array for Professor listing that will displayed as JSON
  $newListings = ['status'=>true, 'results'=>[]];
  if(sizeof($listings) > 0){
    foreach($listings as $listing){
      $temp = ['url'=>$listing[1], 'name'=>$listing[2], 'location'=>$listing[3]];
      array_push($newListings['results'], $temp);
    }
    return $newListings;
  }else {
    return ['status'=>false];
  }
}
function createProfessorRatingArray($prArray){//Creates array for Professor Rating array that will displayed as JSON
  return ['status'=>true, 'results'=>$prArray];
}
//-----||-----
/*function getWebPage($url){//Gets web code
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  $output = curl_exec($curl);
  curl_close($curl);
  return $output;
}*/
function getWebPage($url){//Gets web code
  return file_get_contents($url);
}
function parseWebPage($regex, $source){//Parses web page
  preg_match_all($regex, $source, $matches, PREG_SET_ORDER, 0);
  return $matches;
}
function displayJSON($array){//Displays JSON
  header('Content-Type: application/json');
  echo json_encode($array, JSON_PRETTY_PRINT);
}
function displayArray($array){//Previews a readable array
  echo "<pre>"; var_dump($array); echo "</pre>";
}
?>
