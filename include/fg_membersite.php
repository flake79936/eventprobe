<?PHP
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");

class FGMembersite{
	var $admin_email;
	var $from_address;
	
	var $db_host;    /*host*/
	var $username;   /*From DB*/
	var $pwd;        /*From DB*/
	var $database;   /*EventAdvisors*/
	var $tablename1; /*Registration*/
	var $tablename2; /*Events*/
	var $tablename3; /*MyEvents*/
	var $connection; /**/
	var $rand_key;   /**/

	var $error_message; /**/
    
    /*----(Start) Initialization----*/
    function FGMembersite(){
        $this->sitename = 'jetdevllc.com';
        $this->rand_key = '0iQx5oBk66oVZep';
    }
    
    function InitDB($host, $uname, $pwd, $database, $tablename1, $tablename2, $tablename3){
        $this->db_host    = $host;
        $this->username   = $uname;
        $this->pwd        = $pwd;
        $this->database   = $database;
        $this->tablename1 = $tablename1;   
        $this->tablename2 = $tablename2;   
        $this->tablename3 = $tablename3;  
    }
	
    function SetAdminEmail($email){
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename){
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key){
        $this->rand_key = $key;
    }
    /*----(End) Initialization----*/
	
	
    //----Main Operations-------
	/*----(Start) Registration of User----*/
	function RegisterUser(){
		if(!isset($_POST['submitted'])){
			return false;
		}

		$formvars = array();

		if(!$this->ValidateRegistrationSubmission()){
			return false;
		}
		
		$itemPicture = $this->upLoadUserPic();
		if($itemPicture != false){
			$formvars['Upic'] = $this->upLoadUserPic();
		}
		
		$this->CollectRegistrationSubmission($formvars);
		
		if(!$this->comparePswd($formvars)){
			return false;
		}
		
		if(!$this->SaveToEventAdvDatabase($formvars)){
			return false;
		}

		/*if(!$this->sendConfimMail($formvars)){
			return false;
		}*/

		//$this->SendAdminIntimationEmail($formvars);

		return true;
	}
	
