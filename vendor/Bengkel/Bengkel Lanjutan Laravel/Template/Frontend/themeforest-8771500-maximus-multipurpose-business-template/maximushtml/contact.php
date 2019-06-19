<?php 

	/* ==========================  Define variables ========================== */

	#Your e-mail address
	define("__TO__", "email@example.com");

	#Message subject
	define("__SUBJECT__", "examples.com = From:");

	#Success message
	define('__SUCCESS_MESSAGE__', "Your message has been sent. Thank you!");

	#Error message 
	define('__ERROR_MESSAGE__', "Error, your message hasn't been sent");

	#Messege when one or more fields are empty
	define('__MESSAGE_EMPTY_FILDS__', "Please fill out  all fields");

	/* ========================  End Define variables ======================== */

	//Send mail function
	function send_mail($to,$subject,$message,$headers){
		if(@mail($to,$subject,$message,$headers)){
			//echo json_encode(array('info' => 'success', 'msg' => __SUCCESS_MESSAGE__));
			header("Location: message_success.html");
		} else {
			//echo json_encode(array('info' => 'error', 'msg' => __ERROR_MESSAGE__));
			header("Location: message_unsuccess.html");
		}
	}

	//Check e-mail validation
	function check_email($email){
		if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
			return false;
		} else {
			return true;
		}
	}

	//Get post data
	if(isset($_POST['name']) and isset($_POST['e-mail']) and isset($_POST['themeple_content'])){
		$name 	 = $_POST['name'];
		$mail 	 = $_POST['e-mail'];
		$website  = $_POST['subject'];
		$comment = $_POST['themeple_content'];

		if($name == '') {
			header("Location: message_unsuccess_name.html");
			exit();
		} else if($mail == '' or check_email($mail) == false){
			header("Location: message_unsuccess_mail.html");
			exit();
		} else if($comment == ''){
			header("Location: message_unsuccess_message.html");
			exit();
		} else {
			//Send Mail
			$to = __TO__;
			$subject = __SUBJECT__ . ' ' . $name;
			$message = '
			<html>
			<head>
			  <title>Mail from '. $name .'</title>
			</head>
			<body>
			  <table style="width: 500px; font-family: arial; font-size: 14px;" border="0">
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Name:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $name .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $mail .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Subject:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $website .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Content:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $comment .'</td>
				</tr>
			  </table>
			</body>
			</html>
			';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'From: ' . $mail . "\r\n";

			send_mail($to,$subject,$message,$headers);
		}
	} else {
		//echo json_encode(array('info' => 'error', 'msg' => __MESSAGE_EMPTY_FILDS__));
		header("Location: message_unsuccess.html");
	}
 ?>