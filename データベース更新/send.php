<?php 
    //セッション開始
    session_start();
    
    //セッションが偽の時、入力画面に遷移
    if(!$_SESSION) {
    header('Location: ./form.php');
    }

    //任意入力項目の配列が空の場合のエラーメッセージ制御
    error_reporting(E_ALL ^ E_NOTICE);

    //XSS対策用サニタイズ
    function h($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    //データベースを更新するデータの変数化
    $name = h($_SESSION['input_name']);
    $email = h($_SESSION['input_email']);

    // データベースに接続
    $pdo = new PDO('mysql:dbname=customer;host=localhost;' , 'root', 'root');
    $pdo->query('SET NAMES utf8;');

    // 実行したいSQL文をセット
    $stmt = $pdo->prepare('INSERT INTO contact (name, email) VALUES ("'.$name.'", "'.$email.'")');

    // SQLを実行し、実行結果を格納
    $isInserted = $stmt->execute();

    // データーベースから切断
    unset($pdo);

    //セッション終了
    session_destroy();
    ?>

    <?php
    //実行結果判定
    if($isInserted): ?>
        <p>フォームの内容でデータベースに登録しました。 
        </p> 
    <?php else: ?> 
        <p>登録エラー：データベースの登録に失敗しました。お手数ですが再度お試しください。 
        </p>
    <?php endif; ?>