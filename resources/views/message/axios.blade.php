<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>axiosを学ぶ</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="axios">
        <axios></axios>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>

</html>