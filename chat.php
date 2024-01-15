<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>留言系统</title>
    <style>
      /* 样式 */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }

      .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
      }

      h1 {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 20px;
      }

      form {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
      }

      label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
      }

      input[type="text"],
      textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 1rem;
      }

      textarea {
        resize: vertical;
        min-height: 100px;
      }

      input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
      }
      
      input[type="submit"]:hover {
        background-color: #3e8e41;
      }

      select {
        display: block;
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
      }
      
      .messages {
        list-style: none;
        margin: 0;
        padding: 0;
      }
      
    input[type="email"],
      textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 1rem;
      }

      .message {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 20px;
      }

      .message__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
      }

      .message__author {
        font-weight: bold;
      }

      .message__date {
        font-size: 0.8rem;
        color: #777;
      }

      .message__content {
        font-size: 1rem;
        white-space: pre-wrap;
      }
      
      .message__emoji {
        font-size: 1.5rem;
        margin-top: 5px;
      }
    </style>
  </head>

  <body>
    <div class="container">
      <h1>留言系统</h1>
      <!-- 留言表单 -->
      <form id="message-form" method="post" action="save_message.php">
        <label for="name">姓名：</label>
        <input type="text" id="name" name="name" required />
        <label for="email">邮箱：</label>
        <input type="email" id="email" name="email" required />
        <label for="message">留言：</label>
        <textarea id="message" name="message" required></textarea>
        <label for="emoji">表情：</label>
        <select id="emoji" name="emoji">
          <option value="🙂">🙂 开心</option>
          <option value="😭">😭 伤心</option>
          <option value="😡">😡 生气</option>
          <option value="🥱">🥱 困倦</option>
          <option value="😂">😂 笑出泪</option>
          <option value="😍">😍 心动</option>
          <option value="🤔">🤔 思考</option>
          <option value="👍">👍 点赞</option>
        </select>
        <input type="submit" value="提交" />
      </form>
      <!-- 留言列表 -->
      <ul id="messages" class="messages">
        <?php
        // 创建数据库连接
        $servername = 'localhost';
        $username = 'woshishabi1945';
        $dbname = '5201314';

        $conn = new mysqli($servername, $username, $password, $dbname);

        // 检查连接是否成功
        if ($conn->connect_error) {
            die('数据库连接失败: ' . $conn->connect_error);
        }
        
        // 查询留言数据
        $sql = 'SELECT * FROM messages ORDER BY date DESC';
        $result = $conn->query($sql);

if ($result !== false) {
    // 处理查询结果
        // 输出留言列表
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li class="message">';
                echo '<div class="message__header">';
                echo '<span class="message__author">' . $row['name'] . '</span>';
                echo '<span class="message__date">' . $row['date'] . '</span>';
                echo '</div>';
                echo '<div class="message__content">' . $row['message'] . '</div>';
                echo '<span class="message__emoji">' . $row['emoji'] . '</span>';
                echo '</li>';
            }
        } else {
            echo '<li class="message">暂无留言</li>';
        }
        }

        // 关闭数据库连接
        $conn->close();
        ?>
      </ul>
    </div>
  </body>
</html>
