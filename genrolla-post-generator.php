<?php
/**
 * Genrolla Theme - Dummy Post Generator
 * 
 * INSTRUCTIONS:
 * 1. Upload file ini ke WordPress root folder (sama level dengan wp-config.php)
 * 2. Akses via browser: http://your-site.com/genrolla-post-generator.php
 * 3. Refresh halaman = generate 5 posts baru
 * 4. DELETE file ini setelah selesai (security risk kalau dibiarkan)
 */

// Load WordPress
require_once('wp-load.php');

// Check if user is admin
if (!current_user_can('administrator')) {
    die('Access denied. Only admins can run this script.');
}

// Sample posts data
$sample_posts = array(
    array(
        'title' => '10 Strategi Content Marketing yang Terbukti Efektif di 2024',
        'content' => '<p>Content marketing telah menjadi tulang punggung strategi digital marketing modern. Dalam artikel ini, kita akan membahas 10 strategi yang terbukti meningkatkan engagement dan konversi.</p>

<h2>1. SEO-Optimized Long-form Content</h2>
<p>Artikel panjang (2000+ kata) dengan riset keyword yang tepat masih menjadi raja di Google. Fokus pada search intent dan user experience.</p>

<h2>2. Video Content Integration</h2>
<p>Kombinasi artikel dengan video embed meningkatkan time-on-page hingga 80%. Gunakan YouTube atau Vimeo untuk hosting.</p>

<h2>3. Newsletter Consistency</h2>
<p>Email marketing masih punya ROI tertinggi ($42 untuk setiap $1 yang dikeluarkan). Konsistensi adalah kunci.</p>

<p>Baca selengkapnya untuk strategi lainnya yang bisa langsung diterapkan hari ini!</p>',
        'category' => 'Marketing',
        'tags' => array('content marketing', 'SEO', 'digital marketing'),
    ),
    array(
        'title' => 'Cara Monetisasi Blog dengan Google AdSense: Panduan Lengkap',
        'content' => '<p>Google AdSense adalah salah satu cara termudah untuk monetisasi blog, terutama untuk pemula. Berikut panduan step-by-step dari approval hingga optimasi revenue.</p>

<h2>Syarat Approval AdSense</h2>
<p>Sebelum apply, pastikan blog kamu memenuhi:</p>
<ul>
<li>Minimal 20-30 artikel original (bukan copy-paste)</li>
<li>Traffic organik dari Google (minimal 100 visitor/hari)</li>
<li>Niche yang jelas dan policy-compliant</li>
<li>Halaman About, Contact, Privacy Policy lengkap</li>
</ul>

<h2>Optimasi Ad Placement</h2>
<p>Posisi iklan yang paling efektif:</p>
<ol>
<li>Header banner (728x90 atau 970x90)</li>
<li>Sidebar sticky (300x600)</li>
<li>In-content (setelah paragraf ke-2)</li>
</ol>

<p>Dengan strategi yang tepat, blog dengan 10K pageviews/bulan bisa generate $200-500/bulan.</p>',
        'category' => 'Monetization',
        'tags' => array('AdSense', 'blog monetization', 'passive income'),
    ),
    array(
        'title' => 'Newsletter Growth Hacks: Dari 0 ke 10,000 Subscribers dalam 6 Bulan',
        'content' => '<p>Membangun email list adalah asset digital paling berharga. Berikut strategi yang saya gunakan untuk grow dari nol ke 10K subscribers tanpa ads berbayar.</p>

<h2>1. Lead Magnet yang Irresistible</h2>
<p>Buat freebie yang solve 1 specific problem pembaca:</p>
<ul>
<li>Checklist PDF (paling mudah dibuat)</li>
<li>Template/Swipe file (high value, low effort)</li>
<li>Mini course email (5-7 hari)</li>
</ul>

<h2>2. Popup Timing yang Tepat</h2>
<p>Jangan langsung popup saat visitor baru masuk. Optimal timing:</p>
<ul>
<li>Setelah scroll 50% halaman</li>
<li>Exit-intent (mau close tab)</li>
<li>Setelah 30 detik di site</li>
</ul>

<h2>3. Social Media Integration</h2>
<p>Promosikan lead magnet di Instagram/Twitter bio, Stories highlight, dan CTA di setiap post.</p>

<p>Konsistensi + value adalah kunci. Jangan spam, fokus pada relationship building.</p>',
        'category' => 'Email Marketing',
        'tags' => array('newsletter', 'email list', 'growth hacking'),
    ),
    array(
        'title' => 'Perbandingan Platform Blog: WordPress vs Medium vs Substack',
        'content' => '<p>Memilih platform blog yang tepat adalah keputusan penting. Mari kita bandingkan 3 platform terpopuler dari sisi monetisasi, SEO, dan kontrol.</p>

<h2>WordPress (Self-Hosted)</h2>
<p><strong>Pros:</strong></p>
<ul>
<li>Full control atas konten dan data</li>
<li>SEO terbaik (custom domain, plugin, schema markup)</li>
<li>Monetisasi fleksibel (ads, affiliate, products)</li>
<li>Theme & plugin unlimited</li>
</ul>
<p><strong>Cons:</strong></p>
<ul>
<li>Butuh hosting ($5-10/bulan)</li>
<li>Learning curve lebih tinggi</li>
<li>Maintenance sendiri (update, backup, security)</li>
</ul>

<h2>Medium</h2>
<p><strong>Pros:</strong></p>
<ul>
<li>Built-in audience (distribution otomatis)</li>
<li>Setup cepat (5 menit langsung publish)</li>
<li>Medium Partner Program (monetisasi mudah)</li>
</ul>
<p><strong>Cons:</strong></p>
<ul>
<li>SEO terbatas (semua di medium.com subdomain)</li>
<li>Paywall membatasi reach</li>
<li>Zero kontrol platform (bisa di-ban)</li>
</ul>

<h2>Verdict</h2>
<p>WordPress untuk long-term asset building. Medium untuk quick validation & distribution. Substack untuk newsletter-first strategy.</p>',
        'category' => 'Blogging',
        'tags' => array('WordPress', 'Medium', 'blogging platform'),
    ),
    array(
        'title' => 'Affiliate Marketing untuk Pemula: Strategi Tanpa Followers Banyak',
        'content' => '<p>Affiliate marketing bisa dimulai dari nol followers. Yang penting: traffic terget + konten yang solve problem. Berikut strategi praktis untuk pemula.</p>

<h2>Pilih Niche yang Profitable</h2>
<p>Jangan terlalu broad. Contoh niche bagus:</p>
<ul>
<li>Productivity tools untuk freelancer</li>
<li>Skincare untuk kulit berjerawat</li>
<li>Hosting untuk blogger pemula</li>
</ul>

<h2>SEO Article Strategy</h2>
<p>Buat artikel comparison & review yang target buyer intent:</p>
<ol>
<li>"[Product] vs [Competitor]" → high conversion</li>
<li>"Best [category] for [specific use case]"</li>
<li>"[Product] Review: Worth It or Not?"</li>
</ol>

<h2>Tools Affiliate Recommended (High Commission)</h2>
<ul>
<li>ConvertKit (30% recurring) → email marketing</li>
<li>Kinsta (10-20%) → WordPress hosting</li>
<li>Tailwind ($15 per sale) → Pinterest scheduler</li>
</ul>

<h2>Realistic Expectations</h2>
<p>Month 1-3: Build content (10-20 artikel)<br>
Month 4-6: First sales ($50-200)<br>
Month 7-12: Passive income mulai konsisten ($500-1000)</p>

<p>Kunci: konsistensi, bukan viral. Focus on evergreen content yang terus mendatangkan traffic organik.</p>',
        'category' => 'Affiliate Marketing',
        'tags' => array('affiliate marketing', 'passive income', 'online business'),
    ),
);

