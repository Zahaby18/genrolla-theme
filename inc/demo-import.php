<?php
/**
 * Genrolla — One-Click Demo Content Importer
 *
 * Creates categories, tags, posts (with featured images) and
 * a few comments so the "Trending" section actually has data.
 *
 * @package Genrolla
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ---------- Admin page: Appearance > Import Demo ---------- */
function genrolla_demo_menu() {
    add_theme_page(
        esc_html__( 'Import Demo Content', 'genrolla' ),
        esc_html__( 'Import Demo', 'genrolla' ),
        'manage_options',
        'genrolla-demo',
        'genrolla_demo_page'
    );
}
add_action( 'admin_menu', 'genrolla_demo_menu' );

function genrolla_demo_page() {
    $imported = get_option( 'genrolla_demo_imported', 0 );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Genrolla — Import Demo Content', 'genrolla' ); ?></h1>
        <p><?php esc_html_e( 'Generate sample content (categories, tags, 12 posts, featured images, and comments) so the theme looks alive right away. Everything can be removed with one click.', 'genrolla' ); ?></p>

        <?php if ( isset( $_GET['genrolla_demo_done'] ) ) : ?>
            <div class="notice notice-success">
                <p><strong><?php esc_html_e( 'Success!', 'genrolla' ); ?></strong> <?php esc_html_e( 'Demo content has been generated.', 'genrolla' ); ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank"><?php esc_html_e( 'View site', 'genrolla' ); ?></a>
                </p>
            </div>
        <?php endif; ?>
        <?php if ( isset( $_GET['genrolla_demo_reset'] ) ) : ?>
            <div class="notice notice-success">
                <p><strong><?php esc_html_e( 'Done!', 'genrolla' ); ?></strong> <?php esc_html_e( 'All demo content has been removed.', 'genrolla' ); ?></p>
            </div>
        <?php endif; ?>

        <?php if ( $imported ) : ?>
            <div class="notice notice-warning">
                <p><?php esc_html_e( 'Demo content has already been imported.', 'genrolla' ); ?></p>
            </div>
        <?php endif; ?>

        <form method="post" style="margin-top:16px">
            <?php wp_nonce_field( 'genrolla_demo_import' ); ?>
            <p>
                <button class="button button-primary button-hero" type="submit" name="genrolla_demo_action" value="import">
                    <?php esc_html_e( 'Import Demo Content Now', 'genrolla' ); ?>
                </button>
            </p>
        </form>

        <form method="post" style="margin-top:8px">
            <?php wp_nonce_field( 'genrolla_demo_reset' ); ?>
            <p>
                <button class="button button-secondary" type="submit" name="genrolla_demo_action" value="reset" onclick="return confirm('<?php esc_attr_e( 'Remove all demo content?', 'genrolla' ); ?>');">
                    <?php esc_html_e( 'Remove Demo Content', 'genrolla' ); ?>
                </button>
            </p>
        </form>
    </div>
    <?php
}

/* ---------- Handle actions ---------- */
function genrolla_demo_handle() {
    if ( ! isset( $_POST['genrolla_demo_action'] ) || ! current_user_can( 'manage_options' ) ) {
        return;
    }
    $action = sanitize_key( $_POST['genrolla_demo_action'] );

    if ( 'import' === $action ) {
        check_admin_referer( 'genrolla_demo_import' );
        genrolla_demo_import();
        wp_safe_redirect( admin_url( 'themes.php?page=genrolla-demo&genrolla_demo_done=1' ) );
        exit;
    }

    if ( 'reset' === $action ) {
        check_admin_referer( 'genrolla_demo_reset' );
        genrolla_demo_reset();
        wp_safe_redirect( admin_url( 'themes.php?page=genrolla-demo&genrolla_demo_reset=1' ) );
        exit;
    }
}
add_action( 'admin_init', 'genrolla_demo_handle' );

