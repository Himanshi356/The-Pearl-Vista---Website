<?php
// Test Room Images Accessibility
echo "🧪 Testing Room Images\n";
echo "======================\n\n";

$images = [
    'Pearl Signature Room' => 'images/sophistication-room.png',
    'Deluxe Room' => 'Gallery/deluxe_room1.jpg',
    'Premium Room' => 'images/Premium_room1.png',
    'Executive Room' => 'Gallery/Executive_room2.jpg',
    'Luxury Suite' => 'images/luxury_suite.jpg',
    'Family Suite' => 'images/Family_suite.jpg'
];

foreach ($images as $roomType => $imagePath) {
    if (file_exists($imagePath)) {
        $fileSize = filesize($imagePath);
        echo "✅ $roomType: $imagePath ($fileSize bytes)\n";
    } else {
        echo "❌ $roomType: $imagePath (NOT FOUND)\n";
    }
}

echo "\n🎯 Image Test Complete!\n";
echo "All images should be accessible for the admin rooms page.\n";
?> 