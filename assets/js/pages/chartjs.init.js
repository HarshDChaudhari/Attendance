function getChartColorsArray(r) {
  if (null !== document.getElementById(r)) {
    var o =
        "data-colors" +
        ("-" + document.documentElement.getAttribute("data-theme") ?? ""),
      o =
        document.getElementById(r).getAttribute(o) ??
        document.getElementById(r).getAttribute("data-colors");
    if (o)
      return (o = JSON.parse(o)).map(function (r) {
        var o = r.replace(" ", "");
        return -1 === o.indexOf(",")
          ? getComputedStyle(document.documentElement).getPropertyValue(o) || o
          : 2 == (r = r.split(",")).length
          ? "rgba(" +
            getComputedStyle(document.documentElement).getPropertyValue(r[0]) +
            "," +
            r[1] +
            ")"
          : o;
      });
    console.warn("data-colors attributes not found on", r);
  }
}
(Chart.defaults.borderColor = "rgba(133, 141, 152, 0.1)"),
  (Chart.defaults.color = "#858d98");
var pieChart,
  ispiechart = document.getElementById("pieChart")(
    (pieChartColors = getChartColorsArray("pieChart")) &&
      (pieChart = new Chart(ispiechart, {
        type: "pie",
        data: {
          labels: ["Desktops", "Tablets"],
          datasets: [
            {
              data: [300, 180],
              backgroundColor: pieChartColors,
              hoverBackgroundColor: pieChartColors,
              hoverBorderColor: "#fff",
            },
          ],
        },
        options: {
          plugins: { legend: { labels: { font: { family: "Poppins" } } } },
        },
      }))
  );
