<head>
    <meta charset="utf-8" />
    <title>CMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('/favicon/favicon.ico')}}">

    <!--Morris Chart-->
    {{-- <link rel="stylesheet" href="{{ asset('/admin/libs/morris-js/morris.css')}}" /> --}}

    @stack('styles')
    
    <style>
        /* ckeditor css */
        .ck.ck-editor__main>.ck-editor__editable {
            min-height: 200px
        }
    </style>


    <!-- App css -->
    <link href="{{ asset('/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/admin/css/admin.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/admin/css/style.css')}}?v=0.2" rel="stylesheet" type="text/css" />
</head>