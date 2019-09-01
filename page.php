<?php get_header(); ?>

			<?php $bg = get_post_meta(get_the_ID(),'_guru_page_page_bg',true); ?>
			<div id="content"<?php echo $bg ? 'class="has-bg" style="background-image:url('.$bg.')"' : ''; ?>>
				<div class="header-container">
					<header class="article-header wrap">
						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
					</header> <?php // end article header ?>
				</div>
				<div id="inner-content" class="wrap cf">
					<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
							<?php $hasContentSecondary = is_active_sidebar('sidebar1'); ?>
							<section class="entry-content<?php echo $hasContentSecondary ? ' has-content-secondary':''; ?>" itemprop="articleBody">
								<div class="content-primary">
									<?php the_content(); ?>
								</div>
								<?php if ($hasContentSecondary) { ?>
								<div class="content-secondary">
									<?php if (is_active_sidebar('sidebar1')) { 
										get_sidebar();
									} ?>
								</div>
								<?php } ?>
							</section> <?php // end article section ?>
							<?php comments_template(); ?>
						</article>
						<?php endwhile; endif; ?>
					</main>
				</div>
			</div>
<?php get_footer(); ?>
