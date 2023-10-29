

document.getElementById('sendData').addEventListener('click', function() {
  const data = {
      name: 'John Doe',
      email: 'johndoe@example.com'
  };

  fetch('./php/profile.php', {
      method: 'POST',
      body: JSON.stringify(data),
      headers: {
          'Content-Type': 'application/json'
      }
  })
  .then(response => response.text())
  .then(result => console.log(result))
  .catch(error => console.error(error));
});
