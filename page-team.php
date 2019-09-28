<?php
/*
 Template Name: Our Team Page
 *
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div class="header-container">
					<header class="article-header wrap">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</header>
				</div>
				<div id="inner-content" class="wrap cf">
					<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<section class="entry-content" itemprop="articleBody">
								<div class="content-primary">
									<?php if (get_the_content()) { ?>
									<div class="content-body"><?php the_content(); ?></div>
									<?php } ?>
									<?php $teamPeople = get_posts(array(
										'posts_per_page'=>-1,
										'post_type'=>'person'
									)); ?>
									<div class="profile-list">
									<?php foreach($teamPeople as $key => $person) {
										$personThumbArray = wp_get_attachment_image_src( get_post_thumbnail_id($person->ID), 'thumbnail');
										$personMeta = get_post_meta($person->ID);
										?>
										<div class="profile-item">
											<?php if ($personThumbArray) { ?>
											<div class="img-container">
												<img src="<?php echo $personThumbArray[0]; ?>" alt="<?php echo $person->post_title; ?>" width="<?php echo $personThumbArray[1]; ?>" height="<?php echo $personThumbArray[2]; ?>" />
											</div>
											<?php } ?>
											<div class="profile-text">
												<span class="profile-name"><?php echo $person->post_title; ?></span>
												<span class="profile-title"><?php echo $personMeta['_guru_person_title'][0]; ?></span>
											</div>
										</div>
									<?php } ?>
									
									<?php /*
										<div class="profile-item"><div class="img-container"><img class="alignnone wp-image-63 size-thumbnail" src="http://localhost.gurustump.com/tourdeute/wp-content/uploads/Juanita-2-300x300.jpg" alt="" width="300" height="300" /></div><div class="profile-text"><span class="profile-name">Juanita PlentyHoles</span><span class="profile-title">Tiwahe Director</span></div></div>
										<div class="profile-item"><div class="img-container"><img class="alignnone wp-image-65 size-thumbnail" src="http://localhost.gurustump.com/tourdeute/wp-content/uploads/Antoinette-300x300.jpg" alt="Antoinette" width="300" height="300" /></div><div class="profile-text"><span class="profile-name">Antoinette Porambo</span><span class="profile-title">Community Resource Specialist</span></div></div>
										<div class="profile-item"><div class="img-container"><img class="alignnone wp-image-66 size-thumbnail" src="http://localhost.gurustump.com/tourdeute/wp-content/uploads/Bernadette-300x300.jpg" alt="" width="300" height="300" /></div><div class="profile-text"><span class="profile-name">Bernadette Cuthair</span><span class="profile-title">Planning Director</span></div></div>
										<div class="profile-item"><div class="img-container"><img class="alignnone wp-image-64 size-thumbnail" src="http://localhost.gurustump.com/tourdeute/wp-content/uploads/Priscilla--300x300.jpg" alt="Our Team 3" width="300" height="300" /></div><div class="profile-text"><span class="profile-name">Priscilla BlackHawk</span><span class="profile-title">Court Administrator</span></div></div>
										<div class="profile-item"><div class="img-container"></div><div class="profile-text"><span class="profile-name">Beverly Santicola</span><span class="profile-title">Grant Writer</span></div></div>
										<div class="profile-item"><div class="img-container"></div><div class="profile-text"><span class="profile-name">Ronald Scott</span>	<span class="profile-title">Grants and Contracts Administrator</span></div></div>
										<div class="profile-item"><div class="img-container"></div><div class="profile-text"><span class="profile-name">Todd Giesen</span>	<span class="profile-title">Mugua-n Behavioral Health Project Director</span></div></div> */ ?>
									</div>
								</div>
							</section>
						</article>
						<?php endwhile; endif; ?>
					</main>
				</div>
			</div>
<?php get_footer(); ?>
