<?php


header('Content-Type: application/json');

require_once __DIR__ . '/../lib/Student.php';
$student = new Student();
$result1=$student->getcomplaints();
$result=$student->getStudentMark();
$result2=$student->getfeedback();
$data = array();

require_once __DIR__ . '/../lib/Util.php';
$util = new Util();




$type = "bar";
if (!empty($_GET["chart_type"])) {
    $type = $_GET["chart_type"];
}

switch ($type) {
    case "bar":
        $data = $result;
        break;
    
    
    case "pie":
        $pendingCount = 0;
$ongoingCount = 0;
$resolvedCount = 0;

foreach ($result1 as $verification) {
    $status = $verification["permission"];

    if ($status == 0) {
        $pendingCount++;
    } elseif ($status == 1) {
        $ongoingCount++;
    } elseif ($status == 2) {
        $resolvedCount++;
    }
}

$data = array(
    array("label" => "Pending", "data" => $pendingCount, 'backgroundColor' => '#36a2eb'),
    array("label" => "Ongoing", "data" => $ongoingCount, 'backgroundColor' => '#ff6384'),
    array("label" => "Resolved", "data" => $resolvedCount, 'backgroundColor' => '#4caf50')
);
        break;
        
        case "pie1":
        $pendingCount = 0;
$ongoingCount = 0;
$resolvedCount = 0;

foreach ($result2 as $verification) {
    $status = $verification["feedback_permission"];

    if ($status == 0) {
        $pendingCount++;
    } elseif ($status == 1) {
        $ongoingCount++;
    }
}

$data = array(
    array("label" => "Pending", "data" => $pendingCount, 'backgroundColor' => '#36a2eb'),
    array("label" => "Given", "data" => $ongoingCount, 'backgroundColor' => '#ff6384'),
);
        break;
         case "doughnut":
        $verifiedCount = 0;
        $notVerifiedCount = 0;

        foreach ($result as $verification) {
            if ($verification["verification_status"] == 1) {
                $verifiedCount++;
            } else {
                $notVerifiedCount++;
            }
        }

        $data = array(
            array("label" => "Verified", "data" => $verifiedCount, 'backgroundColor' => '#36a2eb'),
            array("label" => "Not Verified", "data" => $notVerifiedCount, 'backgroundColor' => '#ff6384')
        );
        break;

    case "vertical-bar":
        $verifiedCount = 0;
        $notVerifiedCount = 0;

        foreach ($result as $verification) {
            if ($verification["verification_status"] == 1) {
                $verifiedCount++;
            } else {
                $notVerifiedCount++;
            }
        }

        $data = array(
            array("label" => "Verified", "data" => array($verifiedCount), 'backgroundColor' => '#36a2eb'),
            array("label" => "Not Verified", "data" => array($notVerifiedCount), 'backgroundColor' => '#ff6384')
        );
        break;
}

$data = json_encode($data);
echo str_replace("},", "},\n", $data);
?>