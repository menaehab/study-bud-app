<!DOCTYPE html>
<html lang="en">
@include('livewire.partials.head')

<body>
    @include('livewire.partials.header')
    {{ $slot }}
    <script src="{{ asset('assets') }}/script.js"></script>
</body>

</html>
