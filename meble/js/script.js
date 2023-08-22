document.getElementById('contact-form').addEventListener('submit', function(event) {
  event.preventDefault(); // Zapobieganie domyślnej akcji przesyłania formularza

  var form = event.target;
  var formData = new FormData(form);

  var xhr = new XMLHttpRequest();
  xhr.open(form.method, form.action, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Wyświetlanie komunikatu jako powiadomienie przeglądarki
      if ('Notification' in window && Notification.permission === 'granted') {
        new Notification('Dziękujemy za wiadomość!');
      } else {
        alert('Dziękujemy za wiadomość!');
      }
      form.reset(); // Wyczyszczenie formularza
    } else if (xhr.readyState === XMLHttpRequest.DONE && xhr.status !== 200) {
      alert('Coś poszło nie tak i nie udało się wysłać wiadomości. Proszę spróbować ponownie później.');
    }
  };
  xhr.send(formData);
});