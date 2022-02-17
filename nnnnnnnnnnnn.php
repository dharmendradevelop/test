<?php

get_header();

$sidebar_configs = entaro_get_company_layout_configs();
entaro_render_breadcrumbs();
?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<style>
	.modal-backdrop.in {
		opacity: 0 !important;
		z-index:-1 !important;
	}
	section#apus-breadscrumb {
	    display: none !important;
	}
	.widgetff{
	    width:20%;
	    display: inline-block;
	    
	}
 .vc_column_container >.vc_column-inner {
    box-sizing: border-box;
    padding-left: 15px;
    padding-right: 15px;
    width: 100%;
 }
 @media only screen and (max-width: 1500px) {
   
.widgetsecond{
   position: relative !important;
    top: -404px;
    left: 31%;
}
.widgetth{
 position: relative !important;
      top: -713px;
    left: 55%;
}
.widgetfour{
  position: relative !important;
     top: -1050px;
    left: 80%;
}
.topmargin{margin-top:80px;
    margin-bottom:-1000px;
}
.footer-left{width: 50%; float:left; margin-bottom:30px;}
.footer-right{width:50%; float:right;}
}
</style>

<?php
global $wpdb;
$current_url = home_url($_SERVER['REQUEST_URI']);

$chk_old=0;
if(isset($_POST['submit']) and $_POST['post_id']!='' and $_POST['rating']!='')
{
	$posts_id=$_POST['post_id'];
	$rating=$_POST['rating'];
	$cur_user_id=get_current_user_id();
	
	$date = date('d-m-Y');
	$ins_q="INSERT INTO wp_company_rating (post_id, user_id, rating,`date`) VALUES ('$posts_id','$cur_user_id', '$rating','$date')";
// 	echo $ins_q;
	$wpdb->query($ins_q);
	echo "<script>window.location.href='".$current_url."'</script>";
}

?>

