<!DOCTYPE html>
<html>
<head>
    <title>Ask AI</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/github-dark.min.css"
    >

    @vite(['resources/css/style.css', 'resources/js/chat.js'])
</head>
<body>

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"></script>

    <script>
        hljs.highlightAll();
    </script>

</body>
</html>