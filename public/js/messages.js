$(document).on('click', '.channel', function () {
   //alert('test');
   this.classList.remove("active");

   var participant = $('#'+this.id+' #hiddenName').val();
   var initials = participant.match(/\b\w/g) || [];
   initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();
   $('.chat-header .d-flex .avatar').text(initials);
   $('.chat-header .d-flex div h6').text(participant);
   $('.chat-header .d-flex div p').text($('#'+this.id+' #hiddenEmail').val());
   //alert(this.id);
   var body = document.getElementById("chat-body");
   body.innerHTML = "";
   axios.post('/api/messages/' + user_id+'/'+this.id).then(resp => {
      //console.log(resp.data);

      messages = resp.data;
      //console.log(conversations["163"]);
      var i=0;
      for (var key in messages) {
          i++;
         var dflex = document.createElement('div');
         dflex.setAttribute('class', 'd-flex align-items-end mb-5');  
         dflex.setAttribute('id', key);

         var avatar = document.createElement('span');
         avatar.setAttribute('class', 'avatar avatar-sm mr-3 bg-info rounded-circle');
         var senderName = messages[key].sender.name;
         var initials = senderName.match(/\b\w/g) || [];
         initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();
         avatar.innerHTML = initials;

         var div = document.createElement('div');

         var card = document.createElement('div');
         card.setAttribute('class', 'card mb-3');

         var content = document.createElement('p');
         content.innerHTML = messages[key].body;
            if( i == Object.keys(messages).length){
               content.setAttribute('id','last');
            }

         var diff = document.createElement('p');
         diff.setAttribute('class', 'lh-100');
         diff.innerHTML = messages[key].diff;

         if (messages[key].is_sender == 1) {
             dflex.setAttribute('class', 'd-flex align-items-end justify-content-end mb-5');
             avatar.setAttribute('class', 'avatar avatar-sm order-2 ml-3 bg-primary rounded-circle');
             div.setAttribute('class', 'order-1');
             card.setAttribute('class', 'card mb-3 text-white bg-primary');
             diff.setAttribute('class', 'lh-100 text-right');
         }

         card.appendChild(content);

         div.appendChild(card);
         div.appendChild(diff);

         dflex.appendChild(avatar);
         dflex.appendChild(div);

         body.appendChild(dflex);

        
         window.location.href = "#last";
      }
   });
   axios.post('/api/read/' + user_id + '/' + this.id).then(resp => {
      //console.log('readed');
   });
    window.location.href = "#last";
    setTimeout(anchor, 500);
});

function anchor() {
   window.location.href = "#last"
}