// Start output
echo '<html><head><title>Genrolla Post Generator</title></head><body>';
echo '<h1>Genrolla Theme - Dummy Post Generator</h1>';
echo '<p>Generating 5 sample blog posts...</p><hr>';

$created_count = 0;

foreach ($sample_posts as $post_data) {
    // Create category if not exists
    $category_id = wp_create_category($post_data['category']);
    
    // Prepare post data
    $new_post = array(
        'post_title'    => $post_data['title'],
        'post_content'  => $post_data['content'],
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array($category_id),
        'post_type'     => 'post',
    );
    
    // Insert post
    $post_id = wp_insert_post($new_post);
    
    if ($post_id) {
        // Add tags
        wp_set_post_tags($post_id, $post_data['tags'], true);
        
        // Try to set a featured image (placeholder)
        // Using placeholder service (https://via.placeholder.com)
        $image_url = 'https://via.placeholder.com/800x450/0066cc/ffffff?text=' . urlencode($post_data['category']);
        
        echo '<p>✅ Created: <strong>' . $post_data['title'] . '</strong> (ID: ' . $post_id . ')</p>';
        $created_count++;
    } else {
        echo '<p>❌ Failed to create: ' . $post_data['title'] . '</p>';
    }
}

echo '<hr>';
echo '<h2>Summary</h2>';
echo '<p>✅ Successfully created <strong>' . $created_count . '</strong> posts!</p>';
echo '<p>🔗 <a href="' . admin_url() . '">Go to WordPress Admin</a></p>';
echo '<p>🗑️ <strong>IMPORTANT:</strong> Delete this file (genrolla-post-generator.php) from your server now for security!</p>';
echo '</body></html>';
?>
