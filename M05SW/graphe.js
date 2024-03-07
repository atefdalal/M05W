function Graph(x,y) {
const ctx = document.getElementById("monGraphe");
new Chart(ctx, {
    type: "line",
    data: {
    labels: x,
    datasets: [{
    label: "km/h",
    data: y,
    borderWidth: 1
    }]
},
});
}
var x=[];var y=[];
for (let i =0; i < 100; i++){
    x[i]=i;
    y[i]=10*i;
}
Graph(x,y);