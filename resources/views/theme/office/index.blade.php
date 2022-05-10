<!DOCTYPE html>
<html lang="en">
@include('theme.office.head')
<body id="page-top">
@include('theme.office.aside')
<main class="py-4">
    {{$slot}}
</main>
@include('theme.office.modal')
@include('theme.office.js')
@yield('custom_js')
</body>
</html>