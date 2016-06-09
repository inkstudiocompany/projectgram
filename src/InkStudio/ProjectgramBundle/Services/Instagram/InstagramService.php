<?php
	namespace InkStudio\ProjectgramBundle\Services\Instagram;

    use MetzWeb\Instagram\Instagram;

    class InstagramService
    {

		private $instagram_app;
        private $scopes;

		public function __construct(
            $apiKey,
            $apiSecret = null,
            $apiCallback = null,
            $implicitApiCallback = null,
            $scopes
        )
		{
			$this->instagram_app = new Instagram(array(
			    'apiKey'                => $apiKey,
			    'apiSecret'             => $apiSecret,
			    'apiCallback'           => $apiCallback,
                'implicitApiCallback'   => $implicitApiCallback
			));

            $this->setScopes($scopes);
		}

        /**
         * set Scopes
         *
         * Agrega los permisos que se solicitan en instagram.
         *
         * @return InstagramService
         */
        public function setScopes($scopes)
        {
            $this->scopes = $scopes;
            return $this;
        }

        /**
         * get Scopes
         *
         * Obtiene los permisos que se solicitan en instagram.
         *
         * @return array
         */
        public function getScopes()
        {
            return $this->scopes;
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

        /**
         * get login url
         *
         * Retorna la URL de Registro/Login en Instagram.
         *
         * @return string
         */
        public function getLoginUrl()
        {
            return $this->instagram_app->getLoginUrl($this->getScopes());
        }

        /**
         * get OAuth
         *
         * Obtiene el Access Token de Instagram.
         * El parámetro option es un valor booleano y define si la API nos retorna solo
         * el Auth Token ó este y el data profile del usuario.
         *
         * true : Returns only the OAuth token
         * false [default] : Returns OAuth token and profile data of the authenticated user
         *
         * @param $code
         * @param $option
         *
         * @return bool|\stdClass
         */
        public function getOAuth($code, $option = false)
        {
            $data = $this->instagram_app->getOAuthToken($code, $option);

            if (true === property_exists($data, 'access_token')) {
                $session                = new \stdClass();
                $session->access_token  = $data->access_token;
                $session->user          = $data->user;

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