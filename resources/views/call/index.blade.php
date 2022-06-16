@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div style="margin-top: 250px;">
<div class="row">
    <div id="videos">
        <div id="subscriber"></div>
        <div id="publisher"></div>
    </div>
</div>
</div>


<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
<script type="text/javascript">
    var session;
    var connectionCount = 0;
    var apiKey = "{{env('VONAGE_API_KEY')}}";
    var sessionId = "{{$sessionId}}";
    var token = "{{$token}}";
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
    connect();

</script>

@endsection