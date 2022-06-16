<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>{{ config('app.name', 'Gharyal') }}</title>


  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/img/favicons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets/img/favicons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/img/favicons/favicon-16x16.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicons/favicon.ico') }}">
  <link rel="manifest" href="{{ asset('backend/assets/img/favicons/manifest.json') }}">
  <meta name="msapplication-TileImage" content="{{ asset('backend/assets/img/favicons/mstile-150x150.png') }}">
  <meta name="theme-color" content="#ffffff">
  <script src="{{ asset('backend/assets/js/config.js') }}"></script>
  <script src="{{ asset('backend/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>

  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  <link href="{{ asset('backend/vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/assets/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
  <link href="{{ asset('backend/assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
  <link href="{{ asset('backend/assets/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
  <link href="{{ asset('backend/assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
  <link href="{{ asset('backend/vendors/choices/choices.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendors/dropzone/dropzone.min.css') }}" rel="stylesheet">

  <style>
    #videos {
        position: relative;
        width: 100%;
        height: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    #subscriber {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
    }

    #publisher {
        position: absolute;
        width: 360px;
        height: 240px;
        bottom: 10px;
        left: 10px;
        z-index: 100;
        border: 3px solid white;
        border-radius: 3px;
    }

  </style>

  <script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
      var linkDefault = document.getElementById('style-default');
      var userLinkDefault = document.getElementById('user-style-default');
      linkDefault.setAttribute('disabled', true);
      userLinkDefault.setAttribute('disabled', true);
      document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
      var linkRTL = document.getElementById('style-rtl');
      var userLinkRTL = document.getElementById('user-style-rtl');
      linkRTL.setAttribute('disabled', true);
      userLinkRTL.setAttribute('disabled', true);
    }
  </script>
  @livewireStyles
</head>


<body>

  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container" data-layout="container">
      <script>
        var isFluid = JSON.parse(localStorage.getItem('isFluid'));
        if (isFluid) {
          var container = document.querySelector('[data-layout]');
          container.classList.remove('container');
          container.classList.add('container-fluid');
        }
      </script>
      @include('partials.sidebar')
      <div class="content">
        @include('partials.topHeader')
        @yield('content')
        @include('partials.footer')
      </div>
    </div>
  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->

  @include('partials.pageSettings')

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
  <script src="{{ asset('backend/vendors/popper/popper.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/anchorjs/anchor.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/is/is.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/chart/chart.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/countup/countUp.umd.js') }}"></script>
  <script src="{{ asset('backend/vendors/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/dayjs/dayjs.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/fontawesome/all.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/lodash/lodash.min.js') }}"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="{{ asset('backend/vendors/list.js/list.min.js') }}"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="{{ asset('backend/assets/js/emoji-button.js') }}"></script>
  <script src="{{ asset('backend/vendors/choices/choices.min.js') }}"></script>
  <script src="{{ asset('backend/vendors/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/theme.js') }}"></script>
  <script type="text/javascript">
    var session;
    var connectionCount = 0;
    var apiKey = "{{env('VONAGE_API_KEY')}}";
    var sessionId = "";
    var token = "";
    var publisher;

    function connect() {

        // Replace apiKey and sessionId with your own values:

        session = OT.initSession(apiKey, sessionId);
        session.on("streamCreated", function (event) {
            console.log("New stream in the session: " + event.stream.streamId);
            session.subscribe(event.stream, 'subscriber', {
                insertMode: 'append',
                width: '100%',
                height: '100%'
            });
        });

        session.on({
            connectionCreated: function (event) {
                connectionCount++;
                alert(connectionCount + ' connections.');
            },
            connectionDestroyed: function (event) {
                connectionCount--;
                alert(connectionCount + ' connections.');
            },
            sessionDisconnected: function sessionDisconnectHandler(event) {
                // The event is defined by the SessionDisconnectEvent class
                alert('Disconnected from the session.');
                document.getElementById('disconnectBtn').style.display = 'none';
                if (event.reason == 'networkDisconnected') {
                    alert('Your network connection terminated.')
                }
            }
        });

        var publisher = OT.initPublisher('publisher', {
            insertMode: 'append',
            width: '100%',
            height: '100%'
        }, error => {
            if (error) {
                alert(error.message);
            }
        });

        // Replace token with your own value:
        session.connect(token, function (error) {
            if (error) {
                alert('Unable to connect: ', error.message);
            } else {
                // document.getElementById('disconnectBtn').style.display = 'block';
                alert('Connected to the session.');
                connectionCount = 1;

                if (session.capabilities.publish == 1) {
                    session.publish(publisher);
                } else {

                    alert("You cannot publish an audio-video stream.");
                }
            }
        });
    }
    // connect();
  </script>
  @livewireScripts
</body>

</html>