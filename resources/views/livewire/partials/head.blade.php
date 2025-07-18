<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets') }}/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets') }}/style.css" />
    <title>{{ $title ?? config('app.name') }}</title>
    @fluxAppearance
    @livewireStyles
    @livewireScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
