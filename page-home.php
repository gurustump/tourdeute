<?php
/*
 Template Name: Home Page
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>
			<div id="content">
				<div class="home-sizzle-container">
					<video class="bg-video" id="home_sizzle" autoplay loop muted>
						<source src="<?php echo get_template_directory_uri(); ?>/library/video/home-vid-workmen-medbitrate.mp4" type="video/mp4"></source>
						<source src="<?php echo get_template_directory_uri(); ?>/library/video/home-vid-workmen-medbitrate.webm" type="video/webm"></source>
						<source src="<?php echo get_template_directory_uri(); ?>/library/video/home-vid-workmen-medbitrate.ogv" type="video/ogg"></source>
					</video>
				</div>
				<div id="inner-content" class="wrap cf">
					<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<section class="entry-content" itemprop="articleBody">
								<div class="content-primary">
								<?php the_content(); ?>
								</div>
							</section>
						</article>
						<?php endwhile; endif; ?>
					</main>
				</div>
			</div>
<?php get_footer(); ?>
