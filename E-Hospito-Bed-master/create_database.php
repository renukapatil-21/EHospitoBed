<?php
require "connection.php";
$sql = "CREATE TABLE IF NOT EXISTS admin(
    ad_email varchar(50) primary key,
    password varchar(50),
    ad_name varchar(50),
    gender varchar(20),
    bdate date,
    address varchar(50),
    phoneno bigint
    )";
if ($conn->query($sql) === TRUE) {
  echo "admin table created successfully";
} else {
  echo "Error creating admin table : " . $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS hospital(
    hospt_id int primary key,
    hospt_name varchar(50),
    address varchar(50),
    dist varchar(50),
    phoneno bigint,
    gen_bed int ,
    gen_price int,
    spec_bed int,
    spec_price int,
    gen_bed_2days int,
    spec_bed_2days int,
    gen_tatkal_price int,
    spec_tatkal_price int
    )";
if ($conn->query($sql) === TRUE) {
  echo "hospital table created successfully";
} else {
  echo "Error creating hospital table : " . $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS doctor(
  doc_email varchar(50) primary key,
    password varchar(50),
    doc_name varchar(50),
    gender varchar(20),
    bdate date,
    address varchar(50),
    phoneno bigint,
    hospt_id int,
    foreign key (hospt_id) references hospital(hospt_id)
  )";
if ($conn->query($sql) === TRUE) {
echo "doctor table created successfully";
} else {
echo "Error creating doctor table : " . $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS patient(
  patient_email varchar(50) primary key,
    password varchar(50),
    patient_name varchar(50),
    gender varchar(20),
    bdate date,
    address varchar(50),
    phoneno bigint
  )";
if ($conn->query($sql) === TRUE) {
echo "patient table created successfully";
} else {
echo "Error creating patient table : " . $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS request_bed(
  req_index int PRIMARY KEY AUTO_INCREMENT,
  patient_email varchar(50),
  hospt_id int,
  category varchar(50),
  status varchar(50), 
  req_date date,
  transaction_id varchar(50),
  foreign key (hospt_id) references hospital(hospt_id),
  foreign key (patient_email) references patient(patient_email) 
  )";
if ($conn->query($sql) === TRUE) {
echo "request_bed table created successfully";
} else {
echo "Error creating request_bed table : " . $conn->error;
}
?>