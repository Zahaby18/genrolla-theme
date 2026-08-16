-- ============================================
-- Genrolla Theme - Complete SQL Installation
-- ============================================
-- INSTRUCTIONS:
-- 1. Backup database dulu!
-- 2. Copy-paste SEMUA query ini ke phpMyAdmin → SQL tab
-- 3. Execute
-- 4. Refresh homepage: https://demo.azdevs.my.id/
-- ============================================

-- Step 1: Set Reading Settings (Homepage = Latest Posts)
UPDATE wp_options SET option_value = 'posts' WHERE option_name = 'show_on_front';
UPDATE wp_options SET option_value = '0' WHERE option_name = 'page_on_front';
UPDATE wp_options SET option_value = '0' WHERE option_name = 'page_for_posts';

-- Step 2: Insert Categories
INSERT IGNORE INTO wp_terms (name, slug, term_group) VALUES
('Marketing', 'marketing', 0),
('Monetization', 'monetization', 0),
('Email Marketing', 'email-marketing', 0),
('Blogging', 'blogging', 0),
('Affiliate Marketing', 'affiliate-marketing', 0);

-- Get term IDs and create taxonomy relationships
INSERT IGNORE INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count)
SELECT term_id, 'category', '', 0, 0 FROM wp_terms WHERE slug IN ('marketing', 'monetization', 'email-marketing', 'blogging', 'affiliate-marketing');

-- Step 3: Insert Tags
INSERT IGNORE INTO wp_terms (name, slug, term_group) VALUES
('content marketing', 'content-marketing', 0),
('SEO', 'seo', 0),
('digital marketing', 'digital-marketing', 0),
('AdSense', 'adsense', 0),
('blog monetization', 'blog-monetization', 0),
('passive income', 'passive-income', 0),
('newsletter', 'newsletter', 0),
('email list', 'email-list', 0),
('growth hacking', 'growth-hacking', 0),
('WordPress', 'wordpress', 0),
('Medium', 'medium', 0),
('blogging platform', 'blogging-platform', 0),
('affiliate', 'affiliate', 0),
('online business', 'online-business', 0);

INSERT IGNORE INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count)
SELECT term_id, 'post_tag', '', 0, 0 FROM wp_terms WHERE slug IN 
('content-marketing', 'seo', 'digital-marketing', 'adsense', 'blog-monetization', 
 'passive-income', 'newsletter', 'email-list', 'growth-hacking', 'wordpress', 
 'medium', 'blogging-platform', 'affiliate', 'online-business');

-- Step 4: Insert Posts
INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES

-- Post 1: Content Marketing
(1, NOW(), UTC_TIMESTAMP(), 
'<p>Content marketing telah menjadi tulang punggung strategi digital marketing modern. Dalam artikel ini, kita akan membahas 10 strategi yang terbukti meningkatkan engagement dan konversi.</p>

<h2>1. SEO-Optimized Long-form Content</h2>
<p>Artikel panjang (2000+ kata) dengan riset keyword yang tepat masih menjadi raja di Google. Fokus pada search intent dan user experience untuk meningkatkan ranking organik.</p>

<h2>2. Video Content Integration</h2>
<p>Kombinasi artikel dengan video embed meningkatkan time-on-page hingga 80%. Gunakan YouTube atau Vimeo untuk hosting, lalu embed di artikel relevant.</p>

<h2>3. Newsletter Consistency</h2>
<p>Email marketing masih punya ROI tertinggi ($42 untuk setiap $1 yang dikeluarkan). Konsistensi adalah kunci - minimal 1x seminggu.</p>

<h2>4. Social Media Amplification</h2>
<p>Share konten di platform yang relevant dengan audience. LinkedIn untuk B2B, Instagram untuk visual content, Twitter untuk thought leadership.</p>

<h2>5. Data-Driven Optimization</h2>
<p>Track metrics: traffic, bounce rate, conversion rate, time-on-page. Optimize berdasarkan data, bukan asumsi.</p>

<p>Baca selengkapnya untuk strategi lainnya yang bisa langsung diterapkan hari ini!</p>',
'10 Strategi Content Marketing yang Terbukti Efektif di 2024',
'Content marketing telah menjadi tulang punggung strategi digital marketing modern. Dalam artikel ini, kita akan membahas 10 strategi yang terbukti meningkatkan engagement dan konversi.',
'publish', 'open', 'open', '', '10-strategi-content-marketing-2024', '', '', NOW(), UTC_TIMESTAMP(), '', 0, 'https://demo.azdevs.my.id/?p=101', 0, 'post', '', 0),

