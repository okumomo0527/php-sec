# PHP App ② レビュー

## XSS(クロスサイトスクリプティング)

### XSSとはどんな攻撃か、また攻撃者にどんなメリットがあるか説明してください。

- XSSは、悪意あるスクリプトを被害者のブラウザ上で実行させる攻撃です。攻撃者がフォームやURLにスクリプトを仕込み、ページに挿入されたスクリプトが他のユーザーのブラウザで実行されることで発生します。

- 攻撃者のメリットには、ユーザーのクッキーやセッション情報の盗み出し、フィッシングや不正なリダイレクトなどがあり、これによりユーザーの個人情報やアカウントが悪用される可能性があります。


### `htmlspecialchars()`を`e()`として定義しなおすメリットを説明してください。

- htmlspecialchars()を短縮してe()とすることで、コードが読みやすくなり、頻繁にエスケープ処理を使用する際の記述がシンプルになります。

- メンテナンス性が向上し、コードの見通しも良くなります。


### `htmlspecialchars()`を使うことでなぜXSSが防げるのか説明してください。

- htmlspecialchars()は、HTMLタグの特殊文字（<, >, &, " など）をエンティティ化して出力します。これにより、ユーザーが入力した内容がそのままHTMLタグとして解釈されることを防ぎ、スクリプトの実行が回避されます。


## CSRF(クロスサイトリクエストフォージェリ)

### CSRFとはどんな攻撃か、また攻撃者にどんなメリットがあるか説明してください。

- CSRFは、ユーザーが意図していないリクエストを別サイト経由で送信させる攻撃です。たとえば、あるサイトにログインしているユーザーが、そのサイトの機能を別の悪意あるサイトから操作させられることで、ユーザーの意図に反するデータの変更や送信が発生します。

- 攻撃者のメリットには、ユーザーの権限で不正なアクションを実行させること（例えば送金やアカウント情報の変更）が含まれます。


### SessionとCookieの違いを説明してください。

- Sessionはサーバー側で管理される一時的なデータストレージで、ユーザーごとに固有のセッションIDを発行し、情報がサーバーに保存されます。

- Cookieはクライアント（ブラウザ）側に保存され、サーバー間での識別情報としても利用されますが、ユーザーのデバイスに依存します。


### `setToken()`が何をしているか説明してください。

- setToken()はCSRFトークンを生成して、サーバー側でセッションに保存し、フォームやリンクに埋め込むために使われます。これにより、不正なリクエストが弾かれやすくなります。


### `checkToken()`が何をしているか説明してください。

- checkToken()は、リクエストに含まれるトークンとサーバーに保存されたトークンを比較して、CSRF対策が有効かどうかを確認します。トークンが一致しない場合、不正なリクエストとして処理が拒否されます。


### トークンを使うことでなぜCSRFが防げるのか説明してください。

- トークンを用いることで、正規のページを通過していないリクエストには適切なトークンが含まれておらず、結果としてリクエストがサーバー側で拒否されます。


## SQLインジェクション

### SQLインジェクションとはどんな攻撃か、また攻撃者にどんなメリットがあるか説明してください。

- SQLインジェクションは、ユーザーが入力欄にSQL構文を挿入して不正なクエリを実行させる攻撃です。これにより、攻撃者はデータベース内の情報を不正に取得・改ざんすることが可能になります。


### `->prepare()`の返り値と、またこのメソッドが何をしているか説明してください。

- ->prepare()は準備されたステートメントを返します。SQLクエリを実行する前に、安全な構文としてパラメータをバインドすることができ、SQLインジェクションを防ぐ役割を果たします。


### `->bindValue()`が何をしているか説明してください。

- ->bindValue()はプレースホルダーに特定の値をバインド（結び付け）します。この方法で、クエリにパラメータを挿入する際の安全性が向上します。


### 今回の対策でなぜSQLインジェクションが防げるのか説明してください。

- SQL文と値を分離してバインドすることで、ユーザーの入力がSQL構文として解釈されることを防ぎ、不正なクエリの実行を防ぎます。


## バリデーション

### バリデーションの目的について説明してください。

- バリデーションは、ユーザーの入力内容が適切であることを確認し、不正なデータやシステムの意図しないデータがアプリケーションに送信されるのを防ぎます。


### `validate()`が何をしているか説明してください。

- validate()は、入力内容が所定のルールに従っているか確認し、問題がある場合にエラーメッセージを生成する関数です。


### `isset($post['content'])`はなぜ必要か、無い場合どうなるか説明してください。

- isset($post['content'])は、配列内にcontentキーが存在するか確認しています。これが無い場合、存在しないキーを参照しようとしてエラーが発生する可能性があります。


## その他

### `unsetError()`を実行しないとどうなるか説明してください。

- unsetError()を実行しないと、エラーメッセージが次回のリクエスト時にも保持されてしまい、正しい入力をしてもエラーメッセージが表示され続けるなどの問題が発生します。