const meals = [];
const hashtags = []; // Mảng để lưu trữ các hashtagX
let meal_favourite = [];
document.querySelectorAll(".nav-link").forEach((link) => {
  link.addEventListener("click", function () {
    // Xóa class active khỏi tất cả link
    document
      .querySelectorAll(".nav-link")
      .forEach((l) => l.classList.remove("active"));
    // Thêm class active vào link đang được click
    this.classList.add("active");
  });
});

async function loadFavouriteMeals() {
  try {
    const res = await fetch("backend/favourite.php");
    if (!res.ok) throw new Error("HTTP lỗi: " + res.status);

    const text = await res.text();

    if (!text) {
      console.error("Response rỗng");
      return; // hoặc xử lý khi không có dữ liệu
    }

    const result = JSON.parse(text);
    if (result.success) {
      meal_favourite = result.data.map((item) => ({
        id: item.meal_id,
        name: item.name,
      }));
    } else {
      console.error("Không lấy được dữ liệu yêu thích:", result.message);
    }
  } catch (err) {
    console.error("Lỗi kết nối:", err);
  }
}

async function init() {
  try {
    // const response = await fetch('meals.json');
    // const data = await response.json();
    // data.forEach(meal => meals.push(meal));
    await searchFood();
    await loadFavouriteMeals();

    // render(meals, "mealplan--menu");
    if (meal_favourite > 0) {
      render(meal_favourite, "mealfavourite--menu");
    }else{return;}
  } catch (error) {
    console.error("Lỗi khi đọc JSON:", error);
  }
}

init();


function render(meals, id) {
  let element = document.getElementById(id);
  if (meals.length === 0) {
    element.innerHTML = `
    <div style="grid-column: 1 / -1; text-align: center; padding: 50px 0;">
                        <i class="fas fa-search" style="font-size: 3rem; color: #ddd; margin-bottom: 20px;"></i>
                        <h3>Không tìm thấy món ăn nào phù hợp</h3>
                        <p>Vui lòng thử lại với các bộ lọc khác</p>
                    </div>`;
    return;
  }
  

  element.innerHTML = "";
  meals.forEach((meal) => {
    let tagsHTML = '';
    meal.tags.forEach(tag => {
    let tagClass = '';
    let cleanTag = tag.trim().toLowerCase(); // Xử lý khoảng trắng + viết thường

    if (cleanTag === 'vegan' || cleanTag === 'vegetarian') tagClass = 'tag-vegan';
    else if (cleanTag === 'keto' || cleanTag === 'lowcarb') tagClass = 'tag-keto';
    else if (cleanTag === 'paleo') tagClass = 'tag-paleo';
    else tagClass = 'tag-lowcarb'; // default

    tagsHTML += `<span class="tag ${tagClass}">${tag.trim()}</span>`; // In ra nội dung gọn gàng
});

    let card = document.createElement("div");
    meal.isfavourite = meal_favourite.some((fav) => fav.id === meal.id);
    card.className = "meal-card";
    card.innerHTML = `<div class="meal-image">
                        <img src="${meal.image_url}" alt="${meal.name}">
                        <button class="favorite-btn ${
                          meal.isfavourite ? "active" : ""
                        }" type="submit" id="fav-${meal.id}">
                            <input type="hidden" value="${meal.id}" />
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                    <div class="meal-content">
                        <h3>${meal.name}</h3>
                        <div class="meal-tags">
                            ${tagsHTML}
                        </div>
                        <div class="meal-stats">
                            <div class="meal-stat">
                                <i class="fas fa-fire"></i>
                                ${meal.Calories} kcal
                            </div>
                            <div class="meal-stat">
                                <i class="fas fa-stopwatch"></i>
                                ${meal.prep_time} phút
                            </div>
                        </div>
                    </div>`;

    card.addEventListener("click", () => {
      opencard(meal);
      const clickoutbox = function (event) {
        const box = document.querySelector(".pop-up__detail");
        let element = document.getElementById("detail__food");
        if (!box.contains(event.target)) {
          element.classList.add("d-none");
          document.removeEventListener("click", clickoutbox);
        }
      };

      setTimeout(() => {
        document.addEventListener("click", clickoutbox);
      }, 0);
    });

    element.appendChild(card);

    let favorite_btn = card.querySelector(`#fav-${meal.id}`);

      favorite_btn.addEventListener("click", async function (e) {
        e.stopPropagation();
        let isLiked = favorite_btn.classList.contains("active");
        favorite_btn.classList.toggle("active"); // Toggle màu trái tim
        const action = isLiked ? "remove" : "add";
      try {
        const res = await fetch("backend/favourite.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            id: meal.id,
            name: meal.name,
            action: action,
          }),
        });

        const result = await res.json();

        if (result.success) {
          if (action === "add") {
            meal_favourite.push(meal);
          } else {
            meal_favourite = meal_favourite.filter(
              (item) => item.id !== meal.id
            );
          }
        } else {
          alert("Lỗi: " + result.message);
        }
        render(meal_favourite, "mealfavourite--menu");
      } catch (error) {
        alert("Lỗi kết nối: " + error.message);
      }
    });
  });
}

