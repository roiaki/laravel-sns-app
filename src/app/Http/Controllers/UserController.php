<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user    = User::where('name', $name)->first();
        $article = $user->articles->sortByDesc('created_at');

        return view('users.show', [
            'user'     => $user,
            'articles' => $article,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first();

        // $article->likes 記事モデルからlikesテーブル経由で紐づいているユーザーモデルのコレクションが返る
        // $article->likes() 多対多のリレーション（BelongsToManyクラスのインスタンス）が返る
        $articles = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    /**
     * フォロー中のユーザを取得
     * @param $name ユーザの名前
     */
    public function followings(string $name)
    {
        $user = User::where('name', $name)->first();

        // ユーザーモデルのリレーションfollowings/followersを使用して、
        // フォロー中・フォロワーのユーザーモデルをコレクションで取得
        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }
    
    /**
     * フォロワーを取得
     */
    public function followers(string $name)
    {
        $user = User::where('name', $name)->first();

        // ユーザーモデルのリレーションfollowings/followersを使用して、
        // フォロー中・フォロワーのユーザーモデルをコレクションで取得
        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        // 自分をフォロー仕様とする場合
        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }
}
