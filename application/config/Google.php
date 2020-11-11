<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
/*
$config['google']['client_id']        = '36583164870-vgb0598bi5eumn7h5hqegpidh4nakpfg.apps.googleusercontent.com';
$config['google']['client_secret']    = 'xf1Ksogn4-zXZtFFHYXNgQlC';
$config['google']['redirect_uri']     = 'https://localhost/mangsi/user_authentication/';
$config['google']['application_name'] = 'Login to Mangsi Membership';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();
*/
$config['clientId'] = '472213605676-uhhv4n7k7mhkevdnlj9d5qh1pdgqhmo1.apps.googleusercontent.com'; //add your client id
$config['clientSecret'] = 'rRN27N0O7_GoKBzAr2gTpXSj'; //add your client secret
$config['redirectUri'] = 'https://localhost/mangsi/auth'; //add your redirect uri
$config['apiKey'] = ''; //add your api key here
$config['applicationName'] = 'Login to Mangsi Membership'; //application name for the api