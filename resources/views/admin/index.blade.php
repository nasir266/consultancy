@extends('layouts.master')

@section('title','Home page')

@section('tailwind')
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-clifford: #da373d;
        }
    </style>

@endsection
@section('styles')

    <style>
        #mobile-label .flex-wrap{
            flex-wrap: nowrap;
        }
        #mobile-label button{
            font-size: 12px;
        }
    </style>

@endsection

@section('content')
    <section class="grid grid-cols-4 md:grid-cols-4 gap-6 p-6 ">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-500">Gross Sales</p>
            <h3 class="text-2xl font-bold text-blue-600">40,000</h3>
            <p class="text-green-500 text-sm">↑ 80% from last month</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-500">Total Purchase</p>
            <h3 class="text-2xl font-bold text-purple-600">35,000</h3>
            <p class="text-green-500 text-sm">↑ 95% from last month</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-500">Total Income</p>
            <h3 class="text-2xl font-bold text-green-600">30,000</h3>
            <p class="text-red-500 text-sm">↓ 30% from last month</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-500">Total Expense</p>
            <h3 class="text-2xl font-bold text-orange-600">7,000</h3>
            <p class="text-green-500 text-sm">↑ 60% from last month</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-500">TOTAL PARTY</p>
            <h3 class="text-2xl font-bold text-blue-600">{{$total_party}}</h3>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-500">TOTAL ITEMS</p>
            <h3 class="text-2xl font-bold text-blue-600">{{$total_item}}</h3>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-500">TOTAL CITIES</p>
            <h3 class="text-2xl font-bold text-blue-600">{{$total_city}}</h3>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <p class="text-gray-500">TOTAL INVOICE</p>
            <h3 class="text-2xl font-bold text-blue-600">{{$total_invoice}}</h3>
        </div>
    </section>

    <!-- Charts Section -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 pb-6">
        <div class="col-span-2 bg-white p-6 rounded-lg shadow flex flex-col">
            <h3 class="font-semibold mb-4">Income vs Expense</h3>
            <div class="relative h-72">
                <canvas id="incomeExpenseChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow flex flex-col">
            <h3 class="font-semibold mb-4">Overall Report</h3>
            <div class="relative h-72 flex items-center justify-center">
                <canvas id="reportChart"></canvas>
            </div>
        </div>
    </section>

    <!-- Top Suppliers & Customers -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6 pb-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg text-gray-800">Top Suppliers</h3>
                <span class="text-sm text-gray-500">Updated 1 day ago</span>
            </div>

            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="w-full border-collapse text-sm">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-right">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">1</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=1" class="w-6 h-6 rounded-full">
                            Esther Howard
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">30,000</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">2</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=2" class="w-6 h-6 rounded-full">
                            Wade Warren
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">40,000</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">3</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=3" class="w-6 h-6 rounded-full">
                            Jenny Wilson
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">50,000</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">4</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=4" class="w-6 h-6 rounded-full">
                            Kristin Watson
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">60,000</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="py-3 px-4">5</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=5" class="w-6 h-6 rounded-full">
                            Eleanor Pena
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">70,000</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg text-gray-800">Top Users</h3>
                <span class="text-sm text-gray-500">Last 7 days</span>
            </div>

            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">User</th>
                        <th class="py-3 px-4 text-right">Orders</th>
                        <th class="py-3 px-4 text-right">Total Spent</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">1</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=11" class="w-6 h-6 rounded-full">
                            Savannah Nguyen
                        </td>
                        <td class="py-3 px-4 text-right">32</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">15,250</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">2</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=12" class="w-6 h-6 rounded-full">
                            Annette Black
                        </td>
                        <td class="py-3 px-4 text-right">25</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">13,640</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">3</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=13" class="w-6 h-6 rounded-full">
                            Theresa Webb
                        </td>
                        <td class="py-3 px-4 text-right">22</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">12,700</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">4</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=14" class="w-6 h-6 rounded-full">
                            Marvin McKinney
                        </td>
                        <td class="py-3 px-4 text-right">19</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">10,980</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="py-3 px-4">5</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=15" class="w-6 h-6 rounded-full">
                            Brooklyn Simmons
                        </td>
                        <td class="py-3 px-4 text-right">17</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">9,540</td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
        <div class="bg-white p-6 rounded-lg shadow">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg text-gray-800">Top Customers</h3>
                <span class="text-sm text-gray-500">Last 7 days</span>
            </div>

            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Customer</th>
                        <th class="py-3 px-4 text-right">Orders</th>
                        <th class="py-3 px-4 text-right">Total Spent</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">1</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=11" class="w-6 h-6 rounded-full">
                            Savannah Nguyen
                        </td>
                        <td class="py-3 px-4 text-right">32</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">15,250</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">2</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=12" class="w-6 h-6 rounded-full">
                            Annette Black
                        </td>
                        <td class="py-3 px-4 text-right">25</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">13,640</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">3</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=13" class="w-6 h-6 rounded-full">
                            Theresa Webb
                        </td>
                        <td class="py-3 px-4 text-right">22</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">12,700</td>
                    </tr>
                    <tr class="hover:bg-blue-50 border-b">
                        <td class="py-3 px-4">4</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=14" class="w-6 h-6 rounded-full">
                            Marvin McKinney
                        </td>
                        <td class="py-3 px-4 text-right">19</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">10,980</td>
                    </tr>
                    <tr class="hover:bg-blue-50">
                        <td class="py-3 px-4">5</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/24?img=15" class="w-6 h-6 rounded-full">
                            Brooklyn Simmons
                        </td>
                        <td class="py-3 px-4 text-right">17</td>
                        <td class="py-3 px-4 text-right font-semibold text-blue-600">9,540</td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>



    </section>

    <!-- Purchase & Sales + Transactions -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 px-6 pb-10">
        <!-- Bar Chart -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-4">Purchase & Sales</h3>
            <div class="relative h-80">
                <canvas id="purchaseSalesChart"></canvas>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg text-gray-800">Recent Transactions</h3>
                <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">View All</button>
            </div>

            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="w-full text-sm border-collapse">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">#</th>
                        <th class="py-3 px-4 text-left">Date</th>
                        <th class="py-3 px-4 text-left">Customer</th>
                        <th class="py-3 px-4 text-center">Payment Method</th>
                        <th class="py-3 px-4 text-right">Amount</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="py-3 px-4">1</td>
                        <td class="py-3 px-4">01 Nov 2025</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/32?img=31" class="w-6 h-6 rounded-full">
                            <span>Jenny Wilson</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Cash</span>
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-gray-800">350</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Paid</span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <button class="text-blue-600 hover:underline text-xs">View</button>
                            <button class="text-red-600 hover:underline text-xs">Delete</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 border-b">
                        <td class="py-3 px-4">2</td>
                        <td class="py-3 px-4">31 Oct 2025</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/32?img=32" class="w-6 h-6 rounded-full">
                            <span>Robert Fox</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">Bank</span>
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-gray-800">520</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Pending</span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <button class="text-blue-600 hover:underline text-xs">View</button>
                            <button class="text-red-600 hover:underline text-xs">Delete</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 border-b">
                        <td class="py-3 px-4">3</td>
                        <td class="py-3 px-4">29 Oct 2025</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/32?img=33" class="w-6 h-6 rounded-full">
                            <span>Kristin Watson</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700">PayPal</span>
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-gray-800">230</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Paid</span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <button class="text-blue-600 hover:underline text-xs">View</button>
                            <button class="text-red-600 hover:underline text-xs">Delete</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 border-b">
                        <td class="py-3 px-4">4</td>
                        <td class="py-3 px-4">28 Oct 2025</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/32?img=34" class="w-6 h-6 rounded-full">
                            <span>Annette Black</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-pink-100 text-pink-700">Card</span>
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-gray-800">110</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Failed</span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <button class="text-blue-600 hover:underline text-xs">View</button>
                            <button class="text-red-600 hover:underline text-xs">Delete</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4">5</td>
                        <td class="py-3 px-4">27 Oct 2025</td>
                        <td class="py-3 px-4 flex items-center gap-2">
                            <img src="https://i.pravatar.cc/32?img=35" class="w-6 h-6 rounded-full">
                            <span>Guy Hawkins</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">Bank</span>
                        </td>
                        <td class="py-3 px-4 text-right font-semibold text-gray-800">490</td>
                        <td class="py-3 px-4 text-center">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Paid</span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <button class="text-blue-600 hover:underline text-xs">View</button>
                            <button class="text-red-600 hover:underline text-xs">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </section>









    {{--<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>--}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        // Income vs Expense
        new Chart(document.getElementById('incomeExpenseChart'), {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep'],
                datasets: [
                    {
                        label: 'Income',
                        data: [40,35,45,50,60,55,65,70,60],
                        borderColor: '#3b82f6',
                        tension: 0.4,
                        fill: false
                    },
                    {
                        label: 'Expense',
                        data: [20,25,30,28,35,40,38,45,40],
                        borderColor: '#f59e0b',
                        tension: 0.4,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Donut Chart
        new Chart(document.getElementById('reportChart'), {
            type: 'doughnut',
            data: {
                labels: ['Purchase','Sales','Expense','Gross Profit'],
                datasets: [{
                    data: [30,30,20,20],
                    backgroundColor: ['#3b82f6','#8b5cf6','#f59e0b','#10b981']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { position: 'bottom' } }
            }
        });



        // Expense Breakdown (Donut)
        new Chart(document.getElementById('expenseChart'), {
            type: 'doughnut',
            data: {
                labels: ['Rent','Supplies','Utilities','Other'],
                datasets: [{
                    data: [25, 35, 20, 20],
                    backgroundColor: ['#3b82f6','#10b981','#f59e0b','#ef4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Purchase & Sales (Bar)
        new Chart(document.getElementById('purchaseSalesChart'), {
            type: 'bar',
            data: {
                labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
                datasets: [
                    { label: 'Purchase', data: [50,80,60,70,90,50,80], backgroundColor: '#f59e0b' },
                    { label: 'Sales', data: [80,100,90,110,120,80,100], backgroundColor: '#10b981' }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } },
                scales: { y: { beginAtZero: true } }
            }
        });


    </script>
    <script>


        const chartConfig = {
            series: [
                {
                    name: "Sales",
                    data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                },
            ],
            chart: {
                type: "bar",
                height: 240,
                toolbar: {
                    show: false,
                },
            },
            title: {
                show: "",
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#2731F5"],
            plotOptions: {
                bar: {
                    columnWidth: "40%",
                    borderRadius: 2,
                },
            },
            xaxis: {
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                labels: {
                    style: {
                        colors: "blue",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400,
                    },
                },
                categories: [
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
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "blue",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400,
                    },
                },
            },
            grid: {
                show: true,
                borderColor: "#dddddd",
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true,
                    },
                },
                padding: {
                    top: 5,
                    right: 20,
                },
            },
            fill: {
                opacity: 0.8,
            },
            tooltip: {
                theme: "dark",
            },
        };

        const chart = new ApexCharts(document.querySelector("#bar-chart"), chartConfig);

        chart.render();
    </script>

    <script>
        const lineChartConfig = {
            series: [
                {
                    name: "Sales",
                    data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                },
            ],
            chart: {
                type: "line",
                height: 240,
                toolbar: {
                    show: false,
                },
            },
            title: {
                show: "",
            },
            dataLabels: {
                enabled: false,
            },
            colors: ["#2731F5"],
            stroke: {
                lineCap: "round",
                curve: "smooth",
            },
            markers: {
                size: 0,
            },
            xaxis: {
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                labels: {
                    style: {
                        colors: "blue",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400,
                    },
                },
                categories: [
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
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "blue",
                        fontSize: "12px",
                        fontFamily: "inherit",
                        fontWeight: 400,
                    },
                },
            },
            grid: {
                show: true,
                borderColor: "#dddddd",
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true,
                    },
                },
                padding: {
                    top: 5,
                    right: 20,
                },
            },
            fill: {
                opacity: 0.8,
            },
            tooltip: {
                theme: "dark",
            },
        };

        const lineChart = new ApexCharts(document.querySelector("#line-chart"), lineChartConfig);

        lineChart.render();
    </script>
@endsection


@section('scripts')



@endsection
