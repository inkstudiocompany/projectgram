<?php
    namespace InkStudio\ProjectgramBundle\Services\Instagram;

    use MetzWeb\Instagram\Instagram As InstagramBase;

    class Instagram extends InstagramBase{
        /**
         * The callback URL for Implicit OAuth
         *
         * @var string
         */
        private $_implicitcallbackurl;

        public function __construct($config)
        {
            parent::__construct($config);
            if (true === is_array($config)) {
                $this->setImplicitApiCallback($config['implicitApiCallback']);
            }
        }

        /**
         * API Implicit Callback Setter
         *
         * @param string $implicitApiCallback
         * @return void
         */
        public function setImplicitApiCallback($implicitApiCallback)
        {
            $this->_implicitcallbackurl = $implicitApiCallback;
        }

        /**
         * API Implicit Callback URL Getter
         *
         * @return string
         */
        public function getImplicitApiCallback() {
            return $this->_implicitcallbackurl;
        }

        public function getAuthToken() {
            echo $implicitAuthUrl = self::API_OAUTH_URL . '?client_id=' . $this->getApiKey() . '&redirect_uri=' . urlencode($this->getImplicitApiCallback()) . '&response_type=token';
        }
    }
