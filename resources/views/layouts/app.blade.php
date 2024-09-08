<link href="{{ asset('css/library/bootstrap.css') }}" rel="stylesheet">
<script src="{{ asset('js/library/bootstrap.js') }}"></script>

<!-- {{-- <script src="https://kit.fontawesome.com/213b585f79.js" crossorigin="anonymous"></script> --}} -->
<!-- Jquery -->
<script rel="stylesheet" src="{{ asset('js/library/jquery.min.js') }}"></script>

<!--toastMessage-->
<link rel="stylesheet" href="{{asset('css/library/toastmessage.css')}}" />    
<link rel="stylesheet" href="{{asset('css/library/message-box.css')}}" />    

<!--config setup-->
<script  rel="stylesheet" src="{{asset('js/config/config.js')}}"></script>

<!--pagination-->
<script  rel="stylesheet" src="{{asset('js/library/pagination.js')}}"></script>

<!--Message Box-->
<script src="{{asset('js/library/message-box.js')}}"></script>
<!--Helper-->
<script src="{{asset('js/library/helper.js')}}"></script>
<script src="{{asset('js/library/buildfontendrestfullapi.js')}}"></script>

<!--Icon-->
<link rel="stylesheet" type="text/css" href="{{asset('lib/slick-1.8.1/slick/slick.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('lib/slick-1.8.1/slick/slick-theme.css')}}" />
{{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
{{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
<script src="https://kit.fontawesome.com/213b585f79.js" crossorigin="anonymous"></script>

<style>
    ul{
        padding: 0px;
    }
    li{
        cursor: pointer;
    }
    a{
        text-decoration: none;
    }
    tbody{
        position: relative;
    }
</style>
<!-- ##### notifications ##### -->
<ul class="notifications"></ul>
@yield('main') 
<script type="text/javascript" src="{{asset('lib/slick-1.8.1/slick/slick.min.js')}}"></script>
<!-- Toastmessage -->
<script type="text/javascript" src="{{asset('js/library/toastmessage.js')}}"></script>   