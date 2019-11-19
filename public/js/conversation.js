function updateConversation() {
    
    var direct = document.getElementById('direct');
    direct.innerHTML = "";
    axios.post('/api/conversations/' + user_id).then(resp => {
        //console.log(resp.data);
        conversations = resp.data;
        //console.log(typeof conversations);
        //conversations.sort();
        var newA = Array();
        for (var key in conversations) {
            newA[key] = conversations[key];
        }
        //console.log(typeof newA);
        newA.sort((a, b) => b.conversation.updated_at.localeCompare(a.conversation.updated_at));
        //console.log(newA);
        conversations = newA;
        //console.log(conversations);
        for (var key in conversations) {
            //console.log("key " + key );
            var participant = conversations[key].participants[0].name;
            var initials = participant.match(/\b\w/g) || [];
            initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();

            var channel = document.createElement('div');
            channel.setAttribute('class', 'channel');
            channel.setAttribute('id', conversations[key].conversation.id);

            var avatar = document.createElement('span');
            avatar.setAttribute('class', 'avatar avatar-sm status status-online mr-3 bg-primary rounded-circle');
            avatar.innerHTML = initials;

            var flex_grow = document.createElement('div');
            flex_grow.setAttribute('class', 'flex-grow-1');
            var d_flex = document.createElement('div');
            d_flex.setAttribute('class', 'd-flex align-items-center mb-3');

            var name = document.createElement('h6');
            name.setAttribute('class', 'mr-auto');
            name.innerHTML = participant;

            var diff = document.createElement('p');
            diff.setAttribute('class', 'ml-3');
            diff.innerHTML = conversations[key].conversation.diff;

            var last_message = document.createElement('p');
            last_message.setAttribute('class', 'text');
            last_message.innerHTML = conversations[key].conversation.last_message.body;

            var hiddenName = document.createElement('input');
            hiddenName.setAttribute('type', 'hidden');
            hiddenName.setAttribute('id', 'hiddenName');
            hiddenName.value = participant;

            var hiddenEmail = document.createElement('input');
            hiddenEmail.setAttribute('type', 'hidden');
            hiddenEmail.setAttribute('id', 'hiddenEmail');
            hiddenEmail.value = conversations[key].participants[0].email;

            d_flex.appendChild(name);
            d_flex.appendChild(diff);

            flex_grow.appendChild(d_flex);
            flex_grow.appendChild(last_message);

            channel.appendChild(avatar);
            channel.appendChild(flex_grow);
            channel.appendChild(hiddenName);
            channel.appendChild(hiddenEmail);

            if (conversations[key].conversation.last_message.is_seen == 0) {
                channel.classList.add("active");
            }
            direct.append(channel);
        }
        //console.log(conversations["163"].conversation.last_message.body);
    });
}
