<?php
    namespace InkStudio\ProjectgramBundle\Services\Instagram;

    use MetzWeb\Instagram\Instagram As InstagramBase;

    class Instagram extends InstagramBase
    {

        /**
         * The callback URL for Implicit OAuth
         *
         * @var string
         */
        private $_implicitcallbackurl;

        public function __construct($config)
        {
            parent::__construct($config);
        }

        /**
         * Get user recent media
         *
         * @param integer [optional] $id        Instagram user ID
         * @param integer [optional] $limit     Limit of returned results
         * @return mixed
         */
        public function getUserMedia($id = 'self', $limit = 0, $max_id = 0) {
            return $this->_makeCall('users/' . $id . '/media/recent', ($id === 'self'),
                array('count' => $limit, 'max_id' => $max_id));
        }
    }