<?php 
$post_ids=array();
?>
<section id="main-container" class="main-content <?php echo apply_filters( 'entaro_company_content_class', 'container' ); ?> inner">
	<div class="row">
		<?php
            $class = '';
            if ( isset($sidebar_configs['left']) ) {
                $class = 'pull-right';
            }
        ?>
		<div id="main-content" class="col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class'].' '.$class); ?>">
			<div id="primary" class="content-area detail-company">
				<div id="content" class="site-content" role="main">
						<div class="top-content">
							<?php the_post(); ?>
								<div class="job-content-wrapper ">
									<div class="top-info">
										<div class="col-md-8">
										<?php the_company_logo('full'); ?>
										<div class="info-company">
											<h3 class="title-company"><?php the_company_name( '<strong>', '</strong> ' ); ?>
											<span class="fsrs" style="font-size:14px" id="comrat">
											  
											  
											</span>
										</h3>
											<?php the_company_tagline( '<p class="tagline">', '</p>' ); ?>
											<div class="company">
												<i aria-hidden="true" class="text-second fa fa-map-marker"></i>
												<?php the_job_location( false ); ?>
											</div>
										</div>
										</div>
										<div class="col-md-4">
											<!-- 				Manual Review Code					 -->
											<div class="row">

												<?php
											
												if($chk_old==0 && is_user_logged_in()){
													$current_user = wp_get_current_user();
											
													$user = wp_get_current_user();
													/*if(!empty($current_user->roles[1]) && $current_user->roles[1]=='candidate')
													{
													 //*/   //print($current_user->roles[1]);
												?>
												<button class="btn btn-primary" id="rabutton" style="float:right;" data-toggle="modal" data-target="#wordpressLoginModal1">
													Rate this company
												</button>


												<?php
											/*	}*/
												
															
												}
												?>

											</div>
											<!-- 			END	Manual Review Code					 -->
										</div>
									</div>
									<!-- social share -->
									<?php if ( entaro_get_config('show_job_company_social_share') ) { ?>
										<?php get_template_part('template-parts/sharebox'); ?>
									<?php } ?>
									<!-- company link -->
									<div class="link-more-company">
									<?php if ( $website = get_the_company_website() ) : ?>
										<a class="website" href="<?php echo esc_url( $website ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-link text-theme"></i> <?php echo trim($website); ?></a>
									<?php endif; ?>

									<?php
										$company_twitter = get_the_company_twitter( $post );
										if ( $company_twitter ) :
											$company_twitter = $company_twitter;
									?>
										<a class="twitter" href="<?php echo esc_url( $company_twitter ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-twitter text-theme"></i> <?php echo trim(get_the_company_twitter( $post )); ?></a>
									<?php endif; ?>


									<?php
										$facebook = get_post_meta( get_the_ID(), '_company_facebook', true);
										if ( $facebook ) :
											$company_facebook = $facebook;
									?>
										<a class="facebook" href="<?php echo esc_url( $company_facebook ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-facebook text-theme"></i> <?php echo trim(get_post_meta( get_the_ID(), '_company_facebook', true)); ?></a>
									<?php endif; ?>

									<?php
										$gplus = get_post_meta( get_the_ID(), '_company_gplus', true);
										if ( $gplus ) :
											$company_gplus = $gplus;
									?>
										<a class="gplus" href="<?php echo esc_url( $company_gplus ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-google-plus text-theme"></i> <?php echo trim(get_post_meta( get_the_ID(), '_company_gplus', true)); ?></a>
									<?php endif; ?>
									
									<?php
										$linkedin = get_post_meta( get_the_ID(), '_company_linkedin', true);
										if ( $linkedin ) :
											$company_linkedin = $linkedin;
									?>
										<a class="linkedin" href="<?php echo esc_url( $company_linkedin ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-linkedin text-theme"></i> <?php echo trim(get_post_meta( get_the_ID(), '_company_linkedin', true)); ?></a>
									<?php endif; ?>

									<?php
										$pinterest = get_post_meta( get_the_ID(), '_company_pinterest', true);
										if ( $pinterest ) :
											$company_pinterest =$pinterest;
									?>
										<a class="pinterest" href="<?php echo esc_url( $company_pinterest ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-pinterest text-theme"></i> <?php echo trim(get_post_meta( get_the_ID(), '_company_pinterest', true)); ?></a>
									<?php endif; ?>
									</div>

								</div>
								<div class="job-content-description-wrapper">
									<?php the_company_video(); ?>
								<!--	<?php $content = get_post_meta(get_the_ID(), '_company_description', true);
										if ( !empty($content) ) {
											echo wp_kses_post($content);
										}
									?>-->
								</div>
							<?php rewind_posts(); ?>
						</div>
						<?php while ( have_posts() ) : the_post();?>
							<div class="job_listings">
								<?php get_template_part( 'job_manager/loop/list'); ?>
							</div>
							
						<?php   
							
					array_push($post_ids,$post->ID);
						
					endwhile;
					$all_post_ids='';
					$k=0;
					foreach ($post_ids as $pid)
					{
						if($k==0)
						{
							$all_post_ids=$pid;
							$k=1;
						}
						else{
							$all_post_ids.=','.$pid;
							
						}
					}
					$cur_user_id=get_current_user_id();
					$nsql="SELECT * FROM wp_company_rating WHERE user_id='$cur_user_id' ";
					//echo $nsql;
					$results = $wpdb->get_results($nsql);
					$chi=0;
					foreach($results as $res)
					{
						$pids = $res->post_id;
						$paray =explode(',',$pids);
						foreach($paray as $pi)
						{
							if(in_array($pi,$post_ids))	{
								$chi=1;
								break;
							}
						}
							
					} 
				
				$nsql2="SELECT * FROM wp_company_rating ";
				$all_cmp_data = $wpdb->get_results($nsql2);
			
				$cmp_rate=array();
				foreach($all_cmp_data as $cmp){
					$rm=0;
					$pids = $cmp-> post_id;
						$paray =explode(',',$pids);
						foreach($paray as $pi)
						{
							if(in_array($pi,$post_ids))	{
								$rm=1;
							}
						}
					if($rm==1)
					{
							array_push($cmp_rate,$cmp->rating);
					}
					

				}
			
			
			$sum_of_ratings=array_sum($cmp_rate);
				$total_count_rating=count($cmp_rate);
				
					if($total_count_rating != 0)
				{
				    $avg_rating=round($sum_of_ratings/ $total_count_rating);
				    
					
				}
				else{
				
<?php
$cur_user_id=get_current_user_id();
					$bnsql="SELECT * FROM wp_company_rating WHERE user_id='$cur_user_id' ";
					$starss=$wpdb->prepare($bnsql);
$starsresult=$starss->fetch(PDO::FETCH_ASSOC);
$starss->execute();
while ($rowst=$stdetails->fetch(PDO::FETCH_ASSOC)) {
?>
				 $avg_rating=$rowst['rating'];
				<?php  } ?> 
				}
					$a1='';
					$a2='';
					$a3='';
					$a4='';
					$a5='';
					if(round($avg_rating)>0)
					{
						$a1='frcback';
					}
					if(round($avg_rating)>1)
					{
					$a2='frcback';
						
					}
					if(round($avg_rating)>2)
					{
						$a3='frcback';

					}
					if(round($avg_rating)>3)
					{
						$a4='frcback';

					}
					if(round($avg_rating)>4)
					{
						$a5='frcback';

					}
				$rat=' <span class="fsrs-stars"><i class="fa fa-star '.$a1.'"></i><i class="fa fa-star '.$a2.'"></i><i class="fa fa-star '.$a3.'"></i><i class="fa fa-star '.$a4.'"></i><i class="fa fa-star '.$a5.'"></i></span><span class="fsrs-text fsrs-text__visible" aria-hidden="false">'.round($avg_rating).' out of 5 ('.$total_count_rating.')</span>';
					if($chi==1)
					{ ?>
						<script>
							document.getElementById('rabutton').style.display="none";
							document.getElementById('comrat').innerHTML ='aa';
							
					</script>
					<?php }
					?>
					<script>	
						
						document.getElementById('comrat').innerHTML ='<?php echo $rat; ?>';
					</script>
