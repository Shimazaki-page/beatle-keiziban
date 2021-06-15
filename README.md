<<<<<<< HEAD
=======
#カブトムシ掲示板  
※beatle-branchブランチが最新です。

##概要  
画像投稿できるユーザー匿名性の掲示板を作成しました。

##機能  
- 基本機能
  - ユーザーはスレッド・コメントの作成ができます。
  - スレッドは5件表示、コメントは10件表示可能です。  
  - スレッド・コメントに画像の添付ができます。  
  - 管理者はスレッド・コメントの削除ができます。
  - 管理者は/loginからログインし、各ページのlogoutリンクからログアウトできます。
  - パスワードを忘れた際にはメールでリセットリンクを送信します。  
  - 検索機能はスレタイの部分一致検索です。空白・部分一致しなかった場合は全件表示されます。
    
- 技術的機能一覧
  - ThreadsController　多くの表示に関する処理が記載
  - RegisterController　DBに保存する処理が記載
  - DeleteController  DBから削除する処理が記載
  - CommentRequest,ThreadRequest　バリデーションに関する処理が記載
  - web.php　ルーティングに関する処理が記載
  - migration関係　Factoryでseedを作成
  - Model　DBリレーション処理のみ  
  - 認証周辺　初期装備のミドルウェアやログイン・リセット機能を利用  
    
##環境
- [Laravel Sail](https://readouble.com/laravel/8.x/ja/sail.html)
  を使用(Laravel 8.41.0,PHP 8.0.5,MySQL,Redis)
- コンテナ起動
  - ```docker-compose.yml```のあるディレクトリで```sail up -d```
- コンテナ停止
  - ```sail down```
- workspaceコンテナ内に入る
  - ```sail shell```
- マイグレーション実行・table作成    
  - workspaceコンテナ内で```php artisan migrate --seed```  

##課題点
- ~~部分一致検索において意図しない挙動になっている。ThreadsController@searchにおいて、部分検索にかからない場合はスレッドを全件表示したいが0件の表示になってしまう。~~(動作改善したが冗長)
- ModelとControllerの分離。
- laravel sailによって立ち上がった各コンテナの役割・Dockerに対する理解。
- 認証周辺、ページネーションの処理内容の理解。
- クラスの深堀り（eloquentビルダー,queryビルダー, collectionあたり）

##気をつけた点・学んだ点
- 部分検索におけるエスケープ機能
- DB接続回数に気をつけ、Eagerloadを行った
- フラッシュ利用による投稿・削除成功メッセージの表示
- 共通した処理を別の処理としてまとめた(RegisterController@storeImage)
- validationエラーのbootstrapを利用した警告表示
- コントローラーに詰め込みすぎないようにフォームリクエストを利用

>>>>>>> beatle-branch
