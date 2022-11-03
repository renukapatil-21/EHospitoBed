<?php
    require "connection.php";
    session_start();
    $req_id = $_POST['req_id'];
    $sql = "select hospt_id, category, patient_email, req_date from request_bed where req_index = ". $req_id ."";
    $result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output data of each row
		$row = $result->fetch_assoc();
        $hospt_id = $row['hospt_id'];
        $category = $row['category'];
        $patient_email = $row['patient_email'];
        $req_date = $row['req_date'];
        $sql = "select gen_bed, spec_bed, hospt_name from hospital where hospt_id = ". $hospt_id ."";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
		    // output data of each row
		    $row = $result->fetch_assoc();
            $gen_bed = $row['gen_bed'];
            $spec_bed = $row['spec_bed'];
            $hospt_name = $row['hospt_name'];
            if($category == "gen") {
                if($gen_bed < 1) {
                    $_SESSION['accept'] = "false";
                }
            } else {
                if($spec_bed < 1) {
                    $_SESSION['accept'] = "false";
                }
            }
        } else {
        }   
        if($_SESSION['accept'] == "true") { 
            $sql = "update request_bed set status = 'approved' where req_index = ".$req_id."";
            if ($conn->query($sql) === TRUE) {
                if($category == "gen") {
                    $sql = "update hospital set gen_bed = gen_bed - 1 where hospt_id = ". $hospt_id ."";
                    $conn->query($sql);
                } else {
                    $sql = "update hospital set spec_bed = spec_bed - 1 where hospt_id = ". $hospt_id ."";
                    $conn->query($sql);
                }
    //             require 'phpmailer/PHPMailerAutoload.php';
    //     $mail= new PHPMailer(); // defaults to using php "mail()"
    // $mail->IsSMTP();
    // $mail->Host = "smtp.gmail.com";
    // $mail->SMTPAuth = true;
    // $mail->SMTPSecure = 'ssl';
    // $mail->Port = 465;
    // $mail->Username = 'aniketbhise251@gmail.com';
    // $mail->Password = 'aniket@12';
    // $mail->From = 'aniketbhise251@gmail.com';
    // $mail->FromName = 'HospitoBed';
    // $address = $patient_email;
    // $mail->AddAddress($address);
    // $mail->Subject    = "Bed request accepted,HospitoBed";
    // $mail->Body    = '<!DOCTYPE html > 
    // <head></head>
    // <body>
    // <h1>Your bed has been reserved at '. $hospt_name .'</h1>
    // <p>Category : '. $category .'</p>
    // <p>Request Date : '. $req_date .'</p>
    // <p>Thank You</p>
    // </body>';
    // $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 
    // $mail->isHTML(true);      // attachment
    // if(!$mail->Send()) 
    //    {
    //     $_SESSION['accept'] = "mail not sent, ". $mail->ErrorInfo;
    //    } 
    // else{
    //     $_SESSION['accept'] = "mail sent";
    // }
    $_SESSION['accept'] = "mail sent";  
            } else {
                
            }
        }
	} else {
		
	}
?>