<?php
	namespace InkStudio\ProjectgramBundle\Services\Instagram;

	use MetzWeb\Instagram\Instagram;

	class InstagramService {

		private $instagram_app;

		public function __construct($client_id)
		{
			$this->instagram_app = new Instagram(array(
			    'apiKey'      => 'bb5157e5603d4ea698c19c75255ce56d',
			    'apiSecret'   => '60a20fc9f7cd4285ab24a3c895a1e729',
			    'apiCallback' => 'YOUR_APP_CALLBACK'
			));
		}

		public function getUserId($username = false)
		{
			
		}

		public function getPosts($userId)
		{
			
		}
	}
?>