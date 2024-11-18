Untuk memastikan roda turbin berhenti ketika flow rate adalah 0, kita perlu menyesuaikan logika JavaScript sedikit. Kita dapat mengatur agar animasi berhenti dengan menghapus kelas `.rotate` saat flow rate mencapai 0.

Berikut adalah versi terbaru dari kode `index.php`:

### Kode index.php dengan Perbaikan Animasi Saat Flow Rate 0
```php
<!DOCTYPE html>
<html>
<head>
    <title>Flow Meter Sensor Display</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f0f0f0; 
            color: #333; 
        }
        .container { 
            width: 50%; 
            margin: auto; 
            text-align: center; 
            background-color: #ffffff; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px; 
        }
        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0; 
            margin-top: 20px; 
            border-radius: 10px; 
            overflow: hidden; 
        }
        th, td { 
            padding: 15px; 
            text-align: center; 
            border: 1px solid #ccc; 
        }
        th { 
            background-color: #0077b6; 
            color: #ffffff; 
        }
        td { 
            background-color: #00b4d8; 
            color: #ffffff;
        }
        tr:nth-child(even) td {
            background-color: #90e0ef;
            color: #333;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .rotate {
            animation: rotate infinite linear;
        }
    </style>
    <!-- Menambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Flow Meter Sensor Display</h1>
        <div id="data-display">
            <table>
                <tr>
                    <th>Deskripsi</th>
                    <th>Nilai</th>
                    <th>Satuan</th>
                </tr>
                <tr>
                    <td>Jumlah Flow Terlewat</td>
                    <td id="current-flow">0</td>
                    <td>L/min</td>
                </tr>
                <tr>
                    <td>Total Jumlah Terlewat</td>
                    <td id="total-flow">0</td>
                    <td>Liter</td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>Deskripsi</th>
                    <th>Nilai</th>
                    <th>Satuan</th>
                </tr>
                <tr>
                    <td>Flow Rate per Meter</td>
                    <td id="flow-rate-per-meter">0</td>
                    <td>L/m</td>
                </tr>
            </table>
            <svg id="turbine" width="100" height="100" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" stroke="#0077b6" stroke-width="5" fill="none"/>
                <line x1="50" y1="5" x2="50" y2="95" stroke="#0077b6" stroke-width="5"/>
                <line x1="5" y1="50" x2="95" y2="50" stroke="#0077b6" stroke-width="5"/>
            </svg>
        </div>
    </div>

    <script>
        function fetchData() {
            $.ajax({
                url: 'fetch_data.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#current-flow').text(data.current_flow);
                    $('#total-flow').text(data.total_flow);
                    $('#flow-rate-per-meter').text(data.flow_rate_per_meter);
                    
                    const flowRate = data.flow_rate_per_meter;
                    const turbine = document.getElementById('turbine');
                    
                    // Mengatur durasi animasi atau menghentikan animasi jika flowRate = 0
                    if (flowRate > 0) {
                        turbine.style.animationDuration = `${10 / flowRate}s`;
                        turbine.classList.add('rotate');
                    } else {
                        turbine.style.animationDuration = '0s';
                        turbine.classList.remove('rotate');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $(document).ready(function() {
            fetchData(); // Fetch initial data
            setInterval(fetchData, 1000); // Update data every 5 seconds
        });
    </script>
</body>
</html>
```

### Penjelasan
- **Cek Nilai `flowRate`**: Script JavaScript sekarang mengecek apakah `flowRate` lebih besar dari 0 sebelum menambahkan kelas `.rotate`.
- **Pengaturan Durasi Animasi**: Jika `flowRate` adalah 0, animasi akan berhenti dengan menghapus kelas `.rotate`.

Dengan perubahan ini, roda turbin akan berhenti berputar saat flow rate adalah 0. Jika ada lagi yang perlu disesuaikan atau ditambahkan, beri tahu saya! 😊