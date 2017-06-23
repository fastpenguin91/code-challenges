<?php
/**
 * Template Name: Archive Challenge
 */

get_header();

?>
<div id="primary">
    <div id="content" role="main">
        <?php
        $num_of_posts = wp_count_posts('code_challenge');
        global $wpdb;
        $db_name = $wpdb->prefix . 'jsc_challenge_user';

        $user = wp_get_current_user();
        $paged = ( get_query_var('paged') );
        $num_of_solved_challenges = $wpdb->get_results( "SELECT COUNT(*) AS post_count FROM $db_name WHERE user_id = $user->ID");
        $mypost = array( 'post_type' => 'code_challenge', 'paged' => $paged );
        $loop = new WP_Query( $mypost );
        ?>

        <h1 class="challenge-title">Code Challenges</h1>
        
        <h2 style="text-align: center;">Solved <?php echo $num_of_solved_challenges[0]->post_count; ?> of <?php echo $num_of_posts->publish; ?> challenges: <a class="challenge-link" href="../unsolved-challenges/">View Unsolved</a></h2>
        <?php
        while ( $loop->have_posts() ) : $loop->the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <a href="<?php the_permalink(); ?>">
                    <div class="code_challenge_list_item">
                        <h2>Challenge: <?php the_title(); ?></h2><br />
                    </div>
                </a>
            </article>
            
        <?php endwhile; ?>
        <div class="challenge-pagination">
            <span><?php next_posts_link( 'older posts' , $loop->max_num_pages ); ?></span>
            <span><?php previous_posts_link( 'Newer posts' );?></span>
        </div>
        


    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
