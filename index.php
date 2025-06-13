<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?><!DOCTYPE html><html>
<head>
    <title>Group Chat App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4 && req.status == 200) {
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET', 'fetch.php', true);
            req.send();
        }
        setInterval(function(){ ajax(); }, 1000);function toggleEmojiPicker() {
        var picker = document.getElementById("emojiPicker");
        picker.style.display = picker.style.display === "none" ? "block" : "none";
    }

    function addEmoji(emoji) {
        var messageInput = document.querySelector("input[name='message']");
        messageInput.value += emoji;
    }

    function editMessage(id) {
        const msgText = document.querySelector(`#msg_${id} .msg-text`);
        const current = msgText.innerText;
        const newMsg = prompt("Edit your message:", current);
        if (newMsg !== null && newMsg.trim() !== "") {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "update.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    msgText.innerText = newMsg;
                }
            };
            xhr.send("id=" + id + "&message=" + encodeURIComponent(newMsg));
        }
    }

    function likeMessage(id) {
        const likeSpan = document.getElementById(`like_${id}`);
        let count = parseInt(likeSpan.innerText);
        likeSpan.innerText = ++count;
    }

    function toggleDarkMode() {
        document.body.classList.toggle('dark');
    }
</script>

</head>
<body onload="ajax();">
    <div id="container">
        <div class="top-bar">
            <span><strong>👥 Group: Cardio</strong></span>
            <a href="#" onclick="toggleDarkMode()">🌓 Toggle Theme</a>
            <a href="logout.php">🚪 Logout</a>
        </div><div id="chat-box">
        <div id="chat"></div>
    </div>

    <!-- Chat Form -->
    <form action="post.php" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="message" placeholder="Type a Message" required>
        <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
        <button type="submit">Send</button>
    </form>

    <!-- Emoji Button -->
    <div style="margin-top: 10px;">
        <button type="button" onclick="toggleEmojiPicker()">😊</button>
        <div id="emojiPicker" style="display:none; margin-top:5px;">
            <span onclick="addEmoji('😀')">😀</span>
            <span onclick="addEmoji('😂')">😂</span>
            <span onclick="addEmoji('😎')">😎</span>
            <span onclick="addEmoji('❤️')">❤️</span>
            <span onclick="addEmoji('👍')">👍</span>
            <span onclick="addEmoji('🍕')">🍕</span>
            <span onclick="addEmoji('💪')">💪</span>
            <span onclick="addEmoji('🤝')">🤝</span>
            <span onclick="addEmoji('🤞')">🤞</span>
            <span onclick="addEmoji('🫶')">🫶</span>
            <span onclick="addEmoji('🤲')">🤲</span>
            <span onclick="addEmoji('👏')">👏</span>
            <span onclick="addEmoji('🙌')">🙌</span>
            <span onclick="addEmoji('🤡')">🤡</span>
            <span onclick="addEmoji('🥶')">🥶</span>
            <span onclick="addEmoji('😈')">😈</span>
            <span onclick="addEmoji('👿')">👿</span>
            <span onclick="addEmoji('😶‍🌫️')">😶‍🌫️</span>
            <span onclick="addEmoji('😛')">😛</span>
            <span onclick="addEmoji('🤪')">🤪</span>
            <span onclick="addEmoji('🤗')">🤗</span>
            <span onclick="addEmoji('🫢')">🫢</span>
            <span onclick="addEmoji('🫡')">🫡</span>
        </div>
    </div>
</div>

</body>
</html>
