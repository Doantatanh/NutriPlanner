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
                                <option value="1">Bữa Sáng</option>
                                <option value="2">Bữa Trưa</option>
                                <option value="3">Bữa Tối</option>
                                <option value="4">Đồ ăn nhẹ</option>
                                <option value="5">Đồ uống</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-title">Chế độ ăn</label>
                            <select class="filter-select" name="diet_type">
                                <option value="all">Tất cả</option>
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
                                <option value="all">Tất cả</option>
                                <option value="under300">Dưới 300 kcal</option>
                                <option value="300-500">300 - 500 kcal</option>
                                <option value="500-800">500 - 800 kcal</option>
                                <option value="over800">Trên 800 kcal</option>
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
            <div class="meals-grid" id="meals-grid">



            </div>
        </div>
    </section>

    <script>
        // Xử lý sự kiện khi trang web đã load xong
        document.addEventListener('DOMContentLoaded', () => {
            // Lấy tất cả các nút tab
            const tabbutton = document.querySelectorAll('.tab-btn');

            // Thêm sự kiện click cho từng nút
            tabbutton.forEach(button => {
                button.addEventListener('click', () => {
                    // Xóa class active ở tất cả các nút
                    tabbutton.forEach(btn => btn.classList.remove('active'));
                    // Thêm class active cho nút được click
                    button.classList.add('active');
                });
            });
        });
    </script>

    <script>
        // Xử lý sự kiện submit form tìm kiếm
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            // Ngăn chặn form submit mặc định
            e.preventDefault();

            // Tạo đối tượng FormData từ form
            const formData = new FormData(this);
            // Chuyển đổi FormData thành chuỗi query parameters
            const params = new URLSearchParams(formData);

            // Gọi API tìm kiếm
            fetch('../backend/search.php?' + params.toString())
                // Chuyển response thành JSON
                .then(response => response.json())
                // Xử lý dữ liệu trả về
                .then(response => {
                    // Lấy div chứa kết quả
                    const resultsDiv = document.getElementById('meals-grid');
                    // Xóa nội dung cũ
                    resultsDiv.innerHTML = '';

                    // Kiểm tra nếu không có kết quả
                    if (!response.data || response.data.length === 0) {
                        // Hiển thị thông báo không tìm thấy kết quả
                        resultsDiv.innerHTML = '<div style="grid-column: 1 / -1; text-align: center; padding: 50px 0;"><i class="fas fa-search" style="font-size: 3rem; color: #ddd; margin-bottom: 20px;"></i><h3>Không tìm thấy món ăn nào phù hợp</h3><p>Vui lòng thử lại với các bộ lọc khác</p></div>';
                        return;
                    }

                    // Duyệt qua từng món ăn trong kết quả
                    response.data.forEach(meal => {
                        // Xử lý tags từ diet_tags array
                        // Nếu có tags thì chuyển thành HTML, không có thì trả về chuỗi rỗng
                        const tagsHTML = meal.diet_tags ? meal.diet_tags.map(tag => `<span class="meal-tag">${tag.trim()}</span>`).join(' ') : '';

                        // Xử lý đường dẫn hình ảnh
                        // Nếu không có hình thì dùng hình mặc định
                        const imgSrc = meal.image || '../assets/images/no-image.png';

                        // Xử lý đường dẫn hình ảnh dựa vào loại đường dẫn
                        // - Nếu là URL đầy đủ (http/https) thì giữ nguyên
                        // - Nếu là đường dẫn local thì thêm prefix '../'
                        const fullImgSrc = imgSrc.startsWith('http://') || imgSrc.startsWith('https://') ?
                            imgSrc :
                            ('../' + imgSrc.replace(/^\/+/, '')); // Loại bỏ dấu / ở đầu nếu có

                        // Tạo HTML cho card món ăn
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
                        // Thêm card vào div kết quả
                        resultsDiv.insertAdjacentHTML('beforeend', card);
                    })
                })
                // Xử lý lỗi nếu có
                .catch(err => {
                    console.error('Lỗi khi gọi API tìm kiếm:', err);
                });
        })
    </script>
</body>

</html>