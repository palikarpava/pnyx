<?php
/**
 * Editor Class
 *
 * @package TotalPoll/Classes/Admin/Editor
 * @since   3.0.0
 */
if (defined('ABSPATH') === false) :
    exit;
endif; // Shhh

if (class_exists('TP_Admin_Ajax')) {
    return false;
}

class TP_Admin_Ajax
{

    protected $poll = false;
    protected $page = false;

    public function __construct()
    {
        add_action('wp_ajax_totalpoll_set_default_category', array($this, 'set_default_category'));
        add_action('wp_ajax_totalpoll_hide_welcome', array($this, 'hide_welcome'));
        add_action('wp_ajax_totalpoll_hide_pointers', array($this, 'hide_pointers'));
        add_action('wp_ajax_totalpoll_browse_statistics', array($this, 'browse_statistics'));
        add_action('wp_ajax_totalpoll_browse_logs', array($this, 'browse_logs'));
        add_action('wp_ajax_pnyx_browse_follow_up_responses', array($this, 'browse_follow_up_responses'));

        $poll_id = empty($_REQUEST['poll_id']) ? false : absint($_REQUEST['poll_id']);
        if ($poll_id && get_post_type($poll_id) === 'poll'):
            $this->poll = TotalPoll::poll($poll_id);
        endif;

        $this->page = empty($_REQUEST['page']) ? false : absint($_REQUEST['page']);

    }

    public function hide_welcome()
    {
        update_option('totalpoll_hide_welcome', true);
        wp_send_json_success();
    }

    public function hide_pointers()
    {
        if (empty($_REQUEST['type']) || $_REQUEST['type'] != 'global' && $_REQUEST['type'] != 'poll'):
            wp_send_json_error(array('message' => __('Invalid argument passed', TP_TD)));
        endif;

        update_option("totalpoll_hide_{$_REQUEST['type']}_pointers", true);
        wp_send_json_success();
    }

    public function browse_statistics()
    {
        if ($this->poll === false):
            wp_send_json_error(array('message' => __('Invalid argument passed', TP_TD)));
        endif;

        $statistician = TotalPoll::instance('admin/statistics');
        $statistics = $statistician->analyze($this->poll->id(), 200);
        $analyzed_percentage = $statistician->analyzed_percentage($this->poll->id());

        $response = array(
            'continue' => $analyzed_percentage < 100,
            'percentage' => $analyzed_percentage,
        );

        if ($analyzed_percentage == 100):
            $poll = $this->poll;

            ob_start();
            include TP_PATH . 'includes/admin/editor/browse/statistics-cards.php';
            $response['body'] = ob_get_clean();
        endif;

        wp_send_json_success($response);
    }

    public function browse_logs()
    {
        if ($this->poll === false || $this->page === false):
            wp_send_json_error(array('message' => __('Invalid argument passed', TP_TD)));
        endif;

        wp_send_json_success($this->paginate_meta('logs', $this->page, 'browse'));
    }

    public function browse_follow_up_responses()
    {
        if ($this->poll === false || $this->page === false):
            wp_send_json_error(array('message' => __('Invalid argument passed', TP_TD)));
        endif;

        wp_send_json_success($this->paginate_meta('follow-up-responses', $this->page, 'settings'));
    }

    private function paginate_meta($meta, $page, $section)
    {
        $per_page = 10;
        $poll = $this->poll;

        $meta_pageable = TotalPoll::instance('meta-pageable');
        $count = $meta_pageable->count($meta, $this->poll->id());
        $logs = $meta_pageable->paginate($meta, $this->poll->id(), $page, $per_page);
        $response = array(
            'items' => array(),
            'first' => $page === 1,
            'last' => $page === (int)ceil($count / $per_page),
            'previous' => $page === 1 ? 1 : $page - 1,
            'next' => $page + 1,
        );

        foreach ($logs as $item):
            ob_start();
            include TP_PATH . "includes/admin/editor/{$section}/{$meta}-item.php";
            $response['items'][] = ob_get_clean();
        endforeach;

        return $response;
    }

    public function set_default_category()
    {
        $category_id = (int)$_POST['category_id'];
        $term = get_term_by('id', $category_id, 'poll_category');
        if ($term) {
            update_option('totalpoll_default_category_id', $term->term_id);
        }
    }

}
