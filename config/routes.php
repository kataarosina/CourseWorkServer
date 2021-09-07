<?php

// ROUTES CONFIG. USE IT FOR ROUTES SETTINGS.

return array(
    'articles/edit/([0-9]+)' => 'articles/edit/$1',  // calling actionEdit in ArticlesController if route is 'articles/edit/<id>'
    'articles/delete/([0-9]+)' => 'articles/delete/$1',  // calling actionDelete in ArticlesController if route is 'articles/delete/<id>'
    'articles/new' => 'articles/new',  // calling actionNew in ArticlesController if route is 'articles/new'
    'articles/([0-9]+)' => 'articles/article/$1',  // calling actionArticle in ArticlesController if route is 'articles/<id>'
    'articles' => 'articles/list',  // calling actionList in ArticlesController if route is 'articles'
    'auth/register' => 'auth/register',  // calling actionRegister in AuthController if route is 'auth/register'
    'auth' => 'auth/auth',  // calling actionAuth in AuthController of route is 'auth'
    '' => 'main/index'  // calling actionIndex in MainController if route is 'main'
);