/* ---------- Data ---------- */
function genrolla_demo_data() {
    return array(
        'categories' => array(
            array( 'name' => 'Career', 'slug' => 'career' ),
            array( 'name' => 'Productivity', 'slug' => 'productivity' ),
            array( 'name' => 'Finance', 'slug' => 'finance' ),
            array( 'name' => 'Self-Growth', 'slug' => 'self-growth' ),
            array( 'name' => 'Lifestyle', 'slug' => 'lifestyle' ),
            array( 'name' => 'Highlight', 'slug' => 'highlight' ),
        ),
        'tags'       => array( 'resume', 'job-hunting', 'fresh-graduate', 'salary', 'negotiation', 'investing', 'mutual-funds', 'personal-finance', 'productivity', 'notion', 'deep-work', 'skills', 'future-of-work', 'burnout', 'mental-health', 'linkedin', 'interview', 'portfolio', 'internship', 'freelance' ),
        'posts'      => array(
            array(
                'title'    => 'Gen Z Resume That Makes HR Stop Scrolling: 7 Must-Have Elements',
                'slug'     => 'gen-z-resume-hr-stop-scrolling',
                'category' => 'Career',
                'tags'     => array( 'resume', 'job-hunting', 'fresh-graduate' ),
                'image'    => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Have you ever sent your resume to dozens of companies and heard nothing back? You are not alone. On average, HR recruiters spend only 7 seconds deciding whether your resume is worth a closer look or goes straight to the pile.</p><h2>1. One Page, One Focus</h2><p>Fresh graduates do not need a 3-page resume. Recruiters want to see your value in 60 seconds.</p><ul><li>Cut anything irrelevant</li><li>Use bullet points, not long paragraphs</li><li>Lead with your most recent, relevant wins</li></ul><h2>2. A Headline That Sells</h2><p>Do not just write "Fresh Graduate". Write your value proposition in one clear sentence.</p><h2>3. Achievements, Not Job Descriptions</h2><p>Do not write "Managed company social media". Write the impact: "Grew Instagram followers from 2K to 15K in 6 months".</p><h2>Conclusion</h2><p>A great resume is not about an expensive template — it is about clarity of value.</p>',
            ),
            array(
                'title'    => 'Internship vs Freelance: Which One Builds Your Resume Faster?',
                'slug'     => 'internship-vs-freelance-resume',
                'category' => 'Career',
                'tags'     => array( 'internship', 'freelance', 'career' ),
                'image'    => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Both add value, but the payoff differs depending on your career goals. Internships give you structure, mentorship, and teamwork experience. Freelancing gives you a real portfolio, income, and independent track record.</p><h2>Internship: Structure & Networking</h2><p>Choose an internship if you still need guidance and want to build industry connections.</p><h2>Freelance: Portfolio & Money</h2><p>Choose freelancing if you already have skills and want tangible proof of your work.</p><h2>The Best Combo</h2><p>Internship by day, freelance by night — as long as you stay consistent and show results.</p>',
            ),
            array(
                'title'    => '5 Salary Negotiation Steps for Fresh Graduates Who Just Got an Offer',
                'slug'     => 'salary-negotiation-fresh-graduates',
                'category' => 'Career',
                'tags'     => array( 'salary', 'negotiation' ),
                'image'    => 'https://images.unsplash.com/photo-1560264280-88b68371db39?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Getting a job offer is a big win. But do not rush to sign — this is actually the best moment to negotiate your salary.</p><h2>1. Research the Salary Range</h2><p>Find out the typical range for your role and city. Do not throw out random numbers.</p><h2>2. Do Not Name a Number First</h2><p>If asked for expectations, ask about their budget. Or give a realistic range.</p><h2>3. Bring Your Value</h2><p>Show proof: internship wins, portfolio, or rare skills you bring.</p><h2>4. Look at the Whole Package</h2><p>Salary is not everything. Benefits, bonuses, training, and growth path matter too.</p><h2>5. Do Not Be Afraid to Ask Back</h2><p>Negotiation is a dialogue, not a demand. Stay professional and confident.</p>',
            ),
            array(
                'title'    => 'Investing IDR 100K/Month in Mutual Funds: Where to Start?',
                'slug'     => 'investing-mutual-funds-100k',
                'category' => 'Finance',
                'tags'     => array( 'investing', 'mutual-funds', 'personal-finance' ),
                'image'    => 'https://images.unsplash.com/photo-1579532537598-459ecdaf39cc?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>You do not need to be rich to start investing. IDR 100K per month is enough to get going. The key is consistency.</p><h2>What Are Mutual Funds?</h2><p>A mutual fund pools money from many investors and a fund manager invests it across the market.</p><h2>Pick the Type That Fits Your Risk Profile</h2><ul><li><strong>Money Market:</strong> safest, good for emergency funds</li><li><strong>Fixed Income:</strong> bonds, medium risk</li><li><strong>Equity:</strong> aggressive, for the long term</li></ul><h2>Start Through Regulated Apps</h2><p>Choose platforms registered with the OJK, with a minimum deposit of IDR 10K, and set up autodebit to stay consistent.</p><h2>Conclusion</h2><p>Start small, stay consistent, and do not panic over daily swings.</p>',
            ),
            array(
                'title'    => 'First Salary? Here is How to Budget Without Going Broke',
                'slug'     => 'first-salary-budget',
                'category' => 'Finance',
                'tags'     => array( 'salary', 'personal-finance' ),
                'image'    => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Your first salary hits the account and you want to buy everything you could not before. Before you splurge, here is how to budget so you do not go broke by month end.</p><h2>The 50/30/20 Rule</h2><ul><li><strong>50% Needs:</strong> rent, food, transport</li><li><strong>30% Wants:</strong> entertainment, hanging out, shopping</li><li><strong>20% Savings & Investing:</strong> pay yourself first</li></ul><h2>Separate Your Accounts</h2><p>Create three accounts: daily, savings, and emergency. Transfer automatically on payday.</p><h2>Build an Emergency Fund First</h2><p>Before investing, save 3-6 months of expenses as your safety net.</p>',
            ),
            array(
                'title'    => 'Deep Work for Gen Z: 2 Focused Hours Beat 8 Distracted Ones',
                'slug'     => 'deep-work-gen-z',
                'category' => 'Productivity',
                'tags'     => array( 'productivity', 'deep-work' ),
                'image'    => 'https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>If you work 8 hours but never seem to finish anything, the problem is not time — it is focus. Deep work is the ability to focus without distraction.</p><h2>Why Deep Work Matters</h2><p>In the age of notifications, someone who can focus for 2 hours straight is rare. The skill is becoming scarcer and more valuable.</p><h2>How to Start</h2><ul><li>Turn off notifications and put your phone in another room</li><li>Block 90-120 minutes per session</li><li>One task per session</li><li>Track your progress</li></ul><h2>Consistency Over Intensity</h2><p>One deep work session per day beats an all-nighter marathon.</p>',
            ),
            array(
                'title'    => 'Notion vs Google Keep: Which One Fits College Students?',
                'slug'     => 'notion-vs-google-keep',
                'category' => 'Productivity',
                'tags'     => array( 'productivity', 'notion' ),
                'image'    => 'https://images.unsplash.com/photo-1517842645767-c639042777db?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Two of the most popular note-taking tools. But your needs decide which one wins.</p><h2>Google Keep: Simple & Fast</h2><p>Keep is perfect for quick notes: reminders, shopping lists, sudden ideas. Instantly syncs with your Google account.</p><h2>Notion: For Power Users</h2><p>Notion is for those who want databases, study templates, habit trackers, or project management.</p><h2>Conclusion</h2><p>Both are free. Use Keep for quick capture, Notion for big organization. You can run both side by side.</p>',
            ),
            array(
                'title'    => 'The Most In-Demand Skills in 2026 (It Is Not Coding!)',
                'slug'     => 'in-demand-skills-2026',
                'category' => 'Self-Growth',
                'tags'     => array( 'skills', 'future-of-work' ),
                'image'    => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>AI is taking over many technical tasks, but human skills are becoming more sought after. Here are a few on the rise.</p><h2>1. Communication & Copywriting</h2><p>AI can write, but knowing how to choose the right words for humans still takes a human.</p><h2>2. Problem Solving</h2><p>The ability to break complex problems into small steps is hard to replicate.</p><h2>3. AI Literacy</h2><p>Not just prompting, but understanding how AI works and where it fails.</p><h2>4. Empathy & Soft Skills</h2><p>Collaboration, negotiation, and leadership will never be replaced.</p>',
            ),
            array(
                'title'    => 'Burnout at 22: Signs, Causes, and How to Recover',
                'slug'     => 'burnout-at-22',
                'category' => 'Lifestyle',
                'tags'     => array( 'burnout', 'mental-health' ),
                'image'    => 'https://images.unsplash.com/photo-1499209974431-9dddcece7f88?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Mentally exhausted but cannot take a break? That is not laziness — it is burnout. And burnout in your early twenties is real.</p><h2>Signs of Burnout</h2><ul><li>Mood swings and easy irritability</li><li>No energy for things you used to love</li><li>Trouble sleeping or sleeping too much</li><li>Physical symptoms: headaches, stomach issues</li></ul><h2>Why Gen Z Is Vulnerable</h2><p>Hustle culture, social comparison, and sky-high expectations pile on the pressure.</p><h2>How to Recover</h2><ul><li>Lighten your load, learn to say no</li><li>Take a screen-time detox</li><li>Do light exercise</li><li>Do not hesitate to seek professional help</li></ul>',
            ),
            array(
                'title'    => 'LinkedIn Profile Check: 5 Things That Make Recruiters DM You',
                'slug'     => 'linkedin-profile-check',
                'category' => 'Career',
                'tags'     => array( 'linkedin', 'job-hunting' ),
                'image'    => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Recruiters are like dating apps — they swipe based on first impressions. Here are 5 things that make your profile stand out.</p><h2>1. A Clear Headline</h2><p>Not just "Student", but "Content Writer | 2 years freelance | 50+ SEO articles".</p><h2>2. A Professional Photo</h2><p>A clear photo, slight smile, tidy background. It does not need to be a studio shot, just look natural.</p><h2>3. An About Section That Sells</h2><p>Write your value in 3-4 sentences. Tell your story and why you are different.</p><h2>4. Experience with Numbers</h2><p>Every role should have a metric: "Increased traffic by 40%".</p><h2>5. Stay Active & Consistent</h2><p>Post or repost 2-3 times a week so the algorithm knows you exist.</p>',
            ),
            array(
                'title'    => 'Online Job Interviews: How to Answer the 5 Most Common Questions',
                'slug'     => 'online-job-interviews',
                'category' => 'Career',
                'tags'     => array( 'interview', 'job-hunting' ),
                'image'    => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>"Tell me about yourself" — the question that blanks your brain every time. Here is how to answer the most common interview questions.</p><h2>1. Tell Me About Yourself</h2><p>Use past-present-future. Experience → current position → why you applied here.</p><h2>2. Why Do You Want to Work Here?</h2><p>Research the company first. Mention 1-2 specific things you like about them.</p><h2>3. What Is Your Weakness?</h2><p>Be honest and show improvement: "I used to be impatient, now I use checklists to stay systematic".</p><h2>4. Salary Expectation</h2><p>Give a researched range. Be ready to explain why.</p><h2>5. Do You Have Questions?</h2><p>Always prepare 2 questions. It signals you are serious.</p>',
            ),
            array(
                'title'    => 'Digital Portfolio: 3 Free Tools to Showcase Your Skills',
                'slug'     => 'digital-portfolio-tools',
                'category' => 'Career',
                'tags'     => array( 'portfolio', 'skills' ),
                'image'    => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>A diploma is not enough. Recruiters now want proof. Here are 3 portfolio tools that are incredibly easy to use.</p><h2>1. Notion Portfolio</h2><p>Free, customizable, great for writers and marketers. Share via link.</p><h2>2. Behance</h2><p>A must for designers and creatives. Built-in community and discoverability.</p><h2>3. GitHub Pages</h2><p>For developers: free static hosting, just push HTML/CSS/JS.</p><h2>Bonus: Canva</h2><p>Make a polished one-page portfolio PDF without design skills.</p>',
            ),
        ),
    );
}

