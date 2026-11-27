'use strict';

flatpickr('#expiry_date', {
  enableTime: false,
  dateFormat: "Y-m-d",
  locale: "ru"
});

const form = document.querySelector('.form--add-lot');

if (form) {
  form.addEventListener('input', (evt) => {
    const item = evt.target.closest('.form__item--invalid');
    if (item) {
      item.classList.remove('form__item--invalid');
    }
  });

  form.addEventListener('change', (evt) => {
    const item = evt.target.closest('.form__item--invalid');
    if (item) {
      item.classList.remove('form__item--invalid');
    }
  });
}
