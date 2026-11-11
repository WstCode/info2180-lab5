window.addEventListener('DOMContentLoaded', () => {
  const countryBtn = document.getElementById('lookup');
  const citiesBtn = document.getElementById('lookup-cities');
  const countryInput = document.getElementById('country');
  const result = document.getElementById('result');

  function doLookup(type) {
    const country = countryInput.value.trim();
    let url = `world.php?country=${encodeURIComponent(country)}`;

    if (type === 'cities') {
      url += '&lookup=cities';
    }

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
  }

  countryBtn.addEventListener('click', () => doLookup('country'));
  citiesBtn.addEventListener('click', () => doLookup('cities'));
});