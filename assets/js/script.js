function ajaxRequest(url, method, callback){
    let xhr = new XMLHttpRequest();
    let data = 'test';
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            callback(xhr.responseText);
        }
    }

    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-type', 'application/json')
    xhr.send(JSON.stringify(data));
}