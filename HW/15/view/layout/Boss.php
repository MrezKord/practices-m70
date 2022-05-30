<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hospital</title>
  <link rel="stylesheet" href="output.css" />
</head>

<body class="bg-gray-50">

<nav class="
relative
w-full
flex flex-wrap
items-center
justify-between
py-4
bg-gray-100
text-gray-500
hover:text-gray-700
focus:text-gray-700
shadow-lg
navbar navbar-expand-lg navbar-light
">
        <div class="container-fluid w-full flex flex-wrap items-center justify-between px-6">
          <div class="collapse navbar-collapse flex justify-between flex-grow items-center" id="navbarSupportedContent">
            <!-- Left links -->
            <ul class="navbar-nav flex flex-row gap-5 pl-0 list-style-none mr-auto">
              <li class="nav-item px-2">
                <a class="nav-link active" aria-current="page" href="/home">Home</a>
              </li>
                <li class="nav-item pr-2">
                  <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="/Boss-Profile">Profile</a>
                </li>
                <li class="nav-item pr-2">
                  <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="/Boss-confirm">Confirmation</a>
                </li>
                <li class="nav-item pr-2">
                  <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="/Boss-create-department">Create Department</a>
                </li>
              <li class="nav-item pr-2">
                <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="/Boss-edit-profile">Edit Profile</a>
              </li>
              <li class="nav-item pr-2">
                <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="/Boss-show-department">Department</a>
              </li>
              <li class="nav-item pr-2">
                <a class="nav-link text-gray-500 hover:text-gray-700 focus:text-gray-700 p-0" href="/Boss-show-doctors">Doctors</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </ol>
  </nav>




  <div class="w-[800px] h-[600px] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
    px-5 pt-3 rounded-md shadow-md bg-gray-300">
    {{contents}}
  </div>
</body>

</html>