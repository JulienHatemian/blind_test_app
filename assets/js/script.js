function ajaxRequest(url, method, param = null, callback){
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            callback(JSON.parse(xhr.responseText));
        }
    }

    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-type', 'application/json')
    if(param != null){
        xhr.send(JSON.stringify(param));
    }else{
        xhr.send();
    }
}