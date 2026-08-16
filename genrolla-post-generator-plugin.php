<?php
/**
 * Plugin Name: Genrolla Post Generator
 * Description: Generate 5 dummy blog posts for Genrolla theme demo
 * Version: 1.0
 * Author: Zahab
 */

// Add admin menu
add_action('admin_menu', 'genrolla_generator_menu');

function genrolla_generator_menu() {
    add_management_page(
        'Generate Posts',
        'Generate Posts',
        'manage_options',
        'genrolla-generator',
        'genrolla_generator_page'
    );
}

function genrolla_generator_page() {
    ?>
    <div class="wrap">
        <h1>Genrolla Post Generator</h1>
        
        <?php
        if (isset($_POST['generate_posts'])) {
            check_admin_referer('genrolla_generate_posts');
            genrolla_generate_sample_posts();
        }
        ?>
        
        <form method="post">
            <?php wp_nonce_field('genrolla_generate_posts'); ?>
            <p>Click button below to generate 5 sample blog posts for demo purposes.</p>
            <p><input type="submit" name="generate_posts" class="button button-primary" value="Generate 5 Posts"></p>
        </form>
    </div>
    <?php
}

function genrolla_generate_sample_posts() {
    $sample_posts = array(
        array(
            'title' => '10 Strategi Content Marketing yang Terbukti Efektif di 2024',
            'content' => '<p>Content marketing telah menjadi tulang punggung strategi digital marketing modern.</p>',
            'category' => 'Marketing',
            'tags' => array('content marketing', 'SEO'),
        ),
        array(
            'title' => 'Cara Monetisasi Blog dengan Google AdSense',
            'content' => '<p>Google AdSense adalah salah satu cara termudah untuk monetisasi blog.</p>',
            'category' => 'Monetization',
            'tags' => array('AdSense', 'monetization'),
        ),
        array(
            'title' => 'Newsletter Growth Hacks: 0 ke 10K Subscribers',
            'content' => '<p>Membangun email list adalah asset digital paling berharga.</p>',
            'category' => 'Email Marketing',
            'tags' => array('newsletter', 'email'),
        ),
        array(
            'title' => 'WordPress vs Medium vs Substack',
            'content' => '<p>Memilih platform blog yang tepat adalah keputusan penting.</p>',
            'category' => 'Blogging',
            'tags' => array('WordPress', 'blogging'),
        ),
        array(
            'title' => 'Affiliate Marketing untuk Pemula',
            'content' => '<p>Affiliate marketing bisa dimulai dari nol followers.</p>',
            'category' => 'Affiliate Marketing',
            'tags' => array('affiliate', 'passive income'),
        ),
    );
    
    $created = 0;
    foreach ($sample_posts as $post_data) {
        $cat_id = wp_create_category($post_data['category']);
        $post_id = wp_insert_post(array(
            'post_title' => $post_data['title'],
            'post_content' => $post_data['content'],
            'post_status' => 'publish',
            'post_category' => array($cat_id),
        ));
        if ($post_id) {
            wp_set_post_tags($post_id, $post_data['tags']);
            $created++;
        }
    }
    
    echo '<div class="notice notice-success"><p>✅ Successfully created ' . $created . ' posts! <a href="' . admin_url('edit.php') . '">View Posts</a></p></div>';
}
