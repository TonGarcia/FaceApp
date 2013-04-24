<?php

    //Arquivo com funcionalidade de ser o "processador" principal dos dados do facebook
    
    //fbconfig � uma vari�vel global que contem as configura��es do App que est� no facebook.
    $fbconfig['appid' ] = "151508438353837";
    $fbconfig['secret'] = "62cdf6050480386936cc4266376e5694";
    
    //Base URL � aonde fica o in�cio do App (tela de assinatura do App) na URL a ser carregada no canvas
    $fbconfig['baseUrl'] = "https://shrouded-earth-6459.herokuapp.com/Graph-API-EXEMPLO/";
    
    //appBaseURL � a URL do App no facebook
    $fbconfig['appBaseUrl'] = "http://apps.facebook.com/api_face_app";
    
    /* 
     * se o usu�rio n�o estiver autenticado ele � jogado na baseUrl (URL de assinatura de App)
     * Se o c�digo for correto ele � redirecionado ao appBase (aonde est� o app em si)
     */
    if (isset($_GET['code'])){
        header("Location: " . $fbconfig['appBaseUrl']);
        exit;
    }
    
    //Requests IDs � se o usu�rio veio por meio de convite
    if (isset($_GET['request_ids'])){
        //user comes from invitation
        //track them if you need
    }
    
    //Este � nulo para validar mais pra frente se em algum momento ele foi setado
    $user =   null; //facebook user uid

    include_once "../config/lib/facebook/facebook.php";
    
    // Create inst�ncia da aplica��o
    $meu_face_app = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));
    
    //Autentica��o com facebook
    $user = $meu_face_app->getUser();
    
    // We may or may not have this data based 
    // on whether the user is logged in.
    // If we have a $user id here, it means we know 
    // the user is logged into
    // Facebook, but we don�t know if the access token is valid. An access
    // token is invalid if the user logged out of Facebook.
    //
    $loginUrl   = $meu_face_app->getLoginUrl(
            array(
                'scope' => 'email,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown'
            )
    );
    
?>