// CENTAL OFFICE CHART JS
	var coch = document.getElementById("centralCHART");
	var myDoughnutChart = new Chart(coch, {
	    type: 'pie',
	    width: 200,
	    height: 200,
	    data: {
	        labels: ["For Director's Approval", "On-Going (M&E)", "Due", "Closed", "No. of no Audit Entry"],
	        datasets: [{
	            label: '# of Votes',
	            data: [12, 19, 3, 5, 4],
	            backgroundColor: [
	                '#FF6384',
	                '#36A2EB',
	                '#FFCE56',
	                '#ff4d4d',
	                '#00e673'
	            ],
	            borderWidth: 1
	        }]
	    },
	    options: {
	        responsive: false,
	        legend: {
	        	position: 'right',
	            display: true,
	            labels: {
	                fontColor: 'rgb(255, 99, 132)'
	            }
	        }
	    }
	});


// CENTRAL HIGHCHARTS11
$(document).ready(function(){
    $.ajax({
	    type: 'GET',
	    url: '/get_co_graph',
	    cache: false,
	    success: function (data) {

			Highcharts.chart('container', {
				height: 300,
			    title: {
			         text: 'Summary of Central Office Audit Area'
			    },
			    xAxis: {
			        categories: data.form001
			    }, 
			    yAxis: {
				    min: 0,
				    title: {
				      text: '===================================================='
				    },
				    stackLabels: {
				      enabled: true,
				      style: {
				        fontWeight: 'bold',
				        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
				      }
				    }
				},
				plotOptions: {
						    column: {
						      stacking: 'normal',
						      dataLabels: {
						        enabled: true,
						        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
						      }
						    }
						  },
			    legend: {
				    align: 'right',
				    x: -30,
				    verticalAlign: 'top',
				    y: 25,
				    floating: true,
				    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
				    borderColor: '#CCC',
				    borderWidth: 1,
				    shadow: false
				 },
			    series: [{
			        type: 'column',
			        name: 'Technical Operations',
			        data: [2,8,6,10,data.pesto]
			    }, {
			        type: 'column',
			        name: 'Finance',
			        data: [7,4,2,4,data.pesf]
			    }, {
			        type: 'column',
			        name: 'Administrative Services',
			        data: [4, 6, 2, 7,data.pesas]
			    },  {
			        type: 'pie',
			        name: 'Summary',
			        data: [{
			            name: 'Technical Operations',
			            y: data.pesto + 15,
			            color: Highcharts.getOptions().colors[0] // Jane's color
			        }, {
			            name: 'Finance',
			            y: 23,
			            color: Highcharts.getOptions().colors[1] // John's color
			        }, {
			            name: 'Administrative Services',
			            y: 19,
			            color: Highcharts.getOptions().colors[2] // Joe's color
			        }],
			        center: [50, 20],
			        size: 100,
			        showInLegend: false,
			        dataLabels: {
			            enabled: false
			        }
			    }]
			});
     	}
  	});
});


