<?php
/**
 * ARC plugin for Craft CMS 3.x
 *
 * Custom Plugin for ARCollective Website
 *
 * @link      https://realitygems.com
 * @copyright Copyright (c) 2022 RealityGems
 */

namespace realitygems\arc\services;

use realitygems\arc\ARC;
use Craft;
use craft\base\Component;

define('ARC_GUILD_ID', '926998325213925427');

define('OAUTH2_CLIENT_ID', '945882189638283284'); // Your client Id
define('OAUTH2_CLIENT_SECRET', 'NPuUvXeh3QpzBCwoqqe_QSIVHr-h9iTe'); // Your secret client code
// define('MEMBERS_URL', 'http://localhost/members'); // URL to Members Portal

define('AUTHORIZE_URL', 'https://discordapp.com/api/oauth2/authorize');
define('TOKEN_URL', 'https://discordapp.com/api/oauth2/token');
define('REVOKE_URL', 'https://discord.com/api/oauth2/token/revoke');
define('API_USER_URL', 'https://discordapp.com/api/users/@me');
define('API_USER_GUILDS_URL', 'https://discordapp.com/api/users/@me/guilds');

/**
 * Member Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    RealityGems
 * @package   ARC
 * @since     1.0.0
 */
class ArcService extends Component
{

    public function obtainAccessToken($code)
    {
        $baseUrl = $this->getBaseUrl();

        $data = array(
            "client_id" => OAUTH2_CLIENT_ID,
            "client_secret" => OAUTH2_CLIENT_SECRET,
            "grant_type" => "authorization_code",
            "code" => $code,
            "redirect_uri" => $baseUrl
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, TOKEN_URL);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        curl_close($curl);

        $results = json_decode($response, true);
        // $_SESSION['access_token'] = $results['access_token'];

        return array_key_exists('access_token', $results) ? $results['access_token'] : '';
    }

    public function revokeUserAccess()
    {
        if($this->session('access_token'))
        {
            $data = array(
                "client_id" => OAUTH2_CLIENT_ID,
                "client_secret" => OAUTH2_CLIENT_SECRET,
                "grant_type" => "refresh_token",
                "token" => $this->session('access_token')
            );

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, REVOKE_URL);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            curl_close($curl);

            Craft::$app->getSession()->set('isLoggedIn', false);

            unset($_SESSION['access_token']); 
        }
    }

    public function getRedirectUrl()
    {
        $discordGlobalGroup = Craft::$app->globals->getSetByHandle('discord');
        return $discordGlobalGroup->discordRedirectUrl;
    }

    public function getDiscordUser()
    {
        return $this->apiRequest(API_USER_URL);
    }

    public function getDiscordUserGuilds()
    {
        return $this->apiRequest(API_USER_GUILDS_URL);
    }

    public function getBaseUrl()
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['SERVER_NAME'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function isGuildMember()
    {
        return true;

        $guilds = $this->getDiscordUserGuilds();
        $isMember = false;

        // ob_flush();

        foreach ($guilds as &$guild)
        {
            // print_r($guild);
            // echo '<br><br>';

            if(property_exists('guild', 'id') && $guild->id == ARC_GUILD_ID)
            {
                $isMember = true;
            }
        }

        return $isMember;
    }

    private function apiRequest($url, $post=FALSE, $headers=array())
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($ch);

        if($post)
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        $headers[] = 'Accept: application/json';

        if($this->session('access_token'))
        {
            $headers[] = 'Authorization: Bearer ' . $this->session('access_token');
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        return json_decode($response);
    }

    private function session($key, $default=NULL)
    {
      return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }

}