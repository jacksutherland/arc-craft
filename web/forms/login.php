<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

error_reporting(E_ALL);

define('OAUTH2_CLIENT_ID', '945882189638283284'); // Your client Id
define('OAUTH2_CLIENT_SECRET', 'NPuUvXeh3QpzBCwoqqe_QSIVHr-h9iTe'); // Your secret client code
define('MEMBERS_URL', 'http://localhost/forms/login.php'); // URL to Members Portal

// https://discord.com/api/oauth2/authorize?client_id=945882189638283284&redirect_uri=http%3A%2F%2Flocalhost%2Fmembers&response_type=code&scope=identify%20guilds

$authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
$tokenURL = 'https://discordapp.com/api/oauth2/token';
$apiURLBase = 'https://discordapp.com/api/users/@me';

session_start();

// Start the login process by sending the user to Discord's authorization page
if(get('action') == 'login')
{
  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => MEMBERS_URL,
    'response_type' => 'code',
    'scope' => 'identify guilds'
  );

  // Redirect the user to Discord's authorization page
  header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
  die();
}

// When Discord redirects the user back here, there will be a "code" and "state" parameter in the query string
if(get('code'))
{
  // // Exchange the auth code for a token
  // $token = apiRequest($tokenURL, array(
  //   "grant_type" => "authorization_code",
  //   'client_id' => OAUTH2_CLIENT_ID,
  //   'client_secret' => OAUTH2_CLIENT_SECRET,
  //   'redirect_uri' => MEMBERS_URL,
  //   'code' => get('code')
  // ));

  // $logout_token = $token->access_token;
  // $_SESSION['access_token'] = $token->access_token;

  // //header('Location: ' . $_SERVER['PHP_SELF']);



    $code = get('code');
    // $state = $_GET['state'];
    // # Check if $state == $_SESSION['state'] to verify if the login is legit | CHECK THE FUNCTION get_state($state) FOR MORE INFORMATION.
    // $url = $GLOBALS['base_url'] . "/api/oauth2/token";
    $data = array(
        "client_id" => OAUTH2_CLIENT_ID,
        "client_secret" => OAUTH2_CLIENT_SECRET,
        "grant_type" => "authorization_code",
        "code" => $code,
        "redirect_uri" => MEMBERS_URL
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $tokenURL);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    $results = json_decode($response, true);
    $_SESSION['access_token'] = $results['access_token'];




}

if(session('access_token'))
{
  $user = apiRequest($apiURLBase);

  echo '<h3>Logged In</h3>';
  echo '<h4>Welcome, ' . $user->username . '</h4>';
  echo '<pre>';
  print_r($user);
  echo '</pre>';
}
else
{
  echo '<h3>Not logged in</h3>';
  echo '<p><a href="?action=login">Log In</a></p>';
}


if(get('action') == 'logout')
{
  // This must to logout you, but it didn't worked(

  $params = array(
    'access_token' => $logout_token
  );

  // Redirect the user to Discord's revoke page
  header('Location: https://discordapp.com/api/oauth2/token/revoke' . '?' . http_build_query($params));
  die();
}

function apiRequest($url, $post=FALSE, $headers=array())
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

  $response = curl_exec($ch);
  
  echo '<h4>apiRequest response: ' . $response . '</h4>';

  if($post)
  {
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  }

  $headers[] = 'Accept: application/json';

  if(session('access_token'))
  {
    $headers[] = 'Authorization: Bearer ' . session('access_token');
  }

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $response = curl_exec($ch);
  return json_decode($response);
}

function get($key, $default=NULL)
{
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default=NULL)
{
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}

?>