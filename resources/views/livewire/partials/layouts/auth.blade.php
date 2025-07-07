<!DOCTYPE html>
<html lang="en">
@include('livewire.partials.auth.head')

<body>
    @include('livewire.partials.auth.header')
    <main class="auth layout">
        <div class="container">
            {{ $slot }}
        </div>
    </main>
</body>

</html>
