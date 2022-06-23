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

    async function audioCall() {
      var publisher;
      var targetElement = 'publisher';
      var apiKey = "{{env('VONAGE_API_KEY')}}";
      var sessionId = "{{ $session_id }}";
      var token = "{{ $token }}";
      var pubOptions = {videoSource: null};
      var options = {subscribeToAudio:true, subscribeToVideo:false};
      var session;

      publisher = OT.initPublisher(targetElement, pubOptions, function(error) {
        if (error) {
          alert("The client cannot publish.");
        } else {
          console.log('Publisher initialized.');
        }
      });
      session = OT.initSession(apiKey, sessionId);
      session = session.connect(token, function (error) {
          if (error) {
            console.log("Failed to connect: ", error.message);
            if (error.name === "OT_NOT_CONNECTED") {
              alert("You are not connected to the internet. Check your network connection.");
            }
          } else {
            console.log("Connected");
          }
      });
      await sleep(3000);

      // Setting an audio source to a new MediaStreamTrack
      const stream = await OT.getUserMedia({
        videoSource: null
      });

      const [audioSource] = stream.getAudioTracks();
      publisher.setAudioSource(audioSource).then(() => console.log('Audio source updated'));

      // Cycling through microphone inputs
      let audioInputs;
      let currentIndex = 0;
      OT.getDevices((err, devices) => {
        audioInputs = devices.filter((device) => device.kind.toLowerCase() === 'audioInput');
        // Find the right starting index for cycleMicrophone
        audioInputs.forEach((device, idx) => {
          if (device.label === publisher.getAudioSource().label) {
            currentIndex = idx;
          }
        });
      });

      const cycleMicrophone = () => {
        currentIndex += 1;
        let deviceId = audioInputs[currentIndex % audioInputs.length].deviceId;
        publisher.setAudioSource(deviceId);
      };


      // stream = streams['f39c6-ae02-100c-9727-b3bf2'];
      subscriber = session.subscribe(stream, targetElement, options);

      subscriber.subscribeToAudio(true); // audio on
      subscriber.subscribeToVideo(false); // video off

      if (!stream.hasAudio) {
          console.log("Audio call is ongoing.");
      }

      if (!stream.hasVideo) {
          console.log("Video call is ongoing.");
      }
    }

    function sleep(ms) {
      return new Promise(
        resolve => setTimeout(resolve, ms)
      );
    }
   
  
  </script>
  @livewireScripts
</body>

</html>