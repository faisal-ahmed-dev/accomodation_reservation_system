let navbar = document.querySelector('.header .flex .nav_bar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

let mainImage = document.querySelector('.update-product .image-container .main-image img');
let subImages = document.querySelectorAll('.update-product .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});




var options = {
   series: [{
   name: 'Net Profit',
   data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
 }, {
   name: 'Revenue',
   data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
 }, {
   name: 'Expense',
   data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
 }],
   chart: {
   type: 'bar',
   height: 350
 },
 plotOptions: {
   bar: {
     horizontal: false,
     columnWidth: '55%',
     endingShape: 'rounded'
   },
 },
 dataLabels: {
   enabled: false
 },
 stroke: {
   show: true,
   width: 2,
   colors: ['transparent']
 },
 xaxis: {
   categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
 },
 yaxis: {
   title: {
     text: '$ (thousands)'
   }
 },
 fill: {
   opacity: 1
 },
 tooltip: {
   y: {
     formatter: function (val) {
       return "$ " + val + " thousands"
     }
   }
 }
 };

 var chart = new ApexCharts(document.querySelector("#bar-chart"), options);
 chart.render();





 