-- Post 2: AdSense
(1, NOW(), UTC_TIMESTAMP(),
'<p>Google AdSense adalah salah satu cara termudah untuk monetisasi blog, terutama untuk pemula. Berikut panduan step-by-step dari approval hingga optimasi revenue.</p>

<h2>Syarat Approval AdSense</h2>
<p>Sebelum apply, pastikan blog kamu memenuhi:</p>
<ul>
<li>Minimal 20-30 artikel original (bukan copy-paste)</li>
<li>Traffic organik dari Google (minimal 100 visitor/hari)</li>
<li>Niche yang jelas dan policy-compliant</li>
<li>Halaman About, Contact, Privacy Policy lengkap</li>
<li>Domain sendiri (.com, .net, dll - bukan subdomain gratis)</li>
</ul>

<h2>Optimasi Ad Placement</h2>
<p>Posisi iklan yang paling efektif:</p>
<ol>
<li><strong>Header banner</strong> - 728x90 atau 970x90 (desktop), auto ads untuk mobile</li>
<li><strong>Sidebar sticky</strong> - 300x600 (paling menguntungkan)</li>
<li><strong>In-content</strong> - Setelah paragraf ke-2 atau ke-3</li>
<li><strong>End-of-article</strong> - 336x280 atau responsive</li>
</ol>

<h2>Revenue Expectations</h2>
<p>Dengan strategi yang tepat:</p>
<ul>
<li>5K pageviews/bulan = $50-150</li>
<li>10K pageviews/bulan = $200-500</li>
<li>50K pageviews/bulan = $1,000-3,000</li>
</ul>

<p>Niche high-CPC: finance, insurance, tech, health. Niche low-CPC: entertainment, gossip, general news.</p>',
'Cara Monetisasi Blog dengan Google AdSense: Panduan Lengkap',
'Google AdSense adalah salah satu cara termudah untuk monetisasi blog. Panduan lengkap dari approval hingga optimasi revenue untuk pemula.',
'publish', 'open', 'open', '', 'monetisasi-blog-google-adsense', '', '', NOW(), UTC_TIMESTAMP(), '', 0, 'https://demo.azdevs.my.id/?p=102', 0, 'post', '', 0),

