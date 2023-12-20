<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <form id="myForm">
        <label for="text">Nhập văn bản</label>
        <input type="text" name="text" id="text">
        <button type="button" id="submit">Gửi</button>
    </form>
    <div id="result"></div>

    <script>

        $(document).ready(function() {
            $("#submit").click(function(e) {
                // Lấy dữ liệu từ input
                e.preventDefault()
                var textValue = $("#text").val();

                // Gửi dữ liệu qua Ajax
                $.ajax({
                    type: "POST",
                    url: "http://localhost/sqli/home/sqliDetection",
                    data: { text: textValue },
                    success: function(response) {
                        // Hiển thị kết quả trả về từ PHP
                        console.log(response);
                        $("#result").html(response);
                    },
                    error: function() {
                        console.log("Error calling PHP script.");
                    }
                });
            });
        });
    </script>
</body>
</html>
