<?php
	require_once("../closeup/lib/user.php");
	require_once("../closeup/lib/cms.php");
	
	$profile = new User();
	$validuser = $profile->userprofile($_SESSION['userid']);

	if(empty($validuser->name)) {
    	session_destroy();
    	header("Location: index.php");
	}
	$userid = $_SESSION['userid'];
	// My Profile
	$myprofile = $profile->userprofile($userid);
	// My Score
	$myscore = $profile->myscore($userid);
	// Team Score
	$totalteamscore = $profile->teamscore($myprofile->team);
	$_SESSION['teamid'] = $myprofile->team;
	// Get Questions
	$q = new Cms();
	$userquestions = $q->getweekquestion();

	include_once 'header.php'; 
?>
<!--
	<div class="breadcrumbs">
		<section class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>User Profile : <?php //echo $myprofile->name; ?></h1>
				</div>
				<div class="col-md-12">
					<div class="crumbs">
						<a href="index.php">Home</a>
						<span class="crumbs-span">/</span>
						<a href="#">User</a>
						<span class="crumbs-span">/</span>
						<span class="current">User Profile : <?php // $myprofile->name; ?></span>
					</div>
				</div>
			</div>
		</section>
	</div>-->
	
	<p></p>
	<section class="container main-content">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="user-profile">
						<div class="col-md-12">
							<div class="page-content">
								<h2><?php echo $myprofile->name; ?></h2>
								
								
								<div class="tabs-warp">
							    <ul class="tabs">
							        <li class="tab"><a href="#"><i class="icon-user"></i> Basic Profile</a></li>
							        <li class="tab"><a href="#"><i class="icon-bookmark"></i> Play</a></li>
							    </ul>
							    <div class="tab-inner-warp">
							    	<div class="tab-inner">
							            <div class="col-md-2 col-xs-2 col-sm-2">
												<div class="">
												<img width="80px" height="80px" src="http://graph.facebook.com/<?php echo $myprofile->socid; ?>/picture?type=large" alt="admin">
												</div>
											</div>
											<div class="col-md-5 col-xs-5 col-sm-5">
												<div class="ul_list ul_list-icon-ok about-user">
												<ul>
                                    				<li><i class="icon-bolt"></i> <strong>Sex: </strong> <?php echo $myprofile->sex; ?> </li>
                                        			<li><i class="icon-calendar"></i> <strong>Age:</strong> <?php echo $myprofile->age; ?> </li>
                                        			<li><i class="icon-phone"></i> <strong>Phone:</strong> <?php echo $myprofile->phone; ?> </li>
												</ul>
											
											</div>
											</div>
								
											<div class="col-md-5 col-xs-5 col-sm-5">
												<div class="ul_list ul_list-icon-ok about-user">
												<ul>
													<li><i class="icon-barcode"></i> <strong>Team:</strong> <?php echo $myprofile->team; ?> </li>
                                        			<li><i class="icon-briefcase"></i> <strong>Points:</strong> <?php echo ($myscore->points < 1) ? "0" : $myscore->points; ?> </li>
                                        			<li><i class="icon-dashboard"></i> <strong>Team Points:</strong> <?php echo ($totalteamscore->points < 1) ? "0" : $totalteamscore->points; ?> </li>
												</ul>
												</div>
											</div>
								
											<!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat. Vivamus vulputate posuere nisl quis consequat. Donec congue commodo mi, sed commodo velit fringilla ac. Fusce placerat venenatis mi. Pellentesque habitant morbi tristique senectus et netus et malesuada .</p>
											--><div class="clearfix"></div>
							        </div>
							    </div>
							    <div class="tab-inner-warp">
							    	<div class="tab-inner">
							    		<?php 
                                            // Display Questions by Week
											$totalq = count($userquestions);
											if($totalq > 0) {
										?>
							            <div class="user-questions">
							            	<?php
							            		foreach ($userquestions as $ques) {
							            			$answered = $q->hideifanswered($_SESSION['userid'],$ques->episodeid);
							            		/*
							            		stdClass Object ( [id] => 1 [question] => Who is the Governor of Lagos? [episodeid] => 1 
							            		[options] => Buhari,Ambode,Tinubu,Fashola [answer] => Ambode [filename]
											] => 1 [dnt] => 2015-08-25 12:55:40 )
							            		*/
							            	?>
											<article class="question user-question">
												<h3>
													<a href="<?php if($answered == 0){ echo 'questions.php?epid='.$ques->episodeid; }else{ echo '#';} ?>">Click to Play Episode<?php echo $ques->episodeid;?></a>
												</h3>
                                                                                            <div class="question-type-main"><i class="icon-question-sign"></i><font style="color: black;">Episode <?php echo $ques->episodeid; ?></font></div>
											<div class="question-content">
												<div class="question-bottom">
														<?php if($answered == 0){ ?>
															<div class="question-answered"><i class="icon-spinner"></i>un-answered</div>
														<?php }else{ ?>
															<div class="question-answered question-answered-done"><i class="icon-ok"></i>already answered</div>
														<?php } ?>
														<span class="question-date"><i class="icon-time"></i>added <?php echo $ques->dnt; ?></span>
														<span class="question-comment"><a href="user_questions.html#"><i class="icon-comment"></i><?php echo count(explode(',',$ques->options))?> Options</a></span>
												</div>
											</div>
											</article>
											<?php } ?>
										</div>
										<?php }else{ ?>
											<div class="alert-message error">
						        				<i class="icon-flag"></i>
						        				<p><span>Question(s) Not Found</span><br>
						        				Oh snap! We couldn't load questions at the moment, kindly check back.</p>
						    				</div>
										<?php } ?>
							        </div>
							    </div>
							</div>
								
								
								<!--<div class="accordion">
							    	<h4 class="accordion-title"><a href="#">Basic Profile</a></h4>
							    	<div class="accordion-inner">
							        		something...
								
							    	</div>
							    	<h4 class="accordion-title"><a href="#">Questions by Episode</a></h4>
							    	<div class="accordion-inner">
							        	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat.
							    	</div>
								</div>-->
								
								
								
								
								<span class="user-follow-me">Follow Me</span>
								<a href="user_profile.html#" original-title="Facebook" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#3b5997" span_hover="#2f3239">
											<i class="social_icon-facebook"></i>
										</span>
									</span>
								</a>
								<a href="user_profile.html#" original-title="Twitter" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#00baf0" span_hover="#2f3239">
											<i class="social_icon-twitter"></i>
										</span>
									</span>
								</a>
								<a href="user_profile.html#" original-title="Linkedin" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#006599" span_hover="#2f3239">
											<i class="social_icon-linkedin"></i>
										</span>
									</span>
								</a>
								<a href="user_profile.html#" original-title="Google plus" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#c43c2c" span_hover="#2f3239">
											<i class="social_icon-gplus"></i>
										</span>
									</span>
								</a>
								<a href="user_profile.html#" original-title="Email" class="tooltip-n">
									<span class="icon_i">
										<span class="icon_square" icon_size="30" span_bg="#000" span_hover="#2f3239">
											<i class="social_icon-email"></i>
										</span>
									</span>
								</a>
							</div><!-- End page-content -->
						</div><!-- End col-md-12 -->
						<div class="col-md-12">
						
						</div><!-- End col-md-12 -->
					</div><!-- End user-profile -->
				</div><!-- End row -->
				<div class="clearfix"></div>
				
				<!--
				<div class="page-content">
					<div class="user-stats">
						<div class="user-stats-head">
							<div class="block-stats-1 stats-head">#</div>
							<div class="block-stats-2 stats-head">Today</div>
							<div class="block-stats-3 stats-head">Month</div>
							<div class="block-stats-4 stats-head">Total</div>
						</div>
						<div class="user-stats-item">
							<div class="block-stats-1">Questions</div>
							<div class="block-stats-2">5</div>
							<div class="block-stats-3">20</div>
							<div class="block-stats-4">100</div>
						</div>
						<div class="user-stats-item">
							<div class="block-stats-1">Answers</div>
							<div class="block-stats-2">30</div>
							<div class="block-stats-3">150</div>
							<div class="block-stats-4">1000</div>
						</div>
						<div class="user-stats-item user-stats-item-last">
							<div class="block-stats-1">Visitors</div>
							<div class="block-stats-2">100</div>
							<div class="block-stats-3">3000</div>
							<div class="block-stats-4">5000</div>
						</div>
					</div>
				</div>-->
			</div><!-- End main -->
		</div><!-- End row -->
	</section><!-- End container -->
	

</div>
<!-- End wrap -->
<?php include_once('footer.php'); ?>
