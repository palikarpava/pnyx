<?php
if (defined('ABSPATH') === false) :
    exit;
endif;

require_once __DIR__."/../map/MapFirst.php";
require_once __DIR__."/../map/MapSecond.php";
require_once __DIR__."/../map/MapThird.php";

if (!class_exists('TP_Poll')) :

    /**
     * Poll Class
     *
     * @package TotalPoll/Classes/Poll
     * @since   3.0.0
     */
    class TP_Poll
    {

        /**
         * @var int Poll ID.
         * @access private
         * @since  3.0.0
         */
        private $id;

        /**
         * @var string Poll Unique ID
         * @access private
         * @since  3.0.0
         */
        private $uniqueid = '';

        /**
         * TODO do we need Title ?
         */
        /**
         * @var int Poll total votes.
         * @access private
         * @since  3.0.0
         */
        private $votes = 0;

        /**
         * @var string Poll Question.
         * @access private
         * @since  3.0.0
         */
        private $question = null;

        /**
         * @var string Poll Video question.
         * @access private
         * @since  3.0.0
         */
        private $video_question = null;

        /**
         * @var string Poll thumbnail.
         * @access private
         * @since  3.0.0
         */
        private $thumbnail = null;

        /**
         * @var array Poll Choices.
         * @access private
         * @since  3.0.0
         */
        private $choices = null;

        /**
         * @var array Poll Settings.
         * @access private
         * @since  3.0.0
         */
        private $settings = null;

        /**
         * @var array Poll limitations.
         * @access private
         * @since  3.0.0
         */
        private $limitations = null;

        /**
         * @var array Poll fields.
         * @access private
         * @since  3.0.0
         */
        private $fields = null;

        /**
         * @var object Poll request.
         * @access private
         * @since  3.0.0
         */
        private $request = null;

        /**
         * @var object Poll page.
         * @access private
         * @since  3.0.0
         */
        private $page = 1;

        /**
         * @var object Poll next page.
         * @access private
         * @since  3.0.0
         */
        private $next_page = 1;


        /**
         * @var string Skip to.
         * @access private
         * @since  3.0.0
         */
        private $skip_to = null;

        /**
         * @var object PNX_FollowUp to.
         * @access private
         */
        private $follow_up = null;

        /**
         * Poll constructor.
         *
         * @param            $id       Poll ID.
         * @param bool $prefetch Prefetch question and choices.
         *
         * @since 3.0.0
         */
        public function __construct($id, $prefetch = false)
        {
            // Set the ID
            $this->id = (int)$id;

            // Prefetch properties
            if ($prefetch):
                $this->question();
                $this->choices();
                $this->video_question();
            endif;
        }

        public function mapsec($id)
        {
            $map = new MapFirst();
            $map->setPollId($id);
            $map->render();
        }

        public function mapthree($id)
        {
            $map = new MapThird();
            $map->setPollId($id);
            $map->render();
        }

        public function mapnet($id)
        {
            $map = new MapSecond();
            $map->setPollId($id);
            $map->render();
        }

        /**
         * Get poll question.
         *
         * @since 3.0.0
         * @return mixed|string Poll question.
         */
        public function question()
        {
            // Check the cache
            if ($this->question === null):
                $this->question = get_post_meta($this->id, 'question', true);
            endif;

            return $this->question;
        }

        /**
         * Get video poll question.
         *
         * @since 3.0.0
         * @return mixed|string Poll question.
         */
        public function video_question()
        {
            // Check the cache
            if ($this->video_question === null):
                $this->video_question = array(
                    "url" => get_post_meta($this->id, 'videoquestion', true),
                    "thumbnail" => get_post_meta($this->id, 'videoquestionimg', true)
                );
            endif;

            return $this->video_question;
        }

        /**
         * Get poll thumbnail.
         *
         * @since 3.0.0
         * @return mixed|string Poll question.
         */
        public function poll_thumbnail()
        {
            if ($this->thumbnail === null):
                if ($this->is_video_question() && !empty($this->video_question()["thumbnail"])):
                    $this->thumbnail = $this->video_question()["thumbnail"];
                else:
                    $this->thumbnail = get_the_post_thumbnail_url($this->id, 'full');
                endif;
            endif;

            return $this->thumbnail;
        }

        /**
         * Whether video question defined.
         *
         * @since 3.0.0
         * @return mixed|string Poll question.
         */
        public function is_video_question()
        {
            $video_question = $this->video_question();
            return !empty($video_question["url"]);
        }

        /**
         * Count choices.
         *
         * @since 3.0.0
         * @return int Choices count.
         */
        public function choices_count()
        {
            return (int)get_post_meta($this->id, 'choices', true);
        }

        /**
         * Total votes.
         *
         * @since 3.0.0
         * @return int Choices total votes.
         */
        public function choices_votes()
        {
            return (int)get_post_meta($this->id, 'votes', true);
        }

        /**
         * Get poll choices.
         *
         * @param bool $purge Purge cached choices
         * @param bool $visible_only Retrieve only visible choices.
         *
         * @since 3.0.0
         * @return array Poll choices.
         */
        public function choices($purge = false, $visible_only = true)
        {

            $is_wp_admin = (is_admin() === true && (!defined('DOING_AJAX') || !DOING_AJAX));
            if ($this->choices === null || $purge !== false):

                $this->choices = array();
                $choices_count = $this->choices_count();
                $choices_per_page = $is_wp_admin ? 0 : (int)$this->settings('choices', 'pagination', 'per_page');
                $choices_offset_start = ($choices_per_page === 0) ? 0 : $choices_per_page * ($this->page - 1);
                $choices_offset_end = ($choices_per_page === 0 || ($choices_per_page * $this->page) > $choices_count)
                    ? $choices_count
                    : ($choices_per_page * $this->page);

                $visible_only = ($visible_only === true) && (is_admin() === false);

                if ($choices_count > 0):
                    for (; $choices_offset_start < $choices_offset_end; $choices_offset_start++):

                        // Get choice content.
                        $choice_content = (array)get_post_meta($this->id, "choice_{$choices_offset_start}_content", true);

                        // Check visibility
                        if ($visible_only === true && empty($choice_content['visible'])):
                            // Expand the loop until a visible choice is present.
                            $choices_offset_end += ($choices_count >= $choices_offset_end + 1) ? 1 : 0;

                            continue;
                        endif;

                        // Checked
                        $choice_checked = $this->request !== null && in_array($choices_offset_start, $this->request->choices);

                        // Get choice votes.
                        $choice_votes = (int)get_post_meta($this->id, "choice_{$choices_offset_start}_votes", true);

                        // Append to choices array.
                        $this->choices[$choices_offset_start] = array(
                            'index' => $choices_offset_start,
                            'votes' => $choice_votes,
                            'checked' => $choice_checked,
                            'content' => $choice_content,
                        );

                        // Add date attribute when missed.
                        if (empty($this->choices[$choices_offset_start]['content']['date']) === true):
                            $this->choices[$choices_offset_start]['content']['date'] = current_time('timestamp');
                        endif;

                        // Accumulate votes.
                        $this->votes = $this->choices_votes();

                    endfor;

                    // Calc votes percentage.
                    $this->percentages();
                endif;

                $this->next_page = $choices_offset_end < $choices_count ? $this->page + 1 : $this->page;
            endif;

            if ($this->skip_to === 'vote'):
                // Other
                if ($this->settings('choices', 'other', 'enabled')):
                    $this->choices['other'] = array(
                        'index' => count($this->choices) - 1,
                        'votes' => 0,
                        'votes%' => 0,
                        'content' => array(
                            'date' => current_time('timestamp'),
                            'type' => 'other',
                            'label' => __('Other', TP_TD),
                        ),
                    );
                endif;
            endif;

            return $this->choices;
        }

        /**
         * Get a section of settings or a specified key of a section.
         *
         * @param            $section
         * @param mixed $args ...Args list
         *
         * @since 3.0.0
         * @return mixed|bool Value of the settings
         */
        public function settings($section, $args = false)
        {
            // Section.
            if (!isset($this->settings[$section])):
                $this->settings[$section] = get_post_meta($this->id, "settings_$section", true);
            endif;

            // Deep selection.
            if ($this->settings[$section] !== false && $args !== false):
                $paths = func_get_args();
                unset($paths[0]);

                return TotalPoll::instance('helpers')->pathfinder($this->settings[$section], $paths);
            endif;

            return $this->settings[$section];
        }

        /**
         * Get Limitations instance.
         *
         * @since 3.0.0
         * @return object Limitations instance.
         */
        public function follow_up()
        {
            if ($this->follow_up === null):
                $this->follow_up = TotalPoll::instance('follow-up', array($this, $this->request));
            endif;
            return $this->follow_up;
        }

        /**
         * Get Limitations instance.
         *
         * @since 3.0.0
         * @return object Limitations instance.
         */
        public function limitations()
        {
            if ($this->limitations === null):

                if ($this->choices === null):
                    $this->choices();
                endif;

                $this->limitations = TotalPoll::instance('limitations', array($this, $this->request));
            endif;

            return $this->limitations;
        }

        /**
         * Get Fields instance.
         *
         * @since 3.0.0
         * @return object Fields instance.
         */
        public function fields()
        {
            if ($this->fields === null):
                $this->fields = TotalPoll::instance('fields', array($this, $this->request));
            endif;

            return $this->fields;
        }

        /**
         * Render the poll.
         *
         * @param string $fragment Fragment to render.
         *
         * @since 3.0.0
         * @return string Rendered Poll.
         */
        public function render($fragment = 'vote')
        {
            /**
             * Before render.
             *
             * @param string $fragment Current fragment.
             * @param        object    Poll object.
             *
             * @since  3.0.0
             * @action totalpoll/actions/poll/render/before
             */
            do_action('totalpoll/actions/poll/render/before', $fragment, $this);

            wp_enqueue_script('moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js');

            // Run limitations.
            $this->limitations()->run();

            // Run follow up question rules
            $this->follow_up()->run();

            // Extra attributes
            $extra_attributes = '';

            // Skip to another fragment
            if (!empty($this->skip_to)):
                $fragment = $this->skip_to;
            else:

                // Check request
                if ($this->request !== null):

                    // Check if there are limitations/validations errors.
                    if (!empty($this->limitations()->bag->errors)):
                        $fragment = 'vote';
                    else:
                        if ($this->request->type() === 'vote') :
                            if ($this->settings('screens', 'after_vote', 'enabled') !== false) {
                                $fragment = 'after_vote';
                            } else {
                                $fragment = 'results';
                            }
                        endif;
                    endif;

                    if ($this->request->type() === 'results'):
                        $fragment = 'results';
                    endif;

                endif;

                $this->skip_to = $fragment;
            endif;

            $template = $this->settings('design', 'template', 'name');
            $template_object = TotalPoll::module('template', empty($template) ? 'default' : $template, $this);

            wp_enqueue_style('maptemplate3', TP_URL . 'assets/css/maptemplate3.css', array());

            // charts

            wp_enqueue_script('chart-admin', TP_URL . 'assets/js/chart/admin.js', array());
            wp_enqueue_script('chartjs', TP_URL . 'assets/js/chart/chartjs.js', array());
            wp_enqueue_script('excanvas', TP_URL . 'assets/js/chart/excanvas.js', array());

            // countdown
            wp_enqueue_style('countdown', TP_URL . 'assets/css/coundown.css', array());
            wp_enqueue_script('countdownscript', TP_URL . 'assets/js/countdown.js', array());
            wp_enqueue_script('flip', TP_URL . 'assets/js/flipclock.js', array());

            // custom scripts moved from theme
            wp_enqueue_script('custom', TP_URL . 'assets/js/custom.js', array());
            wp_enqueue_style('custom_css', TP_URL . 'assets/css/totalpoll.css', array());


            if (!defined('DOING_AJAX') || DOING_AJAX === false):
                wp_enqueue_script('totalpoll', TP_URL . 'assets/js' . (WP_DEBUG ? '' : '/min') . '/front.js', array('jquery'), (WP_DEBUG ? time() : TP_VERSION));
                $js_settings = array(
                    'AJAX' => admin_url('admin-ajax.php'),
                    'AJAX_ACTION' => 'tp_action',
                    'VERSION' => TP_VERSION,

                    'settings' => array(
                        'limitations' => array(
                            'selection_maximum' => (int)$this->settings('limitations', 'selection', 'maximum'),
                        ),
                    ),
                );
                wp_localize_script(
                    'totalpoll',
                    'TotalPoll',
                    $js_settings
                );

                $template_object->assets();

                /**
                 * Enqueue assets.
                 *
                 * @param string $fragment Current fragment.
                 * @param        object    Poll object.
                 *
                 * @since  3.0.0
                 * @action totalpoll/actions/poll/render/assets
                 */
                do_action('totalpoll/actions/poll/render/assets', $fragment, $this);
            endif;

            $extra_attributes .= sprintf(' %s="%s"', 'data-id', $this->id);
            $extra_attributes .= sprintf(' %s="%s"', 'data-visual-transition', $this->settings('design', 'transition', 'type'));
            if (! empty ($this->settings('design', 'scroll', 'enabled'))):
                $extra_attributes .= sprintf(' %s="%s"', 'data-visual-transition-scroll-up', $this->settings('design', 'scroll', 'enabled'));
            endif;
            $extra_attributes .= sprintf(' %s="%s"', 'data-max-selection', $this->settings('limitations', 'selection', 'maximum'));
            $extra_attributes .= sprintf(' %s="%s"', 'data-template', $template);

            $html = $template_object->render($fragment, empty($this->request->is_ajax) ? true : false, $extra_attributes);

            /**
             * Vote indexes.
             *
             * @param string $html Rendered poll.
             * @param string $fragment Current fragment.
             * @param        object    Poll object.
             *
             * @since  3.0.0
             * @filter totalpoll/filters/poll/render/content
             */
            $content = apply_filters('totalpoll/filters/poll/render/content', $html, $fragment, $this);

            wp_reset_postdata();

            return $content;
        }

        /**
         * Vote.
         *
         * @param array $indexes Indexes of choices.
         *
         * @since 3.0.0
         * @return bool True when accepted, false when refused.
         */
        public function vote($indexes)
        {

            // Check indexes
            if (!empty($indexes)):

                // Count choices
                $choices_count = $this->choices_count();
                $indexes = array_unique($indexes);

                /**
                 * Vote indexes.
                 *
                 * @param array $indexes Choices indexes.
                 * @param object $poll Poll object.
                 *
                 * @since  3.0.0
                 * @filter totalpoll/filters/poll/vote/indexes
                 */
                $indexes = apply_filters('totalpoll/filters/poll/vote/indexes', $indexes, $this);

                $translations_ids = array($this->id);
                $original_id = $this->id;

                // WPML compatibility
                if (!empty($GLOBALS['sitepress'])):
                    $translations = $GLOBALS['sitepress']->get_element_translations($GLOBALS['sitepress']->get_element_trid($this->id, 'post_poll'));
                    foreach ($translations as $translation):
                        if ($translation->element_id != $this->id):
                            $translations_ids[] = $translation->element_id;
                        endif;
                        if ($translation->original == 1):
                            $original_id = $translation->element_id;
                            $this->votes = (int)get_post_meta($original_id, 'votes', true);
                        endif;
                    endforeach;
                endif;

                // Polylang compatibility
                if (!empty($GLOBALS['polylang'])):
                    $translations = pll_get_post_translations($this->id);
                    foreach ($translations as $code => $translation):
                        if ($translation != $this->id):
                            $translations_ids[] = $translation;
                        endif;
                        if (pll_default_language() == $code):
                            $original_id = $translation;
                            $this->votes = (int)get_post_meta($original_id, 'votes', true);
                        endif;
                    endforeach;
                endif;

                $votes_per_date = get_post_meta($this->id, 'votes_per_date', true);
                if (!$votes_per_date) {
                    $votes_per_date = [];
                }

                $date_ind = date('Y-m-d');
                if (!isset($votes_per_date[$date_ind])) {
                    $votes_per_date[$date_ind] = [];
                }

                foreach ($indexes as $index => $choice):

                    // Regular votes

                    $choice = (int)$choice;

                    if ($choice >= 0 && $choice < $choices_count):

                        $votes = (int)get_post_meta($original_id, "choice_{$choice}_votes", true);

                        if (empty($this->choices[$choice]) === false):
                            $this->choices[$choice]['votes'] = $votes + 1;
                            $votes_per_date[$date_ind][$choice]++;
                            $this->votes += 1;
                        endif;

                        foreach ($translations_ids as $id):

                            if (update_post_meta($id, "choice_{$choice}_votes", $votes + 1) === false):
                                return false; // If one fails, return false
                            endif;

                        endforeach;

                    endif;

                    foreach ($translations_ids as $id):
                        update_post_meta($id, 'votes', $this->votes);
                    endforeach;

                endforeach;

                update_post_meta($this->id, 'votes_per_date', $votes_per_date);

                if (!empty($this->choices)):
                    $this->percentages();
                endif;

                return true; // Successful update

            endif;

            return false; // Nothing to update
        }


        /**
         * Get/set request object.
         *
         * @param bool|false $request
         *
         * @return bool|object Request object, false otherwise.
         */
        public function requested_by($request = false)
        {
            if ($request !== false && $request instanceof TotalPoll::$classes['request']['class']):
                $this->request = $request;
            endif;

            return $this->request;
        }

        /**
         * Skip to another fragment.
         *
         * @param null $fragment Fragment to show (vote, results ...)
         *
         * @since 3.0.0
         * @return string Fragment.
         */
        public function skip_to($fragment = null)
        {
            return $this->skip_to = $fragment;
        }

        /**
         * Get/set current page.
         *
         * @param false|int $page Page.
         *
         * @since 3.0.0
         * @return int Page
         */
        public function page($page = false)
        {
            $page = ($page === false) ? $this->page : absint($page);

            if ($this->page !== $page):
                $this->choices = null;
            endif;

            return $this->page = $page;
        }

        /**
         * Check if there is another page.
         *
         * @since 3.0.0
         * @return bool True when has next page, false otherwise.
         */
        public function has_next_page()
        {
            return $this->next_page > $this->page;
        }

        /**
         * Check if there is a previous page.
         *
         * @since 3.0.0
         * @return bool True when has next page, false otherwise.
         */
        public function has_previous_page()
        {
            return $this->page > 1;
        }

        /**
         * Calculate percentages.
         *
         * @since 3.0.0
         * @return void
         */
        private function percentages()
        {
            foreach ($this->choices as $index => $choice):
                $percentage = $choice['votes'] === 0 || $this->votes === 0 ? 0 : ($choice['votes'] / $this->votes) * 100;
                $this->choices[$index]['votes%'] = empty($choice['content']['visible']) ? 0 : round($percentage, 2);
            endforeach;
        }

        /**
         * Getter
         *
         * @param string $name Property name.
         * @param array $args Args.
         *
         * @since 3.0.0
         * @return mixed Property, false when the property is undefined.
         */
        public function __call($name, $args)
        {
            return isset($this->{$name}) ? $this->{$name} : false;
        }

        /**
         * To string.
         *
         * @since 3.0.0
         * @return string Poll.
         */
        public function __toString()
        {
            return $this->render();
        }


    }


endif;
