const months = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
const colors = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
const defaultValue = [0,0,0,0,0,0,0,0,0,0];
const myChart = {
    loadG1: () => {
        $.ajax({
            url:"api/sales.php",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            type: 'POST',
            data: {},
            success: (data) => {
                data = JSON.parse(data);
                console.log("SALES", data);
                data.map(row => {
                    defaultValue[row.month - 1] = row.total_price
                })

                new Chart(
                    document.getElementById('acquisitions'),
                    {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [
                            {
                                label: 'Sales per month',
                                data: defaultValue
                            }
                            ],
                            backgroundColor: [
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(153, 102, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 205, 86)'
                            ],
                            borderWidth: 1
                        },
                        options: {
                          scales: {
                            y: {
                              beginAtZero: true
                            }
                          }
                        },
                    },
                    
                );
                
            }
        });
    
        
    }
}
setTimeout(() => {
    myChart.loadG1();
}, 2000);