const currentURL = window.location.href;
const absoluteRootPath = currentURL.substring(0, currentURL.lastIndexOf("/") + 1);
let interval;
let audioPlayer;
let isPlaying = false;
let player;

document.addEventListener('DOMContentLoaded', function(){
    let buttons = document.querySelectorAll('[data-params]');

    buttons.forEach(function(button){
        button.addEventListener('click', function(e){
            let obj = {};
            let timer = document.getElementById('timer');
            let timeleft = parseInt(timer.innerHTML);
    
            obj['dataParams'] = button.getAttribute('data-params');
            obj['timeleft'] = timeleft;
            e.preventDefault();
    
            if(obj.dataParams != 'quit'){
                blindtestOptions(obj);
            }else{
                let confirmation = window.confirm('Are you sure you want to quit ? You will have to generate a new blindtest.')
                if(confirmation){
                    blindtestOptions(obj);
                }
            }
        })
    })

    let h1 = document.querySelector('h1');

    h1.addEventListener('click', function(e){
        let confirmation = window.confirm('Are you sure you want to quit ? You will have to generate a new blindtest.')

        if(confirmation){
            window.location.href = absoluteRootPath + 'homepage';
        }else{
            e.preventDefault();
        }
    })
})

function blindtestOptions(param){
    let url = absoluteRootPath + 'blindtestApi.php';
    let timer = document.getElementById('timer');

    ajaxRequest(url, 'POST', param, function(response){
        if(response.disconnected === true){
            window.location.href = absoluteRootPath + 'gameconfig';
        }
        console.log(response);
        if(response.success === true){
            switch(response.input){
                case 'start':
                    if(response.audio && isPlaying === false){
                        timer.innerHTML = response.timeleft;
                        isPlaying = true;
                        startTimer();
                        playAudio(response.audio);
                    }
                    break;
                case 'play':
                    if(response.audio && isPlaying === false){
                        timer.innerHTML = response.timeleft;
                        isPlaying = true;
                        startTimer();
                        playAudio(response.audio);
                    }
                    break;
                case 'restart':
                    timer.innerHTML = response.timeleft;
                    pauseTimer();
                    break;
                // case 'pause':
                //     if(response.audio && isPlaying === true){
                //         timer.innerHTML = response.timeleft;
                //         pauseTimer();
                //         // player;
                //         playAudio(response.audio);
                //         isPlaying = false;
                //     }    
                //     break;
                case 'result':
                    if(response.data){
                        showResult(response.data);
                        // console.log(response.data);
                    }
                    break;
                case 'endtimer':
                    timer.innerHTML = response.timeleft;
                    break;
                default:
                    console.log('Wrong input');
            }
        }
    })
}

function showResult(data){
    let main = document.getElementById('mainContent');
    let round = document.getElementById('round');
    let result = document.getElementById('resultContainer');

    if(!result){
        let resultContainer = document.createElement('div');
        resultContainer.id = 'resultContainer';

        if(data.title){
            let title = document.createElement('p');
            let span = document.createElement('span');
            title.id = 'title';

            span.classList.add('resultElement');
            span.textContent = 'Title:';
            
            title.appendChild(span);
            title.appendChild(document.createTextNode(' ' + data.title));

            resultContainer.appendChild(title);
        }

        if(data.group){
            let group = document.createElement('p');
            let span = document.createElement('span');
            group.id = 'year';
            
            span.classList.add('resultElement');
            span.textContent = 'Group:';
            
            group.appendChild(span);
            group.appendChild(document.createTextNode(' ' + data.group));

            resultContainer.appendChild(group);
        }

        if(data.year){
            let year = document.createElement('p');
            let span = document.createElement('span');
            year.id = 'year';
            
            span.classList.add('resultElement');
            span.textContent = 'Year:';
            
            year.appendChild(span);
            year.appendChild(document.createTextNode(' ' + data.year));

            resultContainer.appendChild(year);
        }

        if(data.number){
            let number = document.createElement('p');
            let span = document.createElement('span');
            number.id = 'season';
            
            span.classList.add('resultElement');
            span.textContent = 'Season:';
            
            number.appendChild(span);
            number.appendChild(document.createTextNode(' ' + data.number));

            resultContainer.appendChild(number);
        }

        if(data.studio){
            let studio = document.createElement('p');
            let span = document.createElement('span');
            studio.id = 'studio';
            
            span.classList.add('resultElement');
            span.textContent = 'Studio:';
            
            studio.appendChild(span);
            studio.appendChild(document.createTextNode(' ' + data.studio));

            resultContainer.appendChild(studio);
        }

        main.insertBefore(resultContainer, round);

        if(data.link){
            insertVisualResult(data.link);
        }
    }
}

function startTimer(){
    let timer = document.getElementById('timer');

    if(!interval){
        timeleft = parseInt(timer.innerHTML);

        if(timeleft > 0){
            interval = setInterval(() => {
                timeleft--
                timer.textContent = timeleft;
                if(timeleft == 0){
                    let obj = {};
                    let timer = document.getElementById('timer');
                    let timeleft = parseInt(timer.innerHTML);

                    obj['dataParams'] = 'endtimer';
                    obj['timeleft'] = timeleft;

                    blindtestOptions(obj);
                    clearInterval(interval);
                    interval = null;
                }
            }, 1000);
        }
    }
}

// function pauseTimer(){
//     if(interval){
//         clearInterval(interval);
//         interval = null;
//     }
// }

function playAudio(param){
    let player = new Audio();
    player.volume = 0.3;
        
    player.addEventListener('canplaythrough', function(){
        isPlaying = true;
        player.play();
    })

    player.addEventListener('ended', function(){
        isPlaying = false
        player.pause();
    });

    player.currentTime = param.start;
    let endPlay = param.start + param.duration;
    player.src = absoluteRootPath + param.official_link;

    player.addEventListener('timeupdate', function(){
        if(player.currentTime >= endPlay){
            isPlaying = false
            player.pause();
        }
    })
}