function toggleMenu() {
    var menu = document.getElementById('headerNav');
    if (menu.style.display === 'flex') {
      menu.style.display = 'none';
    } else {
      menu.style.display = 'flex';
    }
  }


// account.js
document.addEventListener('DOMContentLoaded', function() {
    function loadAppointments() {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'account.php', true);
      xhr.onload = function() {
        if (this.status == 200) {
          var appointments = JSON.parse(this.responseText);
          var output = '';
          for(var i in appointments){
            output += '<tr>' +
                      '<td>'+appointments[i].id+'</td>' +
                      '<td>'+appointments[i].phone+'</td>' +
                      '<td>'+appointments[i].dress_type+'</td>' +
                      '<td>'+appointments[i].date+'</td>' +
                      '</tr>';
          }
          document.querySelector('.order-table').innerHTML += output;
        } else {
          console.error('Не удалось загрузить данные: ' + xhr.statusText);
        }
      };
      xhr.onerror = function() {
        console.error('Ошибка запроса');
      };
      xhr.send();
    }
  
    loadAppointments();
  });
  