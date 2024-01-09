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

// document.querySelector('button').addEventListener(
//     'click',
//     function(e){
//         e.preventDefault();
//         getData();
//         // blindtest();
//     },
//     false
// )

// function getData(){
    let buttons = document.querySelectorAll('[data-params]');

    buttons.forEach(function(button){
        button.addEventListener('click', function(e){
            let data = button.getAttribute('data-params');
            console.log(data);
            e.preventDefault();

            // console.log(data);
            // blindtest(data);
        })
    })
// }

function blindtest(){
    let currentURL = window.location.href;
    let absoluteRootPath = currentURL.substring(0, currentURL.lastIndexOf("/") + 1);
    let url = absoluteRootPath + 'blindtestApi.php';


    ajaxRequest(url, 'POST', function(response){
        console.log(response);
    })
}

function timer(){

}

function skip(){

}

function getResponse(){

}

function pauseMusic(){

}