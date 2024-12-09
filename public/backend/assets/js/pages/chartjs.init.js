function hexToRGB(a, r) {
    var e = parseInt(a.slice(1, 3), 16),
        t = parseInt(a.slice(3, 5), 16),
        o = parseInt(a.slice(5, 7), 16);
    return r
        ? "rgba(" + e + ", " + t + ", " + o + ", " + r + ")"
        : "rgb(" + e + ", " + t + ", " + o + ")";
}
!(function (d) {
    "use strict";
    function a() {
        (this.$body = d("body")), (this.charts = []);
    }
    (a.prototype.respChart = function (r, e, t, o) {
        var n = r.get(0).getContext("2d"),
            l = d(r).parent();
        return (
            (Chart.defaults.global.defaultFontColor = "#8391a2"),
            (Chart.defaults.scale.gridLines.color = "#8391a2"),
            (function () {
                var a;
                switch ((r.attr("width", d(l).width()), e)) {
                    case "Line":
                        a = new Chart(n, { type: "line", data: t, options: o });
                        break;
                    case "Doughnut":
                        a = new Chart(n, {
                            type: "doughnut",
                            data: t,
                            options: o,
                        });
                        break;
                    case "Pie":
                        a = new Chart(n, { type: "pie", data: t, options: o });
                        break;
                    case "Bar":
                        a = new Chart(n, { type: "bar", data: t, options: o });
                        break;
                    case "Radar":
                        a = new Chart(n, {
                            type: "radar",
                            data: t,
                            options: o,
                        });
                        break;
                    case "PolarArea":
                        a = new Chart(n, {
                            data: t,
                            type: "polarArea",
                            options: o,
                        });
                }
                return a;
            })()
        );
    }),
        (a.prototype.initCharts = function () {
            var a,
                r,
                e,
                t,
                o,
                n,
                l,
                s,
                i = [],
                c = ["#1abc9c", "#f1556c", "#4a81d4", "#e3eaef"];
            return (
                0 < d("#line-chart-example").length &&
                    ((a = {
                        labels: [
                            "Mon",
                            "Tue",
                            "Wed",
                            "Thu",
                            "Fri",
                            "Sat",
                            "Sun",
                        ],
                        datasets: [
                            {
                                label: "Current Week",
                                backgroundColor: hexToRGB(
                                    (l = (n = d("#line-chart-example").data(
                                        "colors"
                                    ))
                                        ? n.split(",")
                                        : c.concat())[0],
                                    0.3
                                ),
                                borderColor: l[0],
                                data: [32, 42, 42, 62, 52, 75, 62],
                            },
                            {
                                label: "Previous Week",
                                fill: !0,
                                backgroundColor: "transparent",
                                borderColor: l[1],
                                borderDash: [5, 5],
                                data: [42, 58, 66, 93, 82, 105, 92],
                            },
                        ],
                    }),
                    i.push(
                        this.respChart(d("#line-chart-example"), "Line", a, {
                            maintainAspectRatio: !1,
                            legend: { display: !1 },
                            tooltips: { intersect: !1 },
                            hover: { intersect: !0 },
                            plugins: { filler: { propagate: !1 } },
                            scales: {
                                xAxes: [
                                    {
                                        reverse: !0,
                                        gridLines: {
                                            color: "rgba(0,0,0,0.05)",
                                        },
                                    },
                                ],
                                yAxes: [
                                    {
                                        ticks: { stepSize: 20 },
                                        display: !0,
                                        borderDash: [5, 5],
                                        gridLines: {
                                            color: "rgba(0,0,0,0)",
                                            fontColor: "#fff",
                                        },
                                    },
                                ],
                            },
                        })
                    )),
                0 < d("#bar-chart-example").length &&
                    ((r = {
                        labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec",
                        ],
                        datasets: [
                            {
                                label: "Sales Analytics",
                                backgroundColor: (l = (n =
                                    d("#bar-chart-example").data("colors"))
                                    ? n.split(",")
                                    : c.concat())[0],
                                borderColor: l[0],
                                hoverBackgroundColor: l[0],
                                hoverBorderColor: l[0],
                                data: [
                                    65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80,
                                    81,
                                ],
                            },
                            {
                                label: "Dollar Rate",
                                backgroundColor: l[1],
                                borderColor: l[1],
                                hoverBackgroundColor: l[1],
                                hoverBorderColor: l[1],
                                data: [
                                    89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 65,
                                    59,
                                ],
                            },
                        ],
                    }),
                    i.push(
                        this.respChart(d("#bar-chart-example"), "Bar", r, {
                            maintainAspectRatio: !1,
                            legend: { display: !1 },
                            scales: {
                                yAxes: [
                                    {
                                        gridLines: { display: !1 },
                                        stacked: !1,
                                        ticks: { stepSize: 20 },
                                    },
                                ],
                                xAxes: [
                                    {
                                        barPercentage: 0.7,
                                        categoryPercentage: 0.5,
                                        stacked: !1,
                                        gridLines: {
                                            color: "rgba(0,0,0,0.01)",
                                        },
                                    },
                                ],
                            },
                        })
                    )),
                0 < d("#pie-chart-example").length &&
                    ((e = {
                        labels: ["Direct", "Affilliate", "Sponsored", "E-mail"],
                        datasets: [
                            {
                                data: [300, 135, 48, 154],
                                backgroundColor: (l = (n =
                                    d("#pie-chart-example").data("colors"))
                                    ? n.split(",")
                                    : c.concat()),
                                borderColor: "transparent",
                            },
                        ],
                    }),
                    i.push(
                        this.respChart(d("#pie-chart-example"), "Pie", e, {
                            maintainAspectRatio: !1,
                            legend: { display: !1 },
                        })
                    )),
                0 < d("#donut-chart-example").length &&
                    ((t = {
                        labels: ["Direct", "Affilliate", "Sponsored"],
                        datasets: [
                            {
                                data: [128, 78, 48],
                                backgroundColor: (l = (n = d(
                                    "#donut-chart-example"
                                ).data("colors"))
                                    ? n.split(",")
                                    : c.concat()),
                                borderColor: "transparent",
                                borderWidth: "3",
                            },
                        ],
                    }),
                    i.push(
                        this.respChart(
                            d("#donut-chart-example"),
                            "Doughnut",
                            t,
                            {
                                maintainAspectRatio: !1,
                                cutoutPercentage: 60,
                                legend: { display: !1 },
                            }
                        )
                    )),
                0 < d("#polar-chart-example").length &&
                    ((o = {
                        labels: ["Direct", "Affilliate", "Sponsored", "E-mail"],
                        datasets: [
                            {
                                data: [251, 135, 48, 154],
                                backgroundColor: (l = (n = d(
                                    "#polar-chart-example"
                                ).data("colors"))
                                    ? n.split(",")
                                    : c.concat()),
                                borderColor: "transparent",
                            },
                        ],
                    }),
                    i.push(
                        this.respChart(
                            d("#polar-chart-example"),
                            "PolarArea",
                            o
                        )
                    )),
                0 < d("#radar-chart-example").length &&
                    ((s = {
                        labels: [
                            "Eating",
                            "Drinking",
                            "Sleeping",
                            "Designing",
                            "Coding",
                            "Cycling",
                            "Running",
                        ],
                        datasets: [
                            {
                                label: "Desktops",
                                backgroundColor: hexToRGB(
                                    (l = (n = d("#radar-chart-example").data(
                                        "colors"
                                    ))
                                        ? n.split(",")
                                        : c.concat())[0],
                                    0.3
                                ),
                                borderColor: l[0],
                                pointBackgroundColor: l[0],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: l[0],
                                data: [65, 59, 90, 81, 56, 55, 40],
                            },
                            {
                                label: "Tablets",
                                backgroundColor: hexToRGB(l[1], 0.3),
                                borderColor: l[1],
                                pointBackgroundColor: l[1],
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: l[1],
                                data: [28, 48, 40, 19, 96, 27, 100],
                            },
                        ],
                    }),
                    i.push(
                        this.respChart(d("#radar-chart-example"), "Radar", s, {
                            maintainAspectRatio: !1,
                        })
                    )),
                i
            );
        }),
        (a.prototype.init = function () {
            var r = this;
            (Chart.defaults.global.defaultFontFamily = "Nunito,sans-serif"),
                (r.charts = this.initCharts()),
                d(window).on("resize", function (a) {
                    d.each(r.charts, function (a, r) {
                        try {
                            r.destroy();
                        } catch (a) {}
                    }),
                        (r.charts = r.initCharts());
                });
        }),
        (d.ChartJs = new a()),
        (d.ChartJs.Constructor = a);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.ChartJs.init();
    })();
