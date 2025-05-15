<!DOCTYPE html>
<html lang="id">
<head>
    <title>Chatbot dengan Llama</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #1d1d1d;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            background-color: #5f5f5f;
            border-bottom: 1px solid #dadada;
            padding: 12px 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .header h1 {
            font-size: 18px;
            font-weight: 600;
            color: #ffffff;
            text-align: center;
        }

        /* Chat Container */
        .chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 80px 20px 120px;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }

        /* Message */
        .message {
            margin-bottom: 24px;
            padding: 0 20px;
        }

        .message-content {
            display: flex;
            gap: 16px;
            max-width: 900px;
            margin: 0 auto;
        }

        .message.user .message-content {
            justify-content: flex-start;
        }

        .message.assistant .message-content {
            justify-content: flex-start;
        }

        /* Avatar */
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-weight: 600;
            font-size: 14px;
        }

        .user .avatar {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
        }

        .assistant .avatar {
            background-color: #19C37D;
            color: white;
        }

        /* Message Text */
        .message-text {
            flex: 1;
            padding: 12px 16px;
            border-radius: 8px;
            line-height: 1.6;
            word-wrap: break-word;
        }

        .user .message-text {
            background-color: #2f2f2f;
            color: white;
        }

        .assistant .message-text {
            background-color: #ffffff;
            color: #333;
        }

        /* Markdown Styling */
        .message-text p {
            margin-bottom: 12px;
        }

        .message-text p:last-child {
            margin-bottom: 0;
        }

        .message-text pre {
            background-color: #2a2a2a;
            color: #d4d4d4;
            padding: 12px;
            border-radius: 6px;
            overflow-x: auto;
            margin: 12px 0;
        }

        .message-text code {
            background-color: #1e1e1e;
            color: #d4d4d4;
            padding: 2px 4px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
        }

        .message-text ul, .message-text ol {
            margin-left: 20px;
            margin-bottom: 12px;
        }

        .message-text li {
            margin-bottom: 6px;
        }

        /* Input Container */
        .input-container {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            border-top: 1px solid #e5e5e5;
            padding: 12px 20px;
        }

        .input-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
        }

        /* Form */
        #chat-form {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .input-group {
            flex: 1;
            position: relative;
        }

        textarea {
            width: 100%;
            padding: 12px 50px 12px 16px;
            border: 1px solid #e5e5e5;
            border-radius: 24px;
            font-size: 16px;
            font-family: inherit;
            resize: none;
            min-height: 48px;
            max-height: 200px;
            line-height: 1.5;
            outline: none;
            transition: border-color 0.2s;
        }

        textarea:focus {
            border-color: #10a37f;
        }

        /* Submit Button */
        .submit-button {
            position: absolute;
            right: 6px;
            bottom: 6px;
            width: 36px;
            height: 36px;
            border: none;
            background-color: #10a37f;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .submit-button:hover {
            background-color: #0e8a6f;
        }

        .submit-button:disabled {
            background-color: #e5e5e5;
            cursor: not-allowed;
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #333;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Welcome Message */
        .welcome-message {
            text-align: center;
            padding: 40px 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .welcome-message h2 {
            font-size: 32px;
            margin-bottom: 16px;
            color: #ffffff;
        }

        .welcome-message p {
            font-size: 16px;
            color: #ffffff;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 12px 16px;
            }

            .chat-container {
                padding: 70px 16px 100px;
            }

            .message {
                padding: 0 12px;
            }

            .input-container {
                background-color: #5f5f5f;
                padding: 12px 16px;
            }

            .avatar {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .welcome-message h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Chatbot LLaMA</h1>
    </div>

    <!-- Chat Container -->
    <div class="chat-container" id="chat-container">
        <!-- Welcome Message -->
        <div class="welcome-message" id="welcome-message">
            <h2>Selamat Datang di Chatbot LLaMA</h2>
            <p>Silakan mulai percakapan dengan mengetik pertanyaan Anda di bawah.</p>
        </div>

        <!-- Session Messages -->
        @if(session('messages'))
            @foreach(session('messages') as $message)
                <div class="message {{ $message['role'] }}">
                    <div class="message-content">
                        <div class="avatar">
                            @if($message['role'] == 'user')
                                <i class="fas fa-user"></i>
                            @else
                                <i class="fas fa-robot"></i>
                            @endif
                        </div>
                        <div class="message-text" data-markdown="{{ $message['content'] }}"></div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Display current prompt and response if available -->
            @if(session('prompt'))
                <div class="message user">
                    <div class="message-content">
                        <div class="avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="message-text">{{ session('prompt') }}</div>
                    </div>
                </div>
            @endif

            @if(session('response'))
                <div class="message assistant">
                    <div class="message-content">
                        <div class="avatar">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="message-text" data-markdown="{{ session('response') }}"></div>
                    </div>
                </div>
            @endif
        @endif
    </div>

    <!-- Input Container -->
    <div class="input-container">
        <div class="input-wrapper">
            <form id="chat-form" method="POST" action="/ask-llama">
                @csrf
                <div class="input-group">
                    <textarea 
                        name="prompt" 
                        id="prompt-input"
                        placeholder="Tulis pertanyaanmu..." 
                        rows="1"
                        required>{{ old('prompt') }}</textarea>
                    <button type="submit" class="submit-button" id="submit-button">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        // Render markdown content
        document.querySelectorAll('[data-markdown]').forEach(element => {
            const markdownContent = element.getAttribute('data-markdown');
            if (markdownContent) {
                element.innerHTML = marked.parse(markdownContent);
            }
        });

        // Auto-resize textarea
        const textarea = document.getElementById('prompt-input');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 200) + 'px';
        });

        // Handle form submission
        const form = document.getElementById('chat-form');
        const submitButton = document.getElementById('submit-button');
        
        form.addEventListener('submit', function(e) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<div class="loading"></div>';
        });

        // Scroll to bottom
        function scrollToBottom() {
            const chatContainer = document.getElementById('chat-container');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Hide welcome message if there are messages
        const messages = document.querySelectorAll('.message');
        const welcomeMessage = document.getElementById('welcome-message');
        if (messages.length > 0 && welcomeMessage) {
            welcomeMessage.style.display = 'none';
        }

        // Scroll to bottom on load
        window.addEventListener('load', scrollToBottom);

        // Handle Enter key to submit (without Shift)
        textarea.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                form.submit();
            }
        });
    </script>
</body>
</html>