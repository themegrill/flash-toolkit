<?php
/**
 * Display notices in admin.
 *
 * @class    FT_Admin_Notices
 * @version  1.0.0
 * @package  FlashToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Admin_Notices Class
 */
class FT_Admin_Notices {

	/**
	 * Stores notices.
	 * @var array
	 */
	private static $notices = array();

	private static $current_user_data;

	protected static $active_theme;

	/**
	 * Array of notices - name => callback
	 * @var array
	 */
	private static $core_notices = array(
		'update' => 'update_notice',
	);

	/**
	 * Constructor.
	 */
	public static function init() {
		self::$notices = get_option( 'flash_toolkit_admin_notices', array() );

		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'shutdown', array( __CLASS__, 'store_notices' ) );

		self::$active_theme = wp_get_theme();


		if ( current_user_can( 'manage_flash_toolkit' ) ) {
			add_action( 'admin_print_styles', array( __CLASS__, 'add_notices' ) );
		}

		add_action( 'wp_loaded', array( __CLASS__, 'pro_notice' ) );

	}

	/**
	 * Store notices to DB
	 */
	public static function store_notices() {
		update_option( 'flash_toolkit_admin_notices', self::get_notices() );
	}

	/**
	 * Hooks for showing Pro theme notice.
	 */
	public static function pro_notice() {

		global $current_user;
		self::$current_user_data = $current_user;

		if ( 'Flash' != self::$active_theme ) {
			return;
		}

		$option = get_option( 'flash_pro_notice_start_time' );
		if ( ! $option ) {
			update_option( 'flash_pro_notice_start_time', time() );
		}

		add_action( 'admin_notices', array( __CLASS__, 'pro_notice_markup' ), 0 );
		add_action( 'admin_init', array( __CLASS__, 'pro_notice_temporary_ignore' ), 0 );
		add_action( 'admin_init', array( __CLASS__, 'pro_notice_permanent_ignore' ), 0 );

	}

	public static function pro_notice_markup() {
		$temporary_ignore = get_user_meta( self::$current_user_data->ID, 'flash_pro_notice_temporary_ignore_nag', true );
		$permanent_ignore = get_user_meta( self::$current_user_data->ID, 'flash_pro_notice_permanent_ignore_nag', true );

		if ( ( get_option( 'flash_pro_notice_start_time' ) > strtotime( '-1 min' ) ) || ( $temporary_ignore > strtotime( '-1 min' ) ) || $permanent_ignore ) {
			return;
		}
		?>

		<div class="updated pro-theme-notice">
			<h3 class="pro-notice-heading"><?php esc_html_e( 'Unlock true potential of Flash', 'flash-toolkit' ); ?></h3>

			<p class="pro-notice-message">
				<?php
				printf(
					esc_html__(
						'Howdy, You\'ve been using %1$s for a while now, and we hope you\'re happy with it. If you need more options and want to get access to the Premium features, you can click link below: ', 'themegrill-demo-importer'
					),
					self::$active_theme
				);
				?>
			</p> <!-- /.pro-notice-message -->

			<a class="notice-dismiss" href="?flash_pro_notice_temporary_ignore_nag=1"></a>

			<div class="ft-cta">
				<?php
				$pro_link = '<a target="_blank" href=" ' . esc_url( "https://themegrill.com/plans-pricing/" ) . ' ">' . esc_html( 'Go Pro' ) . ' </a>';
				?>

				<a href="https://themegrill.com/plans-pricing/" class="btn button-primary" target="_blank">
					<span class="dashicons dashicons-thumbs-up"></span>
					<span><?php esc_html_e( 'Go Pro', 'flash-toolkit' ); ?></span>
				</a>

				<a href="?flash_pro_notice_permanent_ignore_nag=1" class="btn button-secondary">
					<span class="dashicons dashicons-smiley"></span>
					<span><?php esc_html_e( 'I already have Pro version', 'flash-toolkit' ); ?></span>
				</a>
			</div> <!-- /.ft-cta -->
		</div> <!-- /.pro-theme-notice -->

		<?php
	}

	public static function pro_notice_temporary_ignore() {
		$user_id = self::$current_user_data->ID;

		if ( isset( $_GET['flash_pro_notice_temporary_ignore_nag'] ) && '1' == $_GET['flash_pro_notice_temporary_ignore_nag'] ) {
			update_user_meta( $user_id, 'flash_pro_notice_temporary_ignore_nag', time() );
		}
	}

	public static function pro_notice_permanent_ignore() {

		global $current_user;
		$user_id = $current_user->ID;

		if ( isset( $_GET['flash_pro_notice_permanent_ignore_nag'] ) && '1' == $_GET['flash_pro_notice_permanent_ignore_nag'] ) {
			add_user_meta( $user_id, 'flash_pro_notice_permanent_ignore_nag', 'true', true );
		}
	}

	/**
	 * Get notices.
	 * @return array
	 */
	public static function get_notices() {
		return self::$notices;
	}

	/**
	 * Remove all notices.
	 */
	public static function remove_all_notices() {
		self::$notices = array();
	}

	/**
	 * Show a notice.
	 * @param string $name
	 */
	public static function add_notice( $name ) {
		self::$notices = array_unique( array_merge( self::get_notices(), array( $name ) ) );
	}

	/**
	 * Remove a notice from being displayed.
	 * @param string $name
	 */
	public static function remove_notice( $name ) {
		self::$notices = array_diff( self::get_notices(), array( $name ) );
		delete_option( 'flash_toolkit_admin_notice_' . $name );
	}

	/**
	 * See if a notice is being shown.
	 * @param  string  $name
	 * @return boolean
	 */
	public static function has_notice( $name ) {
		return in_array( $name, self::get_notices() );
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['flash-toolkit-hide-notice'] ) && isset( $_GET['_flash_toolkit_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_flash_toolkit_notice_nonce'], 'flash_toolkit_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'flash-toolkit' ) );
			}

			if ( ! current_user_can( 'manage_flash_toolkit' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'flash-toolkit' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['flash-toolkit-hide-notice'] );

			self::remove_notice( $hide_notice );

			update_user_meta( get_current_user_id(), 'dismissed_' . $hide_notice . '_notice', true );

			do_action( 'flash_toolkit_hide_' . $hide_notice . '_notice' );
		}
	}

	/**
	 * Add notices + styles if needed.
	 */
	public static function add_notices() {
		$notices = self::get_notices();

		if ( $notices ) {
			wp_enqueue_style( 'flash-toolkit-activation', FT()->plugin_url() . '/assets/css/activation.css', array(), FT_VERSION );

			// Add RTL support
			wp_style_add_data( 'flash-toolkit-activation', 'rtl', 'replace' );

			foreach ( $notices as $notice ) {
				if ( ! empty( self::$core_notices[ $notice ] ) && apply_filters( 'flash_toolkit_show_admin_notice', true, $notice ) ) {
					add_action( 'admin_notices', array( __CLASS__, self::$core_notices[ $notice ] ) );
				} else {
					add_action( 'admin_notices', array( __CLASS__, 'output_custom_notices' ) );
				}
			}
		}
	}

	/**
	 * Add a custom notice.
	 * @param string $name
	 * @param string $notice_html
	 */
	public static function add_custom_notice( $name, $notice_html ) {
		self::add_notice( $name );
		update_option( 'flash_toolkit_admin_notice_' . $name, wp_kses_post( $notice_html ) );
	}

	/**
	 * Output any stored custom notices.
	 */
	public static function output_custom_notices() {
		$notices = self::get_notices();

		if ( $notices ) {
			foreach ( $notices as $notice ) {
				if ( empty( self::$core_notices[ $notice ] ) ) {
					$notice_html = get_option( 'flash_toolkit_admin_notice_' . $notice );

					if ( $notice_html ) {
						include( 'views/html-notice-custom.php' );
					}
				}
			}
		}
	}

	/**
	 * If we need to update, include a message with the update button.
	 */
	public static function update_notice() {
		if ( version_compare( get_option( 'flash_toolkit_db_version' ), FT_VERSION, '<' ) ) {
			$updater = new FT_Background_Updater();
			if ( $updater->is_updating() || ! empty( $_GET['do_update_flash_toolkit'] ) ) {
				include( 'views/html-notice-updating.php' );
			} else {
				include( 'views/html-notice-update.php' );
			}
		} else {
			include( 'views/html-notice-updated.php' );
		}
	}
}

FT_Admin_Notices::init();
