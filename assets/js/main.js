const meals = [];
fetch('meals.json')
  .then(response => response.json())
  .then(data => {
    data.forEach(meal => {
        meals.push(meal);
        console.log(meals);
        render(meals, "mealplan--menu");
    });
  })
  .catch(error => console.error('Lỗi khi đọc JSON:', error));

  let meal_favourite = [];
function render(meals, id){

    let element = document.getElementById(id);
    element.innerHTML = "";
    meals.forEach(meal => {
        let card = document.createElement("div");
        meal.isfavourite = false;
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
                                    <form>
                                        <button class="farvourite-btn m-2 p-3 ${meal.isfavourite ? "color-danger" :""}" id="${meal.id}" type="submit">
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

        let favourite_btn =  document.getElementById(meal.id);

        favourite_btn.addEventListener("click", (e)=>{
            
            isfavourite =false;
            e.stopPropagation();
            e.preventDefault();
            if(favourite_btn.classList.contains("active")) meal.isfavourite = true;
            else meal.isfavourite = true;
            meal_favourite.push(meal);
            render(meal_favourite, "mealfavourite--menu");

        })
        
    });

}

function opencard (meal){
    let element = document.getElementById("detail__food");
    let ingredientsHTML = '';
    meal.ingredients.forEach(ingredient => {
        ingredientsHTML += `<li>${ingredient}</li>`;
    });

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
                        ${ingredientsHTML}
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





