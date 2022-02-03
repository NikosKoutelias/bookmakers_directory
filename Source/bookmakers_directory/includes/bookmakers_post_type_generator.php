<?php

// add_action('init','create_post_type' );

// function create_post_type(){
//     register_post_type('bookmakers_generator', array(
//         'public' => true,
//         'labels' => array(
//             'name' => 'Bookmakers Generator',
//             'add_new' => 'New Bookmakers Generator',
//             'edit_item' => 'Επεξεργασία',
//             'all_items' => 'Όλα τα Generators'
//         ),
//         'menu_icon' => 'dashicons-list-view',
//         'rewrite' => array('slug' => 'bookmakers_genarator', 'with_front' => false),
//         'supports' => array('title','custom-fields'),
//     ));
// }

// function remove_yoast_metabox_bookmakers()
// {
//     $screen = get_current_screen();
//     remove_meta_box('wpseo_meta', $screen, 'normal');
// }

// add_action('add_meta_boxes', 'remove_yoast_metabox_bookmakers', 11);


class TestPlugin
{

    function __construct()
    {


        add_action('admin_menu', array($this, 'adminPage'));

        add_action('admin_init', array($this, 'settings'));

        add_filter('the_content', array($this, 'ifWrap'));
    }

    function ifWrap($content)
    {
        if (is_main_query() and is_front_page()) {
            return $this->createHTML($content);
        }
        return $content;
    }

    function createHTML($content)
    {
        $html = '<div class="wrap"><h3>' . esc_html(get_option('test_headline', 'Post Statistics')) . '</h3><p>';


        $html .= '<div class="post-item">This is the content </p><hr></div></div>';

        if (get_option('test_loc', '0') == '0') {
            return $html . $content;
        }
        return $content . $html;
    }




    function settings()
    {
        add_settings_section('first_section', 'ONe', null, 'test_settings_page');

        add_settings_field('test_loc', 'Display Location', array($this, 'locationHTML'), 'test_settings_page', 'first_section');
        register_setting('testplugin', 'test_loc', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0'));

        add_settings_field('test_headline', 'Headline Text', array($this, 'headlineHTML'), 'test_settings_page', 'first_section');
        register_setting('testplugin', 'test_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

        add_settings_field('test_check', 'Check', array($this, 'checkBoxHTML'), 'test_settings_page', 'first_section', array('theName' => 'test_check'));
        register_setting('testplugin', 'test_check', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

        add_settings_field('alt_check', 'Check2', array($this, 'checkBoxHTML'), 'test_settings_page', 'first_section', array('theName' => 'alt_check'));
        register_setting('testplugin', 'alt_check', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
    }

    function sanitizeLocation($input)
    {
        if ($input != 0 && $input != 1) {
            add_settings_error('test_loc', 'error_location', 'Invalid Value');
            return get_option('test_loc');
        }

        return $input;
    }

    function checkBoxHTML($args)
    {
?>
        <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
    <?php
    }

    function headlineHTML()
    {
    ?>
        <input type="text" name="test_headline" value="<?php echo esc_attr(get_option('test_headline')); ?>">
    <?php
    }

    function locationHTML()
    {
    ?>
        <select name="test_loc">
            <option value="0" <?php selected(get_option('test_loc'), '0'); ?>>Beginning</option>
            <option value="1" <?php selected(get_option('test_loc'), '1'); ?>>End</option>
        </select>
    <?php
    }


    function adminPage()
    {
        add_menu_page('Bookmakers Shortcode Generator', 'Bookmakers Shortcode', 'manage_options', 'shortcode_generator', array($this, 'adminHTML'));
        add_options_page('Test', 'Test Plug', 'manage_options', 'test_settings_page', array($this, 'ourHTML'));
    }


    function adminHTML()
    {
    ?>
        <div class="flex-wrap col-12">
            <h1>Plug Settings</h1>
            <form action="" " method="">

            <div class=" form-group col-4">
                <label for="results_short" class="lead">Αποτελέσματα Shortcode</label>
                <input class="form-control " type="text" name="results_short" value="<?php  ?>">
        </div>
        <div class="form-group col-2  ">
            <label for="order_by" class="h5">Order By</label>
            <select class="form-control text-center p-0 " name="order_by">
                <option value="0" disabled selected>Choose option</option>
                <option value="1">ASC</option>
                <option value="2">DESC</option>
                <option value="3" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" <?php ?>>Sorting ID</option>
            </select>

        </div>
        <div class="form-group col-1">
            <label for="limit_short" class="h5">Limit</label>
            <input class="form-control " type="text" name="limit_short" value="<?php  ?>">
        </div>

        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </div>
                </div>
            </div>

            </form>
        </div>
    <?php
    }

    function ourHTML()
    {
    ?>

        <div class="wrap">
            <h1>Plug Settings</h1>
            <form action="options.php" method="POST">
                <?php
                // no need settings_errors() because we are in settings page
                settings_fields('testplugin');
                do_settings_sections('test_settings_page');
                submit_button();

                ?>
            </form>
        </div>

<?php
    }
}


$test_plug = new TestPlugin();




?>