-- Post 3: Newsletter Growth
(1, NOW(), UTC_TIMESTAMP(),
'<p>Membangun email list adalah asset digital paling berharga. Berikut strategi yang saya gunakan untuk grow dari nol ke 10K subscribers dalam 6 bulan tanpa ads berbayar.</p>

<h2>1. Lead Magnet yang Irresistible</h2>
<p>Buat freebie yang solve 1 specific problem pembaca:</p>
<ul>
<li><strong>Checklist PDF</strong> - Paling mudah dibuat, completion rate tinggi</li>
<li><strong>Template/Swipe file</strong> - High value, low effort dari pembaca</li>
<li><strong>Mini course email</strong> - 5-7 hari drip campaign</li>
<li><strong>Resource library</strong> - Collection tools/resources curated</li>
</ul>

<h2>2. Popup Timing yang Tepat</h2>
<p>Jangan langsung popup saat visitor baru masuk (annoying!). Optimal timing:</p>
<ul>
<li>Setelah scroll 50% halaman</li>
<li>Exit-intent (mau close tab)</li>
<li>Setelah 30-60 detik di site</li>
<li>Setelah baca 2+ artikel (returning visitor)</li>
</ul>

<h2>3. Social Media Integration</h2>
<p>Promosikan lead magnet di:</p>
<ul>
<li>Instagram/Twitter bio dengan link in bio</li>
<li>Stories highlight dedicated</li>
<li>CTA di setiap post relevant</li>
<li>LinkedIn article footer</li>
</ul>

<h2>4. Content Upgrade Strategy</h2>
<p>Di setiap artikel, tawarkan bonus content related:</p>
<ul>
<li>Artikel tentang SEO? Bonus: "50 SEO Checklist PDF"</li>
<li>Artikel tentang productivity? Bonus: "Notion template"</li>
</ul>

<h2>Results Timeline</h2>
<ul>
<li>Month 1-2: 0-500 subscribers (slow start, normal)</li>
<li>Month 3-4: 500-2,000 (content mulai rank)</li>
<li>Month 5-6: 2,000-10,000 (compounding effect)</li>
</ul>

<p>Konsistensi + value adalah kunci. Jangan spam, fokus pada relationship building untuk long-term retention.</p>',
'Newsletter Growth Hacks: Dari 0 ke 10,000 Subscribers dalam 6 Bulan',
'Strategi proven untuk grow email list dari nol ke 10K subscribers tanpa ads berbayar. Lead magnet, popup timing, dan social media integration.',
'publish', 'open', 'open', '', 'newsletter-growth-hacks-0-10k-subscribers', '', '', NOW(), UTC_TIMESTAMP(), '', 0, 'https://demo.azdevs.my.id/?p=103', 0, 'post', '', 0),

-- Post 4: Platform Comparison
(1, NOW(), UTC_TIMESTAMP(),
'<p>Memilih platform blog yang tepat adalah keputusan penting yang affect long-term success. Mari kita bandingkan 3 platform terpopuler dari sisi monetisasi, SEO, dan kontrol.</p>

<h2>WordPress (Self-Hosted)</h2>
<p><strong>Pros:</strong></p>
<ul>
<li>Full control atas konten dan data (nggak bisa di-ban sepihak)</li>
<li>SEO terbaik (custom domain, plugin Yoast/Rank Math, schema markup)</li>
<li>Monetisasi fleksibel (ads, affiliate, digital products, membership)</li>
<li>Theme & plugin unlimited (customize sesuka hati)</li>
<li>Ownership penuh (bisa dijual nanti)</li>
</ul>
<p><strong>Cons:</strong></p>
<ul>
<li>Butuh hosting ($5-10/bulan untuk starter)</li>
<li>Learning curve lebih tinggi (perlu belajar basic WP)</li>
<li>Maintenance sendiri (update, backup, security)</li>
<li>Zero built-in audience (harus build dari nol)</li>
</ul>
<p><strong>Best for:</strong> Long-term asset building, full monetization control, serious bloggers.</p>

<h2>Medium</h2>
<p><strong>Pros:</strong></p>
<ul>
<li>Built-in audience (distribution otomatis ke readers)</li>
<li>Setup cepat (5 menit langsung publish)</li>
<li>Medium Partner Program (monetisasi via reading time)</li>
<li>Clean, distraction-free writing experience</li>
<li>Mobile app bagus untuk nulis on-the-go</li>
</ul>
<p><strong>Cons:</strong></p>
<ul>
<li>SEO terbatas (semua di medium.com subdomain)</li>
<li>Paywall membatasi reach organic</li>
<li>Zero kontrol platform (Medium bisa ubah policy kapanpun)</li>
<li>Monetisasi cuma via MPP (nggak bisa pasang ads sendiri)</li>
<li>Susah build email list (nggak ada popup/lead magnet)</li>
</ul>
<p><strong>Best for:</strong> Quick validation, side hustle, writers yang nggak mau ribet teknis.</p>

<h2>Substack</h2>
<p><strong>Pros:</strong></p>
<ul>
<li>Newsletter-first approach (email ownership)</li>
<li>Subscription model built-in (paid newsletter mudah)</li>
<li>Setup super cepat</li>
<li>Community features (comments, discussions)</li>
</ul>
<p><strong>Cons:</strong></p>
<ul>
<li>SEO lemah (nggak rank di Google)</li>
<li>10% fee dari paid subscriptions</li>
<li>Customization minimal</li>
<li>Sulit diversify monetization</li>
</ul>
<p><strong>Best for:</strong> Newsletter creators, paid subscription focus.</p>

<h2>Verdict</h2>
<ul>
<li><strong>WordPress:</strong> Long-term asset building, full control, diversified monetization</li>
<li><strong>Medium:</strong> Quick validation, side project, minimize effort</li>
<li><strong>Substack:</strong> Newsletter-first strategy, paid subs</li>
</ul>

<p>Rekomendasi gue: <strong>Start WordPress</strong> kalau lu serius. Medium/Substack bisa jadi channel distribusi tambahan (cross-post), tapi base lu harus di platform yang lu control.</p>',
'Perbandingan Platform Blog: WordPress vs Medium vs Substack',
'Analisis lengkap WordPress, Medium, dan Substack dari sisi SEO, monetisasi, dan kontrol. Mana platform terbaik untuk blog lu?',
'publish', 'open', 'open', '', 'wordpress-vs-medium-vs-substack', '', '', NOW(), UTC_TIMESTAMP(), '', 0, 'https://demo.azdevs.my.id/?p=104', 0, 'post', '', 0),

