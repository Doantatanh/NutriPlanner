const meals = [];
let meal_favourite = [];

async function loadFavouriteMeals() {
    try {
      const res = await fetch("favourite.php");
      const result = await res.json();
      if (result.success) {
        meal_favourite = result.data.map(item => ({ id: item.meal_id, name: item.name }));
      } else {
        console.error("Không lấy được dữ liệu yêu thích:", result.message);
      }
    } catch (err) {
      console.error("Lỗi kết nối:", err);
    }
  }


  async function init() {
    try {
        const response = await fetch('meals.json');
        const data = await response.json();
        data.forEach(meal => meals.push(meal));

        await loadFavouriteMeals(); 

        render(meals, "mealplan--menu");
        render(meal_favourite, "mealfavourite--menu");
    } catch (error) {
        console.error('Lỗi khi đọc JSON:', error);
    }
}
init();





function render(meals, id){

    let element = document.getElementById(id);
    element.innerHTML = "";
    meals.forEach(meal => {
        let card = document.createElement("div");
        meal.isfavourite = meal_favourite.some(fav => fav.id === meal.id);

        card.innerHTML =  `
            <div class="card d-flex flex-column scale-105 boder-0 rounded-4 overflow-hidden " > 
                                <picture class="rounded-top overflow-hidden">
                                    <img class="card-img-top" style="aspect-ratio: 4/3; object-fit: cover; cursor:pointer" src="${meal.image_url}"
                                        alt="">
                                </picture>
                                <div class="d-flex">
                                    <div class="infomation_meal flex-fill">
                                        <h5 class="px-3 mt-2" >${meal.name}</h5>
                                        <div class="d-flex gap-3 px-3 mb-2">
                                            <div class="meal-icon">
                                                <i class="fas fa-fire"></i>
                                                ${meal.calories} kcal
                                            </div>
                                            <div class="meal-icon">
                                                <i class="fas fa-stopwatch"></i>
                                                ${meal.preptime} min
                                            </div> 
                                        </div>
                                    </div>
                                    <form class="myForm">
                                        <button class="farvourite-btn m-2 p-3 ${meal.isfavourite ? "text-danger" :""}" type="submit" id="fav-${meal.id}">
                                            <input type="hidden" value="${meal.id}">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </form>
                                        
                                </div>
                                
            </div>
        `
        card.addEventListener('click', () => {    
            opencard(meal);
            const clickoutbox = function (event) {
                const box = document.querySelector(".pop-up__detail");
                let element = document.getElementById("detail__food")
                if (!box.contains(event.target)) {
                    element.classList.add("d-none");
                    document.removeEventListener("click",clickoutbox);
                }
                };

                setTimeout(()=>{
                    document.addEventListener("click", clickoutbox); 
                },0)
            
        });

        element.appendChild(card);

        let favourite_btn =  card.querySelector(`#fav-${meal.id}`);

        favourite_btn.addEventListener('click', async function(e) {
            e.stopPropagation();
            e.preventDefault();
            let isLiked = favourite_btn.classList.contains('text-danger');
            const action = isLiked ? "remove" : "add";
            try {
                const res = await fetch("favourite.php", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json"
                  },
                  body: JSON.stringify({
                    id: meal.id,
                    name: meal.name,
                    action: action
                  })
                });
            
                const result = await res.json();
            
                if (result.success) {
                  favourite_btn.classList.toggle("text-danger"); // Toggle màu trái tim
                  if (action === "add") {
                    meal_favourite.push(meal);
                  } else {
                    meal_favourite = meal_favourite.filter(item => item.id !== meal.id);
                  }
                } else {
                  alert("Lỗi: " + result.message);
                }
                render(meal_favourite, "mealfavourite--menu");
              } catch (error) {
                alert("Lỗi kết nối: " + error.message);
              }
        })});
    }




function opencard (meal){
    let element = document.getElementById("detail__food");

    let stepHTML ="";
    meal.instruction.forEach(element=>stepHTML += `<li>${element}</li>`)
    element.classList.remove("d-none");

    let tagsHTML = ""
    meal.tags.forEach(tag => {
        tagsHTML += `<lable class="rounded-5 bg-blue px-2 m-2 text-success" style="line-height:40px" >${tag}</lable>`;
    });

    element.innerHTML=`
        <div class="pop-up__detail mt-5 col-xl-6 col-sm-10 col-10 mx-auto bg-white rounded-4 overflow-auto p-3" style="height: 600px;" >
            <div class="mealname d-flex justify-content-between"><h3>${meal.name}</h3><button class="close btn bg-white"><i class="fa fa-times"></i></button></div>
            <div class="mealcontent d-grid grid-col-5">
                <div>
                    <picture>
                        <img src="${meal.image_url}" class="rounded w-100" style="aspect-ratio: 4/3; object-fit: cover;"  alt="">
                    </picture>
                    ${tagsHTML}
                    <p class="my-2" >${meal.description}</p>
                    <div class="nutrition-facts">
                    <h3>Thông tin dinh dưỡng</h3>
                    <div class="nutrition-table d-grid gap-4 grid-col-2 bg-light rounded-4 p-3">
                        <div class="nutrition-item">
                            <span class="nutrition-name">Calories</span>
                            <span>${meal.calories} kcal</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Protein</span>
                            <span>${meal.nutrition.protein}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Carbs</span>
                            <span>${meal.nutrition.carbs}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Chất béo</span>
                            <span>${meal.nutrition.fat}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Chất xơ</span>
                            <span>${meal.nutrition.fiber}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Đường</span>
                            <span>${meal.nutrition.sugar}g</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Natri</span>
                            <span>${meal.nutrition.sodium}mg</span>
                        </div>
                        <div class="nutrition-item">
                            <span class="nutrition-name">Thời gian</span>
                            <span>${meal.prepTime} phút</span>
                        </div>
                    </div>
                </div>
                </div>
                <div class=" mx-3">
                    <h3>Ingredients</h3>
                    <ul>
                        ${meal.ingredients}
                    </ul>
                    <h3>Instruction</h3>
                    <ul>
                        ${stepHTML}
                    </ul>
                </div>
                

            </div>
        </div>
    `

    

    document.querySelectorAll(".close").forEach(closeBtn => {
        closeBtn.addEventListener("click", () => {
            console.log("chay roi");
            element.classList.add("d-none");
        });
    });

}
// phần calculator

