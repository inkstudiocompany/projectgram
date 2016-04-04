<?php
	namespace InkStudio\ProjectgramBundle\Services\Instagram;

	class InstagramSecurity {

		private $instaphp;

		public function __construct($instaphp)
		{
			$this->instaphp = $instaphp;
		}

		public function getUserId($username = false)
		{
			if ($username === false) return false;

			return $this->instaphp->Users->FindId($username);
		}

		public function getPosts($userId)
		{
			$posts = false;

			return $this->instaphp->Users->Recent($userId);
		}
	}
?>