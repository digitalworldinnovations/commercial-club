<?php 

    include("conn.php");

    @$firstname = $_SESSION['r_fname']; 
    @$surname = $_SESSION['r_lname']; 
    @$cellNo =  $_SESSION['r_cell']; 
    @$password =  $_SESSION['pswd']; 
    @$refferalNo =  $_SESSION['r_ref']; 
    @$vCode = $_SESSION['r_vCode']; 
    $_SESSION['btn'] = @$_POST['submit'];
    $_SESSION["userVCode"] = @$_POST['vCode'];
 
    $show = true;
    
    if(@$_SESSION['btn'] == "Confirm" && @$_SESSION["userVCode"] == @$_SESSION['r_vCode']){
        $show = false;
        unset($_SESSION['r_vCode']);
    }else{
        @$errMessage = "invalid code";
    }
    if(@$_SESSION["userVCode"] == @$_SESSION['r_vCode'] && @$_SESSION['btn'] == "Finish"){
        
        $bank_name =  $_POST['bankName'];
        $bank_branch = $_POST['accBranch'];
        $account_holder = $_POST['accHolder'];
        $accNum = $_POST['accNumber'];
        $getUniCode = "select * from bankss where bank_name = '".$bank_name."' LIMIT 1;";

        $getResults = $conn->query($getUniCode);

        if(empty($bank_branch)){
            $errBranch = "Enter Bank branch code";
        }

        if(empty($account_holder)){
            $errAccHolder = "Enter account holder";
        }

        if(empty($accNum)){
            $errAccNumber = "Enter account number";
        }

        if(!($getResults->num_rows > 0)){
            $errbankName = "Please select Bank";
        }

        
        if(empty($bank_branch) || empty($account_holder) || empty($accNum) || ($bank_name == "--SELECT YOUR BANK--")){
            $errMessageBankDetails = "Please make sure all fields are not empty";
        }else{
            
            if($getResults->num_rows > 0){
                $row = $getResults->fetch_assoc();
                
                $uniCode = $row['universal_code'];
                $sql = "insert into users values('',\"$firstname\",\"$surname\",\"$cellNo\",\"$password\",\"$cellNo\",\"$vCode\",0,\"$bank_name\",\"$uniCode\",\"$bank_branch\",\"$account_holder\",\"$accNum\");"; 

                if($conn->query($sql)){

                    @$errMessageBankDetails =  "insert";
                    $url = "https://www.winsms.co.za/api/batchmessage.asp?";
                            
                                    $userp = "user=";
                            
                                    $passwordp = "&password=";
                            
                                    $messagep = "&message=";
                            
                                    $numbersp = "&Numbers=";
                            
                                    $username = "qinisozwane11@gmail.com";
                                    $password = "Mangethe91";
                                    $message = "Hi ".$firstname." ".$surname."\n\nWelcome to Commercial Club\nYour Login Details are as follows:\n\nUsername : ".$cellNo."\nPassword : ".$_SESSION['pswd']." \nThank you for joining us.\n-----------------------------\nFrom Commercial Club.";
                                    $numbers = $cellNo;
                            
                                    $encmessage = urlencode(utf8_encode($message));
                            
                                    $all = $url.$userp.$username.$passwordp.$password.$messagep.$encmessage.$numbersp.$numbers;
                            
                                    $fp = fopen($all, 'r');
                                    while(!feof($fp)){
                                    $line = fgets($fp, 4000);
                                    echo "<br>";
                                    echo "Responce";
                                    echo "<br>";
                                    print($line);
                                    echo "<br>";
                            }
                        fclose($fp);
                        
                        $sql="select * from users where  p_number=\"$cellNo\";";
		
                        $result=$conn->query($sql);
                        @$userDetails = $result->fetch_assoc();
                        $_SESSION["u_id"] = $userDetails["id"];
                        $_SESSION["u_fname"] = $userDetails["fname"];
                        $_SESSION["u_lname"] = $userDetails["lname"];
                        $_SESSION["u_username"] = $userDetails["p_number"];
                        $_SESSION["u_bankName"] = $userDetails["bank_name"];
                        $_SESSION["u_uniCode"] = $userDetails["universal_code"];
                        $_SESSION["u_accHolder"] = $userDetails["account_holder"];
                        $_SESSION["u_accNumber"] = $userDetails["account_number"];
                        $_SESSION["u_pswd"] = $userDetails["password"];
                        echo "<script>window.location.href = './dashboard.php';</script>";
                }
                else{
                    @$errMessageBankDetails = "Sorry but we could not create your account. Make sure all your information is valid. Try again";
                }
        }else{
            $errbankName = "Please select Bank";
        }
        
        
    }

    }


?>