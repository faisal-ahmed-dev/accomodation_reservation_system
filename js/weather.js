document.getElementById('city').addEventListener('input', function () {
    var city = this.value;
    getWeather(city);
  });
  
  async function getWeather() {
    try {
        var city = document.getElementById('city').value;
  
        const response = await axios.get('https://api.openweathermap.org/data/2.5/forecast', {
            params: {
                q: city,
                appid: '286166c084c24d364889715afa2cc952',
                units: 'metric'
            },
        });
        const currentTemperature = response.data.list[0].main.temp;
        

        document.querySelector('.weather-temp').textContent = Math.round(currentTemperature) + 'ºC';
  
        const forecastData = response.data.list;



        const dailyForecast = {};
        forecastData.forEach((data) => {
            const day = new Date(data.dt * 1000).toLocaleDateString('en-US', { weekday: 'long' });
            if (!dailyForecast[day]) {
                dailyForecast[day] = {
                    minTemp: data.main.temp_min,
                    maxTemp: data.main.temp_max,
                    id:data.id,
                    description: data.weather[0].description,
                    humidity: data.main.humidity,
                    windSpeed: data.wind.speed,
                    icon: data.weather[0].icon,
  
  
                };
            } else {
                dailyForecast[day].minTemp = Math.min(dailyForecast[day].minTemp, data.main.temp_min);
                dailyForecast[day].maxTemp = Math.max(dailyForecast[day].maxTemp, data.main.temp_max);
            }
        });
  
        document.querySelector('.date-dayname').textContent = new Date().toLocaleDateString('en-US', { weekday: 'long' });
  
        const date = new Date().toUTCString();
        const extractedDateTime = date.slice(5, 16);
        document.querySelector('.date-day').textContent = extractedDateTime.toLocaleString('en-US');
  
        const currentWeatherIconCode = dailyForecast[new Date().toLocaleDateString('en-US', { weekday: 'long' })].icon;
        const weatherIconElement = document.querySelector('.weather-icon');
        weatherIconElement.innerHTML = getWeatherIcon(currentWeatherIconCode);
  
        document.querySelector('.location').textContent = response.data.city.name;
        document.querySelector('.weather-desc').textContent = dailyForecast[new Date().toLocaleDateString('en-US', { weekday: 'long' })].description.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
  
        document.querySelector('.humidity .value').textContent = dailyForecast[new Date().toLocaleDateString('en-US', { weekday: 'long' })].humidity + ' %';
        document.querySelector('.wind .value').textContent = dailyForecast[new Date().toLocaleDateString('en-US', { weekday: 'long' })].windSpeed + ' m/s';
  
  
        const dayElements = document.querySelectorAll('.day-name');
        const tempElements = document.querySelectorAll('.day-temp');
        const iconElements = document.querySelectorAll('.day-icon');
  
        dayElements.forEach((dayElement, index) => {
            const day = Object.keys(dailyForecast)[index];
            const data = dailyForecast[day];
            dayElement.textContent = day;
            tempElements[index].textContent = `${Math.round(data.minTemp)}º / ${Math.round(data.maxTemp)}º`;
            iconElements[index].innerHTML = getWeatherIcon(data.icon);
        });
  
    } catch (error) {
        console.error('error:', error.message);
    }
  }
  
  function getWeatherIcon(iconCode) {
    try {
        const iconBaseUrl = 'https://openweathermap.org/img/wn/';
        const iconSize = '@2x.png';
        const iconUrl = `${iconBaseUrl}${iconCode}${iconSize}`;
        return `<img src="${iconUrl}" alt="Weather Icon">`;
    } catch (error) {
        console.error('Error generating weather icon:', error.message);
        return ''; 
    }
}
  document.addEventListener("DOMContentLoaded", function () {
    getWeather();
    setInterval(getWeather, 900000);
  });
  