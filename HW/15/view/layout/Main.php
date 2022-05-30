<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="output.css">
</head>

<body class="bg-[url(doctor.jpg)] bg-cover  h-[100vh]">



<nav class="
relative
w-full
flex flex-wrap
items-center
justify-between
py-4
text-gray-500
hover:text-gray-700
focus:text-gray-700
navbar navbar-expand-lg navbar-light
">
    <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
      <div class="collapse navbar-collapse flex justify-between flex-grow items-center" id="navbarSupportedContent">
        <!-- Left links -->
        <ul class="navbar-nav flex flex-row gap-5 pl-0 list-style-none mr-auto">
          <li class="nav-item px-2">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item pr-2">
            <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="/Logout">Logout</a>
          </li>
          <li class="nav-item pr-2">
            <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="<?php echo ($name['role']) . '-Profile' ?>">Panel</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  </ol>
  </nav>


  <div class="container">

    {{contents}}
  </div>

</body>

</html>