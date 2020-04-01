<?php

namespace App\Domain\Article\Models;

use App\Domain\User\Models\UserModel;
use App\Request;

class ArticleModel
{

  /**
   * Создание статьи из запроса
   *
   * @param Request $request запрос
   */
  public function fillFromRequest(Request $request): self
  {
    return $this;
  }

  /**
   * Установка автора статьи (тут можно сменить автора статьи)
   *
   * @param UserModel $user
   * @return void
   */
  public function setAuthor(UserModel $user): void
  {

  }

  /**
   * Автор статьи
   *
   * @return UserModel
   */
  public function getAuthor(): UserModel
  {

  }

  /**
   * Сохранить в базе данных
   *
   * @return void
   */
  public function store(): void
  {

  }

}