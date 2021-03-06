<!doctype html>
<html lang="fa">

<head>
  <meta charset="UTF-8">
  <meta name="_token" content="{{ csrf_token() }}">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title> @yield('title' , env('APP_NAME'))</title>
  <link rel="stylesheet" href="{{asset('frontend/assets/bootstrap-4.5.0-dist/css/bootstrap-reboot.min.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/assets/bootstrap-4.5.0-dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/swiper/swiper.min.css')}}">

  <link rel="stylesheet" href="{{asset('frontend/assets/fontawesome-free-5.13.1-web/css/all.css')}}">
  @yield('css')
  <link rel="stylesheet" href="{{asset('assets/vendors/select2/css/select2.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('frontend/assets/style.css')}}">

</head>


<body @if (\Request::route()->getName() == "login" || \Request::route()->getName() == "S.Register"
  || \Request::route()->getName() == "Profile")
  style="background: #fff"
  @endif
  >
  @include('Includes.Front.Header')
  @yield('main')
  @include('Includes.Front.Footer')

  @if (\Request::route()->getName() !== "login" && \Request::route()->getName() !== "S.Register"
  )
  @include('Includes.Front.MobileMenu')
  @endif

</body>
<script>
  var mainUrl = '{{route('MainUrl')}}';
</script>
<script src="{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/vendors/select2/js/select2.min.js')}}"></script>
<script src="{{asset('frontend/assets/bootstrap-4.5.0-dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendors/swiper/swiper.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-validate/jquery.validate.js')}}"></script>
<script
  src="{{asset('frontend/assets/Generic-Mobile-friendly-Slider-Plugin-with-jQuery-touchSlider/jquery.touchSlider.js')}}">
</script>
<script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.css" rel="stylesheet">
<script type="text/javascript" src="{{asset('frontend/assets/js/index.js')}}"></script>
<script src="{{asset('frontend/assets/js/tipped.min.js')}}"></script>
@yield('js')
<script>
  $(document).ready(function () {

    $('.js-example-basic-single').select2({
        placeholder: 'انتخاب کنید'
    });

});
 function call(e) {
     e.preventDefault()
     var id = $(event.target).data('id')
      var typ = $(event.target).data('type')
   var jbox =  new jBox('Modal', {
  attach: '.openModal',
  minWidth:300,
  ajax: {
      type:"POST",
    url: '{{route('Ajax.GetPlayLists')}}',
    data: {
      id:id,
      type:typ
    },
    reload: 'strict',
    setContent: false,
    success: function (response) {
      this.setContent(response);
    },
    error: function () {
      this.setContent('<b style="color: #d33">Error loading content.</b>');
    }
  }
});
jbox.open()
 }







</script>

</html>