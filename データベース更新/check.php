<?php 
    /* 
        コンタクトフォームの確認画面
    */
    
    // セッションを開始
    session_start();

    // フォーム入力からの遷移でないアクセスの場合にフォーム入力画面へリダイレクト
    if (!$_POST) {
        header('Location: ./form.php');
    }

    // トークンチェック
    if ($_SESSION['input_token'] === $_POST['input_token']) {
        
        // POSTからSESSIONへ受け渡し
        $_SESSION = $_POST;

        //エラーフラグに偽を立てる
        $tokenValidateError = false;
    }
    else {

        //エラーフラグに真を立てる
        $tokenValidateError = true;
    }
?>

<form method="post" action="./send.php">
    <p><?php echo htmlspecialchars($_POST['input_name'], ENT_QUOTES, 'utf-8'); ?></p>
    <p><?php echo htmlspecialchars($_POST['input_email'], ENT_QUOTES, 'utf-8'); ?></p>
    <P><input type="button" onClick="history.back();" value="戻る"></p>
    <?php if (!$tokenValidateError): ?>
        <input type="submit" value="送信する">
    <?php endif; ?> 
</form>