let ingredients = [];
fetch('assets/js/ingredients.json')
  .then(response => response.json())
  .then(data => {
    ingredients = data;
    addIngredient();
  })
  .catch(error => console.error('Lỗi khi load JSON:', error));

document.getElementById('add-ingredient').addEventListener('click',()=>{
  addIngredient();
})

function addIngredient (){
  const container = document.querySelector('.ingredients-list');
  console.log(container);
  const newIngredient = document.createElement('div');
  newIngredient.classList.add('ingredient-item');
  newIngredient.innerHTML = `
    <select>
      ${ingredients.map(i => `<option value="${i.name}">${i.name}</option>`).join("")}
    </select>
    <input type="number" placeholder="Gram" />
    <button class="remove-ingredient">x</button>
  `;
  container.appendChild(newIngredient);
  const selectIngredient = newIngredient.querySelector('select');
  const inputIngredient = newIngredient.querySelector('input');
  console.log(selectIngredient);
  console.log(inputIngredient);
  selectIngredient.addEventListener('change',calculator);
  inputIngredient.addEventListener('input',calculator)

  newIngredient.querySelector(".remove-ingredient").addEventListener("click", () => {
    newIngredient.remove();
    calculator();
  });
}

function calculator(){
  console.log('calculator');
  const items = document.querySelectorAll('.ingredient-item')
  console.log(items);
  let total = {
    calories: 0,
    protein: 0,
    carbs: 0,
    fat: 0,
    fiber: 0,
    sugar: 0,
    sodium: 0
  };
  items.forEach(item =>{
    const ingredient = item.querySelector('select').value;
    const amount = parseFloat(item.querySelector('input').value) || 0;

    const selected = ingredients.find((ing)=>ing.name === ingredient)
    if(selected){
      const ratio = amount /100;
      console.log(ratio)
      total.calories += selected.calories * ratio;
      total.protein += selected.protein * ratio;
      total.carbs += selected.carbs * ratio;
      total.fat += selected.fat * ratio;
      total.fiber += selected.fiber * ratio;
      total.sugar += selected.sugar * ratio;
      total.sodium += selected.sodium * ratio;
    }
  })
  document.getElementById("total-calories").innerText = `${total.calories.toFixed(2)} kcal`;
  document.getElementById("protein-result").innerText = `${total.protein.toFixed(2)}g`;
  document.getElementById("carbs-result").innerText = `${total.carbs.toFixed(2)}g`;
  document.getElementById("fat-result").innerText = `${total.fat.toFixed(2)}g`;
  document.getElementById("fiber-result").innerText = `${total.fiber.toFixed(2)}g`;
  document.getElementById("sugar-result").innerText = `${total.sugar.toFixed(2)}g`;
  document.getElementById("sodium-result").innerText = `${total.sodium.toFixed(2)}mg`;
}

document.getElementById('clear-ingredients-in-form').addEventListener('click', () => {
  document.querySelector('.ingredients-list').innerHTML = '';
  calculator();
});

document.getElementById('clear-ingredients-in-result').addEventListener('click', () => {
  document.querySelector('.ingredients-list').innerHTML = '';
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
        console.error(`data-value không hợp lệ trên ngôi sao: ${star.textContent}`);
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

    console.log("Đánh giá mới:", {
      stars: currentRating,
      name,
      email,
      message,
    });

    form.reset();
    updateStars(0);
    currentRating = 0;
  });
});


let meal_search = [];
        document.getElementById('search-form').addEventListener('click', async function() {
            let meal_name = document.getElementById("input_search").value;
            let meal_type = document.getElementById("input_type").value;
            let meal_diet = document.getElementById("meal_diet").value;
            let meal_calo = document.getElementById("meal_calo").value;
            meal_search.push(meal_name);
            meal_search.push(meal_type);
            meal_search.push(meal_diet);
            meal_search.push(meal_calo);
            console.log(meal_search);
            meal_search = [];
            try {
                const res = await fetch("backend/search.php", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json"
                  },
                  body: JSON.stringify({
                    name: meal_name,
                    type: meal_type,
                    diet: meal_diet,
                    calo: meal_calo
                  })
                });
                



            const data = await res.json();

            meal_search = data.data;

    console.log(meal_search);
            } catch (error) {
                console.error("Lỗi khi gọi API:", error);
            }
            render(meal_search, "mealplan--menu");
        });




// admin-list meals