/* ---------- Import ---------- */
function genrolla_demo_import() {
    $data = genrolla_demo_data();

    // Categories
    $cat_ids = array();
    foreach ( $data['categories'] as $cat ) {
        $term = term_exists( $cat['slug'], 'category' );
        if ( ! $term ) {
            $term = wp_insert_term( $cat['name'], 'category', array( 'slug' => $cat['slug'] ) );
        }
        if ( ! is_wp_error( $term ) ) {
            $cat_ids[ $cat['slug'] ] = (int) $term['term_id'];
            update_term_meta( (int) $term['term_id'], '_genrolla_demo', 1 );
        }
    }

    // Tags
    foreach ( $data['tags'] as $tag_slug ) {
        $term = term_exists( $tag_slug, 'post_tag' );
        if ( ! $term ) {
            $term = wp_insert_term( $tag_slug, 'post_tag' );
        }
        if ( ! is_wp_error( $term ) ) {
            update_term_meta( (int) $term['term_id'], '_genrolla_demo', 1 );
        }
    }

    // Posts
    $post_ids = array();
    foreach ( $data['posts'] as $post_data ) {
        $existing = get_page_by_path( $post_data['slug'], OBJECT, 'post' );
        if ( $existing ) {
            continue;
        }

        $cat_slug = $post_data['category'];
        $cat_id   = isset( $cat_ids[ $cat_slug ] ) ? $cat_ids[ $cat_slug ] : 0;

        // Assign posts #1, #3, #6 to Highlight as well (fallback trending demo)
        $extra_cats = array();
        if ( in_array( $post_data['slug'], array( 'gen-z-resume-hr-stop-scrolling', 'salary-negotiation-fresh-graduates', 'deep-work-gen-z' ), true ) && ! empty( $cat_ids['highlight'] ) ) {
            $extra_cats = array( (int) $cat_ids['highlight'] );
        }

        $post_id = wp_insert_post( array(
            'post_title'    => $post_data['title'],
            'post_name'     => $post_data['slug'],
            'post_content'  => $post_data['content'],
            'post_status'   => 'publish',
            'post_type'     => 'post',
            'post_category' => $cat_id ? array_merge( array( $cat_id ), $extra_cats ) : $extra_cats,
            'tags_input'    => $post_data['tags'],
        ) );

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_genrolla_demo', 1 );
            $post_ids[] = $post_id;

            // Featured image (sideload from Unsplash)
            genrolla_demo_set_image( $post_id, $post_data['image'] );
        }
    }

    // Comments on first 3 posts so "Trending" has real data
    $comment_sets = array(
        'This is so useful, I am using it for my application next week!',
        'Been waiting for an article like this. Thanks genrolla!',
        'Totally agree, I have been through this myself. Great write-up.',
        'Quick question — what if I studied a different major but want to enter this field?',
        'Saving this to read again later. Love how structured the article is.',
    );
    $i = 0;
    foreach ( array_slice( $post_ids, 0, 3 ) as $pid ) {
        $comment = $comment_sets[ $i % count( $comment_sets ) ];
        $comment_id = wp_insert_comment( array(
            'comment_post_ID'      => $pid,
            'comment_author'       => 'Genrolla Reader',
            'comment_author_email' => 'reader@example.com',
            'comment_content'      => $comment,
            'comment_approved'     => 1,
        ) );
        if ( $comment_id ) {
            update_comment_meta( $comment_id, '_genrolla_demo', 1 );
        }
        $i++;
    }

    update_option( 'genrolla_demo_imported', 1 );
}

