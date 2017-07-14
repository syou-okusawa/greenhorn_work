<?php

namespace App\Socialite\Two;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class SlackProvider extends AbstractProvider implements ProviderInterface
{
     public function getScopes()
    {
        return $this->scopes;
        if (count($this->scopes) > 0) {
           return $this->scopes;
        }
        // Provide some default scopes if the user didn't define some.
        // See: https://github.com/SocialiteProviders/Providers/pull/53
        return ['identity.basic', 'identity.email', 'identity.team'];
    }

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://slack.com/oauth/authorize', $state);
    }

    protected function getTokenUrl()
    {
        // return 'https://api.line.me/v1/oauth/accessToken';
        return 'https://slack.com/api/oauth.access';
    }

    protected function getUserByToken($token)
    {
        // $response = $this->getHttpClient()->get('https://api.line.me/v1/profile', [
        //     'headers' => [
        //         'X-Line-ChannelToken' => $token,
        //     ],
        // ]);
        $response = $this->getHttpClient()->get(
                'https://slack.com/api/users.identity?token='.$token
            );
        return json_decode($response->getBody(), true);
    }
    // protected function mapUserToObject(array $user)
    // {
    //     return (new User())->setRaw($user)->map([
    //         'id'     => $user['mid'],
    //         'name'   => $user['displayName'],
    //         'avatar' => $user['pictureUrl'],
    //     ]);
    // }
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id' => array_get($user, 'user.id'),
            'name' => array_get($user, 'user.name'),
            'email' => array_get($user, 'user.email'),
            'avatar' => array_get($user, 'user.image_192'),
            'organization_id' => array_get($user, 'team.id'),
        ]);
    }
    // protected function getTokenFields($code)
    // {
    //     return [
    //         'client_id'     => $this->clientId,
    //         'client_secret' => $this->clientSecret,
    //         'code'          => $code,
    //         'redirect_uri'  => $this->redirectUrl,
    //         'grant_type'    => 'authorization_code',
    //     ];
    // }
}