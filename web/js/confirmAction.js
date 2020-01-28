function XXX()
{
let d = new Date();
alert(d.getTime());
}

function confirmDeleteUser(id, url) {
    let is_confirmed = confirm('Вы действительно хотите грохнуть юзера '+id+' со всеми адресами?');
    //console.log(is_confirmed);
    if (is_confirmed) {
        $.ajax({
            type: "POST",
            url: url,
            data: {del_obj: 'user', id: id}
        }).done(function (result) {
            console.log(result);
            let h = window.location.href;
            window.location.href = h;
        });
    } else {
        console.log('Not confirmed');
    }
}

function confirmDeleteAddress(id, url) {
    let is_confirmed = confirm('Вы действительно хотите грохнуть адрес '+id+'?');
    //console.log(is_confirmed);
    if (is_confirmed) {
        $.ajax({
            type: "POST",
            url: url,
            data: {del_obj: 'address', id: id}
        }).done(function (result) {
            console.log(result);
            let h = window.location.href;
            window.location.href = h;
        });
    } else {
        console.log('Not confirmed');
    }
}

function delLastAddress() {
    alert("Единственный адрес удалить нельзя т.к. у пользователя должен быть минимум один адрес.");
}