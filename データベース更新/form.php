<!DOCTYPE html>
<html lang="ja">
    <!-- 送信ボタン押下時、check.phpに遷移 -->
    <form method="POST" action="./check.php">
        <?php
            //CSRF対策のワンタイムトークン発行
            $randomNumber = openssl_random_pseudo_bytes(16);
            $token = bin2hex($randomNumber);
            echo '<input name="input_token" type="hidden" value="'.$token.'">';

            //トークンをセッションに格納
            session_start();
            $_SESSION['input_token'] = $token;
        ?>
        <p>氏　　　　　名<input id="name" type="text" name="input_name"></p>
        <p>メールアドレス<input id="email" type="email" name="input_email"></p>
        <input id="submit" type="submit" value="確認画面へ">
        <input type="reset" value="リセット">
    </form>
<html>