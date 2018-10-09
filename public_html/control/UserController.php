<?php
class UserController{
  private $conn;
  function __construct(){
    require_once('../database.php');
    $this->conn = $pdo;
  }
  //==========| SIGN IN |==========
  public function signin($username, $password){
    return $this->getUserInfo($username);
  }
  private function getUserInfo($info){
    $db = $this->conn;
    $stmt = $db->prepare("SELECT USER_ID, USERNAME, EMAIL, PASSWORD, SALT, FNAME, LNAME FROM USERS WHERE USER_ID = :INFO OR LOWER(USERNAME) = LOWER(:INFO) OR LOWER(EMAIL) = LOWER(:INFO)");
    $stmt->bindParam(':INFO', $info);
    if($stmt->execute()){
				return $stmt->fetch(PDO::FETCH_ASSOC);
			}else{
				return false;
      }
  }
  //==========| REGISTER |==========
  public function register($firstname, $lastname, $email, $username, $password, $password2){
    $userID = $this->insertUser($firstname, $lastname, $email, $username, $password);
    echo $userID;
    //return $this->getUserInfo($userID);
  }
  private function insertUser($firstname, $lastname, $email, $username, $password){
    $db = $this->conn;
    $salt = $this->generateSalt();
    $hashedPass = $this->hashPassword($password, $salt);
    $firstname = ucfirst($firstname);
    $lastname = ucfirst($lastname);
    $stmt = $db->prepare("INSERT INTO USERS (FNAME, LNAME, EMAIL, USERNAME, PASS, SALT) VALUES (:FNAME, :LNAME, :EMAIL, :USERNAME :PASS, :SALT)");
    $stmt->bindParam(':FNAME', $firstname);
		$stmt->bindParam(':LNAME', $lastname);
		$stmt->bindParam(':EMAIL', $email);
		$stmt->bindParam(':USERNAME', $username);
		$stmt->bindParam(':PASS', $hashedPass);
		$stmt->bindParam(':SALT', $salt);
    if($stmt->execute()){
			return $db->lastInsertId();
		}else{
			return false;
		}
  }
  //==========|  |==========
	private function generateSalt(){
		$values = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		$salt = null;
		for($i=0;$i<32;$i++){
			$salt = $salt . $values[rand(0, 61)];
		}
		return $salt;
	}
  //==========|  |==========
	private function hashPassword($password, $salt){
		return hash('sha256', $salt . $password);
	}
  //==========| EXTRA |==========
  private function previewArray($array){
  	echo "<pre>"; var_dump($array); echo "</pre>";
  }
}
?>