-- Post 5: Affiliate Marketing
(1, NOW(), UTC_TIMESTAMP(),
'<p>Affiliate marketing bisa dimulai dari nol followers. Yang penting: traffic terget + konten yang solve problem. Berikut strategi praktis untuk pemula yang bisa generate first sale dalam 3 bulan.</p>

<h2>Pilih Niche yang Profitable</h2>
<p>Jangan terlalu broad. Contoh niche bagus (specific + profitable):</p>
<ul>
<li><strong>Productivity tools untuk freelancer</strong> - High intent, willing to pay</li>
<li><strong>Skincare untuk kulit berjerawat</strong> - Specific pain point, repeat buyers</li>
<li><strong>Hosting untuk blogger pemula</strong> - High ticket ($100-300/tahun)</li>
<li><strong>Fitness equipment untuk home gym</strong> - E-commerce affiliate friendly</li>
</ul>

<h2>SEO Article Strategy (Buyer Intent)</h2>
<p>Buat artikel yang target bottom-of-funnel keywords:</p>
<ol>
<li><strong>"[Product] vs [Competitor]"</strong> - High conversion (orang lagi compare = ready to buy)</li>
<li><strong>"Best [category] for [specific use case]"</strong> - Misal: "Best email tool for solopreneurs"</li>
<li><strong>"[Product] Review: Worth It or Not?"</strong> - Honest review dengan pros/cons</li>
<li><strong>"[Product] Discount/Coupon Code"</strong> - High commercial intent</li>
<li><strong>"How to [solve problem] with [product]"</strong> - Tutorial + soft sell</li>
</ol>

<h2>Tools Affiliate Recommended (High Commission)</h2>
<table>
<tr><th>Product</th><th>Commission</th><th>Cookie</th></tr>
<tr><td>ConvertKit</td><td>30% recurring</td><td>30 days</td></tr>
<tr><td>Kinsta</td><td>$50-500/sale</td><td>60 days</td></tr>
<tr><td>Tailwind</td><td>$15/sale</td><td>30 days</td></tr>
<tr><td>ClickFunnels</td><td>30-40% recurring</td><td>45 days</td></tr>
<tr><td>Shopify</td><td>$58-2000/sale</td><td>30 days</td></tr>
</table>

<h2>Content Distribution</h2>
<ul>
<li>Blog SEO articles (70% effort - long-term traffic)</li>
<li>YouTube reviews (20% - visual learners)</li>
<li>Pinterest pins (10% - discovery platform)</li>
</ul>

<h2>Realistic Expectations</h2>
<p><strong>Month 1-3:</strong> Build content (10-20 artikel), zero sales normal<br>
<strong>Month 4-6:</strong> First sales ($50-200), traffic mulai naik<br>
<strong>Month 7-12:</strong> Passive income mulai konsisten ($500-1,000)<br>
<strong>Year 2+:</strong> Scale ke $2K-5K/bulan dengan content compounding</p>

<h2>Kesalahan yang Harus Dihindari</h2>
<ul>
<li>❌ Promote semua produk (niche terlalu luas)</li>
<li>❌ Hard sell tanpa value (langsung jualan)</li>
<li>❌ Nggak disclose affiliate link (illegal + rusakin trust)</li>
<li>❌ Expect instant result (butuh 3-6 bulan)</li>
</ul>

<p><strong>Kunci success:</strong> Konsistensi + patience. Focus on evergreen content yang terus mendatangkan traffic organik tahun-tahun ke depan. Viral sekali nggak ada artinya dibanding 50 artikel yang masing-masing dapet 100 visitor/bulan selama 2 tahun.</p>',
'Affiliate Marketing untuk Pemula: Strategi Tanpa Followers Banyak',
'Panduan lengkap affiliate marketing dari nol: pilih niche, keyword strategy, tools recommendation, dan realistic timeline. First sale dalam 3 bulan!',
'publish', 'open', 'open', '', 'affiliate-marketing-untuk-pemula', '', '', NOW(), UTC_TIMESTAMP(), '', 0, 'https://demo.azdevs.my.id/?p=105', 0, 'post', '', 0);

