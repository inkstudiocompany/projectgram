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

        public function getUserStatus()
        {
            $this->instagram_app->getAuthToken();
            return $this->instagram_app->getAccessToken();
        }

        public function getLoginUrl()
        {
            return $this->instagram_app->getLoginUrl(['basic']);
        }

        public function getAuth($code)
        {
            $data = $this->instagram_app->getOAuthToken($code, '177738431.83efd5d.3936a1e6f1ed4305ab1552c3f66a3aaf');
var_dump($data); die();
            if (false === isset($data) && 400 !== $data->code) {
                $session = new \stdClass();
                $session->access_token = $data->access_token;
                $session->user = $data->user;
                $this->instagram_app->setAccessToken($data);
            } else {
                return false;
            }

            return $session;
        }

        public function setToken($token)
        {

        }
	}
?>