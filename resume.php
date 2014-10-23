<?php
include 'passwords.php';
class Resume
{
  public $jobs = array();
  public $skills = array();
  public $accomplishments = array();
  public $jobskills = array();
  public $reccomendations = array();
}

function GetJobs($con)
{
  $jobs_arr = array();
  $sql = 'select * from barnesni_resume.jobs order by EndYear desc, StartYear desc';
  $fetch = mysql_query($sql, $con);
  if(!$fetch){
    // means your query failed
    // error checking...
     echo 'Invalid query: ' . mysql_error($con) . '<br>';
  }
  while ($row = mysql_fetch_array($fetch)) {
      $row_array['id'] = $row['idjobs'];
      $row_array['title'] = $row['title'];
      $row_array['company'] = $row['company'];
      $row_array['description'] = $row['description'];
      $row_array['startyear'] = $row['startyear'];
      $row_array['endyear'] = $row['endyear'];
      $row_array['startup'] = $row['startup'];
      array_push($jobs_arr,$row_array);
  }
  return $jobs_arr;
}
function GetSkills($con)
{
  $skills_arr = array();
  $row_array = array();
  $sql = 'select * from barnesni_resume.skills';
  $fetch = mysql_query($sql, $con);
  if(!$fetch){
    // means your query failed
    // error checking...
     echo 'Invalid query: ' . mysql_error($con) . '<br>';
  }
  while ($row = mysql_fetch_array($fetch)) {
      $row_array['id'] = $row['idskills'];
      $row_array['name'] = $row['name'];
      $row_array['description'] = $row['description'];

      array_push($skills_arr,$row_array);
  }
  return $skills_arr;
}
function GetJobSkills($con)
{
  $jobSkills_arr = array();
  $row_array = array();
  $sql = 'select * from barnesni_resume.skills_jobs_r';
  $fetch = mysql_query($sql, $con);
  if(!$fetch){
    // means your query failed
    // error checking...
     echo 'Invalid query: ' . mysql_error($con) . '<br>';
  }
  while ($row = mysql_fetch_array($fetch)) {
      $row_array['idjob'] = $row['idjob'];
      $row_array['idskill'] = $row['idskill'];
      $row_array['description'] = $row['description'];

      array_push($jobSkills_arr,$row_array);
  }
  return $jobSkills_arr;
}

function GetReccomendations($con)
{
  $reccomendations_arr = array();
  $row_array = array();
  $sql = 'select * from barnesni_resume.reccomendations';
  $fetch = mysql_query($sql, $con);
  if(!$fetch){
    // means your query failed
    // error checking...
     echo 'Invalid query: ' . mysql_error($con) . '<br>';
  }
  while ($row = mysql_fetch_array($fetch)) {
      $row_array['id'] = $row['idreccomendations'];
      $row_array['idjob'] = $row['idjob'];
      $row_array['text'] = $row['text'];

      array_push($reccomendations_arr,$row_array);
  }
  return $reccomendations_arr;
}

function GetAccomplishments($con)
{
  $accomplishments_arr = array();
  $row_array = array();
  $sql = 'select * from barnesni_resume.accomplishments order by sweetness desc';
  $fetch = mysql_query($sql, $con);
  if(!$fetch){
    // means your query failed
    // error checking...
     echo 'Invalid query: ' . mysql_error($con) . '<br>';
  }
  while ($row = mysql_fetch_array($fetch)) {
      $row_array['id'] = $row['idaccomplishments'];
      $row_array['name'] = $row['name'];
      $row_array['description'] = $row['description'];
      $row_array['idjob'] = $row['idjob'];
      $row_array['type'] = $row['type'];

      array_push($accomplishments_arr,$row_array);
  }
  return $accomplishments_arr;
}

// Create connection
$con=mysql_connect("localhost",$db_name,$db_pass,"barnesni_resume");
// Check connection
if (!$con) { die('Connect Error (' . mysql_connect_errno() . ') ' . mysql_connect_error()); }
//echo 'Connected... ' . mysql_get_host_info($con) . "<br>";

$resume = new Resume();

$resume->jobs = GetJobs($con);
$resume->skills = GetSkills($con);
$resume->accomplishments = GetAccomplishments($con);
$resume->jobskills = GetJobSkills($con);
$resume->reccomendations = GetReccomendations($con);

echo json_encode($resume);
?>