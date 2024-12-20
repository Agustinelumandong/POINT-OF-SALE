!(function (e) {
    "use strict";
    function a() {}
    (a.prototype.createStackedChart = function (a, t, e, s, r, o) {
        Morris.Bar({
            element: a,
            data: t,
            dataLabels: !1,
            xkey: e,
            ykeys: s,
            stacked: !0,
            labels: r,
            hideHover: "auto",
            resize: !0,
            gridLineColor: "rgba(65, 80, 95, 0.07)",
            barSizeRatio: 0.2,
            barColors: o,
        });
    }),
        (a.prototype.init = function () {
            var a = ["#4a81d4", "#e3eaef"],
                t = e("#leads-statics").data("colors");
            t && (a = t.split(",")),
                this.createStackedChart(
                    "leads-statics",
                    [
                        { y: "2012", a: 75, b: 65 },
                        { y: "2013", a: 50, b: 40 },
                        { y: "2014", a: 75, b: 65 },
                        { y: "2015", a: 50, b: 40 },
                        { y: "2016", a: 75, b: 65 },
                        { y: "2017", a: 100, b: 90 },
                        { y: "2018", a: 80, b: 65 },
                    ],
                    "y",
                    ["a", "b"],
                    ["Won Leads", "Lost Leads"],
                    a
                );
        }),
        (e.LeadsCharts = new a()),
        (e.LeadsCharts.Constructor = a);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.LeadsCharts.init();
    })();
