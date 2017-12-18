<?php
/**
 * Class to work with requests for support
 *
 * Key opportunities:
 *      1. creating a table in the database
 *      2. saving new requests
 *      3. viewing and deleting queries stored in the database
 *
 * @since 1.0.0
 *
 * @package Masterchek
 */

class Mch_Support_Class
{
    public $db_version = 2;
    public $db_prefix = 'requests_for_support';

    function __construct()
    {
        add_action('init', array($this, 'init'));
    }

    public function init()
    {
        $installed_db_version = get_option('support_db_version', 0);

        if (version_compare($this->db_version, $installed_db_version, '>'))
            $this->upgrade_table();
    }

    public function upgrade_table()
    {
        update_option('support_db_version', $this->db_version);
        $this->create_table();
    }

    public function create_table()
    {
        global $wpdb;
        $table_name = $wpdb->get_blog_prefix() . $this->db_prefix;
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        $sql = "CREATE TABLE {$table_name} ( 
                mch_id INT(11) unsigned NOT NULL auto_increment,
                mch_time VARCHAR(255) NOT NULL DEFAULT '',
                mch_author VARCHAR(255) NOT NULL DEFAULT '',
                mch_email VARCHAR(255) NOT NULL DEFAULT '',
                mch_tel VARCHAR(255) NOT NULL DEFAULT '',
                mch_subject VARCHAR(255) NOT NULL DEFAULT '',
                mch_message VARCHAR(255) NOT NULL DEFAULT '',
                PRIMARY KEY (mch_id)
        ) {$charset_collate};";

        dbDelta($sql);
    }

    public function add_entry($data)
    {
        global $wpdb;
        $table_name = $wpdb->get_blog_prefix() . $this->db_prefix;

        $wpdb->insert(
            $table_name,
            array(
                'mch_author' => $data['author'],
                'mch_time' => $data['time'],
                'mch_email' => $data['email'],
                'mch_tel' => $data['tel'],
                'mch_subject' => $data['subject'],
                'mch_message' => $data['message']
            ),
            array(
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
            )
        );
    }

    public function get_entries($sort_field = Null, $sort_order = Null)
    {
        global $wpdb;
        $table_name = $wpdb->get_blog_prefix() . $this->db_prefix;
        $sql_request = 'SELECT * FROM ' . $table_name;

        if ($sort_field) {
            $sql_request = $sql_request . '  ' . $sort_field;
        }

        if ($sort_order) {
            $sql_request = $sql_request . ' GROUP BY ' . $sort_order;
        }

        $results = $wpdb->get_results($sql_request, 'ARRAY_A');

        return $results;
    }
}

$Mch_Support = new Mch_Support_Class;


if (class_exists('WP_List_Table') == FALSE) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}


if (is_admin() == TRUE) {
    new Mch_Support_Init_Menu_Class();
}

/**
 * Class init menu item
 *
 * @since 1.0.0
 *
 * @package Masterchek
 */
class Mch_Support_Init_Menu_Class
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'createMenu'));
    }

    public function createMenu()
    {
        add_menu_page(
            'Support requests',
            'Support',
            'manage_options',
            'mch_support_table',
            array($this, 'createTable'),
            get_stylesheet_directory_uri() . '/images/icon-masterchek.png',
            37
        );
    }

    public function createTable()
    {
        $Table = new Mch_Support_Create_Table_Class();
        $Table->prepare_items();

        ?>
        <div class="wrap">
            <h2>Support requests</h2>
            <?php $Table->display(); ?>
        </div>
        <?php
    }
}

/**
 * Class creates a table to display support requests
 *
 * @since 1.0.0
 *
 * @package Masterchek
 */
class Mch_Support_Create_Table_Class extends WP_List_Table
{
    public function prepare_items()
    {
        global $Mch_Support;
        $per_page = 8;

        $data = $Mch_Support->get_entries();

        $this->set_pagination_args(array(
            'total_items' => count($data),
            'per_page' => $per_page
        ));

        $data = array_slice(
            $data,
            (($this->get_pagenum() - 1) * $per_page),
            $per_page
        );

        $this->_column_headers = array(
            $this->get_columns(),
            $this->get_hidden_columns(),
            $this->get_sortable_columns()
        );

        $this->items = $data;
    }

    public function get_columns()
    {
        return array(
            'mch_id' => 'ID',
            'mch_time' => 'Time',
            'mch_author' => 'Author',
            'mch_email' => 'Email',
            'mch_tel' => 'Phone number',
            'mch_subject' => 'Subject',
            'mch_message' => 'Message',
        );
    }

    public function get_hidden_columns()
    {
        return array();
    }

    public function get_sortable_columns()
    {
        return array();
    }

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'mch_id':
            case 'mch_time':
            case 'mch_author':
            case 'mch_email':
            case 'mch_tel':
            case 'mch_subject':
            case 'mch_message':
                return $item[$column_name];
            default:
                return print_r($item, true);
        }
    }
} ?>
