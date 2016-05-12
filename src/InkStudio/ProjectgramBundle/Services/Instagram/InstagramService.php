<?php
	namespace InkStudio\ProjectgramBundle\Services\Instagram;

	use InkStudio\ProjectgramBundle\Services\Instagram\Instagram;

	class InstagramService {

		private $instagram_app;

		public function __construct($apiKey, $apiSecret = null, $apiCallback = null, $implicitApiCallback = null)
		{
			$this->instagram_app = new Instagram(array(
			    'apiKey'                => $apiKey,
			    'apiSecret'             => $apiSecret,
			    'apiCallback'           => $apiCallback,
                'implicitApiCallback'   => $implicitApiCallback
			));
		}

		public function getUserId($username = false)
		{
			
		}

		public function getPosts($userId)
		{
			
		}

        public function getUser()
        {
            return $this->instagram_app->getUser();
        }

        public function getLoginUrl()
        {
            return $this->instagram_app->getLoginUrl(['basic', 'public_content']);
        }

        public function getAuth($code)
        {
            $data = $this->instagram_app->getOAuthToken($code);

            if (false === property_exists($data, 'code')) {
                $session = new \stdClass();
                $session->access_token = $data->access_token;
                $session->user = $data->user;
                $this->instagram_app->setAccessToken($data);
            } else {
                return false;
            }

            return $session;
        }

        public function getMedia($max_id = 0)
        {
            $pictures = false;
            $this->instagram_app->setSignedHeader(true);
            $content = $this->instagram_app->getUserMedia('self', 10, $max_id);

            if (!$content) {
                return false;
            }

            if (200 !== $content->meta->code) {
                return false;
            }

            return $content;
        }

        public function setAccessToken($accessToken)
        {
            return $this->instagram_app->setAccessToken($accessToken);
        }
	}
?>