function changeQuantity(button, delta) {
    var quantityElement = button.parentNode.querySelector('.quantity');
    var currentQuantity = parseInt(quantityElement.textContent);
    var newQuantity = currentQuantity + delta;
    
    if (newQuantity >= 0) {
      quantityElement.textContent = newQuantity;
      updateSum(button.parentNode.parentNode);
    }
  }
  
  function updateSum(container) {
    var priceText = container.querySelector('.details_price').textContent;
    var price = parseInt(priceText.replace('Цена: ', '').replace('₽', ''));

     var quantity = parseInt(container.querySelector('.quantity').textContent);

     var totalPriceElement = container.querySelector('.total-price');
    totalPriceElement.textContent = price * quantity;
    }
  
  function removeItem(button) {
    button.parentNode.parentNode.remove();
  }

  ///HEADER///
  function toggleMenu() {
    var menu = document.getElementById('headerNav');
    if (menu.style.display === 'flex') {
      menu.style.display = 'none';
    } else {
      menu.style.display = 'flex';
    }
  }