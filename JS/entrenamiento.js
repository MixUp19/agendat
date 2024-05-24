let currentIndex = 0;
const items = document.querySelectorAll('.ejercicio');
const nextButton = document.getElementById('next-button');
const finishButton = document.getElementById('finish-button');
const ejerciciosList = document.querySelector('.ejercicios-list');
const totalTimer = document.getElementById('total-timer');
let totalSeconds = 0;
let interval;


finishButton.addEventListener('click', function() {

    const totalMinutes = Math.floor(totalSeconds / 60);
    const urlParams = new URLSearchParams(window.location.search);
    const entrenamientoId = urlParams.get('id');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'PHP/terminarEntrenamiento.php');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
        } else {
            console.error('Error al actualizar el entrenamiento');
        }
    };
    xhr.send(JSON.stringify({ totalTime: totalMinutes, entrenamientoId: entrenamientoId }));
});

function parseTimeString(timeString) {
    const [hours, minutes, seconds] = timeString.split(':').map(Number);
    return (hours * 3600) + (minutes * 60) + seconds;
}

function updateTotalTimer() {
    totalSeconds++;
    const hours = Math.floor(totalSeconds / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;
    totalTimer.textContent = `Total: ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

function startExerciseTimer(duration) {
    let timer = duration;
    const display = document.getElementById('exercise-timer');
    display.textContent = formatTime(timer);
    interval = setInterval(function () {
        if (--timer < 0) {
            currentIndex++;
            clearInterval(interval);
            nextButton.disabled = false;
            nextButton.classList.add('enabled');
            if(currentIndex===items.length){
                finishButton.disabled = false;
                finishButton.classList.add('enabled');
            }
        } else {
            display.textContent = formatTime(timer);
        }
    }, 1000);
}

function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const sec = seconds % 60;
    return `${minutes.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`;
}

function scrollToNext() {
    // Pausar el video del ejercicio actual
    const currentVideo = items[currentIndex-1].querySelector('video');
    if (currentVideo) {
        currentVideo.pause();
    }
    
    if (currentIndex < items.length) {
        const offset = items[currentIndex].offsetLeft;
        ejerciciosList.style.transform = `translateX(-${offset}px)`;
        nextButton.disabled = true;
        nextButton.classList.remove('enabled');
        const nextItem = items[currentIndex];
        const tiempo = parseTimeString(nextItem.dataset.tiempo);
        startExerciseTimer(tiempo);
    }
}

nextButton.addEventListener('click', function () {
    if (!nextButton.disabled) {
        scrollToNext();
    }
});

finishButton.addEventListener('click', function () {
    if (!finishButton.disabled) {
        clearInterval(interval);
        showModal();
    }
});

function showModal() {
    const modal = document.getElementById('modal');
    const totalTime = document.getElementById('total-time');
    totalTime.textContent = totalTimer.textContent;
    modal.style.display = 'block';
}

document.getElementById('close-modal').addEventListener('click', function () {
    window.history.back();
});

window.onload = function () {
    const firstItem = items[currentIndex];
    const tiempo = parseTimeString(firstItem.dataset.tiempo);
    startExerciseTimer(tiempo);
    setInterval(updateTotalTimer, 1000);
};