function opencard(meal) {
  let element = document.getElementById("detail__food");

  element.classList.remove("d-none");

  let tagsHTML = '';
    meal.tags.forEach(tag => {
      let tagClass = '';
      let cleanTag = tag.trim().toLowerCase(); // Xử lý khoảng trắng + viết thường

      if (cleanTag === 'vegan' || cleanTag === 'vegetarian') tagClass = 'tag-vegan';
      else if (cleanTag === 'keto' || cleanTag === 'lowcarb') tagClass = 'tag-keto';
      else if (cleanTag === 'paleo') tagClass = 'tag-paleo';
      else tagClass = 'tag-lowcarb'; // default

      tagsHTML += `<span class="tag ${tagClass}">${tag.trim()}</span>`; // In ra nội dung gọn gàng
  });


  element.innerHTML = `
        <div class="pop-up__detail mt-5 col-xl-6 col-sm-10 col-10 mx-auto bg-white rounded-4 overflow-auto p-3" style="height: 600px;" >
            <div class="mealname d-flex justify-content-between"><h3>${meal.name}</h3><button class="close btn bg-white"><i class="fa fa-times"></i></button></div>
            <div class="mealcontent d-grid grid-col-5">
                <div>
                    <picture>
                        <img src="${meal.image_url}" class="rounded w-100" style="aspect-ratio: 4/3; object-fit: cover;"  alt="">
                    </picture>
                    <div class="meal-tags my-2">
                            ${tagsHTML}
                    </div>
                    <p class="my-2" >${meal.description}</p>
                    
                </div>
                <div class=" mx-3">
                    <h3>Ingredients</h3>
                        ${meal.ingredients}
                    <h3>Instruction</h3>
                        ${meal.instruction}
                </div>
            </div>
            <div class="nutrition-facts">
                    <h3>Thông tin dinh dưỡng</h3>
                    <div class="nutrition-grid">
                        <div class="nutrition-item">
                            <span class="nutrition-name">Calories</span>
                            <span>${meal.Calories ?? 0} kcal</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Protein</span>
                            <span>${meal.nutrition.protein ?? 0}g</span>
                        </div>
                        <div class="nutrition-item">

                            <span class="nutrition-name">Carbs</span>
                            <span>${meal.nutrition.carbs ?? 0}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Chất béo</span>
                            <span>${meal.nutrition.fat ?? 0}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Chất xơ</span>
                            <span>${meal.nutrition.fiber ?? 0}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Đường</span>
                            <span>${meal.nutrition.sugar ?? 0}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Natri</span>
                            <span>${meal.nutrition.sodium ?? 0}mg</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Thời gian</span>
                            <span>${meal.prepTime?? 0} phút</span>
                        </div>
                    </div>
                </div>

        </div>
    `;

  document.querySelectorAll(".close").forEach((closeBtn) => {
    closeBtn.addEventListener("click", () => {
      element.classList.add("d-none");
    });
  });
}
// phần calculator

let ingredients = [];
fetch("assets/js/ingredients.json")
  .then((response) => response.json())
  .then((data) => {
    ingredients = data;
    addIngredient();
  })
  .catch((error) => console.error("Lỗi khi load JSON:", error));

document.getElementById("add-ingredient").addEventListener("click", () => {
  addIngredient();
});

function addIngredient() {
  const container = document.querySelector(".ingredients-list");
  const newIngredient = document.createElement("div");
  newIngredient.classList.add("ingredient-item");
  newIngredient.innerHTML = `
    <select>
      ${ingredients
        .map((i) => `<option value="${i.name}">${i.name}</option>`)
        .join("")}
    </select>
    <input type="number" placeholder="Gram" />
    <button class="remove-ingredient">x</button>
  `;
  container.appendChild(newIngredient);
  const selectIngredient = newIngredient.querySelector("select");
  const inputIngredient = newIngredient.querySelector("input");

  selectIngredient.addEventListener("change", calculator);
  inputIngredient.addEventListener("input", calculator);

  newIngredient
    .querySelector(".remove-ingredient")
    .addEventListener("click", () => {
      newIngredient.remove();
      calculator();
    });
}

