<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Book Registered</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f7;
            color: #51545e;
            padding: 20px;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #e8e8f1;
        }
        h1 {
            color: #333333;
            font-size: 22px;
            margin-top: 0;
        }
        .book-card {
            background-color: #f8fafc;
            border-left: 4px solid #4f46e5;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <div class="email-wrapper">
        <h1>Hi there,</h1>
        <p>A new book has been successfully registered in the system!</p>

        <div class="book-card">
            <p><strong>Title:</strong> {{ $book->name }}</p>
            <p><strong>Author:</strong> {{ $book->author }}</p>
            <p><strong>Added On:</strong> {{ $book->created_at->format('M d, Y H:i') }}</p>
        </div>

        <p>Thanks,<br>The System Team</p>
    </div>

</body>
</html>