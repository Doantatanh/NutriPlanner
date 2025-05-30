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



function render(meals, id){
    console.log("quyen");
    let element = document.getElementById(id);
    element.innerHTML = "";
    meals.forEach(meal => {
        let card = document.createElement("div");
        card.innerHTML =  `
            <div class="card d-flex flex-column scale-105 boder-0 rounded-4 overflow-hidden " > 
                            <picture class="rounded-top overflow-hidden">
                                <img class="  card-img-top " style="aspect-ratio: 4/3; object-fit: cover; cursor:pointer" src="${meal.image_url}"
                                    alt="">
                                         
                            </picture>
                            <h5 class="px-3 mt-2" >${meal.name}</h5>
                            <div class="d-flex  gap-3 px-3 mb-2">
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
                        <img src="${meal.image}" class="rounded w-100" style="aspect-ratio: 4/3; object-fit: cover;"  alt="">
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
// phần calculator

let ingredients = [];

fetch('assets/js/ingredients.json')
  .then(response => response.json())
  .then(data => {
    ingredients = data;
    console.log('Dữ liệu đã load:', ingredients);
  })
  .catch(error => console.error('Lỗi khi load JSON:', error));


document.getElementById('add-ingredient').addEventListener('click', ()=>{
    const container = document.querySelector('.ingredients-list');
    console.log(container);
    const newIngredientItem = document.createElement("div");
    newIngredientItem.classList.add('ingredient-item')

    newIngredientItem.innerHTML = `
        <select>
            ${ingredients.map(i => `<option value="${i.name}">${i.name}</option>`).join("")}
        </select>
        <input type="number" placeholder="Gram" />
        <button class="remove-ingredient">x</button>
    `;
    container.appendChild(newIngredientItem);

    newIngredientItem.querySelector('.remove-ingredient').addEventListener('click',() => {
        newIngredientItem.remove();
    })
})

document.getElementById('calculate-btn').addEventListener('click',()=>{
    calculator();
})
function calculator (){
    console.log('hàm calculator');
    const items = document.querySelectorAll(".ingredient-item");
    console.log(items)
    let total = {
        calories: 0,
        protein: 0,
        carbs: 0,
        fat: 0,
        fiber: 0,
        sugar: 0,
        sodium: 0
    };

    items.forEach(item => {
        const name = item.querySelector("select").value;
        const amount = parseFloat(item.querySelector("input").value) || 0;

        const selected = ingredients.find(ing => ing.name === name);
        console.log(selected)
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

    document.getElementById("total-calories").innerText = `${total.calories.toFixed(2)} kcal`;
    document.getElementById("protein-result").innerText = `${total.protein.toFixed(2)}g`;
    document.getElementById("carbs-result").innerText = `${total.carbs.toFixed(2)}g`;
    document.getElementById("fat-result").innerText = `${total.fat.toFixed(2)}g`;
    document.getElementById("fiber-result").innerText = `${total.fiber.toFixed(2)}g`;
    document.getElementById("sugar-result").innerText = `${total.sugar.toFixed(2)}g`;
    document.getElementById("sodium-result").innerText = `${total.sodium.toFixed(2)}g`;
}

//login
document.getElementById('pop-login').addEventListener("click", ()=>{
    console.log('openpp')
    showPopupLogin();
})

document.getElementById('close-popup-login').addEventListener("click", ()=>{
    console.log('closepp')
    closePopupLogin();
})

function showPopupLogin (){
    console.log('showlogin')
    document.getElementById("pop-login-form").classList.remove('d-none');
}

function closePopupLogin(){
    console.log('closelogin')
    document.getElementById("pop-login-form").classList.add('d-none');
}
//register
document.getElementById('pop-register').addEventListener("click", ()=>{
    console.log('openpp')
    showPopupRegister();
})

document.getElementById('close-pop-register').addEventListener("click", ()=>{
    console.log('closepp')
    closePopupRegister();
})

function showPopupRegister (){
    console.log('showregis')
    document.getElementById("pop-register-form").classList.remove('d-none');
}

function closePopupRegister(){
    console.log('closeregis')
    document.getElementById("pop-register-form").classList.add('d-none');
}

// chuyển đổi giữa các popup

document.getElementById('to-register').addEventListener('click',()=>{
    console.log('log-regis')
    closePopupLogin();
    showPopupRegister();
})

document.getElementById('to-login').addEventListener('click',()=>{
    console.log('regis-log')
    closePopupRegister();
    showPopupLogin();
})





