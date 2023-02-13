window.addEventListener('load', () => {
  let long;
  let lat;
  let locationTimezone = document.querySelector(".location-timezone");
  let temperatureDegree = document.querySelector(".temperature-degree");
  let temperatureDescription = document.querySelector(".temperature-description");
  let weatherIcon = document.querySelector(".icon");
  let degreeSection = document.querySelector(".degree-section");
  let degreeSectionSpan = document.querySelector(".degree-section span");
  let timeSunrise = document.querySelector(".time-sunrise");
  let timeSunset = document.querySelector(".time-sunset");
  if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(position => {
      long = position.coords.longitude;
      lat = position.coords.latitude;
      const api = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${long}&appid=10a7a57c4e4fd09fbfd00a3d706c125f&units=metric`;
      fetch(api)  //ネットワークからリソースを取得するプロセスを開始
      .then(response => {  //前のプロセスが行われてから次のプロセスを行う
        return response.json();
      })
      .then(data => {
        console.log(data);
        const temperature = data.main.temp;
        const timezone = data.sys.country + " / " + data.name;
        const description = data.weather[0].description;
        const iconID = data.weather[0].icon;
        const iconURL =  `http://openweathermap.org/img/wn/${iconID}@2x.png`;
        const sunrise = new Date(data.sys.sunrise * 1000);
        const sunset = new Date(data.sys.sunset * 1000);
        locationTimezone.textContent = timezone;
        temperatureDegree.textContent = temperature;
        temperatureDescription.textContent = description;
        weatherIcon.src = iconURL;
        timeSunrise.textContent = sunrise.getHours() + " : " + sunrise.getMinutes();
        timeSunset.textContent = sunset.getHours() + " : " + sunset.getMinutes();
        //温度の関数
        let fahrenheit = (temperature * 1.8 + 32);
        degreeSection.addEventListener('click', () => {
          if(degreeSectionSpan.textContent === "°C"){
            degreeSectionSpan.textContent = "°F";
            temperatureDegree.textContent = Math.floor(fahrenheit * 100) / 100;
          }else{
            degreeSectionSpan.textContent = "°C";
            temperatureDegree.textContent = temperature;
          }
        });
      });
    });
  };
});