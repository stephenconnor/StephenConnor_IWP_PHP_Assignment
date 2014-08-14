<?php

/*---------------------------------------------
Program		: Joureny Planner Session Class
Written By	: Stephen Connor	
Date		: 09/01/2014
Decription	:
Version 	: V01
---------------------------------------------*/
session_start();

include 'JourneyPlannerDB_v09.class.php';
include 'JourneyPlannerSession.class.php';


//checks that session variables are not set, redirects to html form if not set. 
if (! isset($_POST['travelDirection'])) {
	header( "refresh:5; journey_planner_form_v08.html" ); 
  	echo 'Journey Planner travel direction not set, you\'ll be redirected in about 5 secs. If redirection fails, click <a href="journey_planner_form_v08.html">here</a>.';
    exit;
	}
if (! isset($_POST['startTime'])) {
	header( "refresh:5; journey_planner_form_v08.html" ); 
 	echo 'Journey Planner starting time not set, you\'ll be redirected in about 5 secs. If redirection fails, click <a href="journey_planner_form_v08.html">here</a>.';
    exit;
	}
if (! isset($_POST['endTime'])) {
	header( "refresh:5; journey_planner_form_v08.html" ); 
 	echo 'Journey Planner end time not set, you\'ll be redirected in about 5 secs. If redirection fails, click <a href="journey_planner_form_v08.html">here</a>.';
    exit;
	}

// assigns seesion variable to new variable names
$userTravelDirection = $_POST['travelDirection'];	
$userStartTime = $_POST['startTime'];
$userEndTime = $_POST['endTime'];



// creates new JourneyPlannerSession object and feeds session variable into the objects' variables
$sessJounrneyPlanner = new JourneyPlannerSession();
$sessJounrneyPlanner->setTravelDirection($userTravelDirection);
$sessJounrneyPlanner->setStartTime($userStartTime);
$sessJounrneyPlanner->setEndTime($userEndTime);


// creates new connection to JourneyPlannerDB database and passes JourneyPlannerSession variables into the mysql query.
// executes mysql query and retrieves data if avaialbe from result from the mysql query
$dbJourneyPlanner = new JourneyPlannerDB('localhost', 'root', '', 'timetables');
$dbJourneyPlanner->setJourneyDirection($sessJounrneyPlanner->getTravelDirection());
$dbJourneyPlanner->setBeginTime($sessJounrneyPlanner->getStartTime());
$dbJourneyPlanner->setFinishTime($sessJounrneyPlanner->getEndTime());
$dbJourneyPlanner->retrieveJourneyData();



// File Paths:
// http://localhost/_Dev/IWP_Assignment/journey_planner_form_v08.html 
// http://localhost/_Dev/IWP_Assignment/JourneyPlannerSession.class.php 
// http://localhost/_Dev/IWP_Assignment/JourneyPlannerController.php

?>