function ajaxRequest(url, method, param, callback){
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            // console.log(xhr.responseText);
            callback(JSON.parse(xhr.responseText));
            // callback(xhr.responseText);
            // console.log(xhr.responseText);
        }
    }

    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-type', 'application/json')
    xhr.send(JSON.stringify(param));
}