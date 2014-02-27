<?php

$this->pageTitle = Yii::app()->name;

//$identity = new UserIdentity('admin', '123456');
//
//echo '<br/><b>$identity: </b>';
//echo '<pre>';
//echo htmlspecialchars(print_r($identity, true));
//echo '</pre>';
//
//$userModel = User::model();
//
//echo '<br/><b>$userModel: </b>';
//echo '<pre>';
//echo htmlspecialchars(print_r($userModel, true));
//echo '</pre>';
//
//$userAR = $userModel->findByAttributes(array('email' => 'admin@nomail.com'));
//
//echo '<br/><b>$userAR: </b>';
//echo '<pre>';
//echo htmlspecialchars(print_r($userAR, true));
//echo '</pre>';
//
//$row = (object) $userAR->attributes;
//
//echo '<br/><b>$row: </b>';
//echo '<pre>';
//echo htmlspecialchars(print_r($row, true));
//echo '</pre>';
//
//$userIdentity = new UserIdentity($row->email, $row->password);
//
//echo '<br/><b>$userIdentity: </b>';
//echo '<pre>';
//echo htmlspecialchars(print_r($userIdentity, true));
//echo '</pre>';

//$userIdentity = new UserIdentity('admin@nomail.com', '123456 ');
//
//$result = $userIdentity->authenticate();
//
//echo '<br/><b>$userIdentity: </b>';
//echo '<pre>';
//echo htmlspecialchars(print_r($userIdentity, true));
//echo '</pre>';
//
//echo '<br/><b>$result: </b>' . ($result ? 'true' : 'false') . '<br/>';

$loginForm = new LoginForm();
//$loginForm->username = 'admin@nomail.com';
//$loginForm->password = '123456';

$loginForm->username = 'h1dd3n@narod.ru';
$loginForm->password = '123456';

$result = $loginForm->login();

echo '<br/><b>$result: </b>' . ($result ? 'true' : 'false') . '<br/>';

$user = Yii::app()->user;

echo '<br/><b>$user: </b>';
echo '<pre>';
echo htmlspecialchars(print_r($user, true));
echo '</pre>';

echo '<br/><b>$user->id: </b>'.htmlspecialchars($user->id).'<br/>';

echo '<br/><b>get_class($user): </b>'.htmlspecialchars(get_class($user)).'<br/>';

//$user->logout();
?>

Index page