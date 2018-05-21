<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif;

if ( ! class_exists( 'PNX_FollowUp' ) ) :

	/**
	 * Extension Class
	 *
	 * @package Pnyx/Classes/Extension
	 * @since   1.0.0
	 */
	class PNX_FollowUp {
		/**
		 * @var TP_Poll Poll object
		 * @access protected
		 */
		protected $poll;
		/**
		 * @var object Request object.
		 * @access protected
		 */
		protected $request = null;
		/**
		 * @var object Settings object.
		 * @access protected
		 */
		protected $settings = null;

		/**
		 * @var object Limitations object.
		 * @access protected
		 */
		protected $limitations = null;

		/**
		 * @var object Validation error.
		 * @access protected
		 */
		protected $error = null;

		/**
		 * Extension constructor.
		 *
		 * @param bool|TP_Poll $poll Poll.
		 *
		 * @access public
		 * @since  3.0.0
		 */
		public function __construct( $poll, $request ) {
			if ( $poll instanceof TotalPoll::$classes['poll']['class'] ):
				$this->poll        = $poll;
				$this->settings = $this->poll->settings( 'results' );
				$this->limitations = $this->poll->settings( 'limitations' );
			endif;

			if ( $request instanceof TotalPoll::$classes['request']['class'] ):
				$this->request = $request;
			endif;
		}

		/**
		 * Run follow up rules.
		 *
		 * @since 3.0.0
		 * @return array Errors.
		 */
		public function run( ) {
			if ($this->request && $this->request->type === 'vote'):
				$result = true;
				$result &= $this->is_email_provided();
				$result &= $this->is_follow_up_question_addressed();
				if (!$result):
					$this->save_redirect_to_follow_up();
				endif;
			elseif($this->is_redirect_to_follow_up()):
				$this->poll->skip_to( 'follow_up_form' );
			endif;
		}

		public function is_email_provided() {
			if (! empty( $this->settings['order']['request_email'] )):
				$cookie_key = 'pnyx_user_email';
				if ( empty( $_COOKIE[ $cookie_key ] ) ):
					$this->poll->skip_to( 'follow_up_form' );

					return false;
				endif;

			endif;

			return true;
		}

		public function is_follow_up_question_addressed() {
			if (! empty($this->settings['order']['follow_up_question']) 
					|| $this->get_follow_up_question_from_request() !== null
					|| $this->get_follow_up_question_from_cookie() !== null):

				$cookie_key = 'pnyx_fqa_' . $this->limitations['unique_id'];
				if ( empty( $_COOKIE[ $cookie_key ] ) ):

					if ($this->get_follow_up_question_from_cookie() == null
						&& $this->get_follow_up_question_from_request() !== null):
						$this->set_follow_up_question_to_cookie($this->get_follow_up_question_from_request());
					endif;

					$this->poll->skip_to( 'follow_up_form' );

					return false;
				endif;

			endif;

			return true;
		}

		public function get_follow_up_question(){
			if ($this->get_follow_up_question_from_request() !== null):
				return $this->get_follow_up_question_from_choices($this->get_follow_up_question_from_request());
			elseif ($this->get_follow_up_question_from_cookie() !== null):
				return $this->get_follow_up_question_from_choices($this->get_follow_up_question_from_cookie());
			elseif (!empty($this->settings['order']['follow_up_question']) ):
				return $this->settings['order']['follow_up_question'];
			endif;
			return null;
		}

		public function save_email_address($email){
			$arguments = [
                'title' => $email,
                'post_type' => 'gathered_emails'
            ];

            $emails = get_posts($arguments);

            if ($emails) {
                $fetchedEmail = array_pop($emails);
            }

            if (!isset($fetchedEmail)) {
                $savedEmail = wp_insert_post([
                    'post_title' => $email,
                    'post_type' => 'gathered_emails',
                    'post_status' => 'publish'
                ]);
            }

			$cookie_key = 'pnyx_user_email';
			$expires = time() + 60 * 60 * 24 * 90;
			setcookie($cookie_key, '1', $expires, '/');
		}

		public function validate($input){
			$this->error = new WP_Error();
			if (array_key_exists("email", $input)
				&& (empty($input["email"])
						|| !is_email($input["email"]))):
				$this->error->add(
					'email',
					__( 'Incorrect email address.', TP_TD )
				);
			endif;

			if (array_key_exists("answer", $input) && empty($input["answer"])):
				$this->error->add(
					'answer',
					__( 'Please provide your answer.', TP_TD )
				);
			endif;

			if (array_key_exists("agreement", $input) && empty($input["agreement"])):
				$this->error->add(
					'agreement',
					__( 'You should approve receiving emails.', TP_TD )
				);
			endif;
		}

		public function save_follow_up_response($follow_up_item){
			$meta = TotalPoll::instance( 'meta-pageable' );
			$meta->add( 'follow-up-responses', $this->poll->id(), $follow_up_item );

			$cookie_key = 'pnyx_fq_' . $this->limitations['unique_id'];
			setcookie($cookie_key, null, -1, '/');

			$cookie_key = 'pnyx_fqa_' . $this->limitations['unique_id'];
			$expires = time() + 60 * 60 * 24 * 90;
			setcookie($cookie_key, '1', $expires, '/');
		}

		private function get_follow_up_question_from_choices($index){
			$allChoices = $this->poll->choices();

			if (isset($allChoices[$index]) && !empty($allChoices[$index]['content']['follow-up-question'])):
				return $allChoices[$index]['content']['follow-up-question'];
			endif;
			return null;
		}

		private function get_follow_up_question_from_request(){
			if ($this->request && count($this->request->choices()) > 0):
				$choice_index = $this->request->choices()[0];

				$allChoices = $this->poll->choices();
				foreach ($allChoices as $key => $choice) :
                    if ($choice['index'] == $choice_index 
                    	 && !empty($choice['content']['follow-up-question'])) :
                        return $choice['index'];
                    endif;
                endforeach;
			endif;
			return null;
		}

		private function get_follow_up_question_from_cookie(){
			$cookie_key = 'pnyx_fq_' . $this->limitations['unique_id'];
			return isset($_COOKIE[$cookie_key]) ? $_COOKIE[$cookie_key] : null;
		}

		private function set_follow_up_question_to_cookie($choice_index){
			if ($choice_index !== null):
				$expires = time() + 60 * 60 * 24 * 90;
				$cookie_key = 'pnyx_fq_' . $this->limitations['unique_id'];
				setcookie($cookie_key, $choice_index, $expires, '/');
			endif;
		}

		public function errors() {
			if ( $this->error ) {
				return (array) $this->error->get_error_messages();
			}

			return array();
		}

		private function save_redirect_to_follow_up(){
			$expires = time() + 60 * 60 * 24 * 90;
			$cookie_key = 'pnyx_fr_' . $this->limitations['unique_id'];
			setcookie($cookie_key, 1, $expires, '/');
		}

		public function remove_redirect_to_follow_up(){
			$cookie_key = 'pnyx_fr_' . $this->limitations['unique_id'];
			setcookie($cookie_key, null, -1, '/');
			unset($_COOKIE[$cookie_key]);
		}

		public function is_redirect_to_follow_up(){
			$cookie_key = 'pnyx_fr_' . $this->limitations['unique_id'];
			return isset($_COOKIE[$cookie_key]) ? $_COOKIE[$cookie_key] : null;
		}

	}


endif;