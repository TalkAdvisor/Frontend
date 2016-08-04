<?php

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;

  require 'C://laragon/www/dev/vendor/autoload.php';

  session_start();

  $appId='219968235071143';
  $appSecret='bcac9e1b105847507e9a710fc677326b';

  FacebookSession::setDefaultApplication($appID,$appSecret);
  $helper= new FacebookRedirectLoginHelper("{{url('')}}",$addId,$app);

  echo $helper->getLoginURL();
?>
