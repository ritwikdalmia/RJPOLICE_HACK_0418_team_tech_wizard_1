<?php
session_start();


$connect = new PDO("mysql:host=localhost;dbname=smilewellnessfoundation", "smilesnheal", "smilewellnessfoundation");

if(isset($_POST["rating_data"]))
{
        $police_station_id = $_POST['police_station_id'];


	$data = array(
	
		':user_rating'		=>	$_POST["rating_data"],
		':feedback'		=>	$_POST["feedback"]
		
	);


}
if(isset($_POST["action"]))
{
    $police_station_id = $_POST['police_station_id'];
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "
SELECT *
FROM application_request
INNER JOIN police_station_list ON application_request.police_station = police_station_list.police_email_id
WHERE application_request.feedback_permission = 1
  AND police_station_list.police_station_id IS NOT NULL  -- Ensure police_station_id is not empty
  AND (police_station_list.police_station_id = '$police_station_id' OR '$police_station_id' = '')  -- Include cases where police_station_id is not provided
ORDER BY application_request.complaint_id DESC";

	$result = $connect->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			
			'feedback'	=>	$row["feedback"],
			'rating'		=>	$row["user_rating"]
			
		);

		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>