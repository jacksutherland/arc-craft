<?php
/**
 * ARC plugin for Craft CMS 3.x
 *
 * Custom Plugin for ARCollective Website
 *
 * @link      https://realitygems.com
 * @copyright Copyright (c) 2022 RealityGems
 */

namespace realitygems\arc\controllers;

use realitygems\arc\ARC;

use Craft;
use craft\web\Controller;
use craft\elements\Entry;

class MembersController extends Controller
{
    protected $allowAnonymous = ['index', 'logout', 'do-something'];

    public function actionIndex()
    {
        $entry = Entry::find()->section('members')->slug('members')->one();
        $service = ARC::$plugin->arcService;

        $result = 'Not Logged In';
        $arcMember = null;

        Craft::$app->getSession()->set('isLoggedIn', false);

        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 

        if($this->session('access_token'))
        {
            if($this->get('code'))
            {
                return $this->redirect($service->getBaseUrl());
            }

            $isGuildMember = $service->isGuildMember();

            if($isGuildMember)
            {
                Craft::$app->getSession()->set('isLoggedIn', true);

                $arcMember = $service->getArcMemberFromApi();

                $result = $this->session('access_token');
            }
            else
            {
                $result = 'Logged In!<br><br>NOT AN ARC GUILD MEMBER';
            }
        }
        elseif($this->get('code'))
        {
            $code = $this->get('code');
            $accessToken = $service->obtainAccessToken($code);
            $_SESSION['access_token'] = $accessToken;

            return $this->redirect($service->getBaseUrl());
        }
        // else
        // {
        //     $this->redirect($service->getRedirectUrl());
        //     return false;
        // }

        return Craft::$app->view->renderTemplate(
            'members/index',
            [
               'entry' => $entry,
               'result' => $result,
               'arcMember' => $arcMember
            ]
        );
    }

    public function actionLogout()
    {
        $service = ARC::$plugin->arcService;
        $service->revokeUserAccess();

        return $this->redirect('members');

        // $params = array(
        //     'refresh_token' => $this->session('access_token')
        // );
        // $this->redirect('https://discordapp.com/api/oauth2/token/revoke' . '?' . http_build_query($params));
        // return false;
    }

    private function get($key, $default=NULL)
    {
      return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
    }

    private function session($key, $default=NULL)
    {
      return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }
}
