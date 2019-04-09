$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "statsreturn.php",
        data: dataToSend,
        success: function(data) {
            location.reload();   
        }
    });
    var ct1 = document.getElementById('chart1').getContext('2d');
    var chart1 = new Chart(ct1, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                data: [0, 10, 5, 2, 20, 30, 45],
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3cba9f","#e8c3b9"],
            }]
        },
        options: {}
    });

    var ct3 = document.getElementById('totalPostsDistribution').getContext('2d');
    var chart3 = new Chart(ct2, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                data: [0, 10, 5, 2, 20, 30, 45],
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3cba9f","#e8c3b9"],
            }]
        },
        options: {}
    });
});