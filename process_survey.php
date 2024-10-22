<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "environment_survey");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $question1 = $_POST['question1'];
    $question2 = $_POST['question2'];
    $question3 = $_POST['question3'];

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO environment_survey (name, email, question1, question2, question3) VALUES ('$name', '$email', '$question1', '$question2', '$question3')";

    if ($conn->query($sql) === TRUE) {
        echo "Terima kasih telah mengisi survei!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih</title>
</head>
<body>

<h2>Terima kasih telah mengisi survei kesadaran lingkungan.</h2>

</body>
</html>
