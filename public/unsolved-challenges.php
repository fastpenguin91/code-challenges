<?php
/**
 * Template Name: Unsolved Challenges
 */

get_header();
?>

<div id="primary">
    <div id="content" role="main">
        <?php
        global $wpdb;

        $user = wp_get_current_user();
        $solved_id_array = $wpdb->get_results( "SELECT challenge_id FROM wp_jsc_challenge_user WHERE user_id = $user->ID");
        $solved_ids = array();
        foreach($solved_id_array as $elem) {
            array_push($solved_ids, $elem->challenge_id);
        }


        $myposts = array( 'post_type' => 'code_challenge', 'post__not_in' => $solved_ids );
        $loop = new WP_Query( $myposts );
        ?>

        
        <?php
        if ( !$loop->have_posts() ) {?>
            <h1 class="challenge-title">You've solved all the challenges!</h1>

            <div style="text-align: center;">
                <a href="https://truthseekers.io/blog">
                    <div class="btn-main">
                        <h3>Check out our Blog</h3>
                    </div>
                </a>

                <a href="https://truthseekers.io/shop">
                    <div class="btn-main">
                        <h3>Visit our Shop</h3>
                    </div>
                </a>
            </div>

            <?php
        } else {
            ?>
            <h1 class="challenge-title">Unsolved Challenges:</h1>
            <?php
        }
        ?>

        <?php while ( $loop->have_posts() ) : $loop->the_post();?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <!-- Display Title and Author Name -->
                    <a href="<?php the_permalink(); ?>">
                        <div class="code_challenge_list_item">
                            <h2><?php the_title(); ?></h2><br />
                            <br />
                        </div>
                    </a>
                </header>
            </article>
        <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
