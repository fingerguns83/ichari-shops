<?php
use App\Models\Shop;
use App\Models\User;

$nameSort = "name-asc";
$modSort = "isMod-desc";
$adminSort = "isAdmin-desc";
$banSort = "isBanned-desc";

switch($field){
    case "name":
        if ($method == "desc"){
            $nameSort = "name-asc";
        }
        else{
            $nameSort = "name-desc";
        }
        break;
    case "isMod":
        if ($method == "desc"){
            $modSort = "isMod-asc";
        }
        else{
            $modSort = "isMod-desc";
        }
        break;
    case "isAdmin":
        if ($method == "desc"){
            $adminSort = "isAdmin-asc";
        }
        else{
            $adminSort = "isAdmin-desc";
        }
        break;
    case "isBanned":
        if ($method == "desc"){
            $banSort = "isBanned-asc";
        }
        else{
            $banSort = "isBanned-desc";
        }
        break;
}

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
        .autocomplete-el{
            padding-left: 1.5em;
            text-indent: -1em;
        }
        .autocomplete-el:hover{
            color:#fde047;
            cursor: pointer;
        }
        </style>
    </head>
    <body class="w-screen bg-[#131314]">
        <nav class="w-full fixed flex bg-[#303032] border-[#155cb3] border-b-2 justify-between items-center content-center py-4">
            <div id="backButton" class="w-1/6 flex text-gray-100 items-center content-center justify-start ml-4 hover:cursor-pointer hover:text-[#155cb3] group" onclick="backButton(true)">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M16.62 2.99a1.25 1.25 0 0 0-1.77 0L6.54 11.3a.996.996 0 0 0 0 1.41l8.31 8.31c.49.49 1.28.49 1.77 0s.49-1.28 0-1.77L9.38 12l7.25-7.25c.48-.48.48-1.28-.01-1.76z"/></svg>
                <span class="text-xl ml-2 hidden lg:inline">Back</span>
            </div>
            <div id="title" class="flex w-1/2 text-gray-100 text-xl md:text-2xl lg:text-3xl justify-center content-center items-center hover:cursor-pointer truncate">
              <i>User List</i>
            </div>
            <div id="userMenuContainer" class="w-1/6 flex text-gray-100 items-center content-center justify-center mr-4">
                <div class="flex items-center content-center justify-center hover:cursor-pointer">
                    <img src="{{Auth::user()->avatar}}" class="rounded-full" style="heigh:3em; width:3em;">
                    <span class="text-xl ml-4 hidden lg:inline">{{Auth::user()->name}}</span>
                </div>
                <div id="userMenu" class="w-fit absolute top-24 right-0 text-right bg-[#303032] rounded-l-xl content-center justify-center py-8 pr-2 pl-4" style="display:none;">
                    <div class="flex justify-end mb-8 hover:cursor-pointer hover:text-[#155cb3]" onclick="manageShopsRedirect()">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M12.09 2.91C10.08.9 7.07.49 4.65 1.67L8.28 5.3c.39.39.39 1.02 0 1.41L6.69 8.3c-.39.4-1.02.4-1.41 0L1.65 4.67C.48 7.1.89 10.09 2.9 12.1a6.507 6.507 0 0 0 6.89 1.48l7.96 7.96a2.613 2.613 0 0 0 3.71 0a2.613 2.613 0 0 0 0-3.71L13.54 9.9c.92-2.34.44-5.1-1.45-6.99z"/></svg>
                        <p class="ml-2 whitespace-nowrap text-2xl">Manage Shops</p>
                    </div>
                    <div class="flex justify-end mb-8 hover:cursor-pointer hover:text-[#155cb3]" onclick="newShopRedirect()">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                        <p class="ml-2 whitespace-nowrap text-2xl">New Shop</p>
                    </div>
                    <div class="flex justify-end hover:cursor-pointer hover:text-[#155cb3]" onclick="logout()">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M6 2h9a2 2 0 0 1 2 2v2h-2V4H6v16h9v-2h2v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"/><path fill="currentColor" d="M16.09 15.59L17.5 17l5-5l-5-5l-1.41 1.41L18.67 11H9v2h9.67z"/></svg>
                        <p class="ml-2 whitespace-nowrap text-2xl">Log Out</p>
                    </div>
                </div>
            </div>
        </nav>
        <div class="w-screen fixed -z-10 top-20 bottom-0 pb-8 overflow-scroll scrollbar-none">
            <main class="flex pt-8 justify-center">
                <table class="w-11/12 md:w-5/6 lg:w-2/3 xl:w-1/2 2xl:w-1/3 bg-gray-300 rounded-xl last:border-b-0">
                    <tr class="border-black border-b-2">
                        <th onclick="sortList('{{$nameSort}}')" class="w-3/6 font-bold text-xl text-center border-gray-500 border-r-2 overflow-hidden hover:cursor-pointer">Name</td>
                        @if(Auth::user()->isAdmin)
                        <th onclick="sortList('{{$adminSort}}')" class="w-1/6 font-bold text-xl text-center border-gray-500 border-r-2 overflow-hidden hover:cursor-pointer">Admin</td>
                            <th onclick="sortList('{{$modSort}}')" class="w-1/6 font-bold text-xl text-center border-gray-500 border-r-2 overflow-hidden hover:cursor-pointer">Mod</td>
                        @endif
                        <th onclick="sortList('{{$banSort}}')" class="w-1/6 font-bold text-xl text-center overflow-hidden hover:cursor-pointer">Ban</td>
                    </tr>
                    <?php $count = 0; ?>
                    @foreach ($users as $user)
                        @if($count%2 == 0)
                            <tr id="{{$user->id}}" class="border-gray-500 border-b-2 h-12 items-center bg-gray-300">
                        @else
                            <tr id="{{$user->id}}" class="border-gray-500 border-b-2 h-12 items-center bg-gray-400">
                        @endif
                            <td class="pl-2 h-8 text-xl border-gray-500 border-r-2 items-center text-left overflow-scroll scrollbar-none">{{ $user->name }}</td>
                            @if(Auth::user()->isAdmin)
                                <td class="text-2xl text-center border-gray-500 border-r-2">
                                    {!! Form::checkbox("admin", '', $user->isAdmin, ['class' => 'form-checkbox h-8 w-8 hover:cursor-pointer text-lime-500']) !!}
                                </td>
                                <td class="text-2xl text-center border-gray-500 border-r-2">
                                    {!! Form::checkbox("mod", '', $user->isMod, ['class' => 'form-checkbox h-8 w-8 hover:cursor-pointer text-orange-500']) !!}
                                </td>
                            @endif
                            <td class="h-12 flex items-center text-center justify-center">
                                @if ($user->isBanned)
                                <svg onclick="unbanUser('{{$user->id}}')" class="hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg"  aria-hidden="true" role="img" width="2.5em" height="2.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g transform="translate(24 0) scale(-1 1)"><path fill="currentColor" d="M17.65 6.35A7.958 7.958 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"/></g></svg>
                                @else
                                <svg onclick="banUser('{{$user->id}}', this)" class="hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2.5em" height="2.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path id="banicon" fill="currentColor" d="M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM17 15.74L15.74 17L12 13.26L8.26 17L7 15.74L10.74 12L7 8.26L8.26 7L12 10.74L15.74 7L17 8.26L13.26 12L17 15.74z"/></svg>
                                @endif
                            </td>
                        </tr>
                        <?php $count++; ?>
                    @endforeach
                </table>
            </main>
        </div>
    </body>
    <script>
        function shoplistRedirect(){
            window.location.href = "/shoplist";
        }
        function backButton(state = false){
            window.location.href = "/shoplist";
        }
        function shopRedirect(id){
            window.location.href = "/shop/view/"+id;
        }
        function newShopRedirect(){
            window.location.href = "/shop/create";
        }
        function manageShopsRedirect(){
            window.location.href = "/shoplist/p:{{Auth::user()->name}}";
        }
        function sortList(sort){
            window.location.href = "/userlist?sort=" + sort;
        }
        function logout(){
            window.location.href = "/logout";
        }
        function unbanUser(user_id){
            window.location.href = "/userlist/edit/" + user_id + "/unban";
        }
    </script>
    <script>
        $('input[type=checkbox]').change(function(){
            var name = $(this).prop('name');
            var userid = $(this).parents('tr').attr('id');
            switch(name){
                case "mod":
                    console.log("MOD");
                    window.location.href = "/userlist/edit/" + userid +"/mod";
                    break;
                case "admin":
                    console.log("ADMIN");
                    window.location.href = "/userlist/edit/" + userid +"/admin";
                    break;
            }   
        });

        var banTimout;
        var doBanRedirect = [];
        function banUser(user_id, el){
            var $this = $(el);
            var userbanicon = $this.children('#banicon');
            
            if (doBanRedirect[user_id]){
                window.location.href = "/userlist/edit/" + user_id + "/ban";
            }
            else {
                $(userbanicon).attr('d', 'M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12s4.48 10 10 10s10-4.48 10-10zm-10 1H8v-2h4V8l4 4l-4 4v-3z');
                doBanRedirect[user_id] = true;
                banTimout = setTimeout(function(){
                    $(userbanicon).attr('d', 'M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM17 15.74L15.74 17L12 13.26L8.26 17L7 15.74L10.74 12L7 8.26L8.26 7L12 10.74L15.74 7L17 8.26L13.26 12L17 15.74z');
                    doBanRedirect[user_id] = false;
                }, 1500);
            }
        }
        /*$('#banbutton').click(function() {
            console.log("here");
            var userbanicon = $(this).children('#banicon');
            var userid = $(this).parents('tr').attr('id');
            console.log(userid);
            if (doBanRedirect){
                //window.location.href = "/userlist/edit/" + userid + "/ban";
            }
            else {
                $(userbanicon).attr('d', 'M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12s4.48 10 10 10s10-4.48 10-10zm-10 1H8v-2h4V8l4 4l-4 4v-3z');
                $(userbanicon).css("color", "#D68910");
                doBanRedirect = true;
                banTimout = setTimeout(function(){
                    $(userbanicon).css("color", "black");
                    $(userbanicon).attr('d', 'M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM17 15.74L15.74 17L12 13.26L8.26 17L7 15.74L10.74 12L7 8.26L8.26 7L12 10.74L15.74 7L17 8.26L13.26 12L17 15.74z');
                    doBanRedirect = false;
                }, 1500);
            }
        });*/
    </script>
    <script>
        $(document).click(function(event) { 
            var $target = $(event.target);
            if(!$target.closest('#userMenuContainer').length && 
            $('#userMenu').is(":visible")) {
                $('#userMenu').animate({width: 'hide'});
            }        
        });
        $('#userMenuContainer').on('click', function(event){
            $('#userMenu').animate({width: 'toggle'});
        });
    </script>
</html>