function calculator() {
  const items = document.querySelectorAll(".ingredient-item");
  let total = {
    calories: 0,
    protein: 0,
    carbs: 0,
    fat: 0,
    fiber: 0,
    sugar: 0,
    sodium: 0,
  };
  items.forEach((item) => {
    const ingredient = item.querySelector("select").value;
    const amount = parseFloat(item.querySelector("input").value) || 0;

    const selected = ingredients.find((ing) => ing.name === ingredient);
    if (selected) {
      const ratio = amount / 100;
      total.calories += selected.calories * ratio;
      total.protein += selected.protein * ratio;
      total.carbs += selected.carbs * ratio;
      total.fat += selected.fat * ratio;
      total.fiber += selected.fiber * ratio;
      total.sugar += selected.sugar * ratio;
      total.sodium += selected.sodium * ratio;
    }
  });
  document.getElementById(
    "total-calories"
  ).innerText = `${total.calories.toFixed(2)} kcal`;
  document.getElementById(
    "protein-result"
  ).innerText = `${total.protein.toFixed(2)}g`;
  document.getElementById("carbs-result").innerText = `${total.carbs.toFixed(
    2
  )}g`;
  document.getElementById("fat-result").innerText = `${total.fat.toFixed(2)}g`;
  document.getElementById("fiber-result").innerText = `${total.fiber.toFixed(
    2
  )}g`;
  document.getElementById("sugar-result").innerText = `${total.sugar.toFixed(
    2
  )}g`;
  document.getElementById("sodium-result").innerText = `${total.sodium.toFixed(
    2
  )}mg`;
}

document
  .getElementById("clear-ingredients-in-form")
  .addEventListener("click", () => {
    document.querySelector(".ingredients-list").innerHTML = "";
    calculator();
  });

document
  .getElementById("clear-ingredients-in-result")
  .addEventListener("click", () => {
    document.querySelector(".ingredients-list").innerHTML = "";
    calculator();
  });

//feedback
document.addEventListener("DOMContentLoaded", () => {
  const starContainer = document.getElementById("starRating");
  if (!starContainer) {
    console.error("Không tìm thấy starRating container!");
    return;
  }
  const stars = starContainer.querySelectorAll("span");
  if (stars.length === 0) {
    console.error("Không tìm thấy ngôi sao nào trong starRating!");
    return;
  }
  let currentRating = 0;

  function updateStars(rating) {
    stars.forEach((star, index) => {
      if (index < rating) {
        star.classList.add("selected");
        star.textContent = "★";
      } else {
        star.classList.remove("selected");
        star.textContent = "☆";
      }
    });
  }

  stars.forEach((star) => {
    star.addEventListener("click", () => {
      const rating = parseInt(star.getAttribute("data-value"));
      if (isNaN(rating)) {
        console.error(
          `data-value không hợp lệ trên ngôi sao: ${star.textContent}`
        );
        return;
      }
      currentRating = rating;
      updateStars(currentRating);
    });
  });

  const form = document.getElementById("feedbackForm");
  if (!form) {
    console.error("Không tìm thấy feedbackForm!");
    return;
  }
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const name = form.querySelector('input[type="text"]').value.trim();
    const email = form.querySelector('input[type="email"]').value.trim();
    const message = form.querySelector("textarea").value.trim();



    form.reset();
    updateStars(0);
    currentRating = 0;
  });
});


document.getElementById("search-form").addEventListener("click",  function () {
    searchFood();
  });
// search food
async function searchFood() {
  let meal_search = [];
  let meal_name = document.getElementById("input_search").value;
  let meal_type = document.getElementById("input_type").value;
  let meal_diet = Array.isArray(hashtags) ? hashtags.join(", ") : "";
  console.log(meal_diet);
  let meal_calo = document.getElementById("meal_calo").value;

  try {
    const res = await fetch("backend/search.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        name: meal_name,
        type: meal_type,
        diet: meal_diet,
        calo: meal_calo,
      }),
    });

    const data = await res.json();

    meal_search = data.data;
    console.log(meal_search);
  } catch (error) {
    console.error("Lỗi khi gọi API:", error);
  }
  render(meal_search, "meals-grid");
}

// admin-list meals
