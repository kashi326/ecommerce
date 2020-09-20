  $('document').ready(function() {
      //Dark/Light mode switching
      const toggleSwitch = document.querySelector('#theme-toggle');
      const currentTheme = localStorage.getItem('theme');
      if (currentTheme) {
          document.documentElement.setAttribute('data-theme', currentTheme);
          if (currentTheme === 'dark') {
              toggleSwitch.checked = true;
          }
      }

      function switchTheme(e) {
          if (e.target.checked) {
              document.documentElement.setAttribute('data-theme', 'dark');
              localStorage.setItem('theme', 'dark');
              document.getElementById('switch-image').src = '/icons/sun.svg';
          } else {
              document.documentElement.setAttribute('data-theme', 'light');
              localStorage.setItem('theme', 'light');
              document.getElementById('switch-image').src = '/icons/moon.svg';
          }
      }
      toggleSwitch.addEventListener('click', switchTheme, false);
      $("#switch").click(function(e) {
          e.preventDefault();
          $("#theme-toggle").trigger("click");
      });
      //Card hover affect

      $('.itemcard').hover(
          function() {
              $(this.lastChild).css('display', 'flex')
          },
          function() {
              $(this.lastChild).css('display', 'none')
          });
  });
  window.onload = function() {
      if (localStorage.getItem('theme') === 'dark') {
          document.getElementById('switch-image').src = '/icons/sun.svg';
      } else {
          document.getElementById('switch-image').src = '/icons/moon.svg';

      }
  }