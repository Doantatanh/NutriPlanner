const meals = [
    {
        id: 1,
        name: "Salad bơ & quinoa",
        description: "Salad bơ quinoa giàu dinh dưỡng, là sự kết hợp hoàn hảo của protein thực vật, chất béo lành mạnh và chất xơ.",
        image: "https://images.unsplash.com/photo-1512621776951-a57141f2eefd",
        type: "lunch",
        calories: 320,
        prepTime: 15,
        tags: ["vegan", "lowcarb", "glutenfree"],
        nutrition: {
            protein: 12,
            carbs: 25,
            fat: 18,
            fiber: 8,
            sugar: 3,
            sodium: 120
        },
        ingredients: [
            "1 cup quinoa",
            "2 quả bơ chín",
            "1 quả chanh",
            "1/4 cup hành tím thái lát",
            "1/2 cup cà chua bi cắt đôi",
            "1/4 cup rau mùi thái nhỏ",
            "2 tbsp dầu oliu",
            "Muối và tiêu đen"
        ],
        steps: [
            "Nấu quinoa theo hướng dẫn trên bao bì, để nguội.",
            "Trộn quinoa với dầu oliu, nước cốt chanh, muối và tiêu.",
            "Thêm bơ cắt hạt lựu, cà chua, hành và rau mùi, trộn đều.",
            "Nếm thử và điều chỉnh gia vị theo khẩu vị."
        ],
        comments: []
    },
    {
        id: 2,
        name: "Cơm gạo lứt ức gà",
        description: "Bữa ăn cân bằng giàu protein với ức gà và gạo lứt, lý tưởng cho những người tập luyện thể thao.",
        image: "https://images.unsplash.com/photo-1598515214211-89d3c73ae83b",
        type: "lunch",
        calories: 450,
        prepTime: 30,
        tags: ["highprotein", "lowfat"],
        nutrition: {
            protein: 35,
            carbs: 50,
            fat: 10,
            fiber: 4,
            sugar: 2,
            sodium: 300
        },
        ingredients: [
            "200g ức gà",
            "1 cup gạo lứt",
            "1 cup rau xanh theo mùa",
            "1 tbsp dầu oliu",
            "2 tép tỏi băm nhỏ",
            "Gia vị (muối, tiêu, bột nghệ)",
            "1 quả chanh"
        ],
        steps: [
            "Ướp ức gà với tỏi, muối, tiêu, bột nghệ trong 15 phút.",
            "Nấu gạo lứt theo hướng dẫn trên bao bì.",
            "Nướng hoặc chiên ức gà với dầu oliu đến khi chín vàng.",
            "Xào rau với tỏi và chút muối.",
            "Sắp xếp gạo lứt, ức gà và rau xanh vào đĩa, vắt chanh lên trên."
        ],
        comments: [
            {
                author: "Nguyễn Văn A",
                date: "2023-05-12",
                text: "Món này rất tuyệt vời cho người tập gym như mình. Tôi thường thêm chút ớt để tăng hương vị."
            }
        ]
    },
    {
        id: 3,
        name: "Súp bí đỏ hạt điều",
        description: "Súp bí đỏ kem mịn với hạt điều rang, mang lại hương vị ngọt tự nhiên và ấm áp.",
        image: "https://images.unsplash.com/photo-1476718406336-bb5a9690ee2a",
        type: "dinner",
        calories: 180,
        prepTime: 35,
        tags: ["vegan", "glutenfree", "lowcalorie"],
        nutrition: {
            protein: 5,
            carbs: 20,
            fat: 8,
            fiber: 6,
            sugar: 8,
            sodium: 250
        },
        ingredients: [
            "500g bí đỏ, cắt khối",
            "1 củ hành tây, thái hạt lựu",
            "2 tép tỏi, băm nhỏ",
            "4 cup nước dùng rau củ",
            "1/4 cup hạt điều rang",
            "1/2 cup sữa dừa",
            "1 tbsp dầu oliu",
            "Muối, tiêu, lá thyme tươi"
        ],
        steps: [
            "Phi thơm hành tây và tỏi với dầu oliu trong nồi lớn.",
            "Thêm bí đỏ và nước dùng, đun sôi rồi hạ lửa nhỏ, nấu khoảng 20 phút đến khi bí đỏ mềm.",
            "Xay nhuyễn súp với máy xay cầm tay.",
            "Thêm sữa dừa, đun nhẹ thêm 5 phút.",
            "Rắc hạt điều rang và lá thyme tươi trước khi phục vụ."
        ],
        comments: [
            {
                author: "Trần Thị B",
                date: "2023-06-03",
                text: "Vị ngọt tự nhiên từ bí đỏ kết hợp với sữa dừa tạo nên hương vị tuyệt vời. Rất thích món này!"
            },
            {
                author: "Lê Văn C",
                date: "2023-06-15",
                text: "Tôi đã thử làm theo công thức và thêm một ít nghệ, rất ngon và bổ dưỡng."
            }
        ]
    },
    {
        id: 4,
        name: "Smoothie xanh siêu dinh dưỡng",
        description: "Sinh tố xanh giàu dinh dưỡng với rau bina, chuối và sữa hạnh nhân, tuyệt vời cho bữa sáng nhanh chóng.",
        image: "https://images.unsplash.com/photo-1638176067000-9e2f9d8169f2",
        type: "smoothie",
        calories: 150,
        prepTime: 5,
        tags: ["vegan", "lowcalorie"],
        nutrition: {
            protein: 3,
            carbs: 25,
            fat: 4,
            fiber: 5,
            sugar: 15,
            sodium: 30
        },
        ingredients: [
            "1 cup rau bina tươi",
            "1 quả chuối chín",
            "1/2 quả táo xanh, cắt miếng",
            "1 cup sữa hạnh nhân không đường",
            "1 tbsp hạt chia",
            "1 tsp mật ong (tùy chọn)",
            "4-5 viên đá"
        ],
        steps: [
            "Cho tất cả nguyên liệu vào máy xay sinh tố.",
            "Xay ở tốc độ cao đến khi mịn (khoảng 30-60 giây).",
            "Nếm thử và thêm mật ong nếu muốn ngọt hơn."
        ],
        comments: []
    },
    {
        id: 5,
        name: "Bánh mì trứng & salad",
        description: "Bữa sáng cân bằng với bánh mì nguyên cám, trứng luộc và rau xanh, cung cấp năng lượng dài lâu.",
        image: "https://images.unsplash.com/photo-1525351484163-7529414344d8",
        type: "breakfast",
        calories: 350,
        prepTime: 10,
        tags: ["vegetarian", "highprotein"],
        nutrition: {
            protein: 15,
            carbs: 30,
            fat: 18,
            fiber: 6,
            sugar: 4,
            sodium: 380
        },
        ingredients: [
            "2 lát bánh mì nguyên cám",
            "2 quả trứng gà luộc chín",
            "1/4 quả bơ",
            "Lá xà lách xanh",
            "Cà chua thái lát",
            "1 tsp dầu oliu",
            "Muối biển và tiêu đen",
            "Vài lá húng quế tươi (tùy chọn)"
        ],
        steps: [
            "Nướng bánh mì nguyên cám.",
            "Thái mỏng bơ, đặt lên bánh mì nướng.",
            "Thái trứng luộc thành lát, xếp lên trên bơ.",
            "Thêm xà lách, cà chua, rưới nhẹ dầu oliu.",
            "Rắc muối, tiêu và lá húng quế tươi."
        ],
        comments: [
            {
                author: "Phan Thị D",
                date: "2023-04-18",
                text: "Bữa sáng hoàn hảo! Đơn giản, nhanh gọn mà vẫn đủ dinh dưỡng cho cả buổi sáng bận rộn."
            }
        ]
    },
    {
        id: 6,
        name: "Bowl açaí",
        description: "Món ăn nhẹ giàu chất chống oxy hóa từ açaí, trái cây tươi và hạt, hoàn hảo cho buổi sáng bận rộn.",
        image: "https://images.unsplash.com/photo-1590301157890-4810ed352733",
        type: "breakfast",
        calories: 320,
        prepTime: 15,
        tags: ["vegan", "glutenfree"],
        nutrition: {
            protein: 8,
            carbs: 45,
            fat: 12,
            fiber: 9,
            sugar: 20,
            sodium: 15
        },
        ingredients: [
            "100g gói açaí đông lạnh hoặc bột açaí",
            "1 quả chuối đông lạnh",
            "1/2 cup dâu tây",
            "1/4 cup sữa hạnh nhân",
            "1 tbsp hạt chia",
            "Topping: granola, trái cây tươi, hạt, dừa bào"
        ],
        steps: [
            "Xay açaí, chuối đông lạnh, dâu tây và sữa hạnh nhân đến khi mịn.",
            "Đổ hỗn hợp vào tô, độ đặc như kem.",
            "Rắc hạt chia, granola, trái cây tươi và các loại hạt lên trên."
        ],
        comments: []
    },
    {
        id: 7,
        name: "Mì Udon xào rau củ",
        description: "Mì Udon xào nhanh chóng với hỗn hợp rau củ tươi, nước sốt miso nhẹ nhàng, phù hợp cho bữa tối nhẹ nhàng.",
        image: "https://images.unsplash.com/photo-1569718212165-3a8278d5f624",
        type: "dinner",
        calories: 380,
        prepTime: 20,
        tags: ["vegetarian", "dairyfree"],
        nutrition: {
            protein: 10,
            carbs: 65,
            fat: 8,
            fiber: 7,
            sugar: 6,
            sodium: 580
        },
        ingredients: [
            "200g mì Udon",
            "1 cup nấm Shiitake thái lát",
            "1 củ cà rốt, thái sợi",
            "1 cup cải thảo thái sợi",
            "1 cup đậu Hà Lan",
            "2 tép tỏi băm nhỏ",
            "1 tbsp gừng tươi băm",
            "2 tbsp nước tương",
            "1 tbsp tương miso",
            "1 tbsp dầu mè",
            "Hành lá thái nhỏ để trang trí"
        ],
        steps: [
            "Nấu mì Udon theo hướng dẫn trên bao bì, sau đó xả dưới vòi nước lạnh.",
            "Phi thơm tỏi và gừng trong chảo với dầu mè.",
            "Thêm nấm, cà rốt và xào khoảng 3 phút.",
            "Thêm cải thảo, đậu Hà Lan và xào thêm 2 phút.",
            "Trộn nước tương và tương miso với 2 tbsp nước, thêm vào chảo.",
            "Cho mì vào, đảo đều để mì thấm gia vị.",
            "Rắc hành lá trước khi phục vụ."
        ],
        comments: []
    },
    {
        id: 8,
        name: "Protein balls hạnh nhân cacao",
        description: "Món ăn nhẹ giàu protein từ bơ hạnh nhân, cacao và hạt, là lựa chọn tuyệt vời cho bữa phụ hoặc sau tập luyện.",
        image: "https://images.unsplash.com/photo-1604467715878-83e57e8bc129",
        type: "snack",
        calories: 120,
        prepTime: 15,
        tags: ["vegan", "glutenfree", "paleo"],
        nutrition: {
            protein: 5,
            carbs: 10,
            fat: 8,
            fiber: 3,
            sugar: 4,
            sodium: 5
        },
        ingredients: [
            "1 cup quả chà là (đã bỏ hạt)",
            "1/2 cup bơ hạnh nhân",
            "1/4 cup bột protein (vegan hoặc whey)",
            "2 tbsp bột cacao nguyên chất",
            "1 tbsp hạt chia",
            "1/4 cup hạnh nhân thái nhỏ",
            "1 tsp chiết xuất vanilla",
            "Một chút muối biển"
        ],
        steps: [
            "Cho chà là vào máy xay thực phẩm và xay nhuyễn.",
            "Thêm các nguyên liệu còn lại và xay đến khi hỗn hợp dẻo, có thể nặn thành viên.",
            "Nặn thành những viên nhỏ cỡ 1 inch.",
            "Bảo quản trong tủ lạnh đến 1 tuần hoặc đông lạnh đến 3 tháng."
        ],
        comments: []
    },
    {
        id: 9,
        name: "Cá hồi nướng với măng tây",
        description: "Bữa tối giàu omega-3 với cá hồi nướng, măng tây tươi và khoai lang nghiền, đảm bảo dinh dưỡng đầy đủ.",
        image: "https://images.unsplash.com/photo-1485921325833-c519f76c4927",
        type: "dinner",
        calories: 420,
        prepTime: 25,
        tags: ["highprotein", "keto", "dairyfree"],
        nutrition: {
            protein: 38,
            carbs: 15,
            fat: 24,
            fiber: 5,
            sugar: 3,
            sodium: 320
        },
        ingredients: [
            "200g phi lê cá hồi",
            "1 bundle măng tây",
            "1 khoai lang trung bình",
            "2 tép tỏi băm nhỏ",
            "1 quả chanh",
            "2 tbsp dầu oliu",
            "Thyme tươi",
            "Muối biển và tiêu đen"
        ],
        steps: [
            "Làm nóng lò ở 200°C.",
            "Nghiền khoai lang với chút dầu oliu, muối.",
            "Đặt cá hồi và măng tây trên khay nướng, rưới dầu oliu và vắt nước chanh.",
            "Rắc tỏi băm, thyme, muối và tiêu lên cá và rau.",
            "Nướng trong 12-15 phút cho đến khi cá chín và măng tây mềm.",
            "Phục vụ với khoai lang nghiền và một miếng chanh."
        ],
        comments: []
    },
    {
        id: 10,
        name: "sữa chua Hy Lạp với granola",
        description: "Bữa sáng hoặc món tráng miệng nhẹ nhàng với sữa chua Hy Lạp, granola giòn và hỗn hợp trái cây tươi.",
        image: "https://images.unsplash.com/photo-1488477181946-6428a0291777",
        type: "breakfast",
        calories: 280,
        prepTime: 10,
        tags: ["vegetarian", "lowfat"],
        nutrition: {
            protein: 15,
            carbs: 40,
            fat: 7,
            fiber: 5,
            sugar: 25,
            sodium: 80
        },
        ingredients: [
            "1 cup sữa chua Hy Lạp không đường",
            "1/3 cup granola tự nhiên",
            "1/2 cup dâu tây thái lát",
            "1/2 cup việt quất",
            "1 tbsp hạt chia",
            "1 tbsp mật ong hoặc siro cây phong (tùy chọn)"
        ],
        steps: [
            "Xếp lớp một nửa sữa chua vào đáy ly hoặc tô.",
            "Thêm một lớp granola và một ít trái cây.",
            "Lặp lại với lớp sữa chua còn lại, granola và trái cây.",
            "Rắc hạt chia lên trên và rưới mật ong hoặc siro nếu muốn."
        ],
        comments: []
    },
    {
        id: 11,
        name: "Bún trộn rau củ kiểu Thái",
        description: "Món bún trộn tươi mát với rau củ và nước sốt Thái chua cay, hoàn hảo cho bữa trưa mùa hè.",
        image: "https://images.unsplash.com/photo-1547496502-affa22d38842",
        type: "lunch",
        calories: 310,
        prepTime: 20,
        tags: ["vegan", "glutenfree", "lowcalorie"],
        nutrition: {
            protein: 8,
            carbs: 45,
            fat: 10,
            fiber: 6,
            sugar: 12,
            sodium: 650
        },
        ingredients: [
            "200g bún gạo",
            "1 cup cà rốt bào sợi",
            "1 cup dưa leo thái sợi",
            "1/2 cup đậu sprouts",
            "1/4 cup húng quế thái nhỏ",
            "1/4 cup rau mùi thái nhỏ",
            "2 tbsp đậu phộng rang giã nhỏ",
            "Nước sốt: 2 tbsp nước cốt chanh, 1 tbsp nước mắm, 1 tbsp đường, 1 tép tỏi băm, 1 quả ớt đỏ thái nhỏ"
        ],
        steps: [
            "Ngâm bún trong nước nóng theo hướng dẫn, xả lại bằng nước lạnh và để ráo.",
            "Trộn tất cả nguyên liệu nước sốt cho đến khi đường tan hết.",
            "Trong một tô lớn, trộn bún, cà rốt, dưa leo, đậu sprouts.",
            "Rưới nước sốt lên trên và trộn đều.",
            "Rắc húng quế, rau mùi và đậu phộng trước khi phục vụ."
        ],
        comments: []
    },
    {
        id: 12,
        name: "Sinh tố dâu chuối",
        description: "Sinh tố ngọt tự nhiên từ dâu và chuối, lý tưởng cho bữa sáng nhanh chóng hoặc sau khi tập luyện.",
        image: "https://images.unsplash.com/photo-1553530666-ba11a90bb900",
        type: "smoothie",
        calories: 200,
        prepTime: 5,
        tags: ["vegan", "glutenfree", "lowfat"],
        nutrition: {
            protein: 5,
            carbs: 35,
            fat: 3,
            fiber: 7,
            sugar: 20,
            sodium: 40
        },
        ingredients: [
            "1 cup dâu tây (tươi hoặc đông lạnh)",
            "1 quả chuối chín",
            "1 cup sữa hạnh nhân không đường",
            "1/2 cup sữa chua Hy Lạp (bỏ qua nếu muốn hoàn toàn vegan)",
            "1 tbsp hạt lanh xay",
            "1/2 tsp chiết xuất vanilla",
            "4-5 viên đá (nếu sử dụng trái cây tươi)"
        ],
        steps: [
            "Cho tất cả nguyên liệu vào máy xay sinh tố.",
            "Xay ở tốc độ cao đến khi mịn (khoảng 30-60 giây).",
            "Nếu quá đặc, thêm chút sữa hạnh nhân hoặc nước."
        ],
        comments: []
    }
];


function render(meals, id){
    console.log("quyen");
    let element = document.getElementById(id);
    element.innerHTML = "";
    meals.forEach(meal => {
        let card = document.createElement("div");
        card.innerHTML =  `
            <div class="card d-flex flex-column scale-105 boder-0 rounded-4 overflow-hidden " > 
                            <picture class="rounded-top overflow-hidden">
                                <img class="  card-img-top " style="aspect-ratio: 4/3; object-fit: cover; pointer:cusor" src="${meal.image}"
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
                                    ${meal.prepTime} min
                                </div>
                                
                            </div>
                            
                        </div>
        `
        card.addEventListener('click', () => {    
            opencard(meal);
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
    meal.steps.forEach(element=>stepHTML += `<li>${element}</li>`)
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
    document.addEventListener("click", function (event) {
        const box = document.querySelector(".pop-up__detail");
        let element = document.getElementById("detail__food")
        if (!box.contains(event.target)) {
            element.classList.add("d-none");
        }
      });
    

    document.querySelectorAll(".close").forEach(closeBtn => {
        closeBtn.addEventListener("click", () => {
            console.log("chay roi");
            element.classList.add("d-none");
        });
    });

}



render(meals, "mealplan--menu");

