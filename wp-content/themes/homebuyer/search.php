<?php /* Template Name: Search Page */ ?>

<?php get_header(); ?>

<div class="search_result">
	<div class="container">
		<?php
		global $query_string;
		$query_args = explode("&", $query_string);
		$search_query = array();

		foreach($query_args as $key => $string) {
			$query_split = explode("=", $string);
			$search_query[$query_split[0]] = urldecode($query_split[1]);
		} // foreach

		$the_query = new WP_Query($search_query);
		if ( $the_query->have_posts() ) : 
		?>
		<!-- the loop -->
		<h3> <?php printf( __( 'Results for %s', 'shape' ), '<span>"' . get_search_query() . '"</span>' ); ?></h3>
		<ul>    
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<p>	<?php
					$char_limit = 400; //character limit
					$content = $post->post_content; //contents saved in a variable
					echo substr(strip_tags($content), 0, $char_limit);
					?>
				</p>
			</li>   
			<?php endwhile; ?>
		</ul>


		<?php wp_reset_postdata(); ?>

		<?php else : ?>
		<h3> <?php printf( __( 'Results for %s', 'shape' ), '<span>"' . get_search_query() . '"</span>' ); ?></h3>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?> <br> <br>
			<?php _e( 'Try rewording your query, or browse through our site.' ); ?> 
		</p>
		<?php endif; ?>

	</div></div>


<?php get_footer(); ?>