/* ---------- Set featured image via sideload ---------- */
function genrolla_demo_set_image( $post_id, $url ) {
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    // Download to temp file
    $tmp = download_url( $url );
    if ( is_wp_error( $tmp ) ) {
        return;
    }

    $file_array = array(
        'name'     => 'genrolla-demo-' . $post_id . '.jpg',
        'tmp_name' => $tmp,
    );

    $attachment_id = media_handle_sideload( $file_array, $post_id, get_the_title( $post_id ) );
    if ( ! is_wp_error( $attachment_id ) ) {
        set_post_thumbnail( $post_id, $attachment_id );
        update_post_meta( $attachment_id, '_genrolla_demo', 1 );
    }
}

/* ---------- Reset ---------- */
function genrolla_demo_reset() {
    // Delete demo posts
    $posts = get_posts( array(
        'post_type'   => 'post',
        'numberposts' => -1,
        'meta_key'    => '_genrolla_demo',
        'fields'      => 'ids',
    ) );
    foreach ( $posts as $pid ) {
        wp_delete_post( $pid, true );
    }

    // Delete demo comments
    $comments = get_comments( array( 'meta_key' => '_genrolla_demo', 'number' => 100 ) );
    foreach ( $comments as $c ) {
        wp_delete_comment( (int) $c->comment_ID, true );
    }

    // Delete demo terms
    foreach ( array( 'category', 'post_tag' ) as $tax ) {
        $terms = get_terms( array( 'taxonomy' => $tax, 'hide_empty' => false, 'meta_key' => '_genrolla_demo', 'fields' => 'ids' ) );
        if ( ! is_wp_error( $terms ) ) {
            foreach ( $terms as $tid ) {
                wp_delete_term( $tid, $tax );
            }
        }
    }

    // Clean orphan attachments
    $attachments = get_posts( array(
        'post_type'   => 'attachment',
        'numberposts' => -1,
        'meta_key'    => '_genrolla_demo',
        'fields'      => 'ids',
    ) );
    foreach ( $attachments as $aid ) {
        wp_delete_attachment( $aid, true );
    }

    delete_option( 'genrolla_demo_imported' );
}
