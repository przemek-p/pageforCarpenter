<?php
// Sprawdzamy, czy użytkownik wysłał formularz
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobieramy dane z formularza
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);
    $consent = $_POST['consent'];

    // Walidujemy dane
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Proszę wypełnić wszystkie pola formularza i upewnić się, że adres email jest prawidłowy.";
        exit;
    }

    // Adres email, na który wysyłamy wiadomość
    $recipient = "biuro@stolarzmateusz.pl";

    // Temat wiadomości
    $subject = "Nowa wiadomosc z formularza kontaktowego MD Meble od $name";

    // Treść wiadomości
    $email_content = "Imię i nazwisko: $name\n";
    $email_content .= "Adres email: $email\n\n";
    $email_content .= "Wiadomość:\n$message\n";
    $email_content .= "Wyrażam zgodę na przetwarzanie danych osobowych: " . ($consent ? 'Tak' : 'Nie') . "";

    // Nagłówki wiadomości
    $email_headers = "From: $name <$email>";

    // Wysyłamy wiadomość
    if (mail($recipient, $subject, $email_content, $email_headers)) {
    // Wyświetlanie komunikatu jako powiadomienie przeglądarki
    echo "<script>
            window.onload = function() {
              if ('Notification' in window && Notification.permission === 'granted') {
                new Notification('Dziękujemy za wiadomość!');
              } else {
                alert('Dziękujemy za wiadomość!');
              }
            }
          </script>";
  } else {
    http_response_code(500);
    echo "Coś poszło nie tak i nie udało się wysłać wiadomości. Proszę spróbować ponownie później.";
  }
} else {
  http_response_code(403);
  echo "Wystąpił błąd podczas przetwarzania formularza. Proszę spróbować ponownie później.";
}
