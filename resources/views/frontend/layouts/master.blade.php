<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>House of Beauty</title>
    <link rel="icon" type="image/png" href="{{ asset(config('settings.favicon')) }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>
    <div class="overlay-container d-none">
        <div class="overlay">
            <span class="loader"></span>
        </div>
    </div>

    <!--=============================
        Cart Popup Modal Start
    ==============================-->
    <div class="fp__cart_popup">
        <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body load_product_modal_body">



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=============================
    Cart Popup Modal End
    ==============================-->

    {{-- @dd(Cart::content()); --}}
    <!--=============================
        TOPBAR START
    ==============================-->

    <!--=============================
        TOPBAR END
    ==============================-->


    <!--=============================
        MENU START
    ==============================-->
    @include('frontend.layouts.menu')
    <!--=============================
        MENU END
    ==============================-->


    @yield('content')


    <!--=============================
        FOOTER START
    ==============================-->
    @include('frontend.layouts.footer')
    <!--=============================
        FOOTER END
    ==============================-->


    <!--=============================
        SCROLL BUTTON START
    ==============================-->
    <div class="fp__scroll_btn">
        go to top
    </div>
    <!--=============================
        SCROLL BUTTON END
    ==============================-->


    <!--jquery library js-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
    <!-- slick slider -->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <!-- isotop js -->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!-- simplyCountdownjs -->
    <script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
    <!-- counter up js -->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
    <!-- nice select js -->
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <!-- venobox js -->
    <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
    <!-- sticky sidebar js -->
    <script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
    <!-- wow js -->
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <!-- ex zoom js -->
    <script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--main/custom js-->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        toastr.options.progressBar = true;
        @if ($errors->any()) //if we have any kind of validation errors
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            } //this code will send csrf token in each ajax request to prevent csrf token mismatch (error 419)
        });
    </script>

    <!--laod global js-->
    @include('frontend.layouts.global-scripts')

    @stack('scripts'){{--  just like @yield('content') but for smaller portion and specific code in specific places, uses keyword @push and @endpush --}}

    <!-- Chatbot UI - Complete Implementation -->
    <div id="skincare-chatbot-container">
        <div class="chat-widget hidden" id="chat-widget">
            <div class="chat-header" id="chatHeader">
                <div class="chat-title">
                    <i class="fas fa-robot"></i>
                    <span>AI Assistant</span>
                </div>
                <button class="minimize-btn" id="minimizeBtn">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="chat-body" id="chatBody">
                <div class="chat-messages" id="chatMessages">
                    <div class="message bot">
                        <div class="message-content">
                            Hello! How can I help you with skincare today?
                        </div>
                    </div>
                </div>
                <div class="chat-input">
                    <input type="text" id="userInput" placeholder="Type your message...">
                    <button id="sendBtn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>

        <button class="chat-toggle" id="chatToggle">
            <i class="fas fa-comments"></i>
        </button>
    </div>

    <style>
        #skincare-chatbot-container {
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: 9999;
        }

        #skincare-chatbot-container .chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        #skincare-chatbot-container .chat-header {
            background: #4a90e2;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #skincare-chatbot-container .chat-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }

        #skincare-chatbot-container .minimize-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 5px;
        }

        #skincare-chatbot-container .chat-body {
            height: 400px;
            display: flex;
            flex-direction: column;
        }

        #skincare-chatbot-container .chat-messages {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
        }

        #skincare-chatbot-container .message {
            margin-bottom: 10px;
            display: flex;
            flex-direction: column;
        }

        #skincare-chatbot-container .message.user {
            align-items: flex-end;
        }

        #skincare-chatbot-container .message.bot {
            align-items: flex-start;
        }

        #skincare-chatbot-container .message-content {
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 15px;
            background: #f0f2f5;
            white-space: pre-wrap;
        }

        #skincare-chatbot-container .message.user .message-content {
            background: #4a90e2;
            color: white;
        }

        #skincare-chatbot-container .chat-input {
            padding: 15px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
        }

        #skincare-chatbot-container .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
        }

        #skincare-chatbot-container .chat-input button {
            background: #4a90e2;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #skincare-chatbot-container .chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: #4a90e2;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex !important;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            z-index: 9999;
            font-size: 24px;
        }

        #skincare-chatbot-container .chat-widget.minimized {
            transform: translateY(calc(100% - 60px));
        }

        #skincare-chatbot-container .hidden {
            display: none !important;
        }

        #skincare-chatbot-container .message-content.loading {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 60px;
        }

        #skincare-chatbot-container .dot {
            width: 8px;
            height: 8px;
            background-color: #999;
            border-radius: 50%;
            margin: 0 3px;
            animation: dot-pulse 1.5s infinite ease-in-out;
        }

        #skincare-chatbot-container .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        #skincare-chatbot-container .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes dot-pulse {
            0%, 100% { transform: scale(0.7); opacity: 0.5; }
            50% { transform: scale(1); opacity: 1; }
        }

        @media (max-width: 576px) {
            #skincare-chatbot-container .chat-widget {
                width: 90%;
                right: 5%;
                left: 5%;
            }
        }
    </style>

    <script>
    (function() {
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', initChatbot);

        // If DOM already loaded, initialize immediately
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(initChatbot, 1);
        }

        function initChatbot() {
            console.log('Initializing chatbot with OpenAI integration...');

            const chatWidget = document.getElementById('chat-widget');
            const chatToggle = document.getElementById('chatToggle');

            console.log('Chat elements:', {chatWidget, chatToggle});

            if (!chatWidget || !chatToggle) {
                console.error('Chat elements not found!');
                return;
            }

            const minimizeBtn = document.getElementById('minimizeBtn');
            const sendBtn = document.getElementById('sendBtn');
            const userInput = document.getElementById('userInput');
            const chatMessages = document.getElementById('chatMessages');

            // Make sure the toggle button is visible and the chat widget is hidden initially
            chatWidget.classList.add('hidden');
            chatToggle.classList.remove('hidden');

            // Toggle chat widget
            chatToggle.addEventListener('click', function() {
                console.log('Toggle button clicked');
                chatWidget.classList.remove('hidden');
                chatToggle.classList.add('hidden');
            });

            // Minimize chat widget
            minimizeBtn.addEventListener('click', function() {
                chatWidget.classList.add('hidden');
                chatToggle.classList.remove('hidden');
            });

            // Send message function
            function sendMessage() {
                const message = userInput.value.trim();
                if (message) {
                    // Add user message to chat
                    addMessage(message, 'user');
                    userInput.value = '';

                    // Show loading indicator
                    const loadingDiv = document.createElement('div');
                    loadingDiv.className = 'message bot';
                    loadingDiv.innerHTML = `
                        <div class="message-content loading">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    `;
                    chatMessages.appendChild(loadingDiv);
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                    console.log('Sending message to backend:', { messageLength: message.length });

                    // Send request to Laravel backend
                    fetch('/chatbot/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ message: message })
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            return response.text().then(text => {
                                console.error('Error response:', text);
                                throw new Error(`Server responded with ${response.status}: ${text}`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Remove loading indicator
                        chatMessages.removeChild(loadingDiv);
                        console.log('Response data:', data);

                        if (data.success) {
                            addMessage(data.message, 'bot');
                        } else {
                            addMessage("Sorry, I encountered an error: " + data.message, 'bot');
                        }
                    })
                    .catch(error => {
                        // Remove loading indicator
                        if (loadingDiv.parentNode) {
                            chatMessages.removeChild(loadingDiv);
                        }

                        console.error('API Error:', error);
                        addMessage("Sorry, I couldn't connect to the OpenAI API. Check browser console for details and make sure your server is running correctly.", 'bot');
                    });
                }
            }

            // Add message to chat
            function addMessage(text, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender}`;
                messageDiv.innerHTML = `
                    <div class="message-content">
                        ${text}
                    </div>
                `;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Send message on button click
            sendBtn.addEventListener('click', sendMessage);

            // Send message on Enter key
            userInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            // Add a test message to check if chatbot is working
            addMessage("Chatbot initialized. Try asking me a question about skincare!", 'bot');
            console.log('Chatbot initialized with OpenAI integration');
        }
    })();
    </script>
</body>

</html>
