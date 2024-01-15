<?php
// 创建数据库连接
$servername = 'localhost';
$username = 'woshishabi1945';
$password = 'woshishabi1945';
$dbname = '1314520';

// 获取表单字段的值
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$emoji = $_POST['emoji'];
$date = date('Y-m-d H:i:s');

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die('数据库连接失败: ' . $conn->connect_error);
}

// 创建插入留言的 SQL 语句
$sql = "INSERT INTO messages (name, email, message, emoji, date) VALUES ('$name', '$email', '$message', '$emoji', '$date')";

// 执行插入操作
if ($conn->query($sql) === TRUE) {
    // 留言保存成功后，返回首页
    header("Location: chat.php");
    exit();
} else {
    echo '留言保存失败: ' . $conn->error;
}

// 关闭数据库连接
$conn->close();
?>
