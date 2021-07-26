<?php
/**
 * Facebook Instant Articles (Custom Ads).
 */

header( 'Content-Type: ' . feed_content_type( 'rss2' ) . '; charset=' . get_option( 'blog_charset' ), true );
echo '<?xml version="1.0" encoding="' . esc_attr( get_option( 'blog_charset' ) ) . '"?' . '>';

$last_modified = null;
$date_timezone = new DateTimeZone('Asia/Jakarta');

/* Tambah Filter untuk Manipulasi Post Content */
add_filter( 'the_content', 'ads_inside_content' );
function ads_inside_content( $content ) {
	$output = $content;
	//We don't want to modify the_content in de admin area
	$ads = '<!-- Kode Iklan MGID (In Artikel) --><figure class="op-ad"><iframe>' . get_option('custom_ads_code_middle') . '</iframe></figure></p>';
	$p_array = explode('<p>', $content);
	$p_count = 8;

	if( !empty( $p_array ) ){

		array_splice( $p_array, $p_count, 0, $ads );
		$output = '';

		foreach( $p_array as $key=>$value ){
			$start_paragraph = '';
			if($key !== 0) {
				$start_paragraph = '<p>';
			}
			$output .= $start_paragraph . $value;
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
			// Posts are sorted by modification time, so our first accepted post should be the one last modified.
			if ( is_null( $last_modified ) ) {
				$last_modified = get_post_modified_time( 'Y-m-d H:i:s', true, get_the_ID() );
			}
			?>
			<item>
				<title><?php echo esc_html( get_the_title() ); ?></title>
				<link><?php echo esc_url( get_permalink() ); ?></link>
				<content:encoded>
					<![CDATA[<!doctype html><html><head><link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>"/><meta charset="utf-8"/><meta property="op:generator" content="facebook-instant-articles-sdk-php"/><meta property="op:generator:version" content="1.10.0"/><meta property="op:generator:application" content="facebook-instant-articles-wp"/><meta property="op:generator:application:version" content="4.2.1"/><meta property="op:generator:transformer" content="facebook-instant-articles-sdk-php"/><meta property="op:generator:transformer:version" content="1.10.0"/><meta property="op:markup_version" content="v1.0"/><meta property="fb:use_automatic_ad_placement" content="enable=true ad_density=default"/><meta property="fb:article_style" content="default"/></head><body><article><!-- Kode iklan facebook audiense network (auto ads)--><figure class="op-ad"><iframe src="https://www.facebook.com/adnw_request?placement=<?php echo get_option('facebook_audience_network'); ?>&adtype=banner300x250" width="300" height="250"></iframe></figure><?php apply_filters( 'ads_inside_content', true, the_content() ); // echo the_content(); ?><!-- Kode Iklan MGID (Bawah Artikel) --><figure class="op-ad"><iframe><?php echo get_option('custom_ads_code_bottom'); ?></iframe></figure><footer><small>Copyright <?php echo date("Y"); ?> <?php bloginfo_rss( 'name' ); ?></small></footer><!-- Tracking Kode (Histats) --><figure class="op-tracker"><iframe><?php echo get_option('custom_script'); ?></iframe></figure></article></body></html>]]>
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
