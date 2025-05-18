<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm món ăn - NutriPlanner</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.7.2-web/css/all.min.css">
</head>

<body>
    <section>
        <div class="container">
            <div class="section-header">
                <h2>Khám phá thực đơn</h2>
                <p>Tìm kiếm và lọc hàng trăm công thức phù hợp với mục tiêu dinh dưỡng và khẩu vị của bạn.</p>
            </div>
            <div class="meal-filter">
                <form id="searchForm" method="GET" action="../backend/search.php">
                    <div class="search-container">
                        <input type="text" class="search-input" name="search_query" placeholder="Tìm kiếm món ăn hoặc nguyên liệu...">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                            Tìm kiếm
                        </button>
                    </div>
                    <div class="filter">
                        <div class="filter-group">
                            <label class="filter-title">Loại món</label>
                            <select class="filter-select" name="meal_type">
                                <option value="all">Tất cả</option>
                                <option value="breakfast">Bữa Sáng</option>
                                <option value="lunch">Bữa Trưa</option>
                                <option value="dinner">Bữa Tối</option>
                                <option value="snack">Đồ ăn nhẹ</option>
                                <option value="smoothie">Đồ uống</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-title">Chế độ ăn</label>
                            <select class="filter-select" name="diet_type">
                                <option value="all">Tất cả</option>
                                <option value="vegan">Chay (Vegan)</option>
                                <option value="vegetarian">Chay (Vegetarian)</option>
                                <option value="keto">Keto</option>
                                <option value="paleo">Paleo</option>
                                <option value="lowcarb">Low Carb</option>
                                <option value="highprotein">High Protein</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-title">Calories</label>
                            <select class="filter-select" name="calories">
                                <option value="all">Tất cả</option>
                                <option value="under200">Dưới 200 kcal</option>
                                <option value="200-400">200 - 400 kcal</option>
                                <option value="400-600">400 - 600 kcal</option>
                                <option value="over600">Trên 600 kcal</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="meal-tabs">
                <button class="tab-btn active" data-type="all">Tất cả</button>
                <button class="tab-btn" data-type="breakfast">Bữa Sáng</button>
                <button class="tab-btn" data-type="lunch">Bữa Trưa</button>
                <button class="tab-btn" data-type="dinner">Bữa Tối</button>
                <button class="tab-btn" data-type="snack">Đồ ăn nhẹ</button>
                <button class="tab-btn" data-type="smoothie">Đồ uống</button>
            </div>
            <div class="meals-grid" id="meals-grid"></div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabbutton = document.querySelectorAll('.tab-btn');

            tabbutton.forEach(button => {
                button.addEventListener('click', () => {
                    tabbutton.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });
        });
    </script>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const params = new URLSearchParams(formData);

            fetch('../backend/search.php?' + params.toString())

                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('meals-grid');
                    resultsDiv.innerHTML = '';
                    if (data.length === 0) {
                        resultsDiv.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 50px 0;"><i class="fas fa-search" style="font-size: 3rem; color: #ddd; margin-bottom: 20px;"></i><h3>Không tìm thấy món ăn nào phù hợp</h3><p>Vui lòng thử lại với các bộ lọc khác</p></div>';
                    }

                    data.forEach(meal => {

                        const tagsArray = meal.tags ? meal.tags.split(',') : [];
                        const tagsHTML = tagsArray.map(tag => `<span class="meal-tag">${tag.trim()}</span>`).join(' ');

                        const imgSrc = meal.image || meal.image_url || '../assets/images/no-image.png';

                        // Kiểm tra nếu imgSrc bắt đầu bằng http hoặc https thì dùng thẳng URL đó,  
                        // còn không thì coi là đường dẫn local (file trên server), có thể thêm prefix nếu cần.

                        const fullImgSrc = imgSrc.startsWith('http://') || imgSrc.startsWith('https://') ?
                            imgSrc :
                            ('../' + imgSrc.replace(/^\/+/, '')); // Loại bỏ dấu / đầu nếu có rồi nối prefix
                        const card = `
                       <div class="meal-card">
        <div class="meal-image">
              <img src="${fullImgSrc}" alt="${meal.name}">
            <button class="favorite-btn active" data-id="${meal.id}">
                <i class="fas fa-heart"></i>
            </button>
        </div>
        <div class="meal-content">
            <div class="meal-tags">
               ${tagsHTML}
            </div>
            <h3>${meal.name}</h3>
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
                        // Thêm đoạn HTML vừa tạo vào trong div kết quả, chèn vào cuối nội dung hiện có
                        resultsDiv.insertAdjacentHTML('beforeend', card);
                    })
                })
                .catch(err => {
                    console.error('Lỗi khi gọi API tìm kiếm:', err);
                });
        })
    </script>
</body>

</html>