
<!DOCTYPE html>
<html lang="en">
    @include('website.components.head')
<body>

    @include('website.components.header')
    <main>
        @include('website.components.main_banner')

        @yield('main')

        @include('website.components.partners')
        @include('website.components.contact')

    </main>



    @include('website.components.footer')
    @include('website.components.scripts')
</body>
</html>
