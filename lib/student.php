<?php
$filepath = realpath (dirname(__FILE__));
include_once $filepath.'/database.php';
?>
<?php

 class Student
 {
 	private $db;
 	public function __construct()
 	{
 		$this->db = new Database();
 	}
 	public function getStudents() {
 		$query = "SELECT * FROM tbl_student";
 		$result = $this->db->select($query);
 		return $result;
 	}

 	public function insertPresentData($cur_date, $present= array())
 	{
 		$query = "SELECT DISTINCT attend_time FROM tbl_attendence";
 		$get_data = $this->db->select($query);
 		while ($result = $get_data->fetch_assoc()) {
 			$db_date =$result['attend_time'];
 			if ($cur_date==$db_date) {
 				$msg = "<div class='alert alert-danger'> <strong>Error! </strong> Attendance already taken today </div>";
 				return $msg;
 			}
 		}
 		foreach ($present as $atn_key => $atn_value) {
 			if ($atn_value == "present") {
 				$stu_query = "INSERT INTO tbl_attendence (roll, atten, attend_time) VALUES ('$atn_key', 'present', now())";
 			$stu_insert = $this->db->insert($stu_query);
 			} elseif ($atn_value == "absent") {
 				$stu_query = "INSERT INTO tbl_attendence (roll, atten, attend_time) VALUES ('$atn_key', 'absent', now())";
 			$stu_insert = $this->db->insert($stu_query);
 			}
 		}
 		if ($stu_insert) {
 				$msg = "<div class='alert alert-success'> <strong>Success! </strong> Attendence Data Inserted successfully</div>";
 					return $msg;
 			} else {
 				$msg = "<div class='alert alert-danger'> <strong>Error! </strong>Attendence Data not Inserted.</div>";
 					return $msg;
 			}
 	}
 	public function insertStudentData ($name, $roll)
 	{
 		$name = mysqli_real_escape_string ($this->db->link, $name);
 		$roll = mysqli_real_escape_string ($this->db->link, $roll);
 		if (empty($name) || empty($roll)) {
 			$msg = "<div class='alert alert-danger'> <strong>Error! </strong> Field must not be empty </div>";
 			return $msg;
 		} else{
 			$stu_query = "INSERT INTO tbl_student(name, roll) VALUES ('$name', '$roll')";
 			$stu_insert = $this->db->insert($stu_query);

 			$att_query = "INSERT INTO tbl_attendence (roll) VALUES ('$roll')";
 			$stu_insert = $this->db->insert($att_query);
 			if ($stu_insert) {
 				$msg = "<div class='alert alert-success'> <strong>Success! </strong> Student Data Inserted successfully</div>";
 					return $msg;
 			} else {
 				$msg = "<div class='alert alert-danger'> <strong>Error! </strong>Student Data not Inserted.</div>";
 					return $msg;
 			}
 		}
 	}
 	public function getDatelist()
 	{
 		$query = "SELECT DISTINCT attend_time FROM tbl_attendence";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function getAllData($dt)
 	{
 		$query = "SELECT tbl_student.name, tbl_attendence. *
 		FROM tbl_student
 		INNER JOIN tbl_attendence
 		ON tbl_student.roll = tbl_attendence.roll
 		WHERE attend_time = '$dt' ";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function updatePresentData($dt, $present)
 	{
 		foreach ($present as $atn_key => $atn_value) {
 			if ($atn_value == "present") {
 				$query = "UPDATE tbl_attendence
 				set atten= 'present'
 				WHERE roll= '".$atn_key." ' AND attend_time = '".$dt."'";
 				$stu_update = $this->db->update($query);
 				
 			} elseif ($atn_value == "absent") {
 				$query = "UPDATE tbl_attendence
 				set atten= 'absent'
 				WHERE roll= '".$atn_key." ' AND attend_time = '".$dt."'";
 				$stu_update = $this->db->update($query);
 			}
 		}
 		if ($stu_update) {
 				$msg = "<div class='alert alert-success'> <strong>Success! </strong> Attendence Data updated successfully</div>";
 					return $msg;
 			} else {
 				$msg = "<div class='alert alert-danger'> <strong>Error! </strong>Attendence Data not updated successfully</div>";
 					return $msg;
 			}
 	}
 }
?>