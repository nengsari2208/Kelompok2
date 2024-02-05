<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image" href="/assets/image/logo.jpg">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/addition.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
</head>
<body style="display: flex;flex-wrap: wrap;overflow-x: hidden;">
    <header>
        
            
                <div id="head">
                    <img src="/assets/image/logo.jpg" alt="" id="logo">
                    <hr>
					
					@yield('nav-menu')

                    <div id="toggle-menu">
                        <input type="checkbox">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                           
                </div>
                <a href="/logout">
                    <button class="btn">
                        <i class="bx bx-log-out"></i>
                        <span>Logout</span>
                    </button>
                </a>
            
        
    </header>
    <script>
        const toggleMenu = document.querySelector('#toggle-menu input');
        const nav = document.querySelector('nav');

        toggleMenu.addEventListener('click', function(){
            nav.classList.toggle('slide');
        });
    </script>