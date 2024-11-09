document.addEventListener("DOMContentLoaded", function() {
   fetch('getCars.php')
       .then(response => response.json())
       .then(cars => {
           const carContainer = document.getElementById('carContainer');

           cars.forEach(car => {
               const carCard = document.createElement('div');
               carCard.className = 'col-lg-4 col-md-6 mb-4';

               carCard.innerHTML = `
                   <div class="card h-100">
                       <img class="card-img-top" src="${car.image_url}" alt="${car.name}">
                       <div class="card-body">
                           <h4 class="card-title">${car.name} ${car.model} ${car.year}</h4>
                           <p class="card-text"><strong>Расход топлива:</strong> ${car.fuel_consumption}</p>
                           <p class="card-text"><strong>Объем двигателя:</strong> ${car.engine_capacity} л</p>
                           <p class="card-text"><strong>Передачи:</strong> ${car.transmission}</p>
                           <p class="price">${car.price_per_day} BYN</p>
                           <a href="#" class="btn btn-primary">Подробнее</a>
                       </div>
                   </div>
               `;
               carContainer.appendChild(carCard);
           });
       })
       .catch(error => console.error('Ошибка:', error));
});
