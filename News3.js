const newsContainer = document.getElementById('newsContainer');
const searchInput = document.getElementById('searchInput');
const searchButton = document.getElementById('searchButton');

// Масив з прикладами новин
const newsData = [
    { title: 'New Game Announcement', content: 'Exciting news about a new game coming soon. #Games #NewRelease', image: 'KK.jpg', date: '2024-05-01' },
    { title: 'Game Update Released', content: 'Learn about the latest features in the game update. #Games #Update', image: 'nyan.gif', date: '2024-05-02' },
    { title: 'Interview with Game Developer', content: 'Insights from the developer about the game development process. #Games #Interview', image: 'nyan.gif', date: '2024-05-03' },
    { title: 'New Game Announcement', content: 'Exciting news about a new game coming soon. #Games #NewRelease', image: 'nyan.gif', date: '2024-05-01' },
    { title: 'Game Update Released', content: 'Learn about the latest features in the game update. #Games #Update', image: 'nyan.gif', date: '2024-05-02' },
    { title: 'Interview with Game Developer', content: 'Insights from the developer about the game development process. #Games #Interview', image: 'nyan.gif', date: '2024-05-03' },
    { title: 'New Game Announcement', content: 'Exciting news about a new game coming soon. #Games #NewRelease', image: 'nyan.gif', date: '2024-05-01' },
    { title: 'Game Update Released', content: 'Learn about the latest features in the game update. #Games #Update', image: 'nyan.gif', date: '2024-05-02' },
    { title: 'Interview with Game Developer', content: 'Insights from the developer about the game development process. #Games #Interview', image: 'nyan.gif', date: '2024-05-03' },

];

// Функція для відображення новин
function displayNews(newsItems) {
    newsContainer.innerHTML = '';
    newsItems.forEach((news) => {
        const newsItem = document.createElement('div');
        newsItem.classList.add('news-item');
        newsItem.innerHTML = `
            <img src="${news.image}" alt="${news.title}">
            <div class="content">
                <h3>${news.title}</h3>
                <p>${news.content}</p>
                <p class="date">${news.date}</p>
            </div>
        `;
        newsContainer.appendChild(newsItem);

        newsItem.addEventListener('click', toggleNewsSize);
    });
}

// Функція для пошуку новин за заголовком
function searchNews() {
    const searchTerm = searchInput.value.toLowerCase();
    const filteredNews = newsData.filter((news) => {
        return news.title.toLowerCase().includes(searchTerm);
    });
    displayNews(filteredNews);
}

// Функція для фільтрації новин за датою
function filterNewsByDate() {
    const yearInput = document.getElementById('yearInput').value;
    const monthInput = document.getElementById('monthInput').value - 1; // Місяці в JavaScript відраховуються від 0
    const dayInput = document.getElementById('dayInput').value;

    const filteredNews = newsData.filter((news) => {
        const newsDate = new Date(news.date);
        const inputDate = new Date(yearInput, monthInput, dayInput);
        return newsDate.toDateString() === inputDate.toDateString();
    });

    displayNews(filteredNews);
}

// Відображення всіх новин при завантаженні сторінки
displayNews(newsData);

// Подія для кнопки пошуку новин
searchButton.addEventListener('click', searchNews);

// Подія для кнопки "Apply" фільтру за датою
document.getElementById('applyDateFilter').addEventListener('click', filterNewsByDate);

// Функція для зміни розміру блоку новини при кліку
function toggleNewsSize(event) {
    const newsItem = event.currentTarget;
    const expandedClass = 'expanded';

    if (newsItem.classList.contains(expandedClass)) {
        newsItem.classList.remove(expandedClass);
    } else {
        const allNewsItems = document.querySelectorAll('.news-item');
        allNewsItems.forEach(item => item.classList.remove(expandedClass));
        newsItem.classList.add(expandedClass);
    }
}
// Функція для пошуку новин за заголовком або хештегом
function searchNews() {
    const searchTerm = searchInput.value.toLowerCase();
    const filteredNews = newsData.filter((news) => {
        const newsContent = news.title.toLowerCase() + ' ' + news.content.toLowerCase();
        // Перевіряємо, чи searchTerm є хештегом
        const isHashtag = searchTerm.startsWith('#');
        if (isHashtag) {
            // Якщо searchTerm є хештегом, фільтруємо новини за хештегом
            return newsContent.includes(searchTerm);
        } else {
            // Якщо searchTerm не є хештегом, фільтруємо новини за заголовком
            return news.title.toLowerCase().includes(searchTerm);
        }
    });
    displayNews(filteredNews);
}

// Прив'язуємо обробник події до події "input" для поля введення
searchInput.addEventListener('input', searchNews);