function changeImage(src) {
    document.getElementById('large-image').src = src;
  }


///попапокнаааа///
  const registrationPopup = document.getElementById('registrationPopup');
  const loginPopup = document.getElementById('loginPopup');
  const closeRegistrationPopup = document.getElementById('closeRegistrationPopup');
  const closeLoginPopup = document.getElementById('closeLoginPopup');
  const showPassword = document.getElementById('showPassword');
  const showConfirmPassword = document.getElementById('showConfirmPassword');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  const switchToLogin = document.getElementById('switchToLogin');
  const switchToRegistration = document.getElementById('switchToRegistration');
  
  document.getElementById('openRegistrationPopup').addEventListener('click', () => {
    registrationPopup.style.display = 'block';
  });
  // Функция для отображения поп-ап окна
  function openPopup(popup) {
    popup.style.display = 'block';
  }
  
  document.getElementById('openRegistrationPopup').addEventListener('click', () => {
    registrationPopup.style.display = 'block';
  });
  
  // Функция для скрытия поп-ап окна
  function closePopup(popup) {
    popup.style.display = 'none';
  }

  document.addEventListener('click', function(event) {
    var popup = document.getElementById('registrationPopup');
    var loginPopup = document.getElementById('loginPopup');
    
    
    if (!popup.contains(event.target) && !loginPopup.contains(event.target) && event.target.id !== 'openRegistrationPopup') {
      popup.style.display = 'none';
      loginPopup.style.display = 'none';
    }
  });
  
  // Переключение между поп-ап окнами
  switchToLogin.addEventListener('click', () => {
    closePopup(registrationPopup);
    openPopup(loginPopup);
  });
  
  switchToRegistration.addEventListener('click', () => {
    closePopup(loginPopup);
    openPopup(registrationPopup);
  });
  
  // Закрытие поп-ап окон
  closeRegistrationPopup.addEventListener('click', () => {
    closePopup(registrationPopup);
  });
  
  closeLoginPopup.addEventListener('click', () => {
    closePopup(loginPopup);
  });

  showPassword.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      showPassword.classList.remove('fa-eye');
      showPassword.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      showPassword.classList.remove('fa-eye-slash');
      showPassword.classList.add('fa-eye');
    }
  });


    ///HEADER///
    function toggleMenu() {
      var menu = document.getElementById('headerNav');
      if (menu.style.display === 'flex') {
        menu.style.display = 'none';
      } else {
        menu.style.display = 'flex';
      }
    }

    

    document.addEventListener('DOMContentLoaded', (event) => {
      document.querySelectorAll('.description_button').forEach(button => {
          button.addEventListener('click', function() {
              const productId = this.dataset.productId;
              addToCart(productId);
          });
      });
  });
  
  function addToCart(productId) {
      fetch('korzina.php', {
          method: 'POST',
          body: JSON.stringify({ product_id: productId }),
          headers: {
              'Content-Type': 'application/json'
          }
      })
      .then(response => response.json())
      .then(data => {
          if(data.success) {
              window.location.href = 'korzina.php'; // Перенаправление на страницу корзины
          } else {
              alert('Не удалось добавить товар в корзину.');
          }
      })
      .catch((error) => {
          console.error('Error:', error);
      });
  }