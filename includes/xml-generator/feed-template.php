<?php
/**
 * Facebook Instant Articles (Custom Ads).
 */

header( 'Content-Type: ' . feed_content_type( 'rss2' ) . '; charset=' . get_option( 'blog_charset' ), true );
echo '<?xml version="1.0" encoding="' . esc_attr( get_option( 'blog_charset' ) ) . '"?' . '>';

$last_modified = null;
$date_timezone = new DateTimeZone('Asia/Jakarta');

/* Tambah Filter untuk Manipulasi Post Content */
add_filter( 'the_content', 'tbn_ads_inside_content' );
function tbn_ads_inside_content( $content ) {
     
	$output = $content;
	//We don't want to modify the_content in de admin area
	$ads = get_option('custom_ads_code');
	$p_array = explode('<p>', $content );
	$p_count = 8;

	if( !empty( $p_array ) ){

		array_splice( $p_array, $p_count, 0, $ads );
		$output = '';

		foreach( $p_array as $key=>$value ){
			$output .= $value;
		}
	}

    return $output;
}
?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<title><?php bloginfo_rss( 'name' ); ?> - <?php esc_html_e( 'Instant Articles', 'instant-articles' ); ?></title>
		<link><?php bloginfo_rss( 'url' ) ?></link>
		<description><?php bloginfo_rss( 'description' ) ?></description>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php

			/* Tambah Filter untuk Manipulasi Post Content */
			// $contents = apply_filters( 'tbn_ads_inside_content', true, the_content() );
			
			//$instant_article_post = new Instant_Articles_Post( get_post( get_the_id() ) );

			// Allow to disable post submit via filter
			// if ( false === apply_filters( 'instant_articles_should_submit_post', true, $instant_article_post ) ) {
			// 	continue;
			// }

			// If we’re OK with a limited post set: Do not include posts with empty content -- FB will complain.
			// if ( defined( 'INSTANT_ARTICLES_LIMIT_POSTS' ) && INSTANT_ARTICLES_LIMIT_POSTS && ! strlen( trim( $instant_article_post->get_the_content() ) ) ) {
			// 	continue;
			// }

			// Posts are sorted by modification time, so our first accepted post should be the one last modified.
			if ( is_null( $last_modified ) ) {
				$last_modified = get_post_modified_time( 'Y-m-d H:i:s', true, get_the_ID() );
			}
			?>
			<item>
				<title><?php echo esc_html( get_the_title() ); ?></title>
				<link><?php echo esc_url( get_permalink() ); ?></link>
				<content:encoded>
					<![CDATA[<!doctype html><html><head><link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>"/><meta charset="utf-8"/><meta property="op:generator" content="facebook-instant-articles-sdk-php"/><meta property="op:generator:version" content="1.10.0"/><meta property="op:generator:application" content="facebook-instant-articles-wp"/><meta property="op:generator:application:version" content="4.2.1"/><meta property="op:generator:transformer" content="facebook-instant-articles-sdk-php"/><meta property="op:generator:transformer:version" content="1.10.0"/><meta property="op:markup_version" content="v1.0"/><meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=default"/><meta property="fb:article_style" content="default"/></head><body><article><?php apply_filters( 'tbn_ads_inside_content', true, the_content() ); // echo the_content(); ?><figure class="op-ad"><?php echo get_option('custom_ads_code'); ?></figure><footer><small>Copyright <?php echo date("Y"); ?> <?php bloginfo_rss( 'name' ); ?></small></footer></article></body></html>]]>
				</content:encoded>
				<guid isPermaLink="false"><?php esc_html( the_guid() ); ?></guid>
				<description><![CDATA[<?php // echo esc_html( get_the_excerpt() ); ?>]]></description>
				<pubDate><?php $pubDate = new DateTime( get_the_date( 'Y-m-d H:i:s', true, get_the_ID() ), $date_timezone ); echo esc_html( $pubDate->format('c') ); ?></pubDate>
				<modDate><?php $modDate = new DateTime( get_post_modified_time( 'Y-m-d H:i:s', true, get_the_ID() ), $date_timezone ); echo esc_html( $modDate->format('c') ); ?></modDate>
				<author><?php echo esc_html( get_the_author() ); ?></author>
			</item>
		<?php endwhile; ?>
		<?php if ( ! is_null( $last_modified ) ) : ?>
			<lastBuildDate><?php echo esc_html( $last_modified ); ?></lastBuildDate>
		<?php endif; ?>
	</channel>
</rss>
