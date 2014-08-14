	<?php

/*---------------------------------------------
Program		: Journey Planner DB Class
Written By	: Stephen Connor	
Date		: 09/01/2014
Decription	:	
Version 	: v09
---------------------------------------------*/

Class JourneyPlannerDB {

	protected $query;
	protected $result;	

	
	public function __construct($host, $username, $password, $dbname) {

		//establishes the connection
		$this->myConnection = mysqli_connect($host, $username, $password, $dbname);	
	}


	private $localTravelParameter;

	// sets $local$localTravelParameter = $userTravelParameter, variable value applied when called from JourneyPlannerController.php
	public function setJourneyDirection($userTravelParameter) {
		$this->localTravelParameter = $userTravelParameter;
	}

	// retrieves varaiable value
	public function getJourneyDirection() {
		return $this->localTravelParameter;
	}



	private $localTimeParameter1;

	// sets $localTimeParameter1 = $userTimeParameter1, variable value applied when called from JourneyPlannerController.php
	public function setBeginTime($userTimeParameter1) {
		$this->localTimeParameter1 = $userTimeParameter1;
	}

	// retrieves varaiable value
	public function getBeginTime() {
		return $this->localTimeParameter1;
	}



	private $localTimeParameter2;

	// sets $localTimeParameter2 = $userTimeParameter2, variable value applied when called from JourneyPlannerController.php
	public function setFinishTime($userTimeParameter2) {
		$this->localTimeParameter2 = $userTimeParameter2;
	}

	// retrieves varaiable value
	public function getFinishTime() {
		return $this->localTimeParameter2;
	}



	public function  retrieveJourneyData() {

		//main code block retrieve relevant data on DB


		//creates query to retrieve Northbound departure times from timetable_n_v01
		//creates query to retrieve Southbound departure times from timetable_s_v01 table.
		if ($this->localTravelParameter =='N'){
			$query = "SELECT Depart, Arrive FROM timetable_n_v01 WHERE Depart >= '".$this->localTimeParameter1."' AND Depart <= '".$this->localTimeParameter2."' ";
		}
		else if ($this->localTravelParameter =='S'){
			$query = "SELECT Depart, Arrive FROM timetable_s_v01 WHERE Depart >= '".$this->localTimeParameter1."' AND Depart <= '".$this->localTimeParameter2."' ";
		}		


		//executes the query
		$result = $this->myConnection->query($query);

		// redirects (with on screen message) if qeury return no results
		if ($row = mysqli_fetch_array($result) == null ) { 
					header( "refresh:8; journey_planner_form_v08.html" ); 
		  			echo 'No train service between '.$this->localTimeParameter1.' and '.$this->localTimeParameter2.', please reselect journey parmeters. You\'ll be redirected in 8 secs. If redirection fails, click <a href="journey_planner_form_v08.html">here</a>.';                
					}
			
			
		//executes the query
		$result2 = $this->myConnection->query($query);

		
		//displays query results in html table format. HTML table foramted using inline CSS code
		while ($row = mysqli_fetch_array($result2)) { 
					echo "<table border='2'  cellpadding='10' font-size='14px' bgcolor='#EEEEEE' align='center' >"; 
					echo "<th>Depart</th><th>Arrive</th>";
					echo"<tr><td>".$row['Depart']."</td><td>".$row['Arrive']."</td></tr>";}
					
					echo "</table>";
		
			
	}
	
}	


//Below block tests code before use in controller file
/*$dbJourneyPlanner = new JourneyPlannerDB('localhost', 'root', '', 'timetables');
$dbJourneyPlanner->setJourneyDirection('S');
echo $dbJourneyPlanner->getJourneyDirection(). "<br>";
$dbJourneyPlanner->setBeginTime('08:00:00');
echo $dbJourneyPlanner->getBeginTime()."<br>";
$dbJourneyPlanner->setFinishTime('11:30:00');
echo $dbJourneyPlanner->getFinishTime(). "<br>";
$dbJourneyPlanner->retrieveJourneyData();*/


// file paths:
// http://localhost/_Dev/IWP_Assignment/JourneyPlannerDB_v09.class.php
// http://localhost/_Dev/IWP_Assignment/journey_planner_form_v08.html 	



?>