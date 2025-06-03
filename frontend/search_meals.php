<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm món ăn - NutriPlanner</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.7.2-web/css/all.min.css">
    <style>
        /* CSS Search */

        .section-header {
            text-align: center;
        }

        .section-header h2 {
            font-size: 2.5rem;
            position: relative;
            margin-bottom: 15px;
        }

        .section-header h2::after {
            content: "";
            position: absolute;
            background: var(--primary);
            width: 50px;
            height: 3px;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 5px;
        }

        .section-header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .search-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 12px 20px;
            flex-grow: 1;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 2px rgba(46, 204, 113, 0.5);
        }

        .search-btn {
            padding: 12px 20px;
            border-radius: 50px;
            background: var(--primary);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            font-family: "Poppins", sans-serif;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-btn:hover {
            background: var(--primary-dark);
        }

        .filter {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 180px;
        }

        .filter-title {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: "Poppins", sans-serif;
            outline: none;
            background-color: #fff;
            transition: all 0.3s ease;
            font-size: 0.813rem;
        }

        .filter-select:focus {
            border-color: var(--primary);
        }

        .meal-tabs {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .tab-btn {
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 500;
            background: var(--bg-light);
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-family: "Poppins", sans-serif;
        }

        .tab-btn.active {
            background: var(--primary);
            color: #fff;
        }

        .meal-card {
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(0, 0, 0, 0.08);
            background: #fff;
            overflow: hidden;
            margin: 16px 0;
            transition: box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            position: relative;
            min-width: 320px;
            max-width: 350px;
        }

        .meal-card .meal-image-wrapper {
            position: relative;
            width: 100%;
            height: 180px;
            overflow: hidden;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }

        .meal-card .meal-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .meal-card .favorite-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            background: #fff;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
            color: #e74c3c;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 2;
            transition: background 0.2s;
        }

        .meal-card .favorite-btn:hover {
            background: #ffeaea;
        }

        .meal-content {
            padding: 18px 18px 14px 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .meal-header {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meal-checkbox {
            accent-color: #2ecc71;
            width: 18px;
            height: 18px;
        }

        .meal-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .meal-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }

        .meal-tag {
            background: #f3f6fa;
            color: #2ecc71;
            border-radius: 12px;
            padding: 2px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: lowercase;
            letter-spacing: 0.5px;
            border: none;
            display: inline-block;
        }

        .meal-tag:nth-child(2) {
            color: #3498db;
            background: #eaf6fb;
        }

        .meal-tag:nth-child(3) {
            color: #9b59b6;
            background: #f5eafd;
        }

        .meal-tag:nth-child(4) {
            color: #e67e22;
            background: #fdf3e6;
        }

        .meal-stats {
            display: flex;
            gap: 18px;
            margin-top: 8px;
        }

        .meal-stat {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #2ecc71;
            font-size: 1rem;
            font-weight: 500;
        }

        .meal-stat i {
            font-size: 1.1em;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <div class="section-header">
                <h2>Discover the Menu</h2>
                <p>Search and filter hundreds of recipes that match your nutritional goals and taste preferences.</p>
            </div>
            <div class="meal-filter">
                <form id="searchForm" method="GET" action="../backend/search.php">
                    <div class="search-container">
                        <input type="text" class="search-input" name="search_query" placeholder="Search for dishes or ingredients...">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                            Search
                        </button>
                    </div>
                    <div class="filter">
                        <div class="filter-group">
                            <label class="filter-title">Meal Type</label>
                            <select class="filter-select" name="meal_type">
                                <option value="all">All</option>
                                <option value="1">Breakfast</option>
                                <option value="2">Lunch</option>
                                <option value="3">Dinner</option>
                                <option value="4">Snacks</option>
                                <option value="5">Drinks</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-title">Diet Type</label>
                            <select class="filter-select" name="diet_type">
                                <option value="all">All</option>
                                <option value="1">Vegan</option>
                                <option value="2">Vegetarian</option>
                                <option value="3">Keto</option>
                                <option value="4">Paleo</option>
                                <option value="5">Low Carb</option>
                                <option value="6">High Protein</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-title">Calories</label>
                            <select class="filter-select" name="calories">
                                <option value="all">All</option>
                                <option value="under300">Under 300 kcal</option>
                                <option value="300-500">300 - 500 kcal</option>
                                <option value="500-800">500 - 800 kcal</option>
                                <option value="over800">Over 800 kcal</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="meal-tabs">
                <button class="tab-btn active" data-type="all">All</button>
                <button class="tab-btn" data-type="breakfast">Breakfast</button>
                <button class="tab-btn" data-type="lunch">Lunch</button>
                <button class="tab-btn" data-type="dinner">Dinner</button>
                <button class="tab-btn" data-type="snack">Snacks</button>
                <button class="tab-btn" data-type="smoothie">Drinks</button>
            </div>
            <div class="meals-grid" id="meals-grid"></div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý sự kiện khi trang web đã load xong
            const tabbutton = document.querySelectorAll('.tab-btn');
            // Thêm sự kiện click cho từng nút
            tabbutton.forEach(button => {
                button.addEventListener('click', () => {
                    tabbutton.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });

            // Xử lý sự kiện submit form tìm kiếm
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const params = new URLSearchParams(formData);
                fetch('../backend/search.php?' + params.toString())
                    .then(response => response.json())
                    .then(response => {
                        const resultsDiv = document.getElementById('meals-grid');
                        if (!resultsDiv) {
                            console.error('Không tìm thấy phần tử #meals-grid');
                            return;
                        }
                        resultsDiv.innerHTML = '';
                        if (!response.data || response.data.length === 0) {
                            resultsDiv.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 50px 0;"><i class="fas fa-search" style="font-size: 3rem; color: #ddd; margin-bottom: 20px;"></i><h3>Không tìm thấy món ăn nào phù hợp</h3><p>Vui lòng thử lại với các bộ lọc khác</p></div>';
                            return;
                        }
                        response.data.forEach(meal => {
                            const tagsHTML = meal.diet_tags ? meal.diet_tags.map(tag => `<span class="meal-tag">${tag.trim()}</span>`).join(' ') : '';
                            const imgSrc = meal.image || '../assets/images/no-image.png';
                            const fullImgSrc = imgSrc.startsWith('http://') || imgSrc.startsWith('https://') ? imgSrc : ('../' + imgSrc.replace(/^\/+/, ''));
                            const card = `
                                <div class="meal-card shadow">
                                    <div class="meal-image-wrapper">
                                        <img src="${fullImgSrc}" alt="${meal.name}" class="meal-img">
                                        <button class="favorite-btn" data-id="${meal.id}">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                    <div class="meal-content">
                                        <div class="meal-header">
                                            <input type="checkbox" class="meal-checkbox" />
                                            <h3 class="meal-title">${meal.name}</h3>
                                        </div>
                                        <div class="meal-tags">
                                            ${tagsHTML}
                                        </div>
                                        <div class="meal-stats">
                                            <div class="meal-stat">
                                                <i class="fas fa-fire"></i>
                                                ${meal.calories || 'Chưa có'} kcal
                                            </div>
                                            <div class="meal-stat">
                                                <i class="fas fa-stopwatch"></i>
                                                ${meal.prep_time || 'Chưa có'} phút
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            resultsDiv.insertAdjacentHTML('beforeend', card);
                        });
                    })
                    .catch(err => {
                        console.error('Lỗi khi gọi API tìm kiếm:', err);
                    });
            });

            // Khi trang vừa load, fetch toàn bộ món ăn
            fetch('../backend/search.php')
                .then(response => response.json())
                .then(response => {
                    const resultsDiv = document.getElementById('meals-grid');
                    if (!resultsDiv) {
                        console.error('Không tìm thấy phần tử #meals-grid');
                        return;
                    }
                    resultsDiv.innerHTML = '';
                    if (!response.data || response.data.length === 0) {
                        resultsDiv.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 50px 0;"><i class="fas fa-search" style="font-size: 3rem; color: #ddd; margin-bottom: 20px;"></i><h3>Không tìm thấy món ăn nào phù hợp</h3><p>Vui lòng thử lại với các bộ lọc khác</p></div>';
                        return;
                    }
                    response.data.forEach(meal => {
                        const tagsHTML = meal.diet_tags ? meal.diet_tags.map(tag => `<span class="meal-tag">${tag.trim()}</span>`).join(' ') : '';
                        const imgSrc = meal.image || '../assets/images/no-image.png';
                        const fullImgSrc = imgSrc.startsWith('http://') || imgSrc.startsWith('https://') ? imgSrc : ('../' + imgSrc.replace(/^\/+/, ''));
                        const card = `
                            <div class="meal-card shadow">
                                <div class="meal-image-wrapper">
                                    <img src="${fullImgSrc}" alt="${meal.name}" class="meal-img">
                                    <button class="favorite-btn" data-id="${meal.id}">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                                <div class="meal-content">
                                    <div class="meal-header">
                                        <input type="checkbox" class="meal-checkbox" />
                                        <h3 class="meal-title">${meal.name}</h3>
                                    </div>
                                    <div class="meal-tags">
                                        ${tagsHTML}
                                    </div>
                                    <div class="meal-stats">
                                        <div class="meal-stat">
                                            <i class="fas fa-fire"></i>
                                            ${meal.calories || 'Chưa có'} kcal
                                        </div>
                                        <div class="meal-stat">
                                            <i class="fas fa-stopwatch"></i>
                                            ${meal.prep_time || 'Chưa có'} phút
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        resultsDiv.insertAdjacentHTML('beforeend', card);
                    });
                });
        });
    </script>
</body>

</html>