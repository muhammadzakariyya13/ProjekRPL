<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel | Welcome</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #fff;
            font-family: 'Roboto', Arial, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        h1 {
            font-size: 5rem;
            font-weight: 400;
            color: #202124;
            margin-bottom: 30px;
            letter-spacing: -1px;
        }

        p {
            color: #5f6368;
            font-size: 1rem;
            margin-bottom: 40px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 20px;
        }

        .buttons a.btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 4px;
            background-color: #19191a;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            user-select: none;
            transition: background-color 0.3s ease;
        }

        .buttons a.btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 3rem;
            }

            .buttons {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <main>
        <h1>Welcome to Laravel!</h1>
        <p>Welcome again from views</p>
        <div class="buttons">
            <a href="/chatbot" class="btn">Chatbot</a>
            <a href="/react" class="btn">React</a>
            <a href="/products" class="btn">Product</a>
        </div>
    </main>
</body>

</html>
