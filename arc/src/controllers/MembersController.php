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

use realitygems\arc\models\ArcMemberGrade;

class MembersController extends Controller
{
    protected $allowAnonymous = ['index', 'logout', 'save-grade'];

    private function get($key, $default=NULL)
    {
      return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
    }

    private function session($key, $default=NULL)
    {
      return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
    }

    public function actionIndex()
    {
        $invalidGuildMember = false;
        $isRateLimited = false;

        $entry = Entry::find()->section('members')->slug('members')->one();
        $service = ARC::$plugin->arcService;
        // $result = 'Not Logged In';
        $arcMember = null;
        $discordUsername = '';

        if(Craft::$app->getSession()->get('isLoggedIn'))
        {
            $discordUsername = Craft::$app->getSession()->get('discordUsername');
        }
        else
        {
            $session = Craft::$app->getSession();

            $session->set('isLoggedIn', false);
            $session->set('discordUsername', '');
            $session->set('discordEmail', '');

            if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 

            // echo 'access_token ' . $this->session('access_token');
            // echo '<br>HERE 1';

            if($this->session('access_token'))
            {
                // echo '<br>HERE 2';

                if($this->get('code'))
                {
                    // echo '<br>HERE 2 code';

                    return $this->redirect($service->getBaseUrl());
                }

                $isGuildMember = $service->isGuildMember();

                // echo '<br>isGuildMember ' . ($isGuildMember[0] ? ' yes ' : ' no ');
                // echo '<br>isRateLimited ' . ($isGuildMember[1] ? ' yes ' : ' no ');
                //exit();

                if($isGuildMember[0])
                {
                    // echo '<br>HERE 2 isGuildMember';

                    $arcMember = $service->getArcMemberFromApi();

                    $discordUsername = $arcMember->discordUsername;

                    $session->set('isLoggedIn', true);
                    $session->set('discordUsername', $arcMember->discordUsername);
                    $session->set('discordEmail', $arcMember->discordEmail);

                    // $result = $this->session('access_token');
                }
                else
                {
                    // echo '<br>HERE 2 else';

                    //$result = 'Logged In!<br><br>NOT AN ARC GUILD MEMBER';
                    $invalidGuildMember = true;
                    $isRateLimited = $isGuildMember[1];
                    $service->revokeUserAccess();
                }
            }
            elseif($this->get('code'))
            {
                // echo '<br>HERE 3';

                $code = $this->get('code');
                $accessToken = $service->obtainAccessToken($code);
                $_SESSION['access_token'] = $accessToken;

                return $this->redirect($service->getBaseUrl());
            }

            // echo '<br>HERE 4';
        }

        return Craft::$app->view->renderTemplate(
            'members/_index',
            [
               'entry' => $entry,
               'invalidGuildMember' => $invalidGuildMember,
               'isRateLimited' => $isRateLimited,
               'discordUsername' => $discordUsername
               //'arcMember' => $arcMember
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

    public function actionSaveGrade()
    {
        $this->requirePostRequest();

        if(!Craft::$app->getSession()->get('isLoggedIn'))
        {
            return $this->redirect('members');
        }

        $service = ARC::$plugin->arcService;
        $request = Craft::$app->getRequest();
        $memberGrade = new ArcMemberGrade($request);
        $memberGrade->questions = $request->getBodyParam('questions');

        $quizScore = $service->saveMemberGrade($memberGrade);

        if($quizScore < 0)
        {
            return 'error';
        }
        else
        {
            return $quizScore;
        }
    }
}
