<?php 
require 'vendor/autoload.php'; 

$faker = Faker\Factory::create('en_PH');
$pdo = new PDO("mysql:host=localhost;dbname=faker", "root", "202280287PSU");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$officeIds = [];
for ($i = 0; $i < 50; $i++) {
    $stmt = $pdo->prepare("INSERT INTO Office (name, contactnum, email, address, city, country, postal) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $faker->company, $faker->phoneNumber, $faker->email, $faker->address, $faker->city, "Philippines", $faker->postcode
    ]);
    $officeIds[] = $pdo->lastInsertId();
}

$employeeIds = [];
for ($i = 0; $i < 200; $i++) {
    $stmt = $pdo->prepare("INSERT INTO Employee (lastname, firstname, office_id, address) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $faker->lastName, $faker->firstName, $faker->randomElement($officeIds), $faker->address
    ]);
    $employeeIds[] = $pdo->lastInsertId();
}

echo "Fake data inserted successfully!";
?> 