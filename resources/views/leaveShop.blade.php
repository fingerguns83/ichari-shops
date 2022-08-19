<?php
use App\Models\Shop;

    $user = Auth::user();

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <title>{{getenv('APP_NAME')}}</title>

        <!--Favicon-->
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">
        <link rel="manifest" href="/assets/site.webmanifest">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
        <!--Scripts-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            /*html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}*/
        body{
            font-family: 'Mukta', sans-serif;
        }
        </style>
    </head>
    <body class="w-screen bg-[#131314]">
        <nav class="w-full fixed flex bg-[#303032] border-[#155cb3] border-b-2 justify-between items-center content-center py-4">
            <div id="backButton" class="w-1/6 flex text-gray-100 items-center content-center justify-start ml-4 hover:cursor-pointer hover:text-[#155cb3] group" onclick="backButton({{$back ?? ''}})">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M16.62 2.99a1.25 1.25 0 0 0-1.77 0L6.54 11.3a.996.996 0 0 0 0 1.41l8.31 8.31c.49.49 1.28.49 1.77 0s.49-1.28 0-1.77L9.38 12l7.25-7.25c.48-.48.48-1.28-.01-1.76z"/></svg>
                <span class="text-xl ml-2 hidden lg:inline">Back</span>
            </div>
            <div id="title" class="flex w-1/2 text-gray-100 text-xl md:text-2xl lg:text-3xl justify-center content-center items-center">
                {{getenv("APP_NAME")}}
            </div>
            <div id="userMenuContainer" class="w-1/6 flex text-gray-100 items-center content-center justify-center mr-4">
                <div class="flex items-center content-center justify-center">
                    <img src="{{$user->avatar}}" class="rounded-full" style="heigh:3em; width:3em;">
                    <span class="text-xl ml-4 hidden lg:inline">{{$user->name}}</span>
                </div>
            </div>
        </nav>
        <div class="w-screen fixed -z-10 top-20 bottom-0 pb-8 overflow-scroll scrollbar-none">
          <div class="flex h-full content-center justify-center items-center">
            <div class="mx-auto bg-black bg-opacity-20 py-8 rounded-xl w-11/12 md:w-3/4 lg:w-1/2 xl:w-1/3 2xl:w-2/5 text-center content-center">
              <p class="text-gray-300 text-2xl md:text-[1.75rem]">Are you sure you want to leave</p>
              <p class="text-gray-300 text-2xl md:text-[1.75rem] mb-2"><span class="underline italic text-[#155cb3] mr-1">{{$shop->name}}</span>?</p>
              @if ($shop->owners()->count() > 1)
              <div class="w-10/12 md:w-9/12 lg:w-8/12 xl:w-7/12 mx-auto mb-8">
                <p class="text-gray-300 text-sm md:text-lg text-center content-centerflex-wrap">You cannot remove other players from a shop, so your co-owners will continue to have access. The shop will only be deleted when no owners are left.</p>
              </div>
              @else
              <div class="w-10/12 md:w-9/12 lg:w-8/12 xl:w-7/12 mx-auto mb-8">
                <p class="text-gray-300 text-sm md:text-lg text-center content-centerflex-wrap">As you are the only owner of this shop, it will be deleted.</p>
              </div>
              @endif
              <div class="flex w-7/12 mx-auto justify-evenly">
                <span onclick="leaveRedirect()" class="bg-[#155cb3] md:w-1/4 lg:w-1/5 p-2 text-2xl md:text-[1.75rem] rounded-xl hover:cursor-pointer hover:underline">Leave</span>
                <span onclick="backButton()" class="bg-gray-300 md:w-1/4 lg:w-1/5 px-2 py-2 text-2xl md:text-[1.75rem] rounded-xl hover:cursor-pointer hover:underline">Back</span>
              </div>
            </div>
        </div>
    </body>
    <script>
        function backButton(){
            window.history.back();
        }
        function editRedirect(){
            window.location.href = "/shop/edit/{{$shop->id}}";
        }
        function leaveRedirect(){
            window.location.href = "/shop/leave/confirm/{{$shop->id}}"
        }
    </script>
</html>