var especieperro = document.getElementById("especiesgraphicdog");
var especieperro = especieperro.textContent;
var especieperro = especieperro.split(' ').pop();

var especiegato = document.getElementById("especiesgraphiccat");
var especiegato = especiegato.textContent;
var especiegato = especiegato.split(' ').pop();

var especieconejo = document.getElementById("especiesgraphicbunny");
var especieconejo = especieconejo.textContent;
var especieconejo = especieconejo.split(' ').pop();

var especiehamster = document.getElementById("especiesgraphichamster");
var especiehamster = especiehamster.textContent;
var especiehamster = especiehamster.split(' ').pop();

var especieserpiente = document.getElementById("especiesgraphicsnake");
var especieserpiente = especieserpiente.textContent;
var especieserpiente = especieserpiente.split(' ').pop();

var especietortuga = document.getElementById("especiesgraphicturthe");
var especietortuga = especietortuga.textContent;
var especietortuga = especietortuga.split(' ').pop();

var especiegotro = document.getElementById("especiesgraphicother");
var especiegotro = especiegotro.textContent;
var especiegotro = especiegotro.split(' ').pop();

var xValues = ["Perro/Dog", "Gato/Cat", "Conejo/Bunny", "Hamster", "Serpiente/Snake","Tortuga/Tortoise","Otro/Other"];
var yValues = [especieperro, especiegato, especieconejo, especiehamster, especieserpiente,especietortuga,especiegotro];
var barColors = ["red", "purple","blue","orange","brown", "palevioletred","green"];


new Chart("ChartSpecies", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: false,
    },
    scales: {
            xAxes: [{
                ticks: {
                    display: false //this will remove only the label
                }
            }]
        }
  }
});


var generohombre = document.getElementById("gendergraphichombre");
var generohombre = generohombre.textContent;
var generohombre = generohombre.split(' ').pop();

var generomujer = document.getElementById("gendergraphicmujer");
var generomujer = generomujer.textContent;
var generomujer = generomujer.split(' ').pop();

var generonobinario = document.getElementById("gendergraphicnobinario");
var generonobinario = generonobinario.textContent;
var generonobinario = generonobinario.split(' ').pop();

var generootro = document.getElementById("gendergraphicotro");
var generootro = generootro.textContent;
var generootro = generootro.split(' ').pop();

var xValues = ["Hombre/Man", "Mujer/Woman", "No binario/No binary", "Otro/Other"];
var yValues = [generohombre, generomujer, generonobinario, generootro];
var barColors = ["red", "purple","blue","orange"];


new Chart("ChartGender", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: false,
    },
    scales: {
            xAxes: [{
                ticks: {
                    display: false //this will remove only the label
                }
            }]
        }
  }
});

var menostreinta = document.getElementById("edadgraphicmenostreinta");
var menostreinta = menostreinta.textContent;
var menostreinta = menostreinta.split(' ').pop();

var entretreintaysesenta = document.getElementById("edadgraphictreintasesenta");
var entretreintaysesenta = entretreintaysesenta.textContent;
var entretreintaysesenta = entretreintaysesenta.split(' ').pop();

var agemassesenta = document.getElementById("edadgraphicmenosmassesenta");
var agemassesenta = agemassesenta.textContent;
var agemassesenta = agemassesenta.split(' ').pop();

var xValues = ["-30", "30-60", "+60"];
var yValues = [menostreinta, entretreintaysesenta, agemassesenta];
var barColors = ["red", "purple","blue"];


new Chart("ChartAge", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: false,
    },
    scales: {
            xAxes: [{
                ticks: {
                    display: false //this will remove only the label
                }
            }]
        }
  }
});

var nohhijo = document.getElementById("hijosgraphicno");
var nohhijo = nohhijo.textContent;
var nohhijo = nohhijo.split(' ').pop();

var unhijo = document.getElementById("hijosgraphicuno");
var unhijo = unhijo.textContent;
var unhijo = unhijo.split(' ').pop();

var doshijo = document.getElementById("hijosgraphicdos");
var doshijo = doshijo.textContent;
var doshijo = doshijo.split(' ').pop();

var masdoshijo = document.getElementById("hijosgraphicmasdos");
var masdoshijo = masdoshijo.textContent;
var masdoshijo = masdoshijo.split(' ').pop();

var xValues = ["0","1", "2", "+2"];
var yValues = [nohhijo, unhijo, doshijo,masdoshijo];
var barColors = ["red", "purple","blue","orange"];


new Chart("ChartChildren", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: false,
    },
    scales: {
            xAxes: [{
                ticks: {
                    display: false //this will remove only the label
                }
            }]
        }
  }
});