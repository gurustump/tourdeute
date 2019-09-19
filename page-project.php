<?php
/*
 Template Name: Project Page
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
									<div class="thumb-list-container video-thumb-list-container">
										<ul class="project-list">
											<?php global $post;
											$items = get_posts(array(
													'posts_per_page'=>-1,
													'post_type'=>'project'/*,
													'orderby'=>'title',
													'order'=>'ASC',
													'media_item_cat'=> $mediaItemCat*/
											));
											foreach($items as $key => $item) {
												$itemThumbArray = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'medium'); $itemMeta = get_post_meta(get_the_ID());
												?>
												<li>
													<div class="thumb-container">
														<img class="thumb" src="<?php echo $itemThumbArray ? $itemThumbArray[0] :'' ?>" />
													</div>
													<div class="item-content-container">
														<h2><?php echo $item->post_title; ?></h2>
														<div class="item-content">
															<?php echo $item->post_content; ?>
														</div>
													</div>
												</li>
											<?php } ?>
										</ul>
									</div>
								<?php the_content(); ?>
								</div>
							</section>
						</article>
						<?php endwhile; endif; ?>
					</main>
				</div>
			</div>
<?php get_footer(); ?>
