// topSlider
const topSlider = new Swiper('.slider', {
    loop: true,
    spaceBetween: 100,

    autoplay: {
      delay: 5000,
     },
     speed: 1500,

    // If we need pagination
    pagination: {
      el: '.slider__nav',
      clickable: true
    },

    on: {
      init() {
        this.el.addEventListener('mouseenter', () => {
          this.autoplay.stop();
        });
  
        this.el.addEventListener('mouseleave', () => {
          this.autoplay.start();
        });
      }
    },
});

// cards slider
const swiper = new Swiper(".project__swiper", {
  slidesPerView: 'auto',
  spaceBetween: 22,
  freeMode: true,

  pagination: {
    el: ".project__pagination",
    clickable: true,
  },
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
      });
  });
});

// gallery
const gallery = new Swiper('.gallery', {
  slidesPerView: 3,
  spaceBetween: 20,
});

// обработка формы
async function submitForm(event) 
{
  event.preventDefault(); // отключаем перезагрузку/перенаправление страницы
  try {
    // Формируем запрос
    const response = await fetch(event.target.action, {
      method: 'POST',
      body: new FormData(event.target)
    });
    // проверяем, что ответ есть
    if (!response.ok) throw (`Ошибка при обращении к серверу: ${response.status}`);
    // проверяем, что ответ действительно JSON
    const contentType = response.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      throw ('Ошибка обработки. Ответ не JSON');
    }
    // обрабатываем запрос
    const json = await response.json();

    if (json.result === "already done") {
      // если уже подписан на рассылку
      document.getElementsByClassName("email-block__input")[0].value='';
      
      const modal = document.getElementById('modal-feedback--alreadydone');
      const span = document.getElementsByClassName("modal__close")[2];
      
      setTimeout(function()
      {
        modal.style.display = "block";
      }, 700);

      span.onclick = function() {
        modal.style.display = "none";
      }
      window.onclick = function(event) 
      {
        if (event.target == modal) {
            modal.style.display = "none";
        }
      }
    }
    if (json.result === "success") {
        // в случае успеха
        if (json.type === "main-form")
        {
          document.getElementsByClassName("form__input")[0].value='';
          document.getElementsByClassName("form__input")[1].value='';
          document.getElementsByClassName("form__textarea")[0].value='';
        }
        if (json.type === "sub-form")
        {
          document.getElementsByClassName("email-block__input")[0].value='';
        }

        const modal = document.getElementById('modal-feedback--success');
        const span = document.getElementsByClassName("modal__close")[0];
        
        modal.style.display = "block";
  
        span.onclick = function() {
          modal.style.display = "none";
        }
        window.onclick = function(event) 
        {
          if (event.target == modal) {
              modal.style.display = "none";
          }
        }    
      } 
      if (json.result === "error") { 
        // в случае ошибки
        console.log(json);
        throw (json.info);
      }
    }
  catch (error) { // обработка ошибки
    console.log(error);
    const modal = document.getElementById('modal-feedback--error');
    const span = document.getElementsByClassName("modal__close")[1];
    
    setTimeout(function()
    {
      modal.style.display = "block";
    }, 700);

    span.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) 
    {
      if (event.target == modal) {
          modal.style.display = "none";
      }
    }
  }
}
