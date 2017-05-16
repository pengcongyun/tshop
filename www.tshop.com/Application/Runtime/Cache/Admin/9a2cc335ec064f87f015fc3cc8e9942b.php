<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <form action="<?php echo U();?>" method="post">
        <p>
            总价：<input type="text" name="money">
        </p>
        <p>
            <input type="submit" value="提交支付">
        </p>
    </form>
</body>
</html>