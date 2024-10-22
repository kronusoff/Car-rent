document.getElementById('bookNowBtn').onclick = function(event) {
    event.preventDefault(); // Предотвращаем переход по ссылке
    document.getElementById('bookingModal').style.display = 'block'; // Показываем модальное окно
};

// Закрытие модального окна при нажатии на <span> (иконка закрытия)
document.querySelector('.close').onclick = function() {
    document.getElementById('bookingModal').style.display = 'none'; // Скрываем модальное окно
};

// Закрытие модального окна при нажатии вне его области
window.onclick = function(event) {
    const modal = document.getElementById('bookingModal');
    if (event.target === modal) {
        modal.style.display = 'none'; // Скрываем модальное окно
    }
};
