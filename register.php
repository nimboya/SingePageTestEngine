<?php
require_once("lib/config.php");
require_once("lib/user.php");
require_once("lib/FacebookDriver.php");
	
$fb_driver = new FacebookDriver();

$APP_PROFILE = array();
$user = new User();
   
if(isset($_POST['action']) && $_POST['action'] == "register") {
    // Define Validator Object
    $validator = new validator();
    
    // Define Parameters
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $validator->sexvalid($_POST['sex']);
    $phone = $validator->phonevalid($_POST['phone']);
    $email = $validator->emailvalid($_POST['email'], "Invalid Email");
    $state = $_POST['state'];
    $team = trim($_POST['team']);
    $socid = $_POST['socid'];
    
    $params = array('socid'=>$socid, 'name'=>$name, 'age'=>$age, 'sex'=>$sex, 'email'=>$email, 'phone'=>$phone, 'state'=>$state, 'team'=>$team);
    
    // Create User Object and Register User
    $resp = $user->register($params);
		if(strstr($resp, "OK")) {
			$_SESSION['userid'] = $_POST['socid'];
			$_SESSION['teamid'] = $user->userprofile($_POST['socid']);
			header("Location: profile.php");
		}
		}
		else{
			if($fb_driver->in_session()){
				 // Get User
				$fb_profile = $fb_driver->get_profile();
				$APP_PROFILE['id'] = $fb_profile->getId();
				$APP_PROFILE['name'] = $fb_profile->getName();
				 
				$profile = $user->userprofile($APP_PROFILE['id']);
				// Check if User Exists
				if($profile->socid == $APP_PROFILE['id']){
				 $_SESSION['userid'] = $APP_PROFILE['id'];
				 header("Location: profile.php");
				}
			} else{
				header("Location: error-page.php");
			}
}
include_once 'header.php';
?>
<!--
	<div class="breadcrumbs">
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Register Now</h1>
				</div>
				<div class="col-md-12">
					<div class="crumbs">
						<a href="index.php">Home</a>
						<span class="crumbs-span">/</span>
						<a href="#">User</a>
						<span class="crumbs-span">/</span>
						<span class="current">Registration</span>
					</div>
				</div>
			</div>
		</section>
	</div><!-- End breadcrumbs -->
	
	
	
	<section class="container main-content">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="user-profile">
						<div class="col-md-12">
							<div class="page-content">
								<h2><?php echo $APP_PROFILE['name']; ?></h2>
								<h6>Kindly complete registration to fully participate</h6>
								
								<div class="form-style form-style-4">
									<form method="post" enctype="multipart/form-data" action="">
										<div class="form-inputs clearfix">
											<p>
												<label class="required">E-Mail Address<span>*</span></label>
                                                                                                <input type="email" class="form-control" required="" name="email" title="Please enter your email" placeholder="Enter the email Here!">
											</p>
											
											<p>
												<label class="required">Phone Number<span>*(This is necessary to claim reward)</span></label>
												<input type="number" class="form-control" autocomplete="off" name="phone" title="Please enter your phone" placeholder="Enter your phone Here!">
											</p>
											
											<p>
											<label class="required">Age<span>*</span>
											    <select class="form-control" name="phone" id="phone">
												   <option>18-25</option>
												   <option>26-34</option>
												   <option>35-44</option>
												   <option>45 and above</option>
												</select>
											</label>
												<!-- <input type="number" required="" autocomplete="off" name="age" title="Please enter your age" placeholder="Enter your age Here!"> -->
											</p>
											
											<p>
												<label class="required">Gender<span>*</span></label>
												<select class="form-control" name="sex" required>
                                    				<option value="" disabled="" selected="selected">Select Gender</option>
                                    				<option value="Male">Male</option>
                                    				<option value="Female">Female</option>
                                				</select>
                                			</p>
                                			
                                			<p>
                                				<label class="required">Location<span>*</span></label>
                                				<select name="state" required>
                                    				<option value="" selected="selected" disabled="">Select State</option>
                                    				<option value="Abuja FCT">Abuja FCT</option>
                                    				<option value="Abia">Abia</option>
                                    				<option value="Adamawa">Adamawa</option>
                                    				<option value="Akwa Ibom">Akwa Ibom</option>
                                    				<option value="Anambra">Anambra</option>
                                    				<option value="Bauchi">Bauchi</option>
                                    				<option value="Bayelsa">Bayelsa</option>
                                    				<option value="Benue">Benue</option>
                                    				<option value="Borno">Borno</option>
                                   					 <option value="Cross River">Cross River</option>
                                   					 <option value="Delta">Delta</option>
                                    				<option value="Ebonyi">Ebonyi</option>
                                    <option value="Edo">Edo</option>
                                    <option value="Ekiti">Ekiti</option>
                                    <option value="Enugu">Enugu</option>
                                    <option value="Gombe">Gombe</option>
                                    <option value="Imo">Imo</option>
                                    <option value="Jigawa">Jigawa</option>
                                    <option value="Kaduna">Kaduna</option>
                                    <option value="Kano">Kano</option>
                                    <option value="Katsina">Katsina</option>
                                    <option value="Kebbi">Kebbi</option>
                                    <option value="Kogi">Kogi</option>
                                    <option value="Kwara">Kwara</option>
                                    <option value="Lagos">Lagos</option>
                                    <option value="Nassarawa">Nassarawa</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Ogun">Ogun</option>
                                    <option value="Ondo">Ondo</option>
                                    <option value="Osun">Osun</option>
                                    <option value="Oyo">Oyo</option>
                                    <option value="Plateau">Plateau</option>
                                    <option value="Rivers">Rivers</option>
                                    <option value="Sokoto">Sokoto</option>
                                    <option value="Taraba">Taraba</option>
                                    <option value="Yobe">Yobe</option>
                                    <option value="Zamfara">Zamfara</option>
                                    <option value="Outside Nigeria">Outside Nigeria</option>
                                </select>
                                
                                		</p>
                                		
                                		<p>
                                			<label class="required">Choose a Team<span>*</span></label>
                                			<select name="team" required>
                                    			<option value="" disabled="" selected="selected">Select Team</option>
                                    			<option value="A">Team Tee-A (Team Red)</option>
                                    			<option value="B">Team Ebuka (Team Green)</option>
                               				 </select>
                               			</p>
									</div>
							
                                 <input type="hidden" value="<?php echo $APP_PROFILE['id']; ?>" name="socid" id="socid" />
                                <input type="hidden" value="<?php echo $APP_PROFILE['name']; ?>" name="name" id="name" />
                                <input type="hidden" name="action" value="register" />
							<p class="form-submit">
								<input type="submit" value="Register" class="btn btn-primary btn-lg">
							</p>
						</form>
					</div>
							</div><!-- End page-content -->
						</div><!-- End col-md-12 -->
						<div class="col-md-12">
						
						</div><!-- End col-md-12 -->
					</div><!-- End user-profile -->
				</div><!-- End row -->
				<div class="clearfix"></div>
			</div><!-- End main -->
		</div><!-- End row -->
	</section><!-- End container -->
	

</div>
<!-- End wrap -->
<?php include_once('footer.php'); ?>