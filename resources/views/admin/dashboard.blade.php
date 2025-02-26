<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering Kita Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/lucide.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background-color: #f3f4f6;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 20px 0;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .stat-icon {
            padding: 10px;
            border-radius: 10px;
            color: white;
        }

        .stat-icon.income {
            background-color: #22c55e;
        }

        .stat-icon.expense {
            background-color: #f97316;
        }

        .stat-icon.orders {
            background-color: #3b82f6;
        }

        .stat-info h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .stat-info .value {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: 300px;
        }

        .transactions {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .transactions h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .transaction-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .transaction-date {
            font-size: 12px;
            color: #666;
        }

        .income {
            color: #22c55e;
        }

        .expense {
            color: #f97316;
        }
    </style>
</head>

<body>
    <x-sidebar></x-sidebar>

    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Dashboard</h1>
            <div class="admin-profile">
                <span>Admin</span>
                <img src="{{ asset('assets/profil.png') }}" alt="Admin" class="admin-avatar">
            </div>
        </div>

        <div class="header">
            <h2>Halo Admin Selamat Datang</h2>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon income">
                    <i data-lucide="trending-up"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Pendapatan</h3>
                    <div class="value" id="total-income">Rp. 12,500,000</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon expense">
                    <i data-lucide="trending-down"></i>
                </div>
                <div class="stat-info">
                    <h3>Total Pengeluaran</h3>
                    <div class="value" id="total-expense">Rp. 10,000,000</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orders">
                    <i data-lucide="shopping-bag"></i>
                </div>
                <div class="stat-info">
                    <h3>Pesanan Hari Ini</h3>
                    <div class="value" id="total-orders">10</div>
                </div>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="incomeChart">
                <script>
                    // Initialize Lucide icons
                    lucide.createIcons();

                    // Chart Configuration
                    const ctx = document.getElementById('incomeChart').getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
                            datasets: [{
                                    label: 'Background',
                                    data: Array(12).fill(6),
                                    backgroundColor: 'rgba(229, 231, 235, 0.3)',
                                    borderWidth: 0,
                                    barPercentage: 0.6,
                                },
                                {
                                    label: 'Pendapatan',
                                    data: [1, 2, 2.5, 0.5, 1.5, 2, 1, 0.5, 1.5, 0.5, 1.5, 2],
                                    backgroundColor: '#4F46E5',
                                    borderWidth: 0,
                                    barPercentage: 0.6,
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Pendapatan',
                                    align: 'start',
                                    font: {
                                        size: 16,
                                        weight: 'normal'
                                    },
                                    padding: {
                                        bottom: 30
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    max: 6,
                                    ticks: {
                                        stepSize: 1,
                                        callback: function(value) {
                                            return value + 'k';
                                        }
                                    },
                                    grid: {
                                        borderDash: [2, 2]
                                    }
                                }
                            }
                        }
                    });
                </script>
            </canvas>
        </div>

        <div class="transactions">
            <h3>Transaksi Terbaru</h3>
            <div id="transaction-list"></div>
        </div>
    </div>

    <script>
        // Initialize transactions
        const transactions = [{
                type: 'expense',
                description: 'Bahan Baku',
                amount: 2500000,
                date: '2025-02-21'
            },
            {
                type: 'income',
                description: 'Pendapatan Catering',
                amount: 2500000,
                date: '2025-02-21'
            },
            {
                type: 'expense',
                description: 'Biaya opsional',
                amount: 2500000,
                date: '2025-02-21'
            },
            {
                type: 'income',
                description: 'Pendapatan Hari ini',
                amount: 2500000,
                date: '2025-02-21'
            }
        ];

        // Render transactions
        function renderTransactions() {
            const list = document.getElementById('transaction-list');
            list.innerHTML = transactions.map(transaction => `
                <div class="transaction-item">
                    <div class="transaction-info">
                        <strong>${transaction.description}</strong>
                        <span class="transaction-date">${transaction.date}</span>
                    </div>
                    <div class="${transaction.type === 'income' ? 'income' : 'expense'}">
                        ${transaction.type === 'income' ? '+' : '-'}Rp. ${transaction.amount.toLocaleString()}
                    </div>
                </div>
            `).join('');
        }

        // Initial render
        renderTransactions();
    </script>
</body>

</html>
