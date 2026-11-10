window.addEventListener('DOMContentLoaded', () => {
  const lookupBtn = document.getElementById('lookup');
  const countryInput = document.getElementById('country');
  const result = document.getElementById('result');

  lookupBtn.addEventListener('click', () => {
    const country = countryInput.value.trim();
    const url = `world.php?country=${encodeURIComponent(country)}`;

    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error(`Request failed with status ${response.status}`);
        }
        return response.text();
      })
      .then(data => {
        result.innerHTML = data;
      })
      .catch(error => {
        result.textContent = 'Sorry, something went wrong. Please try again.';
        console.error(error);
      });
  });
});