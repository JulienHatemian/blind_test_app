function ajaxRequest(url, method, callback){
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            callback(xhr.responseText);
        }
    }

    xhr.open(method, url, true);
    xhr.send();
}

function blindtest(){

}

function timer(){

}

function skip(){

}

function getResponse(){

}

function pauseMusic(){

}