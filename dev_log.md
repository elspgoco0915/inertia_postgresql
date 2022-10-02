# 22.07.07

## やったこと

## 前回
- [Docker+Laravel+PostgreSQL+pgAdmin4+Apacheの開発環境を構築する](https://qiita.com/sakeafterbeer/items/56cea7e981dacdfc686f)


- laravel9 インストールしたよ

- コンテナ自動起動を止める
  - [Dockerコンテナの自動起動設定を変更する方法](https://www.pressmantech.com/tech/6522#:~:text=Docker%E3%82%B3%E3%83%B3%E3%83%86%E3%83%8A%E5%8D%98%E4%BD%93%E3%81%A7%E3%81%AE,%E3%81%AE%E3%82%AA%E3%83%97%E3%82%B7%E3%83%A7%E3%83%B3%E3%82%92%E4%BD%BF%E3%81%84%E3%81%BE%E3%81%99%E3%80%82&text=docker%20update%E3%82%B3%E3%83%9E%E3%83%B3%E3%83%89%E3%82%92%E5%88%A9%E7%94%A8,%E5%90%8D%E3%82%92%E6%8C%87%E5%AE%9A%E3%81%97%E3%81%BE%E3%81%99%E3%80%82)
- php artisan migarteを実行するため、疎通テスト
  - [laravel8スターターキット](https://readouble.com/laravel/8.x/ja/starter-kits.html)で、まずmigrateを実行するみたい
  - [LaravelでPostgreSQLを使うための設定メモ](https://qiita.com/aminevsky/items/52f56546f081c52b79ed)
  
- ` composer require laravel/breeze --dev `を実行して laravel/breezeを入れる
- ` php artisan breeze:install vue `を実行して、inertiaを入れる 
- `Please execute the "npm install" && "npm run dev" commands to build your assets.`と出てきたので、` npm install && npm run dev `を実行します

- [Laravel Breezeで「シンプルな」ログイン機能をインストール](https://blog.capilano-fw.com/?p=8301)


### なぜにnpm入れるの？
> このコマンドは、認証ビュー、ルート、コントローラ、およびその他のリソースをアプリケーションにリソース公開します。
> Laravel Breezeは、その機能と実装を完全に制御し目に見えるようにするために、すべてのコードをアプリケーションへリソース公開します。
> Breezeをインストールしたら、アプリケーションのCSSファイルを使用できるようにアセットをコンパイルする必要もあります。

とのこと

これらがひとまとめにされたらしいよ
JavaScript　・・・　public/js/app.js
CSS　・・・　public/css/app.css

これで localhost開いたら、画面真っ白になった
breeze入れる前までは、問題なく見れていた

## 「前回」の部分からいったんやり直し

- composer create-project laravel/laravel sample
- yml修正

- jetstreamを入れる前に、viteの手順をやってみる
https://laravel-vite.dev/guide/extra-topics/inertia.html#overview
npx @preset/cli apply laravel:inertia
errになるのでできない

- jetstreamを入れるところから始める
- composer require laravel/jetstream
- inertiaもいれる
- php artisan jetstream:install inertia

localhost見てみる　エラー　sessionってテーブルないよ
先にDBの疎通設定
疎通できたら、Vite manifest not found at: /var/www/html/public/build/manifest.json のエラー
やっぱりviteが必要なのか (npm install && npm run dev をやっていないですか？的なのも書いてあった)
しょうがないから、docker-compose exec web bash で、npm install && npm run dev
相変わらずのdependency error連続
ローカルでnpm install, npm run devやってみた
npm installのエラーが出なくなった
npm run devでlocalhost開いたらlaravelの画面表示された！

## webコンテナ どっちも古い
root@c79a3f2969e7:/var/www/html# node -v
v12.22.12
root@c79a3f2969e7:/var/www/html# npm -v
6.14.16

## ローカル
$ node -v
v16.15.0
$ npm -v
8.5.5

npm run dev しないと
Vite manifest not found at: /var/www/html/public/build/manifest.json
でエラーになるよ これでいいのか？

いったんこれで残しておくべき phase2

npm run devしたまま、実装するみたい
vueコンポーネントを編集すると、勝手にリロードしてくれる(=ホットリロード)

07 - まで進められた
[サービスコンテナを利用する - Laravel8でe-Learningシステムを作成する](https://zenn.dev/misaka/books/dd643bac87284a/viewer/c77d99)

22.7.12

-14:00
11 - まで進めた
-18:30
15 - まで終えた
inertiaで一通りの動きは見れた

残りは、リファクタリングなど





## qkyokuルーティングイメージ

ex) https://qkyoku.com/list/eyJpdiI6Inl2STh4bEx/


- リストの定義
- qkyoku … 主となるリスト、更新履歴も含めて残す
- list   … サブリスト、基本変更できない、投稿と削除のみ

- logから引用機能


- ダッシュボード
  - GET    /
- リスト閲覧
  - GET    /list/{list_id}
- いいね機能
  - PUT    /list/{list_id}/like
  - DELETE /list/{list_id}/like
- ユーザー
  - GET    /users/{user_id}
  - フォロー機能
  - PUT    /users/{user_id}/follow
  - DELETE /users/{user_id}/follow

- リスト
  - GET    /users/{user_id}/list/

- 初回作成時
  - GET    list/create
  - POST   list/
  - GET    list/{list_id}

- リスト関連
  - GET    list/{list_id}
  - POST　 list/
  - PUT    list/{list_id}
  - DELETE list/{list_id}

- リストのパネル閲覧(これもlist/{list_id}で全パネル取得したい)
  - GET     list/{list_id}/{num}

- リスト編集
  - GET    list/{list_id}/edit

- リストのパネル編集
  - GET    list/{list_id}/{panel_num}/edit

  - 検索機能(axiosでsearch内で賄いたい)
  - GET    list/{list_id}/{panel_num}/edit/search
    - GET    list/{list_id}/{panel_num}/edit/search?keyword={keyword}&type={album}
    - GET    list/{list_id}/{panel_num}/edit/search?keyword={keyword}&type={artist}
      - GET    list/{list_id}/{panel_num}/edit/search?artist_id={artist_id}

- 新規追加・更新(albumのセット時、editでコメント変更時)
  - POST  list/{list_id}/{panel_num}
  - PUT   list/{list_id}/{panel_num}
- リストパネル編集
  - GET   list/{list_id}/{panel_num}/edit

- ログ機能
  GET    log/create
  POST   log/
  PUT    log/{log_id}
  DELETE log/{log_id}

- ログ編集
　GET    log/{log_id}/edit
  POST　 log/{log_id}

- 検索機能(axiosでsearch内で賄いたい)
- GET    log/{log_id}/edit/search

- タグ検索
- GET    tags/{name}

