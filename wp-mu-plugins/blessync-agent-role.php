<?php
/**
 * Plugin Name: Blessync Agent Role
 * Description: Membuat role "blessync-agent" untuk agent AI: hanya bisa mengelola POST (buat, edit, publish, hapus, upload media). Tidak punya akses ke halaman, plugin, tema, user, atau setting.
 * Version: 1.0.0
 * Author: Blessync
 *
 * CARA PASANG:
 * 1. Buat folder  wp-content/mu-plugins/  kalau belum ada
 * 2. Simpan file ini sebagai  wp-content/mu-plugins/blessync-agent.php
 * 3. Selesai. mu-plugin otomatis aktif (tidak perlu diaktifkan dari dashboard, dan tidak bisa dimatikan dari dashboard).
 * 4. Buat user baru (Users > Add New), beri role "Blessync Agent", lalu generate Application Password untuk user itu.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Kapabilitas yang DIBERIKAN (khusus post type "post"):
 *  - read                 : akses dasar ke WP admin & REST API
 *  - edit_posts           : membuat post baru + edit post sendiri
 *  - edit_others_posts    : edit post milik orang lain
 *  - edit_published_posts : edit post yang sudah dipublish
 *  - publish_posts        : publish post
 *  - delete_posts         : hapus post sendiri
 *  - delete_others_posts  : hapus post milik orang lain
 *  - delete_published_posts : hapus post yang sudah dipublish
 *  - upload_files         : upload media (gambar). Hapus baris ini kalau tidak diperlukan.
 *
 * SENGAJA TIDAK DIBERIKAN (biar akses terbatas di post saja):
 *  edit_pages, publish_pages, edit_others_pages, delete_pages,
 *  install_plugins, activate_plugins, edit_plugins,
 *  switch_themes, edit_themes, edit_theme_options,
 *  manage_options, edit_users, create_users, delete_users,
 *  edit_files, import, export, unfiltered_html
 */
function blessync_agent_role_capabilities() {
	return array(
		'read'                   => true,
		'edit_posts'             => true,
		'edit_others_posts'      => true,
		'edit_published_posts'   => true,
		'publish_posts'          => true,
		'delete_posts'           => true,
		'delete_others_posts'    => true,
		'delete_published_posts' => true,
		'upload_files'           => true, // hapus baris ini kalau media tidak diperlukan
	);
}

/**
 * Buat / sinkronkan role saat WordPress dimuat.
 * Kalau kapabilitas di file ini diubah, role otomatis ikut diperbarui.
 */
function blessync_agent_register_role() {
	$caps = blessync_agent_role_capabilities();
	$role = get_role( 'blessync-agent' );

	if ( ! $role ) {
		add_role( 'blessync-agent', 'Blessync Agent', $caps );
		return;
	}

	// Role sudah ada: pastikan kapabilitasnya sama dengan daftar di atas
	$current = $role->capabilities;
	$changes = false;

	foreach ( $caps as $cap => $grant ) {
		if ( empty( $current[ $cap ] ) ) {
			$role->add_cap( $cap );
			$changes = true;
		}
	}

	// Cabut kapabilitas yang tidak ada di daftar (misalnya sisa kapabilitas lama)
	foreach ( $current as $cap => $grant ) {
		if ( ! array_key_exists( $cap, $caps ) ) {
			$role->remove_cap( $cap );
			$changes = true;
		}
	}

	if ( $changes ) {
		// bersihkan cache kapabilitas
		wp_cache_flush();
	}
}
add_action( 'init', 'blessync_agent_register_role' );

/**
 * Opsional: pastikan role ini juga bisa mengakses Application Passwords
 * (Application Passwords adalah fitur core, tapi sebagian plugin keamanan mematikannya).
 */
add_filter( 'wp_is_application_passwords_available', '__return_true' );

/**
 * Opsional: sembunyikan menu yang tidak relevan di admin untuk role ini
 * agar agen tidak bingung (tidak memberi akses, hanya merapikan tampilan).
 */
function blessync_agent_admin_menu() {
	$user = wp_get_current_user();
	if ( ! $user || ! in_array( 'blessync-agent', (array) $user->roles, true ) ) {
		return;
	}
	remove_menu_page( 'edit.php?post_type=page' );
	remove_menu_page( 'themes.php' );
	remove_menu_page( 'plugins.php' );
	remove_menu_page( 'users.php' );
	remove_menu_page( 'tools.php' );
	remove_menu_page( 'options-general.php' );
}
add_action( 'admin_menu', 'blessync_agent_admin_menu', 999 );
