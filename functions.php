<?php
$phoneBook = json_decode(file_get_contents('phonebook.json'));

Function addContact($a, $b, $mail, $bio){
	global $phoneBook; 
	$success = true;
	$contact = [$a, $b, $mail, $bio];
	array_push($phoneBook, $contact);
	$response = [
		"success"=>$success,
		"message" => ["Contact succesfully added"],
		"results"=>[],
	];
	return $response;
}

function viewContact(){
	global $phoneBook;
	$success = true;
	$response = [
		"success"=>$success,
		"results"=>$phoneBook,
		"message"=>["Found ".count($phoneBook)." result(s)"],
	];
	return $response;
}

function deleteContact($d){
	global $phoneBook;
	array_splice($phoneBook, $d, 1);
}

function deleteAll(){
	global $phoneBook;
	$phoneBook = [];
	$success = true;
	file_put_contents('phonebook.json',json_encode($phoneBook));
	$response = [
		"success"=>$success,
		"results"=>[],
		"message"=>'PhoneBook has been succesfully erased',
	];
return $response;	
}

function searchContact($n){
	global $phoneBook;
	$success = true;
	$contactIndexarray=[];
	$i=0;
	foreach($phoneBook as $contact){
		if(in_array($n, $contact, TRUE)){
			$temp = [$i];
			foreach($phoneBook[$i] as $item){
				$temp[] = $item;
			}
			array_push($contactIndexarray, $temp);
		}
		$i++;
		$response = [
			"success"=>$success,
			"results"=>$contactIndexarray,
			"message"=>["Found ".count($contactIndexarray)." result(s)"],
		];
		return $response;
	}}
	function savePhonebook(){
		global $phoneBook;
		file_put_contents('phonebook.json',json_encode($phoneBook));
	}
function editContact($id, $newName='', $Phone, $mail='', $bio=''){
	global $phoneBook;
	$contact = $phoneBook[$id];
	$success = true;
	if($newName==''){
		$newName = $contact[0];
	if($Phone==''){
		$newPhone = $contact[1];
	}
	if($mail==''){
		$mail = $contact[2];
	}
	if($bio==''){
		$bio = $contact[3];
	}
	$phoneBook[$id] = [$newName, $Phone, $mail, $bio];
	$response = [
		"success"=>$success,
		"results"=>$phoneBook[$id],
		"message"=>['Contact Updated']
	];
	return $response;
}
	}
?>
