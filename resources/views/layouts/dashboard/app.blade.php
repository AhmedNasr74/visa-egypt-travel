<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ setting(\App\Enums\SettingKey::SITE_TITLE->value, true) }} Dashboard">
    <meta name="keywords" content="admin dashboard, {{ setting(\App\Enums\SettingKey::SITE_TITLE->value, true) }}, web app">
    <meta name="author" content="Ahmed Nasr">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <link rel="icon" href="assets/images/dashboard/favicon.png" type="image/x-icon"> --}}
    {{--    <link rel="shortcut icon" href="assets/images/dashboard/favicon.png" type="image/x-icon"> --}}
    <title>{{ setting(\App\Enums\SettingKey::SITE_TITLE->value, true) }} | Dashboard</title>

    <!-- Google font-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-icons.css') }}">
    <link href="{{ asset('assets/admin/css/ace.min.css') }}" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

    <style>
        .auto-translate-d {
            position: fixed;
            bottom: 10%;
            right: 2%;
            width: 50px;
            height: 50px;
            padding: 0px;
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
            font-size: 24px;
        }
        .select2-container {
            width: 100% !important;
        }
        .auto-translate-d {
            position: fixed;
            bottom: 10%;
            right: 2%;
            width: 50px;
            height: 50px;
            padding: 0px;
            display: flex;
            justify-content: center;
            align-content: center;
            align-items: center;
            font-size: 24px;
        }
        .input-group select.dropdown-toggle{
            background: var(--theme-color);
            border: unset;
            padding-left: 10px;
            font-weight: bold;
        }
        .light .input-group select.dropdown-toggle {
            color: #fff;
        }
        .dark .accordion-button.collapsed {
            color: #fff !important;
            border: 1px solid #fff;
        }
        .hide {
            display: none;
        }
        .bootstrap-tagsinput .tag {
            display: inline-block;
            margin: 2px;
        }
    </style>
</head>

<body class="{{ admin()->theme }}">
    <!-- page-wrapper Start-->
    <div class="page-wrapper">

        @include('layouts.dashboard.navbar')

        <!-- Page Body Start -->
        <div class="page-body-wrapper">
            @include('layouts.dashboard.sidebar')
            <div class="page-body">
                @yield('content')
            </div>
            @include('layouts.dashboard.footer')
        </div>
    </div>
    <!-- page-wrapper end-->

    <!--script admin-->
    <script>
        window.supportedLocales = {!! collect(config('translatable.locales'))->toJson() !!}
    </script>
     <script>
       //  let content=document.querySelectorAll( '.code-editor' );
       // content.forEach(element => {
       //  ClassicEditor.create( element )
       //      .catch( error => {
       //          console.error( error );
       //      } );
       //
       // });
    </script>
    {{-- <script src="{{ config('tinymce.sdk-url') }}" referrerpolicy="origin"></script> --}}
    <script src="{{ asset('assets/admin/js/ace/ace.js') }}"></script>
    <script src="{{ asset('assets/admin/js/ace/mode-css.js') }}"></script>
    <script src="{{ asset('assets/admin/js/ace/worker-css.js') }}"></script>
    <script src="{{ asset('assets/admin/js/ace/snippets/css.js') }}"></script>
    <script src="{{ asset('assets/admin/js/ace/ext-language_tools.js') }}"></script>
    <script src="{{ asset('assets/admin/js/ace/beautify-css.min.js') }}"></script>
    @stack('js-upper')
    <script src="{{ asset('assets/admin/js/admin.js') }}?ver=1.6"></script>
    {{-- <script src="{{ asset('assets/admin/js/tinymce-jquery.min.js') }}"></script> --}}
    <script>
         $(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});
        $('.auto-translate').each(function () {
            $(this).on('click', function () {
                if(confirm('This will overwrite any translated property!')) {
                    $(this).addClass('disabled')
                    let $icon = $(this).find('.icon')
                    $icon.removeClass('fa-language')
                    $icon.addClass('fa-spinner fa-spin')
                    axios.post("{{ route('dashboard.model.auto.translate') }}", {
                        model: $(this).data('model'),
                        id: $(this).data('id'),
                    })
                        .then(response=> toastr.success(response.data.message))
                        .catch(error=> toastr.error(error?.response?.data?.message || "Unexpected Error!"))
                        .finally(()=> {
                            $(this).removeClass('disabled')
                            $icon.addClass('fa-language')
                            $icon.removeClass('fa-spinner fa-spin')
                        })
                }
            })
        })
    </script>

    <script>
        $('#en-title').keyup(function () {
            if ($(this).val().length > 0) {
                let slug = $(this).val().toLowerCase()
                    .trim()
                    .normalize("NFD") // Normalize accented characters
                    .replace(/[\u0300-\u036f]/g, "") // Remove diacritics
                    .replace(/[^a-z0-9 -]/g, "") // Remove invalid characters
                    .replace(/\s+/g, "-") // Replace spaces with hyphens
                    .replace(/-+/g, "-"); // Remove multiple hyphens
                $('#slug').val(slug)
            } else {
                $('#slug').val('')
            }
        })
    </script>

    @isset($dataTable)
        <x-dashboard.partials.delete-resource-modal />
        {!! $dataTable->scripts() !!}
    @endisset
    @stack('js')
</body>

</html>