<div class="modal fade" id="wordpressLoginModal1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Rate this company
        </h4>
      </div>
      <div class="modal-body">
        	<div class="rating-form1">
				<?php
				if ( in_array( 'candidate', (array) $user->roles ) ) {
					?>
											<!-- RATING - Form -->
											<form class="rating-form" action="#" method="post" name="rating-movie">
											  <fieldset class="form-group">

												<legend class="form-legend">Rating:</legend>

												<div class="form-item">

												  <input id="rating-5" name="rating" type="radio" value="5" />
												  <label for="rating-5" data-value="5">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">5</span>
												  </label>
												  <input id="rating-4" name="rating" type="radio" value="4" />
												  <label for="rating-4" data-value="4">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">4</span>
												  </label>
												  <input id="rating-3" name="rating" type="radio" value="3" />
												  <label for="rating-3" data-value="3">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">3</span>
												  </label>
												  <input id="rating-2" name="rating" type="radio" value="2" />
												  <label for="rating-2" data-value="2">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">2</span>
												  </label>
												  <input id="rating-1" name="rating" type="radio" value="1" />
												  <label for="rating-1" data-value="1">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">1</span>
												  </label>
													<div class="form-action form-output">
													? / 5
												  </div>
												  <div class="form-action">
													<input class="btn-reset" type="reset" value="Reset" />   																<input type="hidden" name="post_id" id="post_id" value="<?=$all_post_ids?>">
													  <input type="submit" name='submit' value="submit" class="btn">
												  </div>

												  

												</div>

											  </fieldset>
											</form>
				<?php
				} else {
					echo "<div class='text-center'> <div style='margin:0 auto;'> <b class='text-danger fa fa-times'> You Are Not Eligible For Company Rating..</b></div> </div>";
				}
						?>
										</div>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="wordpressLoginModal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
          Rate this company
        </h4>
      </div>
      <div class="modal-body">
        	<div class="rating-form1">
				<?php
				if ( in_array( 'candidate', (array) $user->roles ) ) {
					?>
											<!-- RATING - Form -->
											<form class="rating-form" action="#" method="post" name="rating-movie">
											  <fieldset class="form-group">

												<legend class="form-legend">Rating:</legend>

												<div class="form-item">

												  <input id="rating-5" name="rating" type="radio" value="5" />
												  <label for="rating-5" data-value="5">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">5</span>
												  </label>
												  <input id="rating-4" name="rating" type="radio" value="4" />
												  <label for="rating-4" data-value="4">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">4</span>
												  </label>
												  <input id="rating-3" name="rating" type="radio" value="3" />
												  <label for="rating-3" data-value="3">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">3</span>
												  </label>
												  <input id="rating-2" name="rating" type="radio" value="2" />
												  <label for="rating-2" data-value="2">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">2</span>
												  </label>
												  <input id="rating-1" name="rating" type="radio" value="1" />
												  <label for="rating-1" data-value="1">
													<span class="rating-star">
													  <i class="fa fa-star-o"></i>
													  <i class="fa fa-star"></i>
													</span>
													<span class="ir">1</span>
												  </label>
													<div class="form-action form-output">
													? / 5
												  </div>
												  <div class="form-action">
													<input class="btn-reset" type="reset" value="Reset" />   																<input type="hidden" name="post_id" id="post_id" value="<?=$all_post_ids?>">
													  <input type="submit" name='submit' value="submit" class="btn">
												  </div>

												  

												</div>

											  </fieldset>
											</form>
				<?php
				} else {
					echo "<div class='text-center'> <div style='margin:0 auto;'> <b class='text-danger fa fa-times'> You Are Not Eligible For Company Rating..</b></div> </div>";
				}
						?>
										</div>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
					<div class="hide all_post_ids">
						<input type="hidden" value="<?=$all_post_ids?>" name="all_post_ids" id="all_post_ids">
					</div>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>
		<?php if ( isset($sidebar_configs['left']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
				   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
				   	<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>

		<?php if ( isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
			  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
				   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
				   	<?php endif; ?>
			  	</aside>
			</div>
		<?php endif; ?>
	</div>	
</section>	
</div>
		
<footer id="apus-footer" class="apus-footer" role="contentinfo">
		<div class="footer-inner">
							<div class="clearfix "><div class="footer-builder-wrapper container footer-1"><p></p><div data-vc-full-width="true" data-vc-full-width-init="true" data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid vc_custom_1513582546419 vc_row-has-fill" style="position: relative; left: -120px; box-sizing: border-box; width: 1440px;"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1513582147833 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="vc_empty_space  hidden-xs" style="height: 37px"><span class="vc_empty_space_inner"></span></div><div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div><div class="widget-newletter  ">
	<div class="table-visiable-dk">
		<div class="left-content">
							<div class="icon-img">
	        		<img src="https://www.deemad.com/wp-content/uploads/2017/12/Icon.png" alt="Image">
	        	</div>
	        	        <div class="right-content">
			    			        <h3 class="title">
			            Get Job Notifications			        </h3>
			    			    					<div class="description">
						Subscribe our newsletter for free NOW!!					</div>
							</div>
		</div>
		<div class="content"> 
			<script>(function() {
	window.mc4wp = window.mc4wp || {
		listeners: [],
		forms: {
			on: function(evt, cb) {
				window.mc4wp.listeners.push(
					{
						event   : evt,
						callback: cb
					}
				);
			}
		}
	}
})();
</script><!-- Mailchimp for WordPress v4.8.3 - https://wordpress.org/plugins/mailchimp-for-wp/ --><form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-123" method="post" data-id="123" data-name="Contact"><div class="mc4wp-form-fields">				<div class="input-group"> 
	<div class="input-group-btn left">
		<input class="form-control" type="email" name="EMAIL" placeholder="Type your Email Address" required="">
	</div>
	<span class="input-group-btn"> 
		<button type="submit" class="btn btn-second"><i aria-hidden="true" class="fa fa-plus-circle"></i> Submit</button> 
	</span> 
</div>		</div><label style="display: none !important;">Leave this field empty if you're human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off"></label><input type="hidden" name="_mc4wp_timestamp" value="1644430133"><input type="hidden" name="_mc4wp_form_id" value="123"><input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1"><div class="mc4wp-response"></div></form><!-- / Mailchimp for WordPress Plugin -->		</div>
	</div>
</div><div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div><div class="vc_empty_space  hidden-xs" style="height: 37px"><span class="vc_empty_space_inner"></span></div></div></div></div></div><div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div><div class="vc_empty_space  hidden-xs" style="height: 30px"><span class="vc_empty_space_inner"></span></div>
	<div class="wpb_single_image wpb_content_element vc_align_center  vc_custom_1631848518400">
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img style="margin-left:40%;" width="159" height="49" src="https://www.deemad.com/wp-content/uploads/2021/09/logo1.png" class="vc_single_image-img attachment-full" alt="" loading="lazy"></div>
		</figure>
	
	</div>
<div class="vc_empty_space" style="height: 0px"><span class="vc_empty_space_inner"></span></div><div class="vc_empty_space  hidden-xs" style="height: 0px"><span class="vc_empty_space_inner"></span></div><div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_custom_1513582102112  vc_custom_1513582102112"><span class="vc_sep_holder vc_sep_holder_l"><span style="border-color:#262b3c;" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span style="border-color:#262b3c;" class="vc_sep_line"></span></span>
</div></div></div></div></div><div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="vc_empty_space" style="height: 0px"><span class="vc_empty_space_inner"></span></div><div class="vc_empty_space  hidden-xs" style="height: 20px"><span class="vc_empty_space_inner"></span></div></div></div></div></div>
<hr style="height:2px;border-width:0;color:gray;background-color:gray;opacity:0.1;">
<div class="vc_row wpb_row vc_inner vc_row-fluid box-container topmargin"><div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-3"><div class="vc_column-inner"><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<div class="widget-about widget widgetff ">
<h3 class="widget-title">Who We Are</h3>
<div class="content">
<div class="space-20">
<p>DeeMad provides an exclusive hiring platform to any organization, company, educational institution etc. that promotes social change, development, cohesion, empowerment of communities and people,<span class="Apple-converted-space">&nbsp;</span>NGO, animal shelter, Media/News Company etc.</p></div>
</div>
</div>
<div class="readmore-link"><a class="link-more" href="https://www.deemad.com/about-us/"><i class="fa fa-plus-circle" aria-hidden="true"></i>Read More</a></div>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-4 vc_col-lg-3 vc_col-md-3"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="apus_custom_menu wpb_content_element ">
    <div  class="widget widget_nav_menu widgetff widgetsecond" ><h2 class="widgettitle">CANDIDATES</h2><div class="menu-footer-1-container"><ul id="menu-footer-1" class="menu"><li id="menu-item-1323" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1323"><a href="https://www.deemad.com/submit-resume/">Add a Resume</a></li>
<li id="menu-item-1324" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1324"><a href="https://www.deemad.com/candidate-dashboard/">Candidate’s Dashboard</a></li>
<li id="menu-item-945" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-945"><a href="https://www.deemad.com/candidate-dashboard/">Past Applications</a></li>
<li id="menu-item-1321" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1321"><a href="https://www.deemad.com/362-2/">Job Favorites</a></li>
<li id="menu-item-1322" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1322"><a href="https://www.deemad.com/my-account/">My Account</a></li>
</ul></div></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-4 vc_col-lg-3 vc_col-md-3"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="apus_custom_menu wpb_content_element ">
    <div class="widget widget_nav_menu widgetf widgetth"><h2 class="widgettitle">Employers</h2><div class="menu-footer-2-container"><ul id="menu-footer-2" class="menu"><li id="menu-item-950" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-950"><a href="https://www.deemad.com/resume/">List Of Candidates</a></li>
<li id="menu-item-1325" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1325"><a href="https://www.deemad.com/job-dashboard/">Employer’s Dashboard</a></li>
<li id="menu-item-1326" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1326"><a href="https://www.deemad.com/post-a-job/">Post a Job</a></li>
<li id="menu-item-1327" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1327"><a href="https://www.deemad.com/jobs/">Jobs</a></li>
<li id="menu-item-1328" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1328"><a href="https://www.deemad.com/shop/">Plans</a></li>
<li id="menu-item-1329" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1329"><a href="https://www.deemad.com/my-account/">My Account</a></li>
</ul></div></div></div></div></div></div><div class="wpb_column vc_column_container vc_col-sm-4 vc_col-lg-3 vc_col-md-3"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="apus_custom_menu wpb_content_element ">
    <div class="widget widget_nav_menu widgetff widgetfour"><h2 class="widgettitle">Information</h2><div class="menu-footer-3-container"><ul id="menu-footer-3" class="menu"><li id="menu-item-1330" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1330"><a href="https://www.deemad.com/about-us/">About Us</a></li>
<li id="menu-item-1354" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1354"><a href="https://www.deemad.com/terms-conditions/">Terms &amp; Conditions</a></li>
<li id="menu-item-1358" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-1358"><a href="https://www.deemad.com/privacy-policy/">Privacy Policy</a></li>
<li id="menu-item-1362" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1362"><a href="https://www.deemad.com/work-with-us/">Work With Us</a></li>
<li id="menu-item-961" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-961"><a href="https://www.deemad.com/sitemap.xml">Sitemap</a></li>
<li id="menu-item-1359" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1359"><a href="https://www.deemad.com/contact-us/">Contact Us</a></li>
<li id="menu-item-1365" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1365"><a href="https://www.deemad.com/faqs/">FAQ’s</a></li>
</ul></div></div></div></div></div></div></div>
<hr style="height:2px;border-width:0;color:gray;background-color:gray;opacity:0.1;">

<div class="vc_row wpb_row vc_inner vc_row-fluid apus-copyright box-container"><div class="wpb_column vc_column_container vc_col-sm-6 footer-left"><div class="vc_column-inner"><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  vc_custom_1622824921872">
		<div class="wpb_wrapper">
			<p>©️ 2021 DeeMad. All Rights Reserved.</p>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-6 footer-right"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="widget widget-social  right ">
        <div class="widget-des">
    			<ul class="social">
		    		                <li>
		                    <a href="https://www.facebook.com/DeeMad-108348938013320/" class="facebook">
		                        <i class="fa fa-facebook "></i>
		                    </a>
		                </li>
		    		                <li>
		                    <a href="https://twitter.com/DeeMad21?t=zzIi6GctPyg-HCHWnbuJNw&amp;s=09" class="twitter">
		                        <i class="fa fa-twitter "></i>
		                    </a>
		                </li>
		    		                <li>
		                    <a href="https://www.youtube.com/channel/UC0VGHjS9-Ai7M1fBqQSsVBg" class="youtube">
		                        <i class="fa fa-youtube "></i>
		                    </a>
		                </li>
		    		                <li>
		                    <a href="https://www.pinterest.com/deemad21/_saved/" class="pinterest">
		                        <i class="fa fa-pinterest "></i>
		                    </a>
		                </li>
		    		                <li>
		                    <a href="https://business.google.com/dashboard/l/11412598687114659104" class="google-plus">
		                        <i class="fa fa-google-plus "></i>
		                    </a>
		                </li>
		    		                <li>
		                    <a href="https://www.instagram.com/deemad21/" class="instagram">
		                        <i class="fa fa-instagram "></i>
		                    </a>
		                </li>
		    		</ul>
	</div>
</div></div></div></div></div><div class="vc_empty_space  hidden-xs" style="height: 25px"><span class="vc_empty_space_inner"></span></div></div></div></div></div><div class="vc_row-full-width vc_clearfix"></div><p></p>
</div></div>					</div>
					<a href="#" id="back-to-top" class="add-fix-top active">
				<i class="fa fa-angle-up" aria-hidden="true"></i>
			</a>
			</footer><!-- .site-footer -->
		
</div> <!-- .site -->

	<link rel='stylesheet' id='js_composer_front-css'  href='http://talocare.co.in/jobportal/demo/wp-content/plugins/js_composer/assets/css/js_composer.min.css?ver=6.5.0' type='text/css' media='all' />

	<?php get_template_part('sidebar'); ?>
	

<?php get_template_part('footer'); ?>
<script>
	
	
jQuery(document).ready(function( $ ) {
		$('a[title]').removeAttr('title');
		var top=1;
	$('.review_btn').click(function(){

		if(top==1) {
			$('.rating-form1').removeClass('hide');
			$('.review_btn').html('Close');
			top=2;
		} else {
			$('.rating-form1').addClass('hide');
			$('.review_btn').html('Write Rating');
			top=1;
		}
		$('#post_id').val($('#all_post_ids').val());
		
	});
	
// 	Required The Post Job Form Field Job category
	$('#job_category').prop('required',true);
// End Required The Post Job Form Field Job category
// 
	
});
	</script>
	<?php if ( !function_exists( 'entaro_footer_metaboxes' ) ) {
	function entaro_footer_metaboxes(array $metaboxes) {
		$prefix = 'apus_footer_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Footer Style', 'entaro' ),
				'id'   => $prefix.'style_class',
				'type' => 'select',
				'options' => array(
					'container' => esc_html__('Boxed', 'entaro'),
					'full' => esc_html__('Full', 'entaro'),
				)
			),
			array(
				'name' => esc_html__( 'Footer Background Color', 'entaro' ),
				'id'   => $prefix.'background_class',
				'type' => 'select',
				'options' => array(
					'' => esc_html__('Dark 1', 'entaro'),
					'dark2' => esc_html__('Dark 2', 'entaro'),
				)
			),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'entaro' ),
			'object_types'              => array( 'apus_footer' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'entaro_footer_metaboxes' );?>
</body>
</html>