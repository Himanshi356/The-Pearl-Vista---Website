<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .test-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .stat-card {
            background: #f8f9fa;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        .stat-label {
            color: #666;
            font-size: 14px;
        }
        .error {
            color: red;
            background: #ffe6e6;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .success {
            color: green;
            background: #e6ffe6;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>🧪 Admin Dashboard Statistics Test</h1>
        <p>This page tests the admin dashboard statistics without requiring admin login.</p>
        
        <div id="results">
            <div class="stat-card">
                <div class="stat-label">Loading statistics...</div>
                <div class="stat-value">⏳</div>
            </div>
        </div>
    </div>

    <script>
        // Test the statistics loading
        async function testStatistics() {
            const resultsDiv = document.getElementById('results');
            
            try {
                // Test 1: Direct database query (simulated)
                const response1 = await fetch('test_direct_database.php');
                const data1 = await response1.text();
                
                // Test 2: Room types data
                const response2 = await fetch('Backend/Admin/get_rooms_data.php');
                const data2 = await response2.json();
                
                let html = '';
                
                if (data2.status === 'success') {
                    const totalRooms = data2.room_types.reduce((sum, room) => sum + (room.total_rooms || 0), 0);
                    
                    html += `
                        <div class="success">✅ Statistics loaded successfully!</div>
                        <div class="stat-card">
                            <div class="stat-label">Total Rooms</div>
                            <div class="stat-value">${totalRooms}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Room Types</div>
                            <div class="stat-value">${data2.room_types.length}</div>
                        </div>
                    `;
                    
                    // Show room types
                    data2.room_types.forEach(room => {
                        html += `
                            <div class="stat-card">
                                <div class="stat-label">${room.room_type}</div>
                                <div class="stat-value">${room.total_rooms} rooms - $${room.base_price.toLocaleString()}/night</div>
                            </div>
                        `;
                    });
                } else {
                    html += `<div class="error">❌ Failed to load room data: ${data2.message || 'Unknown error'}</div>`;
                }
                
                resultsDiv.innerHTML = html;
                
            } catch (error) {
                resultsDiv.innerHTML = `
                    <div class="error">❌ Error loading statistics: ${error.message}</div>
                    <div class="stat-card">
                        <div class="stat-label">Manual Database Check</div>
                        <div class="stat-value">Run: C:\\xampp\\php\\php.exe test_direct_database.php</div>
                    </div>
                `;
            }
        }
        
        // Run the test when page loads
        testStatistics();
    </script>
</body>
</html> 