	function ValidateRegistrationSubmission(){
        //This is a hidden input field. Humans won't fill this field.
        if(!empty($_POST[$this->GetSpamTrapInputName()]) ){
            //The proper error is not given intentionally
            $this->HandleError("Automated submission prevention: case 2 failed");
            return false;
        }
        
		$validator = new FormValidator();
		$validator->addValidation("UFname",    "req",   "Please Input Your First Name");
		$validator->addValidation("ULname",    "req",   "Please Input Your Last Name");
		$validator->addValidation("UuserName", "req",   "Please Provide a User Name");
		$validator->addValidation("UPswd",     "req",   "Please Provide a Password");
		$validator->addValidation("ConPswd",   "req",   "Please Confirm Your Password");
		$validator->addValidation("Uemail",    "req",   "Please Please fill in Name");
		$validator->addValidation("Uemail",    "email", "Please Provide a Valid Email: Syntax is Wrong");

        if(!$validator->ValidateForm()){
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err){
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
	
	/*Collections all the values that were submitted:
	 *First, it will sanitize the value for sql injection reasons.
	 *Second, it will store it in the array of '$formvars' to keep track of it.*/
	function CollectRegistrationSubmission(&$formvars){
		
        $formvars['UFname']    = $this->Sanitize($_POST['UFname']);
        $formvars['ULname']    = $this->Sanitize($_POST['ULname']);
		$formvars['UuserName'] = $this->Sanitize($_POST['UuserName']);
        $formvars['UPswd']     = $this->Sanitize($_POST['UPswd']);
        $formvars['ConPswd']   = $this->Sanitize($_POST['ConPswd']);
        $formvars['Uemail']    = $this->Sanitize($_POST['Uemail']);
		$formvars['Uphone']    = $this->Sanitize($_POST['Uphone']);
// 		$formvars['Upic']      = $this->Sanitize($_POST['Upic']);
		
        //$formvars['Uadmin']    = $this->Sanitize($_POST['Uadmin']);
    }
	
	//checks for similar submission inputs in the registration form.
	function comparePswd(&$formvars){
		$pswd1  = $formvars['UPswd'];
		$pswd2  = $formvars['ConPswd'];
		
		if($pswd1 !== $pswd2){
			$this->HandleError("Passwords do not match");
            return false;
		}
        return true;
	}
	
	function SaveToEventAdvDatabase(&$formvars){
        if(!$this->DBLogin()){
            $this->HandleError("Database login failed!");
            return false;
        }
		
        if(!$this->EnsureRegTable()){
            return false;
        }
		
		if(!$this->EnsureMyEventsTable($formvars['UuserName'])){
            return false;
        }
		
        if(!$this->IsFieldUnique($formvars, 'email')){
            $this->HandleError("This email is already registered");
            return false;
        }
        
        if(!$this->IsFieldUnique($formvars, 'username')){
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        }
        
        if(!$this->InsertIntoEventAdvisorDB($formvars)){
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
	
	function DBLogin(){
        $this->connection = mysql_connect($this->db_host, $this->username, $this->pwd);

        if(!$this->connection){   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
		
        if(!mysql_select_db($this->database, $this->connection)){
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
		
        if(!mysql_query("SET NAMES 'UTF8'", $this->connection)){
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }
	
	function EnsureRegTable(){
        $result = mysql_query("SHOW COLUMNS FROM $this->tablename1");   
        if(!$result || mysql_num_rows($result) <= 0){
            return $this->CreateTableReg();
        }
        return true;
    }
	
	function EnsureMyEventsTable($uUserName){
        $uUserName = $this->SanitizeForSQL($uUserName);
        $result = mysql_query("SHOW COLUMNS FROM $uUserName.$this->tablename3;");   
        if(!$result || mysql_num_rows($result) <= 0){
            return $this->CreateTableMyEvents($uUserName);
        }
        return true;
    }
	
	function IsFieldUnique($formvars, $fieldname){
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = "SELECT UuserName from $this->tablename1 where $fieldname='".$field_val."'";
        $result = mysql_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0){
            return false;
        }
        return true;
    }
	
	function InsertIntoEventAdvisorDB(&$formvars){
        //$confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        
        //$formvars['confirmcode'] = $confirmcode;
        
// 		echo 'Password: <br/>';
// 		echo $formvars['UPswd'] . '<br/>';
// 		echo 'Password Hash: <br/>';
// 		echo md5($formvars['UPswd']) . '<br/>';
		
        $insert_query = 'insert into '.$this->tablename1.'(UFname, ULname, Uemail, UuserName, Uphone, UPswd, Upic)
                values(
                "' . $this->SanitizeForSQL($formvars['UFname']) . '",
                "' . $this->SanitizeForSQL($formvars['ULname']) . '",
                "' . $this->SanitizeForSQL($formvars['Uemail']) . '",
                "' . $this->SanitizeForSQL($formvars['UuserName']) . '",
                "' . $this->SanitizeForSQL($formvars['Uphone']) . '",
                "' . md5($formvars['UPswd']) . '",
                "' . $this->SanitizeForSQL($formvars['Upic']) . '"
                )';
				
        if(!mysql_query( $insert_query ,$this->connection)){
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }
		return true;
    }
	
	function HandleError($err){
        $this->error_message .= $err."\r\n";
    }
	
	function MakeConfirmationMd5($email){
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
	
	function SendUserConfirmationEmail(&$formvars){
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'], $formvars['name']);
        
        $mailer->Subject = "Your registration with ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->sitename."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send()){
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }
	
	function sendConfimMail(&$formvars){
		$mail = new PHPMailer();
		
		$name = $formvars['UFname'] . " " . $formvars['ULname'];
		$toAddress = $formvars['Uemail'];
		
		$mail->IsSMTP();
		$mail->CharSet    = 'utf-8';
		$mail->Host       = 'smtp.jetdevllc.com'; // SMTP server example		
// 		$mail->Host       = 'smtp.gmail.com'; // SMTP server example
		$mail->SMTPAuth   = true;             // enable SMTP authentication
		$mail->SMTPSecure = 'ssl';
		$mail->Port       = 25;              // set the SMTP port for the GMAIL server
// 		$mail->Port       = 465;              // set the SMTP port for the GMAIL server
		$mail->Encoding   = '7bit';
		
		$mail->Subject = "Do not reply to this email: Just a confirmation email";
		
		$mail->Username   = "no.reply@jetdevllc.com"; // SMTP account username example  WHERE YOURE SENDING FROM
		$mail->Password   = "PassWord11!!!!";         // SMTP account password example
		
		$mail->Body = "Hello ".$formvars['name']."\r\n\r\n".
					"Thanks for your registration with " . $this->sitename . "\r\n".
					"Please click the link below to confirm your registration.\r\n".
					"Regards,\r\n".
					"Webmaster\r\n".
					$this->sitename;  //simple message only  you can add headers and other stuff
		
		//$mail->MsgHTML($message);
		//$mail->AddAddress("ecorral2@miners.utep.edu", "test");  //WHERE YOURE SENDING TO 
		
		$mail->AddAddress($toAddress, $name);
		
		if(!$mail->Send()) {
			echo 'Message could not be sent.<br>';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
			exit;
		}
		return true;
	}
	
	function SendAdminIntimationEmail(&$formvars){
        if(empty($this->admin_email)){
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="A new user registered at ".$this->sitename."\r\n".
        "Name: ".$formvars['name']."\r\n".
        "Email address: ".$formvars['email']."\r\n".
        "UserName: ".$formvars['username'];
        
        if(!$mailer->Send()){
            return false;
        }
        return true;
    }
	
	/*----(End) Registration of User----*/
	
	/*----(Start) CreateEvent() Submission----*/
	function CreateEvent(){
		if(!isset($_POST['submitted'])){
			return false;
		}
		
// 		echo "in create method\n";
		$formvars = array();

		if(!$this->ValidateEventSubmission()){
			return false;
		}
		
		$itemPicture = $this->upLoadPic();
		if($itemPicture != false){
			$formvars['Eflyer'] = $this->upLoadPic();
		}
		
		$this->CollectEventSubmission($formvars);
		
		if(!$this->SaveEventToDatabase($formvars)){
			return false;
		}
		
		/*if(!$this->SendUserConfirmationEmail($formvars)){
			return false;
		}*/
		
		//$this->SendAdminIntimationEmail($formvars);

		return true;
	}

	function ValidateEventSubmission(){
		//This is a hidden input field. Humans won't fill this field.
		if(!empty($_POST[$this->GetSpamTrapInputName()]) ){
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}

		$validator = new FormValidator();
		$validator->addValidation("Evename",      "req", "Please fill in Event Name");
		$validator->addValidation("Eaddress",     "req", "Please fill in address");
		$validator->addValidation("Ecity",        "req", "Please fill in City");
		$validator->addValidation("Estate",       "req", "Please fill in State");
		$validator->addValidation("Ezip",         "req", "Please fill in Zip code");
		$validator->addValidation("EphoneNumber", "req", "Please fill in Phone Number");
		$validator->addValidation("Etype",        "req", "Please fill in Type of Event");
		$validator->addValidation("EstartDate",   "req", "Please Select a Start Date");
		$validator->addValidation("EtimeStart",   "req", "Please fill in the Start Time");
		$validator->addValidation("EtimeEnd",     "req", "Please fill in the End Time");
		$validator->addValidation("EendDate",     "req", "Please Select an End Date");
		$validator->addValidation("Edescription", "req", "Please fill in Description");

		if(!$validator->ValidateForm()){
			$error='';
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				$error .= $inpname.':'.$inp_err."\n";
			}
			$this->HandleError($error);
			return false;
		}        
		return true;
	}
	
	function CollectEventSubmission(&$formvars){

		$formvars['Evename']      = $this->Sanitize($_POST['Evename']);
		//$formvars['file']         = $this->Sanitize($_POST['file']);		
		$formvars['EstartDate']   = $this->Sanitize($_POST['EstartDate']);
		$formvars['EendDate']     = $this->Sanitize($_POST['EendDate']);
		$formvars['Eaddress']     = $this->Sanitize($_POST['Eaddress']);
		$formvars['Ecity']        = $this->Sanitize($_POST['Ecity']);
		$formvars['Estate']       = $this->Sanitize($_POST['Estate']);
		$formvars['Ezip']         = $this->Sanitize($_POST['Ezip']);
		$formvars['EphoneNumber'] = $this->Sanitize($_POST['EphoneNumber']);
		$formvars['Edescription'] = $this->Sanitize($_POST['Edescription']);
		$formvars['Etype']        = $this->Sanitize($_POST['Etype']);
		$formvars['Ewebsite']     = $this->Sanitize($_POST['Ewebsite']);
		$formvars['Ehashtag']     = $this->Sanitize($_POST['Ehashtag']);
		$formvars['Efacebook']    = $this->Sanitize($_POST['Efacebook']);
		$formvars['Etwitter']     = $this->Sanitize($_POST['Etwitter']);
		$formvars['Egoogle']      = $this->Sanitize($_POST['Egoogle']);
		$formvars['EtimeStart']   = $this->Sanitize($_POST['EtimeStart']);
		$formvars['EtimeEnd']     = $this->Sanitize($_POST['EtimeEnd']);
		$formvars['Eother']       = $this->Sanitize($_POST['Eother']);
		$formvars['Erank']       = $this->Sanitize($_POST['Erank']);
	}
	
	function SaveEventToDatabase(&$formvars){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}

		if(!$this->EnsureEventTable()){
			return false;
		}

		if(!$this->InsertIntoEventTable($formvars)){
			$this->HandleError("Inserting to Database failed!");
			return false;
		}
		return true;
	}

	function EnsureEventTable(){
		$result = mysql_query("SHOW COLUMNS FROM $this->tablename2");   
		if(!$result || mysql_num_rows($result) <= 0){
			return $this->CreateTableEvent();
		}
		return true;
	}
	
	function InsertIntoEventTable(&$formvars){
        //$confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        
        //$formvars['confirmcode'] = $confirmcode;
		
		$uName = $this->UsrName();

		if($formvars['Etype'] === 'Other'){
			$formvars['Evename']      = strtolower (  $formvars['Evename']       );
			$formvars['Eaddress']     = strtolower (  $formvars['Eaddress']      );
			$formvars['Ecity']        = strtolower (  $formvars['Ecity']         );
			$formvars['Estate']       = strtolower (  $formvars['Estate']        );
			$formvars['Edescription'] = strtolower (  $formvars['Edescription']  );
			$formvars['Ewebsite']     = strtolower (  $formvars['Ewebsite']      );
			$formvars['Ehashtag']     = strtolower (  $formvars['Ehashtag']      );
			$formvars['Efacebook']    = strtolower (  $formvars['Efacebook']     );
			$formvars['Etwitter']     = strtolower (  $formvars['Etwitter']      );
			$formvars['Egoogle']      = strtolower (  $formvars['Egoogle']       );
			$formvars['Eother']       = strtolower (  $formvars['Eother']        );
			$formvars['EtimeStart']   = strtolower (  $formvars['EtimeStart']    );
			$formvars['EtimeEnd']     = strtolower (  $formvars['EtimeEnd']    );
			$formvars['Erank']     = strtolower (  $formvars['Erank']    );

						$address = $formvars['Eaddress'] . ", " . $formvars['Ecity'] . ", " . $formvars['Estate'] . " " . $formvars['Ezip'];
						$expression = "/\s/";
						$replace = "+";

						$street = preg_replace($expression, $replace, $address);
						
						
						$prepAddr = str_replace(' ','+',$street);
 
						$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
 
						$output= json_decode($geocode);
 
						$lat = $output->results[0]->geometry->location->lat;
						$long = $output->results[0]->geometry->location->lng;
						
			$insert_query = 'INSERT INTO ' . $this->tablename2 . '(UuserName, Evename, EstartDate, EendDate, Eaddress, Ecity, Estate, Ezip, EphoneNumber, Edescription, Etype, Ewebsite, Ehashtag, Efacebook, Etwitter, Egoogle, Eflyer, Eother, EtimeStart, EtimeEnd, Elat, Elong, Erank)
				VALUES(
					"' . $this->SanitizeForSQL($uName) . '",
					"' . $this->SanitizeForSQL($formvars['Evename']) . '",
					"' . $this->SanitizeForSQL($formvars['EstartDate']) . '",
					"' . $this->SanitizeForSQL($formvars['EendDate']) . '",
					"' . $this->SanitizeForSQL($formvars['Eaddress']) . '",
					"' . $this->SanitizeForSQL($formvars['Ecity']) . '",
					"' . $this->SanitizeForSQL($formvars['Estate']) . '",
					"' . $this->SanitizeForSQL($formvars['Ezip']) . '",
					"' . $this->SanitizeForSQL($formvars['EphoneNumber']) . '",
					"' . $this->SanitizeForSQL($formvars['Etype']) . '",
					"' . $this->SanitizeForSQL($formvars['Edescription']) . '",
					"' . $this->SanitizeForSQL($formvars['Ewebsite']) . '",
					"' . $this->SanitizeForSQL($formvars['Ehashtag']) . '",
					"' . $this->SanitizeForSQL($formvars['Efacebook']) . '",
					"' . $this->SanitizeForSQL($formvars['Etwitter']) . '",
					"' . $this->SanitizeForSQL($formvars['Egoogle']) . '",
					"' . $this->SanitizeForSQL($formvars['Eflyer']) . '",
					"' . $this->SanitizeForSQL($formvars['Eother']) . '",
					"' . $this->SanitizeForSQL($formvars['EtimeStart']) . '",
					"' . $this->SanitizeForSQL($formvars['EtimeEnd']) . '",
					"' . $this->SanitizeForSQL($lat)                . '",
					"' . $this->SanitizeForSQL($long)               . '",
					"' . $this->SanitizeForSQL($formvars['Erank']) . '",
				);';
		} else {
			//
			$formvars['Evename']      = strtolower (  $formvars['Evename']       );
			$formvars['Eaddress']     = strtolower (  $formvars['Eaddress']      );
			$formvars['Ecity']        = strtolower (  $formvars['Ecity']         );
			$formvars['Estate']       = strtolower (  $formvars['Estate']        );
			$formvars['Edescription'] = strtolower (  $formvars['Edescription']  );
			$formvars['Ewebsite']     = strtolower (  $formvars['Ewebsite']      );
			$formvars['Ehashtag']     = strtolower (  $formvars['Ehashtag']      );
			$formvars['Efacebook']    = strtolower (  $formvars['Efacebook']     );
			$formvars['Etwitter']     = strtolower (  $formvars['Etwitter']      );
			$formvars['Egoogle']      = strtolower (  $formvars['Egoogle']       );
			$formvars['Eother']       = strtolower (  $formvars['Eother']        );
			$formvars['EtimeStart']   = strtolower (  $formvars['EtimeStart']    );
			$formvars['EtimeEnd']     = strtolower (  $formvars['EtimeEnd']      );
			$formvars['Erank']     = strtolower (  $formvars['Erank']      );

						$address = $formvars['Eaddress'] . ", " . $formvars['Ecity'] . ", " . $formvars['Estate'] . " " . $formvars['Ezip'];
						$expression = "/\s/";
						$replace = "+";

						$street = preg_replace($expression, $replace, $address);
						
						
						$prepAddr = str_replace(' ','+',$street);
 
						$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
 
						$output= json_decode($geocode);
 
						$lat = $output->results[0]->geometry->location->lat;
						$long = $output->results[0]->geometry->location->lng;

			$insert_query = 'INSERT INTO ' . $this->tablename2 . '(UuserName, Evename, EstartDate, EendDate, Eaddress, Ecity, Estate, Ezip, EphoneNumber, Etype, Edescription, Ewebsite, Ehashtag, Efacebook, Etwitter, Eflyer, Egoogle,EtimeStart, EtimeEnd, Elat, Elong, Erank)
				VALUES(
					"' . $this->SanitizeForSQL($uName) . '",
					"' . $this->SanitizeForSQL($formvars['Evename']) . '",
					"' . $this->SanitizeForSQL($formvars['EstartDate']) . '",
					"' . $this->SanitizeForSQL($formvars['EendDate']) . '",
					"' . $this->SanitizeForSQL($formvars['Eaddress']) . '",
					"' . $this->SanitizeForSQL($formvars['Ecity']) . '",
					"' . $this->SanitizeForSQL($formvars['Estate']) . '",
					"' . $this->SanitizeForSQL($formvars['Ezip']) . '",
					"' . $this->SanitizeForSQL($formvars['EphoneNumber']) . '",
					"' . $this->SanitizeForSQL($formvars['Etype']) . '",
					"' . $this->SanitizeForSQL($formvars['Edescription']) . '",
					"' . $this->SanitizeForSQL($formvars['Ewebsite']) . '",
					"' . $this->SanitizeForSQL($formvars['Ehashtag']) . '",
					"' . $this->SanitizeForSQL($formvars['Efacebook']) . '",
					"' . $this->SanitizeForSQL($formvars['Etwitter']) . '",
					"' . $this->SanitizeForSQL($formvars['Eflyer']) . '",
					"' . $this->SanitizeForSQL($formvars['Egoogle']) . '",
					"' . $this->SanitizeForSQL($formvars['EtimeStart']) . '",
					"' . $this->SanitizeForSQL($formvars['EtimeEnd']) . '",
					"' . $this->SanitizeForSQL($lat)                . '",
					"' . $this->SanitizeForSQL($long)               . '",
					"' . $this->SanitizeForSQL($formvars['Erank']) . '"
				);';
		}
		
        if(!mysql_query($insert_query, $this->connection)){
            $this->HandleDBError("Error inserting data to the table\nquery: $insert_query");
            return false;
        }
		return true;
    }
	
	//new
	function upLoadPic(){
		/**
			$_FILES["Eflyer"]["name"] - the name of the uploaded file
			$_FILES["Eflyer"]["type"] - the type of the uploaded file
			$_FILES["Eflyer"]["size"] - the size in kilobytes of the uploaded file
			$_FILES["Eflyer"]["tmp_name"] - the name of the temporary copy of the file stored on the server
			$_FILES["Eflyer"]["error"] - the error code resulting from the file upload
		*/
		$timestamp      = date('YmdHi'); //timestamp
		$uploaddir      = "./eventFlyers/"; //location to store image
		$filename       = $timestamp . $_FILES['Eflyer']['name'];
		$filename       = strtolower($filename); //create image name with lower case
		$filename		= str_replace(' ', '_', $filename);
		$filename		= str_replace('-', '_', $filename);
		$filename		= str_replace('.', '_', $filename);
		$final_location = $uploaddir.$filename;


			
				
		if (
		(
		   ($_FILES["Eflyer"]["type"] == "image/gif") //set image you want to upload
        || ($_FILES["Eflyer"]["type"] == "image/jpeg") 
        || ($_FILES["Eflyer"]["type"] == "image/png") 
        || ($_FILES["Eflyer"]["type"] == "image/jpg")
        || ($_FILES["Eflyer"]["type"] == "image/GIF")
        || ($_FILES["Eflyer"]["type"] == "image/JPEG") 
        || ($_FILES["Eflyer"]["type"] == "image/PNG") 
        || ($_FILES["Eflyer"]["type"] == "image/JPG")
        
        ) 
        && ($_FILES["Eflyer"]["size"] <5000000)) //set image size
        {
        	if ($_FILES["Eflyer"]["error"] > 0) {
//          	   echo "Return Code: " . $_FILES["Eflyer"]["error"] . "<br />";
        } else {
//             echo "Upload: " . $filename . "<br />";
//             echo "Type: " . $_FILES["Eflyer"]["type"] . "<br />";
//             echo "Size: " . ($_FILES["Eflyer"]["size"] / 1024) . " Kb<br />";
//             echo "Temp file: " . $_FILES["Eflyer"]["tmp_name"] . "<br />";

            move_uploaded_file($_FILES["Eflyer"]["tmp_name"], $final_location);
            $final_location = $this->Sanitize("./eventFlyers/" . $filename);
			return $final_location;
			
      }
    } else {
        echo "INVALID FILE";
    }

		return false;
	}
	
	/*----(End) CreateEvent() Submission----*/
	
	
	
function upLoadUserPic(){
		/**
			$_FILES["Eflyer"]["name"] - the name of the uploaded file
			$_FILES["Eflyer"]["type"] - the type of the uploaded file
			$_FILES["Eflyer"]["size"] - the size in kilobytes of the uploaded file
			$_FILES["Eflyer"]["tmp_name"] - the name of the temporary copy of the file stored on the server
			$_FILES["Eflyer"]["error"] - the error code resulting from the file upload
		*/
		$timestamp      = date('YmdHi'); //timestamp
		$uploaddir      = "./UserPic/"; //location to store image
		$filename       = $timestamp . $_FILES['Upic']['name'];
		$filename       = strtolower($filename); //create image name with lower case
		$filename		= str_replace(' ', '_', $filename);
		$filename		= str_replace('-', '_', $filename);
		$filename		= str_replace('.', '_', $filename);
		$final_location = $uploaddir.$filename;


			
				
		if (
		(
		   ($_FILES["Upic"]["type"] == "image/gif") //set image you want to upload
        || ($_FILES["Upic"]["type"] == "image/jpeg") 
        || ($_FILES["Upic"]["type"] == "image/png") 
        || ($_FILES["Upic"]["type"] == "image/jpg")
        || ($_FILES["Upic"]["type"] == "image/GIF")
        || ($_FILES["Upic"]["type"] == "image/JPEG") 
        || ($_FILES["Upic"]["type"] == "image/PNG") 
        || ($_FILES["Upic"]["type"] == "image/JPG")
        
        ) 
        && ($_FILES["Upic"]["size"] < 5000000)) //set image size
        {
        	if ($_FILES["Upic"]["error"] > 0) {
//          	   echo "Return Code: " . $_FILES["Eflyer"]["error"] . "<br />";
        } else {
//             echo "Upload: " . $filename . "<br />";
//             echo "Type: " . $_FILES["Eflyer"]["type"] . "<br />";
//             echo "Size: " . ($_FILES["Eflyer"]["size"] / 1024) . " Kb<br />";
//             echo "Temp file: " . $_FILES["Eflyer"]["tmp_name"] . "<br />";

            move_uploaded_file($_FILES["Upic"]["tmp_name"], $final_location);
            $final_location = $this->Sanitize("./UserPic/" . $filename);
			return $final_location;
			
      }
    } else {
        echo "INVALID FILE";
    }

		return false;
	} //End uploadUserPic
	
	
	
	/*----(Start) User Management----*/
	function ConfirmUser(){
        if(empty($_GET['code'])||strlen($_GET['code'])<=10){
            $this->HandleError("Please provide the confirm code");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec)){
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
    
    function CheckSession(){
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar])){
            return false;
         }
         return true;
    }
    
	function UsrName(){
        return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
    }
	
    function UserFullName(){
        return isset($_SESSION['name_of_user']) ? $_SESSION['name_of_user'] : '';
    }
    
    function UserEmail(){
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
	
	function SendUserWelcomeEmail(&$user_rec){
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['name']);
        
        $mailer->Subject = "Welcome to ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Welcome! Your registration  with ".$this->sitename." is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send()){
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
	
	function GetUserFromEmail($email,&$user_rec){
        if(!$this->DBLogin()){
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysql_query("SELECT * FROM $this->tablename1 WHERE Uemail='$email'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0){
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);

        
        return true;
    }
	
	/*----(End) User Management----*/
		//nothing in here yet
	/*----(Start) User Management----*/
	
	/*----(Start) Login information/Methods----*/
	function Login(){
        if(empty($_POST['UuserName'])){
            $this->HandleError("UserName is empty!");
            return false;
        }
        
        if(empty($_POST['UPswd'])){
            $this->HandleError("Password is empty!");
            return false;
        }
        
        $username = trim($_POST['UuserName']);
        $password = trim($_POST['UPswd']);
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckSessionInDB($username, $password)){
            return false;
        }
        
        $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
	
	function LogOut(){
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($_SESSION[$sessionvar]);
    }
	
	function GetLoginSessionVar(){
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
	/*----(End) Login information/Methods----*/
	
	/*----(Start) Database Management----*/
	//if the table 'Registration' is not in the database,
	// if will create it.
	function CreateTableReg(){
		$qry = "Create Table $this->tablename1 (".
				"id INTEGER AUTO_INCREMENT NOT NULL,".
				"UFname CHAR(255) NOT NULL,".
				"ULname CHAR(255) NOT NULL,".
				"UPswd CHAR(255) NOT NULL,".
				"Uemail CHAR(255) NOT NULL,".
				"Uphone CHAR(15) DEFAULT 'N/A',".
				"Uadmin CHAR(1) DEFAULT 0,".
				"UuserName CHAR(255) NOT NULL,".
				"Upic CHAR(255) ,".
				"PRIMARY KEY(id, UuserName)".
				");";
				
		if(!mysql_query($qry, $this->connection)){
			$this->HandleDBError("Error creating the table \nquery was\n $qry");
			return false;
		}
		return true;
	}
	
	function CreateTableMyEvents($uUserName){
        $uUserName = $this->SanitizeForSQL($uUserName);
		$tName = $uUserName.$this->tablename3;
		
		$qry = "CREATE TABLE $tName(".
				"id INTEGER AUTO_INCREMENT NOT NULL,".
				"Eid INTEGER,".
				"PRIMARY KEY(id)".
				");";
				
		if(!mysql_query($qry, $this->connection)){
			$this->HandleDBError("Error creating the table \nquery was\n $qry");
			return false;
		}
		return true;
	}
	
	//needs to be updated to the newest table
	function CreateTableEvent(){
		$qry = "Create Table $this->tablename2 (". 
				"Eid INT AUTO_INCREMENT,".
				"UuserName CHAR(255) NOT NULL,".
				"Evename VARCHAR(26) NOT NULL,".
				"EstartDate VARCHAR(20) NOT NULL,".
				"EendDate VARCHAR(20) NOT NULL,".
				"Eaddress VARCHAR(255) NOT NULL,".
				"Ecity VARCHAR(50) NOT NULL,".
				"Estate CHAR(10) NOT NULL,".
				"Ezip INT(5) NOT NULL,".
				"EphoneNumber INT(10),".
				"Edescription VARCHAR(26) NOT NULL,".
				"Etype VARCHAR(26) NOT NULL,".
				"Ewebsite VARCHAR(26) NOT NULL,".
				"Ehashtag CHAR(255),".
				"Efacebook CHAR(255),".
				"Etwitter CHAR(255),".
				"Egoogle CHAR(255),".
				"Eflyer CHAR(255),".
				"Eother CHAR(255),".
				"EtimeStart CHAR(255),".
				"EtimeEnd CHAR(255),".
				"Elat DECIMAL(10,6),".
				"Elong DECIMAL(10,6),".
				"Erank CHAR(255),".
				"PRIMARY KEY(Eid, UuserName)".
			");";

		if(!mysql_query($qry, $this->connection)){
			$this->HandleDBError("Error creating the table \nquery was\n $qry");
			return false;
		}
		return true;
	}

	function CheckSessionInDB($username, $password){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}
		
		$username = $this->SanitizeForSQL($username);
		$pwdmd5 = md5($password);
		//$qry = "Select name, email from $this->tablename where username='$username' and password='$pwdmd5' and confirmcode='y'";
		$qry = "SELECT UFname, UuserName, Uemail FROM $this->tablename1 WHERE UuserName = '$username' AND UPswd = '$pwdmd5'";

		$result = mysql_query($qry, $this->connection);

		if(!$result || mysql_num_rows($result) <= 0){
			$this->HandleError("Error logging in. The username or password does not match");
			return false;
		}

		$row = mysql_fetch_assoc($result);

		$_SESSION['name_of_user']  = $row['UFname'];
		$_SESSION['user_name']     = $row['UuserName'];
		$_SESSION['email_of_user'] = $row['Uemail'];

		return true;
	}
	/*----(End) Database Management----*/
	
	/*----(Start) Search Event----*/
	function searchEvent(){
		if(!isset($_POST['submitted'])){
			return false;
		}

		$formvars = array();

		if(!$this->ValidateSearchSubmission()){
			return false;
		}
		
		$this->CollectSearchSubmission($formvars);
		
		if(!$this->searchEventHelper($formvars)){
			//$this->HandleError("Did not Find any Results by 2 " . $formvars['eventSearch']);
			return false;
		} else {
			$result = $this->searchEventHelper($formvars);
		}

		return $result;
	}
	
	function ValidateSearchSubmission(){
		//This is a hidden input field. Humans won't fill this field.
		if(!empty($_POST[$this->GetSpamTrapInputName()]) ){
			//The proper error is not given intentionally
			$this->HandleError("Automated submission prevention: case 2 failed");
			return false;
		}

		$validator = new FormValidator();
		$validator->addValidation("eventSearch", "req", "Search Field is Empty!");

		if(!$validator->ValidateForm()){
			$error = '';
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				$error .= $inpname.':'.$inp_err."\n";
			}
			$this->HandleError($error);
			return false;
		}        
		return true;
	}
	
	function CollectSearchSubmission(&$formvars){
		$formvars['eventSearch'] = $this->Sanitize($_POST['eventSearch']);
	}
	
	function searchEventHelper($eventSearch){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}
		$eventSearch = strtolower($eventSearch);
		$sql = "SELECT * FROM Events WHERE Ecity LIKE '" . $eventSearch . "' UNION ALL 
		SELECT * FROM Events WHERE Estate LIKE '" . $eventSearch . "' UNION ALL
		SELECT * FROM Events WHERE Evename LIKE '" . $eventSearch . "' UNION ALL
		SELECT * FROM Events WHERE Ezip LIKE '" . $eventSearch . "'UNION ALL
		SELECT * FROM Events WHERE EphoneNumber LIKE '" . $eventSearch . "'UNION ALL
		SELECT * FROM Events WHERE Edescription LIKE '" . $eventSearch . "' UNION ALL 
		SELECT * FROM Events WHERE Etype LIKE '" . $eventSearch . "' UNION ALL
		SELECT * FROM Events WHERE Ehashtag  LIKE '" . $eventSearch . "'ORDER BY EstartDate";
		
		$result = mysql_query($sql, $this->connection);
		
		if(!$result || mysql_num_rows($result) <= 0){
			$this->HandleError("Did Not Find Any Results For " . $eventSearch);
			return false;
		}
		
		return $result;
	}
	/*----(End) Search Event----*/
	
	/*----(Start) Password Management----*/
	function EmailResetPasswordLink(){
		if(empty($_POST['email'])){
			$this->HandleError("Email is empty!");
			return false;
		}
		
		$user_rec = array();
		
		if(false === $this->GetUserFromEmail($_POST['email'], $user_rec)){
			return false;
		}
		
		if(false === $this->SendResetPasswordLink($user_rec)){
			return false;
		}
		return true;
	}

	function ResetUserPasswordInDB($user_rec){
		$new_password = substr(md5(uniqid()), 0, 10);

		if(false == $this->ChangePasswordInDB($user_rec, $new_password)){
			return false;
		}
		return $new_password;
	}

	function ResetPassword(){
		if(empty($_GET['email'])){
			$this->HandleError("Email is empty!");
			return false;
		}
		
		if(empty($_GET['code'])){
			$this->HandleError("reset code is empty!");
			return false;
		}
		
		$email = trim($_GET['email']);
		$code  = trim($_GET['code']);

		if($this->GetResetPasswordCode($email) != $code){
			$this->HandleError("Bad reset code!");
			return false;
		}

		$user_rec = array();
		if(!$this->GetUserFromEmail($email,$user_rec)){
			return false;
		}

		$new_password = $this->ResetUserPasswordInDB($user_rec);
		
		if(false === $new_password || empty($new_password)){
			$this->HandleError("Error updating new password");
			return false;
		}

		if(false == $this->SendNewPassword($user_rec,$new_password)){
			$this->HandleError("Error sending new password");
			return false;
		}
		return true;
	}

	function ChangePassword(){
		if(!$this->CheckSession()){
			$this->HandleError("Not logged in!");
			return false;
		}

		if(empty($_POST['oldpwd'])){
			$this->HandleError("Old password is empty!");
			return false;
		}
		
		if(empty($_POST['newpwd'])){
			$this->HandleError("New password is empty!");
			return false;
		}

		$user_rec = array();

		if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec)){
			return false;
		}

		$pwd = trim($_POST['oldpwd']);

		if($user_rec['UPswd'] != md5($pwd)){
			$this->HandleError("The old password does not match!");
			return false;
		}
		
		$newpwd = trim($_POST['newpwd']);

		if(!$this->ChangePasswordInDB($user_rec, $newpwd)){
			return false;
		}
		return true;
	}

	function ChangePasswordInDB($user_rec, $newpwd){
		$newpwd = $this->SanitizeForSQL($newpwd);

		$qry = "UPDATE $this->tablename1 SET UPswd='".md5($newpwd)."' WHERE  UuserName='".$user_rec['UuserName']."'";

		if(!mysql_query( $qry ,$this->connection)){
			$this->HandleDBError("Error updating the password \nquery:$qry");
			
			return false;

		}    
		return true;
	}

	function SendResetPasswordLink($user_rec){
		$email = $user_rec['email'];

		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		$mailer->AddAddress($email,$user_rec['name']);

		$mailer->Subject = "Your reset password request at ".$this->sitename;

		$mailer->From = $this->GetFromAddress();

		$link = $this->GetAbsoluteURLFolder().
		'/resetpwd.php?email='.
		urlencode($email).'&code='.
		urlencode($this->GetResetPasswordCode($email));

		$mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
		"There was a request to reset your password at ".$this->sitename."\r\n".
		"Please click the link below to complete the request: \r\n".$link."\r\n".
		"Regards,\r\n".
		"Webmaster\r\n".
		$this->sitename;

		if(!$mailer->Send()){
			return false;
		}
		return true;
	}

	function SendNewPassword($user_rec, $new_password){
		$email = $user_rec['email'];

		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		$mailer->AddAddress($email,$user_rec['name']);

		$mailer->Subject = "Your new password for ".$this->sitename;

		$mailer->From = $this->GetFromAddress();

		$mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
		"Your password is reset successfully. ".
		"Here is your updated login:\r\n".
		"username:".$user_rec['username']."\r\n".
		"password:$new_password\r\n".
		"\r\n".
		"Login here: ".$this->GetAbsoluteURLFolder()."/login.php\r\n".
		"\r\n".
		"Regards,\r\n".
		"Webmaster\r\n".
		$this->sitename;

		if(!$mailer->Send()){
			return false;
		}
		return true;
	}

	function GetResetPasswordCode($email){
		return substr(md5($email.$this->sitename.$this->rand_key),0,10);
	}
	/*----(End) Password Management----*/
	
    /*----(Start) Other Management----*/
	function GetSelfScript(){
		return htmlentities($_SERVER['PHP_SELF']);
	}    

	function SafeDisplay($value_name){
		if(empty($_POST[$value_name])){
			return'';
		}
		return htmlentities($_POST[$value_name]);
	}

	function RedirectToURL($url){
		header("Location: $url");
		exit;
	}

	function GetSpamTrapInputName(){
		return 'sp'.md5('KHGdnbvsgst' . $this->rand_key);
	}

	function GetErrorMessage(){
		if(empty($this->error_message)){
			return '';
		}
		$errormsg = nl2br(htmlentities($this->error_message));
		return $errormsg;
	}    

	function HandleDBError($err){
		$this->HandleError($err . "\r\n mysqlerror: " . mysql_error());
	}

	function GetFromAddress(){
		if(!empty($this->from_address)){
			return $this->from_address;
		}

		$host = $_SERVER['SERVER_NAME'];

		$from ="nobody@$host";
		return $from;
	} 

	function UpdateDBRecForConfirmation(&$user_rec){
		if(!$this->DBLogin()){
			$this->HandleError("Database login failed!");
			return false;
		}
		
		$confirmcode = $this->SanitizeForSQL($_GET['code']);

		$result = mysql_query("Select Uname, Uemail from $this->tablenameU where confirmcode='$confirmcode'", $this->connection);   
		
		if(!$result || mysql_num_rows($result) <= 0){
			$this->HandleError("Wrong confirm code.");
			return false;
		}
		
		$row = mysql_fetch_assoc($result);
		$user_rec['Uname'] = $row['Uname'];
		$user_rec['Uemail']= $row['Uemail'];

		$qry = "Update $this->tablename1 Set confirmcode = 'y' Where confirmcode = '$confirmcode'";

		if(!mysql_query( $qry ,$this->connection)){
			$this->HandleDBError("Error inserting data to the table\nquery:$qry");
			return false;
		}      
		return true;
	}

	function SendAdminIntimationOnRegComplete(&$user_rec){
		if(empty($this->admin_email)){
			return false;
		}
		$mailer = new PHPMailer();

		$mailer->CharSet = 'utf-8';

		$mailer->AddAddress($this->admin_email);

		$mailer->Subject = "Registration Completed: ".$user_rec['name'];

		$mailer->From = $this->GetFromAddress();         

		$mailer->Body ="A new user registered at ".$this->sitename."\r\n".
		"Name: ".$user_rec['name']."\r\n".
		"Email address: ".$user_rec['email']."\r\n";

		if(!$mailer->Send()){
			return false;
		}
		return true;
	}

	function GetAbsoluteURLFolder(){
		$scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
		$scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
		return $scriptFolder;
	}

	function SanitizeForSQL($str){
		if( function_exists( "mysql_real_escape_string" ) ){
			$ret_str = mysql_real_escape_string( $str );
		} else {
			$ret_str = addslashes( $str );
		}
		return $ret_str;
	}
	
	/*uses a third party tool to search for the city based on the IP address*/
	function getCity(){
		$user_ip = getenv('REMOTE_ADDR');
		$geo     = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
		$city    = $geo["geoplugin_city"];
		
		return $city;
		/*
		$region = $geo["geoplugin_regionName"];
		$country = $geo["geoplugin_countryName"];
		echo "City: ".$city."<br>";
		echo "Region: ".$region."<br>";
		echo "Country: ".$country."<br>";
		geoplugin_request
		geoplugin_status
		geoplugin_credit
		geoplugin_city
		geoplugin_region
		geoplugin_areaCode
		geoplugin_dmaCode
		geoplugin_countryCode
		geoplugin_countryName
		geoplugin_continentCode
		geoplugin_latitude
		geoplugin_longitude
		geoplugin_regionCode
		geoplugin_regionName
		geoplugin_currencyCode
		geoplugin_currencySymbol
		geoplugin_currencySymbol_UTF8
		geoplugin_currencyConverter
		*/	
	}

	function getLat(){
		$user_ip = getenv('REMOTE_ADDR');
		$geo     = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
		$lat    = $geo["geoplugin_latitude"];
		
		return $lat;
		/*
		$region = $geo["geoplugin_regionName"];
		$country = $geo["geoplugin_countryName"];
		echo "City: ".$city."<br>";
		echo "Region: ".$region."<br>";
		echo "Country: ".$country."<br>";
		geoplugin_request
		geoplugin_status
		geoplugin_credit
		geoplugin_city
		geoplugin_region
		geoplugin_areaCode
		geoplugin_dmaCode
		geoplugin_countryCode
		geoplugin_countryName
		geoplugin_continentCode
		geoplugin_latitude
		geoplugin_longitude
		geoplugin_regionCode
		geoplugin_regionName
		geoplugin_currencyCode
		geoplugin_currencySymbol
		geoplugin_currencySymbol_UTF8
		geoplugin_currencyConverter
		*/	
	}
	
	function getLocalTimeZone(){
	
		$lat = $this->getLat();
		$lon = $this->getLon();
		$jsonObject = file_get_contents("https://maps.googleapis.com/maps/api/timezone/json?timestamp=0&sensor=true&location=".$lat.",".$lon."");
		$object = json_decode($jsonObject);
		$timezone=$object->timeZoneId;
		date_default_timezone_set($timezone);
		
		return $timezone;
		
		}
		
		
		
		function getLon(){
		$user_ip = getenv('REMOTE_ADDR');
		$geo     = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
		$lon    = $geo["geoplugin_longitude"];
		
		return $lon;
		/*
		$region = $geo["geoplugin_regionName"];
		$country = $geo["geoplugin_countryName"];
		echo "City: ".$city."<br>";
		echo "Region: ".$region."<br>";
		echo "Country: ".$country."<br>";
		geoplugin_request
		geoplugin_status
		geoplugin_credit
		geoplugin_city
		geoplugin_region
		geoplugin_areaCode
		geoplugin_dmaCode
		geoplugin_countryCode
		geoplugin_countryName
		geoplugin_continentCode
		geoplugin_latitude
		geoplugin_longitude
		geoplugin_regionCode
		geoplugin_regionName
		geoplugin_currencyCode
		geoplugin_currencySymbol
		geoplugin_currencySymbol_UTF8
		geoplugin_currencyConverter
		*/	
	}
	
	/*
	Sanitize() function removes any potential threat from the
	data submitted. Prevents email injections or any other hacker attempts.
	if $remove_nl is true, newline chracters are removed from the input.
	*/
	function Sanitize($str, $remove_nl = true){
		$str = $this->StripSlashes($str);

		if($remove_nl){
			$injections = array('/(\n+)/i', '/(\r+)/i',
								'/(\t+)/i', '/(%0A+)/i',
								'/(%0D+)/i', '/(%08+)/i',
								'/(%09+)/i', '/(%+)/i'
								);
			$str = preg_replace($injections, '', $str);
		}
		return $str;
	}

	function StripSlashes($str){
        if(get_magic_quotes_gpc()){
            $str = StripSlashes($str);
        }
        return $str;
    }
	/*----(End) Other Management----*/
}
?>