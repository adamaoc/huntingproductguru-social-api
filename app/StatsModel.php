<?php

class StatsModel
{
  private $_twitterFollowers = null;
  private $_facebookLikes = null;
  private $_instgramFollows = null;

  public function __construct()
  {
    require_once('twitter.php');
      $this->_getTwitter();
      $this->_getFacebook();
      $this->_getInstagram();
  }

  public function getAll()
	{
    $stats = array(
      array("id"=>1004, "title"=>"Facebook", "slug"=>"facebook", "stat"=>$this->_facebookLikes, "color"=>"blue", "link"=>"http://facebook.com/HuntingProductGuru"),
      array("id"=>1005, "title"=>"Twitter", "slug"=>"twitter", "stat"=>$this->_twitterFollowers, "color"=>"light-blue","link"=>"http://twitter.com/huntinguru"),
      array("id"=>1006, "title"=>"Instagram", "slug"=>"instagram", "stat"=>$this->_instgramFollows, "color"=>"brown", "link"=>"http://instagram.com/huntingproductguru")
    );
		return $stats;
	}

  private function _getTwitter()
  {
    $twitter = new Twitter;
		$this->_twitterFollowers = $twitter->getFollowerCount();
  }

  private function _getFacebook()
  {
    $token = $GLOBALS['config']['facebook']['access_token'];
    $url = 'https://graph.facebook.com/HuntingProductGuru/?fields=likes&access_token='.$token;
    $data = file_get_contents($url);
    $data = json_decode($data);
    $this->_facebookLikes = $data->likes;
  }

  private function _getInstagram()
  {
    $url = 'https://api.instagram.com/v1/users/1570768404/?client_id='.$GLOBALS['config']['instagram']['client_id'];
    $data = file_get_contents($url);
    $data = json_decode($data);
    $this->_instgramFollows = $data->data->counts->followed_by;

  }

}
