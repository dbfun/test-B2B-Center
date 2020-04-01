<?php

namespace App;

use App\Domain\Article\Models\ArticleModel;
use App\Domain\User\Models\UserModel;

class ArticleFactory
{
  /**
   * Создать новую статью от имени пользователя из запроса
   *
   * @param Request $request
   * @param UserModel $user
   */
  public function create(Request $request, UserModel $user)
  {
    $article = new ArticleModel();
    $article->fillFromRequest($request);
    $article->setAuthor($user);
    $article->store();
  }
}