-- Step 5: Link Posts to Categories
-- Post 1 → Marketing
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 101, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'category' AND term_id = (SELECT term_id FROM wp_terms WHERE slug = 'marketing');

-- Post 2 → Monetization
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 102, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'category' AND term_id = (SELECT term_id FROM wp_terms WHERE slug = 'monetization');

-- Post 3 → Email Marketing
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 103, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'category' AND term_id = (SELECT term_id FROM wp_terms WHERE slug = 'email-marketing');

-- Post 4 → Blogging
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 104, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'category' AND term_id = (SELECT term_id FROM wp_terms WHERE slug = 'blogging');

-- Post 5 → Affiliate Marketing
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 105, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'category' AND term_id = (SELECT term_id FROM wp_terms WHERE slug = 'affiliate-marketing');

-- Step 6: Link Posts to Tags
-- Post 1 tags: content marketing, SEO, digital marketing
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 101, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'post_tag' AND term_id IN (
    SELECT term_id FROM wp_terms WHERE slug IN ('content-marketing', 'seo', 'digital-marketing')
);

-- Post 2 tags: AdSense, blog monetization, passive income
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 102, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'post_tag' AND term_id IN (
    SELECT term_id FROM wp_terms WHERE slug IN ('adsense', 'blog-monetization', 'passive-income')
);

-- Post 3 tags: newsletter, email list, growth hacking
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 103, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'post_tag' AND term_id IN (
    SELECT term_id FROM wp_terms WHERE slug IN ('newsletter', 'email-list', 'growth-hacking')
);

-- Post 4 tags: WordPress, Medium, blogging platform
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 104, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'post_tag' AND term_id IN (
    SELECT term_id FROM wp_terms WHERE slug IN ('wordpress', 'medium', 'blogging-platform')
);

-- Post 5 tags: affiliate, passive income, online business
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order)
SELECT 105, term_taxonomy_id, 0 FROM wp_term_taxonomy 
WHERE taxonomy = 'post_tag' AND term_id IN (
    SELECT term_id FROM wp_terms WHERE slug IN ('affiliate', 'passive-income', 'online-business')
);

-- Step 7: Update term counts
UPDATE wp_term_taxonomy tt SET count = (
    SELECT COUNT(*) FROM wp_term_relationships tr WHERE tr.term_taxonomy_id = tt.term_taxonomy_id
);

-- Step 8: Clear WordPress cache (if using persistent object cache)
-- Manual: Go to WordPress admin and clear cache plugin if installed

-- ============================================
-- DONE! Now refresh https://demo.azdevs.my.id/
-- ============================================
