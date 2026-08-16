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
        <p><?php esc_html_e( 'Generate contoh konten (kategori, tag, 12 artikel, featured images, dan komentar) biar theme langsung kelihatan hidup. Semua bisa dihapus sekali klik.', 'genrolla' ); ?></p>

        <?php if ( isset( $_GET['genrolla_demo_done'] ) ) : ?>
            <div class="notice notice-success">
                <p><strong><?php esc_html_e( 'Berhasil!', 'genrolla' ); ?></strong> <?php esc_html_e( 'Demo content berhasil di-generate.', 'genrolla' ); ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank"><?php esc_html_e( 'Lihat situs', 'genrolla' ); ?></a>
                </p>
            </div>
        <?php endif; ?>
        <?php if ( isset( $_GET['genrolla_demo_reset'] ) ) : ?>
            <div class="notice notice-success">
                <p><strong><?php esc_html_e( 'Done!', 'genrolla' ); ?></strong> <?php esc_html_e( 'Semua demo content sudah dihapus.', 'genrolla' ); ?></p>
            </div>
        <?php endif; ?>

        <?php if ( $imported ) : ?>
            <div class="notice notice-warning">
                <p><?php esc_html_e( 'Demo content sudah pernah di-import.', 'genrolla' ); ?></p>
            </div>
        <?php endif; ?>

        <form method="post" style="margin-top:16px">
            <?php wp_nonce_field( 'genrolla_demo_import' ); ?>
            <p>
                <button class="button button-primary button-hero" type="submit" name="genrolla_demo_action" value="import">
                    <?php esc_html_e( 'Import Demo Content Sekarang', 'genrolla' ); ?>
                </button>
            </p>
        </form>

        <form method="post" style="margin-top:8px">
            <?php wp_nonce_field( 'genrolla_demo_reset' ); ?>
            <p>
                <button class="button button-secondary" type="submit" name="genrolla_demo_action" value="reset" onclick="return confirm('<?php esc_attr_e( 'Hapus semua demo content?', 'genrolla' ); ?>');">
                    <?php esc_html_e( 'Hapus Demo Content', 'genrolla' ); ?>
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
        ),
        'tags'       => array( 'cv', 'job-hunting', 'fresh-graduate', 'gaji', 'negosiasi', 'investasi', 'reksadana', 'personal-finance', 'productivity', 'notion', 'deep-work', 'skill', 'future-of-work', 'burnout', 'mental-health', 'linkedin', 'interview', 'portfolio', 'magang', 'freelance' ),
        'posts'      => array(
            array(
                'title'    => 'CV Gen Z yang Bikin HR Berhenti Scroll: 7 Elemen Wajib',
                'slug'     => 'cv-gen-z-hr-berhenti-scroll',
                'category' => 'Career',
                'tags'     => array( 'cv', 'job-hunting', 'fresh-graduate' ),
                'image'    => 'https://images.unsplash.com/photo-1586281380349-632531db7ed4?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Pernah nggak sih kirim CV ke puluhan perusahaan tapi nggak ada satu pun yang dipanggil? Tenang, kamu nggak sendirian. HR rata-rata cuma menghabiskan 7 detik buat memutuskan CV kamu layak dibaca atau langsung masuk keranjang sampah.</p><h2>1. Satu Halaman, Fokus ke Satu Hal</h2><p>Fresh graduate nggak butuh CV 3 halaman. Recruiter mau liat value kamu dalam 60 detik.</p><ul><li>Hapus yang nggak relevan</li><li>Pakai bullet point, bukan paragraf panjang</li><li>Prioritaskan pencapaian terbaru</li></ul><h2>2. Headline yang Menjual</h2><p>Jangan cuma nulis "Fresh Graduate". Tulis value proposition kamu dalam satu kalimat yang jelas.</p><h2>3. Pencapaian, Bukan Job Desc</h2><p>Jangan nulis "Bertanggung jawab atas media sosial". Tulis dampaknya: "Menumbuhkan followers dari 2K ke 15K dalam 6 bulan".</p><h2>Kesimpulan</h2><p>CV yang bagus bukan soal template mahal — tapi soal kejelasan value.</p>',
            ),
            array(
                'title'    => 'Magang vs Freelance: Mana yang Lebih Cepat Bikin CV Gemuk?',
                'slug'     => 'magang-vs-freelance-cv-gemuk',
                'category' => 'Career',
                'tags'     => array( 'magang', 'freelance', 'karir' ),
                'image'    => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Dua-duanya nambah value, tapi hasilnya beda tergantung tujuan karier kamu. Magang kasih struktur, bimbingan, dan pengalaman kerja tim. Freelance kasih portofolio nyata, uang, dan jam terbang mandiri.</p><h2>Magang: Struktur & Networking</h2><p>Magang cocok kalau kamu masih butuh bimbingan dan mau bangun networking di industri.</p><h2>Freelance: Portofolio & Uang</h2><p>Freelance cocok kalau kamu udah punya skill dan mau bukti nyata hasil kerja.</p><h2>Kombinasi Terbaik</h2><p>Magang pagi, freelance malam — yang penting konsisten dan hasilnya keliatan.</p>',
            ),
            array(
                'title'    => '5 Langkah Negosiasi Gaji buat Fresh Graduate yang Baru Diterima',
                'slug'     => 'negosiasi-gaji-fresh-graduate',
                'category' => 'Career',
                'tags'     => array( 'gaji', 'negosiasi' ),
                'image'    => 'https://images.unsplash.com/photo-1560264280-88b68371db39?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Dapet tawaran kerja itu kemenangan besar. Tapi jangan buru-buru tanda tangan — momen ini justru saat paling tepat buat negosiasi gaji.</p><h2>1. Riset Range Gaji</h2><p>Cari tau range gaji fresh graduate di posisi dan kota kamu. Jangan asal sebut angka.</p><h2>2. Jangan Sebut Angka Duluan</h2><p>Kalau ditanya ekspektasi, tanya balik budget-nya. Atau kasih range yang realistis.</p><h2>3. Sebut Nilai Kamu</h2><p>Bawa bukti: prestasi magang, portofolio, skill langka yang kamu punya.</p><h2>4. Pertimbangkan Total Package</h2><p>Gaji bukan segalanya. Tunjangan, bonus, training, dan jenjang karier juga penting.</p><h2>5. Jangan Takut Ditanya Balik</h2><p>Negosiasi itu dialog, bukan permintaan. Bersikap profesional dan percaya diri.</p>',
            ),
            array(
                'title'    => 'Investasi Reksadana Rp100 Ribu/Bulan: Mulai dari Mana?',
                'slug'     => 'investasi-reksadana-100-ribu',
                'category' => 'Finance',
                'tags'     => array( 'investasi', 'reksadana', 'personal-finance' ),
                'image'    => 'https://images.unsplash.com/photo-1579532537598-459ecdaf39cc?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Nggak perlu nunggu kaya buat mulai investasi. Seratus ribu per bulan udah cukup kok buat mulai. Kuncinya: konsisten.</p><h2>Apa Itu Reksadana?</h2><p>Reksadana itu wadah kelola dana bersama. Kamu beli unit, manajer investasi yang muter duitnya ke pasar.</p><h2>Pilih Jenis Sesuai Profil Risiko</h2><ul><li><strong>Pasar Uang:</strong> paling aman, cocok dana darurat</li><li><strong>Pendapatan Tetap:</strong> obligasi, risiko sedang</li><li><strong>Saham:</strong> agresif, buat jangka panjang</li></ul><h2>Mulai dari Aplikasi Resmi</h2><p>Pilih platform terdaftar OJK, minimal deposit Rp10 ribu, dan aktifkan autodebit biar konsisten.</p><h2>Kesimpulan</h2><p>Mulai kecil, konsisten, dan jangan panik sama fluktuasi harian.</p>',
            ),
            array(
                'title'    => 'Gaji Pertama? Begini Cara Ngatur Duit Biar Nggak Boncos',
                'slug'     => 'gaji-pertama-atur-duit',
                'category' => 'Finance',
                'tags'     => array( 'gaji', 'personal-finance' ),
                'image'    => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Gaji pertama masuk, rasanya pengen beli semua yang dulu nggak bisa. Tapi sebelum kalap, ini cara ngatur biar akhir bulan nggak boncos.</p><h2>Rumus 50/30/20</h2><ul><li><strong>50% Kebutuhan:</strong> kosan, makan, transport</li><li><strong>30% Keinginan:</strong> hiburan, nongkrong, belanja</li><li><strong>20% Tabungan & Investasi:</strong> bayar diri sendiri dulu</li></ul><h2>Pisahkan Rekening</h2><p>Bikin 3 rekening: harian, tabungan, dan darurat. Transfer otomatis tanggal gajian.</p><h2>Dana Darurat Dulu</h2><p>Sebelum investasi, kumpulin dana darurat 3-6x pengeluaran bulanan.</p>',
            ),
            array(
                'title'    => 'Deep Work buat Gen Z: Fokus 2 Jam Lebih Nendang dari 8 Jam',
                'slug'     => 'deep-work-gen-z',
                'category' => 'Productivity',
                'tags'     => array( 'productivity', 'deep-work' ),
                'image'    => 'https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Kalau kamu kerja 8 jam tapi rasanya nggak kelar-kelar, masalahnya bukan waktu — tapi fokus. Deep work adalah kemampuan fokus penuh tanpa distraksi.</p><h2>Kenapa Deep Work Penting</h2><p>Di era notifikasi, orang yang bisa fokus 2 jam aja udah rare. Skill ini makin langka dan makin berharga.</p><h2>Cara Mulai</h2><ul><li>Matikan notifikasi & taruh HP di ruangan lain</li><li>Blokir 90-120 menit per sesi</li><li>Satu tugas per sesi</li><li>Catat progress</li></ul><h2>Consistency > Intensity</h2><p>Satu sesi deep work per hari lebih baik daripada marathon pas lagi mood.</p>',
            ),
            array(
                'title'    => 'Notion vs Google Keep: Mana yang Cocok buat Anak Kuliah?',
                'slug'     => 'notion-vs-google-keep',
                'category' => 'Productivity',
                'tags'     => array( 'productivity', 'notion' ),
                'image'    => 'https://images.unsplash.com/photo-1517842645767-c639042777db?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Dua tools catatan paling populer. Tapi kebutuhan kamu menentukan mana yang menang.</p><h2>Google Keep: Simpel & Cepat</h2><p>Keep cocok buat catatan kilat: reminder, daftar belanja, ide mendadak. Instant sync sama Google account.</p><h2>Notion: Power User</h2><p>Notion cocok buat yang mau database, template kuliah, habit tracker, atau project management.</p><h2>Kesimpulan</h2><p>Keduanya gratis. Pakai Keep buat capture cepat, Notion buat organize besar. Dua-duanya bisa jalan bareng.</p>',
            ),
            array(
                'title'    => 'Skill yang Paling Dicari di 2026 (Bukan Coding!)',
                'slug'     => 'skill-paling-dicari-2026',
                'category' => 'Self-Growth',
                'tags'     => array( 'skill', 'future-of-work' ),
                'image'    => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>AI ngambil banyak kerjaan teknis, tapi skill manusiawi justru makin dicari perusahaan. Ini beberapa yang lagi naik daun.</p><h2>1. Komunikasi & Copywriting</h2><p>AI bisa nulis, tapi yang bisa memilih kata yang tepat buat manusia masih butuh manusia.</p><h2>2. Problem Solving</h2><p>Kemampuan memecah masalah kompleks jadi langkah kecil itu yang susah ditiru.</p><h2>3. AI Literacy</h2><p>Bukan cuma bisa prompt, tapi paham cara kerja dan limitasi AI.</p><h2>4. Empati & Soft Skill</h2><p>Kolaborasi, negosiasi, dan leadership nggak akan tergantikan.</p>',
            ),
            array(
                'title'    => 'Burnout di Usia 22: Tanda, Penyebab, dan Cara Pulih',
                'slug'     => 'burnout-usia-22',
                'category' => 'Lifestyle',
                'tags'     => array( 'burnout', 'mental-health' ),
                'image'    => 'https://images.unsplash.com/photo-1499209974431-9dddcece7f88?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Capek mental tapi nggak bisa cuti? Itu bukan malas — itu burnout. Dan burnout di usia muda itu nyata.</p><h2>Tanda-tanda Burnout</h2><ul><li>Mood swing & gampang emosi</li><li>Nggak ada energi buat hal yang dulu disuka</li><li>Sulit tidur atau malah kebanyakan tidur</li><li>Gangguan fisik: sakit kepala, perut</li></ul><h2>Kenapa Gen Z Rentan</h2><p>Budaya hustle, perbandingan di sosmed, dan ekspektasi tinggi bikin tekanan nambah.</p><h2>Cara Pulih</h2><ul><li>Kurangi beban, berani bilang nggak</li><li>Screen time detox</li><li>Olahraga ringan</li><li>Jangan ragu cari bantuan profesional</li></ul>',
            ),
            array(
                'title'    => 'LinkedIn Profile Check: 5 Hal yang Bikin Recruiter Nge-DM Kamu',
                'slug'     => 'linkedin-profile-check',
                'category' => 'Career',
                'tags'     => array( 'linkedin', 'job-hunting' ),
                'image'    => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Recruiter itu kayak dating app — mereka swipe based on first impression. Ini 5 hal yang bikin profil kamu stand out.</p><h2>1. Headline yang Jelas</h2><p>Bukan cuma "Mahasiswa", tapi "Content Writer | 2 tahun freelance | 50+ artikel SEO".</p><h2>2. Foto Profil Profesional</h2><p>Foto jelas, senyum tipis, background rapi. Nggak harus jasa foto, yang penting wajar.</p><h2>3. About Section yang Menjual</h2><p>Tulis value kamu dalam 3-4 kalimat. Cerita kenapa kamu beda.</p><h2>4. Pengalaman dengan Angka</h2><p>Setiap experience harus ada angka: "Meningkatkan traffic 40%".</p><h2>5. Aktif & Konsisten</h2><p>Post atau repost 2-3x seminggu biar algoritma aware sama kamu.</p>',
            ),
            array(
                'title'    => 'Interview Kerja Online: Cara Jawab 5 Pertanyaan Paling Sering',
                'slug'     => 'interview-kerja-online',
                'category' => 'Career',
                'tags'     => array( 'interview', 'job-hunting' ),
                'image'    => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>"Ceritain tentang diri kamu" — pertanyaan yang paling gampang bikin otak blank. Ini cara jawab pertanyaan paling umum di interview online.</p><h2>1. Ceritakan Tentang Diri Kamu</h2><p>Pakai format masa lalu-sekarang-masa depan. Pengalaman → posisi sekarang → kenapa apply di sini.</p><h2>2. Kenapa Kamu Mau Kerja di Sini?</h2><p>Riset company dulu. Sebut 1-2 hal spesifik yang kamu suka dari mereka.</p><h2>3. Apa Kelemahan Kamu?</h2><p>Jujur + tunjukkan perbaikan: "Saya kurang sabar, tapi sekarang pakai checklist biar sistematis".</p><h2>4. Ekspektasi Gaji</h2><p>Kasih range berdasarkan riset. Siap jelasin alasannya.</p><h2>5. Ada Pertanyaan?</h2><p>Selalu siap 2 pertanyaan. Itu sinyal kamu serius.</p>',
            ),
            array(
                'title'    => 'Portofolio Digital: 3 Tools Gratis buat Nunjukin Skill Kamu',
                'slug'     => 'portofolio-digital-tools',
                'category' => 'Career',
                'tags'     => array( 'portfolio', 'skill' ),
                'image'    => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=800&auto=format&fit=crop',
                'content'  => '<p>Ijazah nggak cukup. Recruiter sekarang mau liat bukti. Ini 3 tools portfolio yang gampang banget dipake.</p><h2>1. Notion Portfolio</h2><p>Gratis, bisa di-custom, bagus buat writer dan marketer. Share via link.</p><h2>2. Behance</h2><p>Wajib buat designer dan creative. Udah ada komunitas dan discoverability.</p><h2>3. GitHub Pages</h2><p>Buat developer: hosting statis gratis, cukup push HTML/CSS/JS.</p><h2>Bonus: Canva</h2><p>Buat one-page portfolio PDF yang cakep tanpa skill desain.</p>',
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

        $post_id = wp_insert_post( array(
            'post_title'   => $post_data['title'],
            'post_name'    => $post_data['slug'],
            'post_content' => $post_data['content'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_category' => $cat_id ? array( $cat_id ) : array(),
            'tags_input'   => $post_data['tags'],
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
        'Keren banget nih, langsung kepake buat lamaran gue minggu depan!',
        'Nungguin artikel kayak gini dari dulu. Makasih genrolla!',
        'Bener banget, gue ngalamin sendiri. Thanks udah nulis ini.',
        'Mau tanya dong, kalau beda jurusan tapi pengen masuk bidang ini gimana?',
        'Save dulu buat dibaca ulang nanti. Bagus banget struktur artikelnya.',
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
