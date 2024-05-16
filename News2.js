const newsContainer = document.getElementById('newsContainer');
const searchInput = document.getElementById('searchInput');
const searchButton = document.getElementById('searchButton');

// ����� � ���������� �����
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

// ������� ��� ����������� �����
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

// ������� ��� ������ ����� �� ����������
function searchNews() {
    const searchTerm = searchInput.value.toLowerCase();
    const filteredNews = newsData.filter((news) => {
        return news.title.toLowerCase().includes(searchTerm);
    });
    displayNews(filteredNews);
}

// ������� ��� ���������� ����� �� �����
function filterNewsByDate() {
    const yearInput = document.getElementById('yearInput').value;
    const monthInput = document.getElementById('monthInput').value - 1; // ̳���� � JavaScript ������������� �� 0
    const dayInput = document.getElementById('dayInput').value;

    const filteredNews = newsData.filter((news) => {
        const newsDate = new Date(news.date);
        const inputDate = new Date(yearInput, monthInput, dayInput);
        return newsDate.toDateString() === inputDate.toDateString();
    });

    displayNews(filteredNews);
}

// ³���������� ��� ����� ��� ����������� �������
displayNews(newsData);

// ���� ��� ������ ������ �����
searchButton.addEventListener('click', searchNews);

// ���� ��� ������ "Apply" ������� �� �����
document.getElementById('applyDateFilter').addEventListener('click', filterNewsByDate);

// ������� ��� ���� ������ ����� ������ ��� ����
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
// ������� ��� ������ ����� �� ���������� ��� ��������
function searchNews() {
    const searchTerm = searchInput.value.toLowerCase();
    const filteredNews = newsData.filter((news) => {
        const newsContent = news.title.toLowerCase() + ' ' + news.content.toLowerCase();
        // ����������, �� searchTerm � ��������
        const isHashtag = searchTerm.startsWith('#');
        if (isHashtag) {
            // ���� searchTerm � ��������, ��������� ������ �� ��������
            return newsContent.includes(searchTerm);
        } else {
            // ���� searchTerm �� � ��������, ��������� ������ �� ����������
            return news.title.toLowerCase().includes(searchTerm);
        }
    });
    displayNews(filteredNews);
}

// ����'����� �������� ��䳿 �� ��䳿 "input" ��� ���� ��������
searchInput.addEventListener('input', searchNews);