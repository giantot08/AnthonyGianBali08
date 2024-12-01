// Clock functionality
function updateClock() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const seconds = now.getSeconds();
    const timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    document.getElementById('clock').innerText = timeString;

    // Greeting based on time of day
    let greeting;
    if (hours < 12) {
        greeting = "Good Morning!";
    } else if (hours < 18) {
        greeting = "Good Afternoon!";
    } else {
        greeting = "Good Evening!";
    }
    document.getElementById('greeting').innerText = greeting;
}

// Counter functionality
let counter = 0;
document.getElementById('counterButton').addEventListener('click', () => {
    counter++;
    document.getElementById('counterDisplay').innerText = counter;
});

// Theme toggle functionality
const themeToggle = document.getElementById('themeToggle');
themeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme');
});

// Random Quote functionality
const quotes = [
    "The only way to do great work is to love what you do. - Steve Jobs",
    "Life is what happens when you're busy making other plans. - John Lennon",
    "The purpose of our lives is to be happy. - Dalai Lama",
    "Get busy living or get busy dying. - Stephen King",
];

document.getElementById('quoteButton').addEventListener('click', () => {
    const randomIndex = Math.floor(Math.random() * quotes.length);
    document.getElementById('quoteDisplay').innerText = quotes[randomIndex];
});

// To-Do List functionality
const todoInput = document.getElementById('todoInput');
const todoButton = document.getElementById('todoButton');
const todoList = document.getElementById('todoList');

todoButton.addEventListener('click', () => {
    const task = todoInput.value;
    if (task) {
        const listItem = document.createElement('li');
        listItem.innerText = task;
        listItem.classList.add('list-group-item');
        listItem.addEventListener('click', () => {
            listItem.remove();
        });
        todoList.appendChild(listItem);
        todoInput.value = '';
    }
});

// Initialize clock
setInterval(updateClock, 1000);
updateClock();