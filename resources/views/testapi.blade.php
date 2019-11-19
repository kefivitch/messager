<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b3090ece02c41b33bc54', {
      cluster: 'eu',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      updateConversation();
    });
  </script>
</head>
<body >
    
    <div id="app">

    </div>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js" integrity="sha256-XmdRbTre/3RulhYk/cOBUMpYlaAp2Rpo/s556u0OIKk=" crossorigin="anonymous"></script>
    <script>
        var data;
        axios.get('https://api.github.com/users/kefivitch/followers').then(resp => {
            data = resp.data;
            //console.log(resp.data);
            var theDiv = document.getElementById("app");
            var list = document.createElement('ul');
            list.setAttribute('id','list');
            theDiv.appendChild(list);
            data.forEach(elt => {
                console.log(elt.login);
                var li = document.createElement('li');
                //li.setAttribute('class','item');
                li.innerHTML=li.innerHTML + elt.login;
                list.appendChild(li);

                
                
                

            });
        });
    </script>-->
</body>
</html>