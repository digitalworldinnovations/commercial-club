<div class="row">
    <div class="col-md-6">
        <?php include("server/register.php");?>
        
        <div class="welcomeWrapper">
                <div class="welcomeTitle border-shape">
                    <h6>Registration</h6>
                </div>
                <form id="reg" class="welcomeContent" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" required type="text" name="fname" placeholder="Name" value="<?php echo @$firstname;?>" />
                            <?php echo "<span style='color:red'>".@$errName."</span>";?>

                        </div>
                        <div class="col-md-6">
                            <input class="form-control" required type="text" name="sname" placeholder="Surname" value="<?php echo @$surname;?>"/>
                      
                            <?php echo "<span style='color:red'>".@$errSurname."</span>";?>
                        </div>  
                    </div>
                    <input id="pNumber" size="10" class="form-control" required type="text"  maxlength="10" name="cellNumber" value="<?php echo @$cellNo;?>" placeholder="Phone Number"/>
                    <?php echo "<span style='color:red'>".@$errCellNumber."</span>";?>
                    <input class="form-control" required type="password" name="password" min="8" maxlength="15"  placeholder="Password"/>
                     <?php echo "<span style='color:red'>".@$errPassword."</span>";?>
                    <input id="rNumber" class="form-control" required type="text" name="refferalNo" placeholder="Refferal Number" value="<?php echo @$refferalNo;?>"/>
					<?php echo "<span style='color:red'>".@$errRefferal."</span>";?></br>
                    
                    <span class="form-group">
                        <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" required value="value1">
                        <label for="styled-checkbox-1">I Agree to Commercial Club Terms & Conditions</label>
                    </span>
            	<?php echo "<span style='color:red'>".@$errAgree."</span>";?></br>
                    <input style="width:100%;" class="btn button-gold" type="submit" name="submit"value="Register"/>
                    <?php echo "<span style='color:red'>".@$errMessage."</span>";?>
                    <?php echo "<span style='color:green'>".@$succMessage."</span>";?>
                </form>				
        </div>
    </div>
	

    <div class="col-md-6">
        <div class="welcomeWrapper">
                <div class="welcomeTitle border-shape">
                        <h6>Password Reset</h6>
                </div>
                <p class="welcomeContent">
                   
                    <ol class="list">
                                    <li>Click on Login.</li>
                                        <li>Click on "forgot password?" link.</li>
                                        <li>Enter your Phone Number. </li>
                                        <li>Click on "Request" button.</li>
                                        <li>Your old password will be sent to you by sms.</li>
                                        <li>Then Login.</li>
                                        <li>Click on "Profile" and change your password</li> 
                                     </ol>  
                    
                </p>
        </div>
    </div>
</div>

