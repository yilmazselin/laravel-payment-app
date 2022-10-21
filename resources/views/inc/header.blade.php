<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <title>Elestaş Payment System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Elestaş Payment System" name="description" />
    <meta content="elestas" name="author" />
   <!-- App favicon -->
   <meta name="csrf-token" content="{{ csrf_token() }}" />
   <link href="{{ config('app.asset_url')}}css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="{{ config('app.asset_url')}}css/custom.css" rel="stylesheet" type="text/css" />
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
   <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
</head>    