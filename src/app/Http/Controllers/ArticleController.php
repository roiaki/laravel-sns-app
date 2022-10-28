<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // ダミーデータ
        $articles = [
            (object) [
                'id' => 1,
                'title' => 'タイトル1',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum enim magni, impedit molestias ut debitis voluptatibus, qui quod harum error recusandae dolores dolorum et nam, ad deleniti. Ullam, veritatis! Temporibus.Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum enim magni, impedit molestias ut debitis voluptatibus, qui quod harum error recusandae dolores dolorum et nam, ad deleniti. Ullam, veritatis! Temporibus.Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum enim magni, impedit molestias ut debitis voluptatibus, qui quod harum error recusandae dolores dolorum et nam, ad deleniti. Ullam, veritatis! Temporibus.',
                'created_at' => now(),
                'user' => (object) [
                    'id' => 1,
                    'name' => 'ユーザー名1',
                ],
            ],
            (object) [
                'id' => 2,
                'title' => 'タイトル2',
                'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum enim magni, impedit molestias ut debitis voluptatibus, qui quod harum error recusandae dolores dolorum et nam, ad deleniti. Ullam, veritatis! Temporibus.',
                'created_at' => now(),
                'user' => (object) [
                    'id' => 2,
                    'name' => 'ユーザー名2',
                ],
            ],
            (object) [
                'id' => 3,
                'title' => 'タイトル3',
                'body' => '本文3',
                'created_at' => now(),
                'user' => (object) [
                    'id' => 3,
                    'name' => 'ユーザー名3',
                ],
            ],
        ];

        return view('articles.index', ['articles' => $articles]);
    }
}
