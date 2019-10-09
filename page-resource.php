<?php
/*
 Template Name: Resources Page
 *
*/
?>

<?php get_header(); ?>
			<?php $bgURL = get_post_meta(get_the_ID(),'_guru_page_page_bg',true); 
			$bgID = attachment_url_to_postid($bgURL);
			$bg = wp_get_attachment_image_url($bgID, 'extra-large');
			$icDownloadDoc = file_get_contents(get_stylesheet_directory().'/library/images/ic-download-doc.svg');
			?>
			<div id="content"<?php echo $bg ? 'class="has-bg" style="background-image:url('.$bg.')"' : ''; ?>>
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
									<div class="entry-content-inner">
										<?php the_content(); ?>
									</div>
									<div class="thumb-list-container">
										<ul class="info-list">
											<?php global $post;
											$items = get_posts(array(
													'posts_per_page'=>-1,
													'post_type'=>'resource'/*,
													'orderby'=>'title',
													'order'=>'ASC',
													'media_item_cat'=> $mediaItemCat*/
											));
											foreach($items as $key => $item) {
												$itemThumbArray = wp_get_attachment_image_src( get_post_thumbnail_id($item->ID), 'medium');
												$itemMeta = get_post_meta($item->ID);
												if ($itemMeta['_guru_resource_resource_file_id'][0]) { ?>
												<li>
													<div class="thumb-container">
														<a target="_blank" href="<?php echo $itemMeta['_guru_resource_resource_file'][0]; ?>">
															<?php if ($itemThumbArray) { ?>
															<img class="thumb" src="<?php echo $itemThumbArray[0]; ?>" />
															<?php } else {
															echo $icDownloadDoc;
															} ?>
														</a>
													</div>
													<div class="item-content-container">
														<h2><a target="_blank" href="<?php echo $itemMeta['_guru_resource_resource_file'][0]; ?>"><?php echo $item->post_title; ?></a></h2>
														<div class="item-content">
															<?php echo $item->post_content; ?>
															<a href="<?php echo $itemMeta['_guru_resource_resource_file'][0]; ?>" class="btn-turquoise-dark btn-download">Download</a>
														</div>
													</div>
												</li>
												<?php } } ?>
										</ul>
									</div>
								</div>
							</section>
						</article>
						<?php endwhile; endif; ?>
					</main>
				</div>
			</div>
<?php get_footer(); ?>
