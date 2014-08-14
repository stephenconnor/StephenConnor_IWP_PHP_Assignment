<?php

/*---------------------------------------------
Program		: Joureny Planner Session Class
Written By	: Stephen Connor	
Date		: 09/01/2014
Decription	:
Version 	: V01
---------------------------------------------*/

// JourneyPlannerSession Class required to pass $_Session variables to and from JourneyPlanner controller so as to avoid 
// session_start() being called multiple times causing conflicts
Class JourneyPlannerSession {
	

	private $localTravelDirection;

	// sets $localTravelDirection = $newTravelDirection, variable value applied when called from JourneyPlannerController.php
	public function setTravelDirection($newTravelDirection) {
	
		$this->localTravelDirection = $newTravelDirection;
	}

	// retrieves varaiable value
	public function getTravelDirection() {
		
		return $this->localTravelDirection;
	}



	private $localStartTime;

	// sets $localStartTime = $newStartTime, variable value applied when called from JourneyPlannerController.php
	public function setStartTime($newStartTime) {
	
		$this->localStartTime = $newStartTime;

	}

	// retrieves varaiable value
	public function getStartTime() {
		
		return $this->localStartTime;
	}



	private $localEndTime;

	// sets $localEndTime = $newEndTime, variable value applied when called from JourneyPlannerController.php
	public function setEndTime($newEndTime) {
	
		$this->localEndTime = $newEndTime;
	}

	// retrieves varaiable value
	public function getEndTime() {
		
		return $this->localEndTime;
	}
	

}


//Below block tests code before use in controller file
/*$sessJounrneyPlanner = new JourneyPlannerSession();
$sessJounrneyPlanner->setTravelDirection('S');
echo $sessJounrneyPlanner->getTravelDirection(). "<br>";
$sessJounrneyPlanner->setStartTime('08:00:00');
echo $sessJounrneyPlanner->getStartTime()."<br>";
$sessJounrneyPlanner->setEndTime('11:30:00');
echo $sessJounrneyPlanner->getEndTime(). "<br>";*/


// File paths for relevant files
// http://localhost/_Dev/IWP_Assignment/journey_planner_form_v07.html 
// http://localhost/_Dev/IWP_Assignment/JourneyPlannerSession.class.php 

?>