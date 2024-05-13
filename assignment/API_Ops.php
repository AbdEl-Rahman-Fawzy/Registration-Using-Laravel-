<html>
   <form method="get">
    <input type="date" name='birthday'>
    <input type="submit" >
</form>
   </form> 
<html>


<?php

//get day and month from birthday
$datestring = $_REQUEST['birthday'];
$date = strtotime($datestring);
$day = date('d', $date);
$month = date('m', $date);

// Output the day and month
echo "Day: $day, Month: $month <br>";


$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://imdb8.p.rapidapi.com/actors/v2/get-born-today?today=".$month."-".$day."&first=5",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: imdb8.p.rapidapi.com",
		"X-RapidAPI-Key: 057e6f9d7bmsh6cf67b350e2a9fep13a56ejsna24625f6a59b"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {

    $responseData = json_decode($response, true);

if (isset($responseData['data']['bornToday']['edges'])) {
    $actors = $responseData['data']['bornToday']['edges'];
    
    foreach ($actors as $actor) {
        $actorid = $actor['node']['id'];
       
        
        $curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://imdb8.p.rapidapi.com/actors/v2/get-base?nconst=".$actorid,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: imdb8.p.rapidapi.com",
		"X-RapidAPI-Key: 057e6f9d7bmsh6cf67b350e2a9fep13a56ejsna24625f6a59b"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $responsedata = json_decode($response, true);
    echo "Actor id: $actorid<br>";
	echo "Actor name ".$responsedata['data']['name']['nameText']['text']."<br>";
    }}
} else {
    echo "No actors found for today.";
}
}

?>
