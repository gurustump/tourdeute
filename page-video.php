<?php
/*
 Template Name: Video Page
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
										<ul class="thumb-list VID_THUMBS_LIST">
											<?php global $post;
											$items = get_posts(array(
													'posts_per_page'=>-1,
													'post_type'=>'video'/*,
													'orderby'=>'title',
													'order'=>'ASC',
													'media_item_cat'=> $mediaItemCat*/
											));
											foreach($items as $key => $item) {
												$post = $item;
												setup_postdata($post);
												$itemThumbArray = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'movie-thumb'); $itemMeta = get_post_meta(get_the_ID());
												?>
												<li class="thumb-item">
													<?php if ($itemMeta['_guru_video_video_ID'][0]) { ?>
													<a class="btn-play VIDEO_PLAY" href="<?php the_permalink(); ?>" 
														data-video-ID="<?php echo $itemMeta['_guru_video_video_ID'][0]; ?>">
														<span class="thumb-container">
															<img class="thumb" src="<?php echo $itemThumbArray ? $itemThumbArray[0] : getVimeoThumbnail($itemMeta['_guru_video_video_ID'][0]); ?>" />
														</span>
														<span class="thumb-title"><span><?php the_title(); ?></span></span>
													</a>
													<?php } ?>
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
