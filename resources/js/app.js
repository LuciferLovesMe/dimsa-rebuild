import "./bootstrap";
import Chart from "chart.js/auto";

// chart tren pengunjung harian
document.addEventListener("DOMContentLoaded", () => {
    const chartEl = document.getElementById("dailyVisitorChart");
    if (chartEl) {
        new Chart(chartEl.getContext("2d"), {
            type: "line",
            data: {
                labels: ["01", "02", "03", "04", "05", "06", "07"],
                datasets: [
                    {
                        label: "Pengunjung",
                        data: [30, 19, 14, 20, 16, 22, 18],
                        borderColor: "#051244",
                        backgroundColor: "rgba(37, 99, 235, 0.1)",
                        fill: false,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: "#051244",
                    },
                    {
                        label: "Halaman Dilihat",
                        data: [50, 40, 35, 60, 45, 70, 55],
                        borderColor: "#38bdf8",
                        backgroundColor: "rgba(56, 189, 248, 0.1)",
                        fill: false,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: "#38bdf8",
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                            boxWidth: 20,
                            padding: 15,
                        },
                    },
                },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true },
                },
            },
        });
    }

    // Chart tipe pengguna (donut)
    const userTypeEl = document.getElementById("userTypeChart");
    if (userTypeEl) {
        new Chart(userTypeEl.getContext("2d"), {
            type: "doughnut",
            data: {
                labels: ["Pengunjung Baru", "Pengunjung Lama"],
                datasets: [
                    {
                        data: [60, 30],
                        backgroundColor: ["#2563eb", "#38bdf8"],
                        borderWidth: 2,
                        borderColor: "#fff",
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: "bottom",
                    },
                },
            },
        });
    }
});
