<?php
use App\Models\Shop;
use App\Models\User;

$user = Auth::user();
$search = false;

if(isset($isearch)){
    $search = true;
}
elseif(isset($ssearch)){
    $search = true;
}
elseif(isset($psearch)){
    $search = true; 
}
else {
    $shops = Shop::orderBy('updated_at', 'desc')->where('status', '!=', 'inactive')->get(); 
}

$userlist = implode('", "', User::orderBy('name')->pluck('name')->toArray());
$shoplist = implode('", "', Shop::orderBy('name')->pluck('name')->toArray());

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
            @if (!$search)
                <div id="searchBoxContainer" class="w-1/6 flex text-gray-100 items-center content-center justify-start ml-4">
                    <div id="searchBoxButton" class="flex items-center content-center justify-center hover:cursor-pointer group">
                        <svg class="group-hover:text-[#155cb3]" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
                        <span class="text-xl ml-2 hidden lg:inline group-hover:text-[#155cb3]">Search</span>
                    </div>
                    <div id="searchBox" class="w-full md:w-fit absolute top-24 left-0 text-left bg-[#2f2f31] md:rounded-r-xl content-center justify-center py-8 px-4" style="display:none;">
                        <div class="flex justify-start items-center max-h-1/6 overflow-scroll scrollbar-none mb-8">
                            <label class="text-xl" for="searchtype">Type:</label>
                            <select class="form-select bg-[hsl(240,2%,10%)] py-1 items-center ml-2" name="searchtype" id="searchtype">
                                <option value="i">Item</option>
                                <option value="s">Shop</option>
                                <option value="p">Player</option>
                                <option value="d">Text</option>
                            </select>
                        </div>
                        <div class="flex justify-start items-center">
                            <div class="relative inline-block">
                                <div class="flex">
                                    <input id="searchInput" autocomplete="off" class="form-input w-56 py-1 items-center bg-[hsl(240,2%,10%)]" type="text" name="searchterm" id="searchterm">
                                    <button id="searchSubmitButton" class="text-xl ml-4 px-2 py-1 rounded-xl cursor-not-allowed" style="background-color:#6f6f6f; color: black;">Go</button>
                                </div>
                                <div id="searchInput-autocomplete" class="fixed hidden w-56 z-10 h-fit max-h-32 text-[1.75rem] lg:text-[1.65rem] overflow-y-scroll scrollbar-thin scrollbar-track-transparent scrollbar-thumb-[#155cb3] bg-[hsl(240,2%,10%)]">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @else
                <div id="backButton" class="w-1/6 flex text-gray-100 items-center content-center justify-start ml-4 hover:cursor-pointer hover:text-[#155cb3] group" onclick="backButton(true)">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M16.62 2.99a1.25 1.25 0 0 0-1.77 0L6.54 11.3a.996.996 0 0 0 0 1.41l8.31 8.31c.49.49 1.28.49 1.77 0s.49-1.28 0-1.77L9.38 12l7.25-7.25c.48-.48.48-1.28-.01-1.76z"/></svg>
                    <span class="text-xl ml-2 hidden lg:inline">Back</span>
                </div>
            @endif
            <div id="title" class="flex w-1/2 text-gray-100 text-xl md:text-2xl lg:text-3xl justify-center content-center items-center hover:cursor-pointer truncate">
                <?php
                    if(isset($isearch)){
                        echo "<i>";
                        echo substr($isearch, 0, 18) . "...";
                        echo "</i>";
                    }
                    elseif(isset($ssearch)){
                        echo "<i>";
                        echo substr($ssearch, 0, 18) . "...";
                        echo "</i>";
                    }
                    elseif(isset($psearch)){
                        echo "<i>";
                        echo $psearch . "...";
                        echo "</i>";
                    }
                    else {
                        echo getenv("APP_NAME");
                    }
                ?>
            </div>
            <div id="userMenuContainer" class="w-1/6 flex text-gray-100 items-center content-center justify-center mr-4">
                <div class="flex items-center content-center justify-center hover:cursor-pointer">
                    <img src="{{$user->avatar}}" class="rounded-full" style="heigh:3em; width:3em;">
                    <span class="text-xl ml-4 hidden lg:inline">{{$user->name}}</span>
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
                    @if (Auth::user()->isMod || Auth::user()->isAdmin)
                        <div class="flex justify-end mb-8 hover:cursor-pointer hover:text-[#155cb3]" onclick="userListRedirect()">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M12 12.75c1.63 0 3.07.39 4.24.9c1.08.48 1.76 1.56 1.76 2.73V18H6v-1.61c0-1.18.68-2.26 1.76-2.73c1.17-.52 2.61-.91 4.24-.91zM4 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2zm1.13 1.1c-.37-.06-.74-.1-1.13-.1c-.99 0-1.93.21-2.78.58A2.01 2.01 0 0 0 0 16.43V18h4.5v-1.61c0-.83.23-1.61.63-2.29zM20 13c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2zm4 3.43c0-.81-.48-1.53-1.22-1.85A6.95 6.95 0 0 0 20 14c-.39 0-.76.04-1.13.1c.4.68.63 1.46.63 2.29V18H24v-1.57zM12 6c1.66 0 3 1.34 3 3s-1.34 3-3 3s-3-1.34-3-3s1.34-3 3-3z"/></svg>
                            <p class="ml-2 whitespace-nowrap text-2xl">User List</p>
                        </div>
                        <script>
                            function userListRedirect(){
                                window.location.href = "/userlist"
                            }
                        </script>
                    @endif
                    <div class="flex justify-end hover:cursor-pointer hover:text-[#155cb3]" onclick="logout()">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M6 2h9a2 2 0 0 1 2 2v2h-2V4H6v16h9v-2h2v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z"/><path fill="currentColor" d="M16.09 15.59L17.5 17l5-5l-5-5l-1.41 1.41L18.67 11H9v2h9.67z"/></svg>
                        <p class="ml-2 whitespace-nowrap text-2xl">Log Out</p>
                    </div>
                </div>
            </div>
        </nav>
        <div class="w-screen fixed -z-10 top-20 bottom-0 pb-8 overflow-scroll scrollbar-none">
            @if ((isset($shops)) && ($shops->count() > 0))
                <main class="mx-6 xl:mx-32 pt-8 grid gap-2 lg:gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($shops as $shop)
                        <?php
                            switch($shop->status){
                                case('closed'):
                                    $shopStatusStyle = "background-color:hsl(0, 35%, 70%);";
                                    break;
                                case('pending'):
                                    $shopStatusStyle = "background-color:hsl(50, 35%, 70%);";
                                    break;
                                case('open'):
                                    $shopStatusStyle = "background-color:hsl(142, 35%, 70%);";
                                    break;
                                default:
                                    $shopStatusStyle = "background-color:hsl(216, 12%, 84%);";
                            }
                        ?>
                        <div class="px-4 py-2 lg:px-6 rounded-xl hover:cursor-pointer border-2 border-[#131314] hover:border-gray-300" style="{{$shopStatusStyle}}" onclick="shopRedirect('{{$shop->id}}')">
                            <div>
                                <div class="justify-around block">
                                    <span class="font-bold block text-lg lg:text-2xl xl:text-3xl truncate overflow-hidden">{{ $shop->name }}</span>
                                    <p class="block text-lg">({{$shop->area}}: {{$shop->location}})</p>
                                    <?php
                                        $owners = $shop->owners();
                                        $ownerArr = [];
                                        foreach($owners as $owner){
                                            $ownerArr[] = $owner->name;
                                        }
                                        if (count($ownerArr) > 1){
                                            $label = "Owners";
                                        }
                                        else {
                                            $label = "Owner";
                                        }
                                    ?>
                                    <p class="block text-lg"><span class="underline">{{$label}}</span>: <span class="italic">{{implode(", ", $ownerArr)}}</span>
                                    </p>
                                </div>
                                <div class="w-full overflow-hidden block">
                                    @if (isset($isearch))
                                        <p class="text-indigo-600 italic font-bold">
                                            <?php
                                                $stock = json_decode($shop->inventory, true);
                                                foreach($stock as $item){
                                                    if ($item['item'] == $isearch){
                                                        $output = $isearch . ": ";
                                                        $output .= $item['pricing']['amount'] . " " . $item['pricing']['unit'];
                                                        if ($item['pricing']['amount'] > 1){
                                                            $output .= "s";
                                                        }
                                                        $output .= " for ";
                                                        $output .= $item['product']['amount'] . " " . $item['product']['unit'];
                                                        if ($item['product']['amount'] > 1){
                                                            $output .= "s";
                                                        }
                                                        echo $output;
                                                        break;
                                                    }
                                                }
                                            ?>
                                    @else
                                        <p class=" text-indigo-600 font-bold truncate">
                                            {{str_replace("\n", " ", $shop->blurb)}}
                                    @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </main>
            @else
                <div class="text-center pt-8 text-2xl text-gray-300">
                    <p class="text-gray-300 text-2xl">No Results</p>
                    <p class="underline text-xl hover:cursor-pointer" onclick="shoplistRedirect()">Back</p>
                </div>
            @endif
        </div>
        <!--<div id="filterbox" class="w-full md:w-1/2 lg:w-2/5 xl:w-1/3 h-64 xl:h-80 inline-block fixed bottom-0 right-0 px-4 py-4" style="display:none;">
            <div id="filterhidebutton" class="h-8 w-8 flex absolute top-2 right-2 bg-gray-300 text-gray-400 rounded-full justify-center content-center text-center items-center hover:pointer">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z"/></svg>
            </div>
            <div class="h-full text-center content-center py-4 bg-sky-400 rounded-xl text-xl">
            </div>
        </div>
        <div id="filterbutton" class="w-16 h-16 flex bg-sky-400 items-center content-center justify-center fixed bottom-0 right-0 mx-4 my-4 lg:mx-8 lg:my-8 rounded-xl hover:text-gray-100 hover:cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M4.25 5.61C6.27 8.2 10 13 10 13v6c0 .55.45 1 1 1h2c.55 0 1-.45 1-1v-6s3.72-4.8 5.74-7.39A.998.998 0 0 0 18.95 4H5.04c-.83 0-1.3.95-.79 1.61z"/></svg>
        </div>-->
    </body>
    <script>
        function shoplistRedirect(){
            window.location.href = "/shoplist";
        }
        function backButton(state = false){
            if (state){
                window.location.href = "/shoplist";
            }
            else {
                window.history.back();
            }
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
        function logout(){
            window.location.href = "/logout";
        }
    </script>
    <script>
        $("#filterbutton").on('click', function () {
            /*$("#filterbutton").hide('fast', function(){
                $("#filterbox").show('fast');
            });*/
            window.alert("Filtering coming soon");
        });
        $("#filterhidebutton").on('click', function(){
            $("#filterbox").hide('fast', function(){
                $("#filterbutton").show('fast');
            });
        });

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
        $(document).click(function(event) { 
            var $target = $(event.target);
            if(!$target.closest('#searchBoxContainer').length && $('#searchBox').is(":visible")) {
                //$('#searchBox').animate({width: 'hide'});
            }        
        });
        $('#searchBoxButton').on('click', function(event){
            if ($('#searchBox').is(":visible")){
                    $('#searchInput-autocomplete').hide(0);
                }
            $('#searchBox').animate({width: 'toggle'});
        });
    </script>
    <script>
        var items = [
            "Acacia Boat",
            "Acacia Button",
            "Acacia Door",
            "Acacia Fence",
            "Acacia Fence Gate",
            "Acacia Leaves",
            "Acacia Log",
            "Acacia Planks",
            "Acacia Pressure Plate",
            "Acacia Sapling",
            "Acacia Sign",
            "Acacia Slab",
            "Acacia Stairs",
            "Acacia Trapdoor",
            "Acacia Wood",
            "Activator Rail",
            "Allium",
            "Amethyst Block",
            "Amethyst Cluster",
            "Amethyst Shard",
            "Ancient Debris",
            "Andesite",
            "Andesite Slab",
            "Andesite Stairs",
            "Andesite Wall",
            "Anvil",
            "Apple",
            "Armor Stand",
            "Arrow",
            "Axolotl Bucket",
            "Azalea",
            "Azalea Leaves",
            "Azure Bluet",
            "Baked Potato",
            "Bamboo",
            "Barrel",
            "Basalt",
            "Beacon",
            "Bee Nest",
            "Beef",
            "Beehive",
            "Beetroot",
            "Beetroot Seeds",
            "Beetroot Soup",
            "Bell",
            "Big Dripleaf",
            "Birch Boat",
            "Birch Button",
            "Birch Door",
            "Birch Fence",
            "Birch Fence Gate",
            "Birch Leaves",
            "Birch Log",
            "Birch Planks",
            "Birch Pressure Plate",
            "Birch Sapling",
            "Birch Sign",
            "Birch Slab",
            "Birch Stairs",
            "Birch Trapdoor",
            "Birch Wood",
            "Black Banner",
            "Black Bed",
            "Black Candle",
            "Black Carpet",
            "Black Concrete",
            "Black Concrete Powder",
            "Black Dye",
            "Black Glazed Terracotta",
            "Black Shulker Box",
            "Black Stained Glass",
            "Black Stained Glass Pane",
            "Black Terracotta",
            "Black Wool",
            "Blackstone",
            "Blackstone Slab",
            "Blackstone Stairs",
            "Blackstone Wall",
            "Blast Furnace",
            "Blaze Powder",
            "Blaze Rod",
            "Blue Banner",
            "Blue Bed",
            "Blue Candle",
            "Blue Carpet",
            "Blue Concrete",
            "Blue Concrete Powder",
            "Blue Dye",
            "Blue Glazed Terracotta",
            "Blue Ice",
            "Blue Orchid",
            "Blue Shulker Box",
            "Blue Stained Glass",
            "Blue Stained Glass Pane",
            "Blue Terracotta",
            "Blue Wool",
            "Bone",
            "Bone Block",
            "Bone Meal",
            "Book",
            "Bookshelf",
            "Bow",
            "Bowl",
            "Brain Coral",
            "Brain Coral Block",
            "Brain Coral Fan",
            "Bread",
            "Brewing Stand",
            "Brick",
            "Brick Slab",
            "Brick Stairs",
            "Brick Wall",
            "Bricks",
            "Brown Banner",
            "Brown Bed",
            "Brown Candle",
            "Brown Carpet",
            "Brown Concrete",
            "Brown Concrete Powder",
            "Brown Dye",
            "Brown Glazed Terracotta",
            "Brown Mushroom",
            "Brown Mushroom Block",
            "Brown Shulker Box",
            "Brown Stained Glass",
            "Brown Stained Glass Pane",
            "Brown Terracotta",
            "Brown Wool",
            "Bubble Coral",
            "Bubble Coral Block",
            "Bubble Coral Fan",
            "Bucket",
            "Bundle",
            "Cactus",
            "Cake",
            "Calcite",
            "Campfire",
            "Candle",
            "Carrot",
            "Carrot on a Stick",
            "Cartography Table",
            "Carved Pumpkin",
            "Cauldron",
            "Chain",
            "Chainmail Boots",
            "Chainmail Chestplate",
            "Chainmail Helmet",
            "Chainmail Leggings",
            "Charcoal",
            "Chest",
            "Chest Minecart",
            "Chicken",
            "Chipped Anvil",
            "Chiseled Deepslate",
            "Chiseled Nether Bricks",
            "Chiseled Polished Blackstone",
            "Chiseled Quartz Block",
            "Chiseled Red Sandstone",
            "Chiseled Sandstone",
            "Chiseled Stone Bricks",
            "Chorus Flower",
            "Chorus Fruit",
            "Chorus Plant",
            "Clay",
            "Clay Ball",
            "Clock",
            "Coal",
            "Coal Block",
            "Coal Ore",
            "Coarse Dirt",
            "Cobbled Deepslate",
            "Cobbled Deepslate Slab",
            "Cobbled Deepslate Stairs",
            "Cobbled Deepslate Wall",
            "Cobblestone",
            "Cobblestone Slab",
            "Cobblestone Stairs",
            "Cobblestone Wall",
            "Cobweb",
            "Cocoa Beans",
            "Cod",
            "Cod Bucket",
            "Comparator",
            "Compass",
            "Composter",
            "Conduit",
            "Cooked Beef",
            "Cooked Chicken",
            "Cooked Cod",
            "Cooked Mutton",
            "Cooked Porkchop",
            "Cooked Rabbit",
            "Cooked Salmon",
            "Cookie",
            "Copper Block",
            "Copper Ingot",
            "Copper Ore",
            "Cornflower",
            "Cracked Deepslate Bricks",
            "Cracked Deepslate Tiles",
            "Cracked Nether Bricks",
            "Cracked Polished Blackstone Bricks",
            "Cracked Stone Bricks",
            "Crafting Table",
            "Creeper Banner Pattern",
            "Creeper Head",
            "Crimson Button",
            "Crimson Door",
            "Crimson Fence",
            "Crimson Fence Gate",
            "Crimson Fungus",
            "Crimson Hyphae",
            "Crimson Nylium",
            "Crimson Planks",
            "Crimson Pressure Plate",
            "Crimson Roots",
            "Crimson Sign",
            "Crimson Slab",
            "Crimson Stairs",
            "Crimson Stem",
            "Crimson Trapdoor",
            "Crossbow",
            "Crying Obsidian",
            "Cut Copper",
            "Cut Copper Slab",
            "Cut Copper Stairs",
            "Cut Red Sandstone",
            "Cut Red Sandstone Slab",
            "Cut Sandstone",
            "Cut Sandstone Slab",
            "Cyan Banner",
            "Cyan Bed",
            "Cyan Candle",
            "Cyan Carpet",
            "Cyan Concrete",
            "Cyan Concrete Powder",
            "Cyan Dye",
            "Cyan Glazed Terracotta",
            "Cyan Shulker Box",
            "Cyan Stained Glass",
            "Cyan Stained Glass Pane",
            "Cyan Terracotta",
            "Cyan Wool",
            "Damaged Anvil",
            "Dandelion",
            "Dark Oak Boat",
            "Dark Oak Button",
            "Dark Oak Door",
            "Dark Oak Fence",
            "Dark Oak Fence Gate",
            "Dark Oak Leaves",
            "Dark Oak Log",
            "Dark Oak Planks",
            "Dark Oak Pressure Plate",
            "Dark Oak Sapling",
            "Dark Oak Sign",
            "Dark Oak Slab",
            "Dark Oak Stairs",
            "Dark Oak Trapdoor",
            "Dark Oak Wood",
            "Dark Prismarine",
            "Dark Prismarine Slab",
            "Dark Prismarine Stairs",
            "Daylight Detector",
            "Dead Brain Coral",
            "Dead Brain Coral Block",
            "Dead Brain Coral Fan",
            "Dead Bubble Coral",
            "Dead Bubble Coral Block",
            "Dead Bubble Coral Fan",
            "Dead Bush",
            "Dead Fire Coral",
            "Dead Fire Coral Block",
            "Dead Fire Coral Fan",
            "Dead Horn Coral",
            "Dead Horn Coral Block",
            "Dead Horn Coral Fan",
            "Dead Tube Coral",
            "Dead Tube Coral Block",
            "Dead Tube Coral Fan",
            "Debug Stick",
            "Deepslate",
            "Deepslate Brick Slab",
            "Deepslate Brick Stairs",
            "Deepslate Brick Wall",
            "Deepslate Bricks",
            "Deepslate Copper Ore",
            "Deepslate Diamond Ore",
            "Deepslate Gold Ore",
            "Deepslate Iron Ore",
            "Deepslate Lapis Ore",
            "Deepslate Redstone Ore",
            "Deepslate Tile Slab",
            "Deepslate Tile Stairs",
            "Deepslate Tile Wall",
            "Deepslate Tiles",
            "Detector Rail",
            "Diamond",
            "Diamond Axe",
            "Diamond Block",
            "Diamond Boots",
            "Diamond Chestplate",
            "Diamond Helmet",
            "Diamond Hoe",
            "Diamond Horse Armor",
            "Diamond Leggings",
            "Diamond Ore",
            "Diamond Pickaxe",
            "Diamond Shovel",
            "Diamond Sword",
            "Diorite",
            "Diorite Slab",
            "Diorite Stairs",
            "Diorite Wall",
            "Dirt",
            "Dispenser",
            "Dragon Breath",
            "Dragon Egg",
            "Dragon Head",
            "Dried Kelp",
            "Dried Kelp Block",
            "Dripstone Block",
            "Dropper",
            "Egg",
            "Elytra",
            "Emerald",
            "Emerald Block",
            "Emerald Ore",
            "Enchanted Book",
            "Enchanted Golden Apple",
            "Enchanting Table",
            "End Crystal",
            "End Portal Frame",
            "End Rod",
            "End Stone",
            "End Stone Brick Slab",
            "End Stone Brick Stairs",
            "End Stone Brick Wall",
            "End Stone Bricks",
            "Ender Chest",
            "Ender Eye",
            "Ender Pearl",
            "Experience Bottle",
            "Exposed Copper",
            "Exposed Cut Copper",
            "Exposed Cut Copper Slab",
            "Exposed Cut Copper Stairs",
            "Farmland",
            "Feather",
            "Fermented Spider Eye",
            "Fern",
            "Filled Map",
            "Fire Charge",
            "Fire Coral",
            "Fire Coral Block",
            "Fire Coral Fan",
            "Firework Rocket",
            "Firework Star",
            "Fishing Rod",
            "Fletching Table",
            "Flint",
            "Flint And Steel",
            "Flower Banner Pattern",
            "Flower Pot",
            "Flowering Azalea",
            "Flowering Azalea Leaves",
            "Furnace",
            "Furnace Minecart",
            "Ghast Tear",
            "Gilded Blackstone",
            "Glass",
            "Glass Bottle",
            "Glass Pane",
            "Glistering Melon Slice",
            "Globe Banner Pattern",
            "Glow Berries",
            "Glow Ink Sac",
            "Glow Item Frame",
            "Glowstone",
            "Glowstone Dust",
            "Gold Block",
            "Gold Ingot",
            "Gold Nugget",
            "Gold Ore",
            "Golden Apple",
            "Golden Axe",
            "Golden Boots",
            "Golden Carrot",
            "Golden Chestplate",
            "Golden Helmet",
            "Golden Hoe",
            "Golden Horse Armor",
            "Golden Leggings",
            "Golden Pickaxe",
            "Golden Shovel",
            "Golden Sword",
            "Granite",
            "Granite Slab",
            "Granite Stairs",
            "Granite Wall",
            "Grass",
            "Grass Block",
            "Grass Path",
            "Gravel",
            "Gray Banner",
            "Gray Bed",
            "Gray Candle",
            "Gray Carpet",
            "Gray Concrete",
            "Gray Concrete Powder",
            "Gray Dye",
            "Gray Glazed Terracotta",
            "Gray Shulker Box",
            "Gray Stained Glass",
            "Gray Stained Glass Pane",
            "Gray Terracotta",
            "Gray Wool",
            "Green Banner",
            "Green Bed",
            "Green Candle",
            "Green Carpet",
            "Green Concrete",
            "Green Concrete Powder",
            "Green Dye",
            "Green Glazed Terracotta",
            "Green Shulker Box",
            "Green Stained Glass",
            "Green Stained Glass Pane",
            "Green Terracotta",
            "Green Wool",
            "Grindstone",
            "Gunpowder",
            "Hay Block",
            "Heart of the Sea",
            "Heavy Weighted Pressure Plate",
            "Honey Block",
            "Honey Bottle",
            "Honeycomb",
            "Honeycomb Block",
            "Hopper",
            "Hopper Minecart",
            "Horn Coral",
            "Horn Coral Block",
            "Horn Coral Fan",
            "Ice",
            "Infested Chiseled Stone Bricks",
            "Infested Cobblestone",
            "Infested Cracked Stone Bricks",
            "Infested Mossy Stone Bricks",
            "Infested Stone",
            "Infested Stone Bricks",
            "Ink Sac",
            "Iron Axe",
            "Iron Bars",
            "Iron Block",
            "Iron Boots",
            "Iron Chestplate",
            "Iron Door",
            "Iron Helmet",
            "Iron Hoe",
            "Iron Horse Armor",
            "Iron Ingot",
            "Iron Leggings",
            "Iron Nugget",
            "Iron Ore",
            "Iron Pickaxe",
            "Iron Shovel",
            "Iron Sword",
            "Iron Trapdoor",
            "Item Frame",
            "Jack O Lantern",
            "Jigsaw",
            "Jukebox",
            "Jungle Boat",
            "Jungle Button",
            "Jungle Door",
            "Jungle Fence",
            "Jungle Fence Gate",
            "Jungle Leaves",
            "Jungle Log",
            "Jungle Planks",
            "Jungle Pressure Plate",
            "Jungle Sapling",
            "Jungle Sign",
            "Jungle Slab",
            "Jungle Stairs",
            "Jungle Trapdoor",
            "Jungle Wood",
            "Kelp",
            "Knowledge Book",
            "Ladder",
            "Lantern",
            "Lapis Block",
            "Lapis Lazuli",
            "Lapis Ore",
            "Large Amethyst Bud",
            "Large Fern",
            "Lava",
            "Lava Bucket",
            "Lead",
            "Leather",
            "Leather Boots",
            "Leather Chestplate",
            "Leather Helmet",
            "Leather Horse Armor",
            "Leather Leggings",
            "Lectern",
            "Lever",
            "Light Blue Banner",
            "Light Blue Bed",
            "Light Blue Candle",
            "Light Blue Carpet",
            "Light Blue Concrete",
            "Light Blue Concrete Powder",
            "Light Blue Dye",
            "Light Blue Glazed Terracotta",
            "Light Blue Shulker Box",
            "Light Blue Stained Glass",
            "Light Blue Stained Glass Pane",
            "Light Blue Terracotta",
            "Light Blue Wool",
            "Light Gray Banner",
            "Light Gray Bed",
            "Light Gray Candle",
            "Light Gray Carpet",
            "Light Gray Concrete",
            "Light Gray Concrete Powder",
            "Light Gray Dye",
            "Light Gray Glazed Terracotta",
            "Light Gray Shulker Box",
            "Light Gray Stained Glass",
            "Light Gray Stained Glass Pane",
            "Light Gray Terracotta",
            "Light Gray Wool",
            "Light Weighted Pressure Plate",
            "Lilac",
            "Lily of the Valley",
            "Lily Pad",
            "Lime Banner",
            "Lime Bed",
            "Lime Candle",
            "Lime Carpet",
            "Lime Concrete",
            "Lime Concrete Powder",
            "Lime Dye",
            "Lime Glazed Terracotta",
            "Lime Shulker Box",
            "Lime Stained Glass",
            "Lime Stained Glass Pane",
            "Lime Terracotta",
            "Lime Wool",
            "Lingering Potion",
            "Lodestone",
            "Loom",
            "Magenta Banner",
            "Magenta Bed",
            "Magenta Candle",
            "Magenta Carpet",
            "Magenta Concrete",
            "Magenta Concrete Powder",
            "Magenta Dye",
            "Magenta Glazed Terracotta",
            "Magenta Shulker Box",
            "Magenta Stained Glass",
            "Magenta Stained Glass Pane",
            "Magenta Terracotta",
            "Magenta Wool",
            "Magma Block",
            "Magma Cream",
            "Map",
            "Medium Amethyst Bud",
            "Melon",
            "Melon Seeds",
            "Melon Slice",
            "Milk Bucket",
            "Minecart",
            "Mojang Banner Pattern",
            "Mossy Cobblestone",
            "Mossy Cobblestone Slab",
            "Mossy Cobblestone Stairs",
            "Mossy Cobblestone Wall",
            "Mossy Stone Brick Slab",
            "Mossy Stone Brick Stairs",
            "Mossy Stone Brick Wall",
            "Mossy Stone Bricks",
            "Mushroom Stem",
            "Mushroom Stew",
            "Music Disc 11",
            "Music Disc 13",
            "Music Disc Blocks",
            "Music Disc Cat",
            "Music Disc Chirp",
            "Music Disc Far",
            "Music Disc Mall",
            "Music Disc Mellohi",
            "Music Disc Pigstep",
            "Music Disc Stal",
            "Music Disc Strad",
            "Music Disc Wait",
            "Music Disc Ward",
            "Mutton",
            "Mycelium",
            "Name Tag",
            "Nautilus Shell",
            "Nether Brick",
            "Nether Brick Fence",
            "Nether Brick Slab",
            "Nether Brick Stairs",
            "Nether Brick Wall",
            "Nether Bricks",
            "Nether Gold Ore",
            "Nether Quartz Ore",
            "Nether Sprouts",
            "Nether Star",
            "Nether Wart",
            "Nether Wart Block",
            "Netherite Axe",
            "Netherite Block",
            "Netherite Boots",
            "Netherite Chestplate",
            "Netherite Helmet",
            "Netherite Hoe",
            "Netherite Ingot",
            "Netherite Leggings",
            "Netherite Pickaxe",
            "Netherite Scrap",
            "Netherite Shovel",
            "Netherite Sword",
            "Netherrack",
            "Note Block",
            "Oak Boat",
            "Oak Button",
            "Oak Door",
            "Oak Fence",
            "Oak Fence Gate",
            "Oak Leaves",
            "Oak Log",
            "Oak Planks",
            "Oak Pressure Plate",
            "Oak Sapling",
            "Oak Sign",
            "Oak Slab",
            "Oak Stairs",
            "Oak Trapdoor",
            "Oak Wood",
            "Observer",
            "Obsidian",
            "Orange Banner",
            "Orange Bed",
            "Orange Candle",
            "Orange Carpet",
            "Orange Concrete",
            "Orange Concrete Powder",
            "Orange Dye",
            "Orange Glazed Terracotta",
            "Orange Shulker Box",
            "Orange Stained Glass",
            "Orange Stained Glass Pane",
            "Orange Terracotta",
            "Orange Tulip",
            "Orange Wool",
            "Oxeye Daisy",
            "Oxidized Copper",
            "Oxidized Cut Copper",
            "Oxidized Cut Copper Slab",
            "Oxidized Cut Copper Stairs",
            "Packed Ice",
            "Painting",
            "Paper",
            "Peony",
            "Petrified Oak Slab",
            "Phantom Membrane",
            "Piglin Banner Pattern",
            "Pink Banner",
            "Pink Bed",
            "Pink Candle",
            "Pink Carpet",
            "Pink Concrete",
            "Pink Concrete Powder",
            "Pink Dye",
            "Pink Glazed Terracotta",
            "Pink Shulker Box",
            "Pink Stained Glass",
            "Pink Stained Glass Pane",
            "Pink Terracotta",
            "Pink Tulip",
            "Pink Wool",
            "Piston",
            "Player Head",
            "Podzol",
            "Pointed Dripstone",
            "Poisonous Potato",
            "Polished Andesite",
            "Polished Andesite Slab",
            "Polished Andesite Stairs",
            "Polished Basalt",
            "Polished Blackstone",
            "Polished Blackstone Brick Slab",
            "Polished Blackstone Brick Stairs",
            "Polished Blackstone Brick Wall",
            "Polished Blackstone Bricks",
            "Polished Blackstone Button",
            "Polished Blackstone Pressure Plate",
            "Polished Blackstone Slab",
            "Polished Blackstone Stairs",
            "Polished Blackstone Wall",
            "Polished Deepslate",
            "Polished Deepslate Slab",
            "Polished Deepslate Stairs",
            "Polished Deepslate Wall",
            "Polished Diorite",
            "Polished Diorite Slab",
            "Polished Diorite Stairs",
            "Polished Granite",
            "Polished Granite Slab",
            "Polished Granite Stairs",
            "Popped Chorus Fruit",
            "Poppy",
            "Porkchop",
            "Potato",
            "Potion",
            "Powder Snow",
            "Powder Snow Bucket",
            "Powered Rail",
            "Prismarine",
            "Prismarine Brick Slab",
            "Prismarine Brick Stairs",
            "Prismarine Bricks",
            "Prismarine Crystals",
            "Prismarine Shard",
            "Prismarine Slab",
            "Prismarine Stairs",
            "Prismarine Wall",
            "Pufferfish",
            "Pufferfish Bucket",
            "Pumpkin",
            "Pumpkin Pie",
            "Pumpkin Seeds",
            "Purple Banner",
            "Purple Bed",
            "Purple Candle",
            "Purple Carpet",
            "Purple Concrete",
            "Purple Concrete Powder",
            "Purple Dye",
            "Purple Glazed Terracotta",
            "Purple Shulker Box",
            "Purple Stained Glass",
            "Purple Stained Glass Pane",
            "Purple Terracotta",
            "Purple Wool",
            "Purpur Block",
            "Purpur Pillar",
            "Purpur Slab",
            "Purpur Stairs",
            "Quartz",
            "Quartz Block",
            "Quartz Bricks",
            "Quartz Pillar",
            "Quartz Slab",
            "Quartz Stairs",
            "Rabbit",
            "Rabbit Foot",
            "Rabbit Hide",
            "Rabbit Stew",
            "Rail",
            "Raw Copper",
            "Raw Copper Block",
            "Raw Gold",
            "Raw Gold Block",
            "Raw Iron",
            "Raw Iron Block",
            "Red Banner",
            "Red Bed",
            "Red Candle",
            "Red Carpet",
            "Red Concrete",
            "Red Concrete Powder",
            "Red Dye",
            "Red Glazed Terracotta",
            "Red Mushroom",
            "Red Mushroom Block",
            "Red Nether Brick Slab",
            "Red Nether Brick Stairs",
            "Red Nether Brick Wall",
            "Red Nether Bricks",
            "Red Sand",
            "Red Sandstone",
            "Red Sandstone Slab",
            "Red Sandstone Stairs",
            "Red Sandstone Wall",
            "Red Shulker Box",
            "Red Stained Glass",
            "Red Stained Glass Pane",
            "Red Terracotta",
            "Red Tulip",
            "Red Wool",
            "Redstone",
            "Redstone Block",
            "Redstone Lamp",
            "Redstone Ore",
            "Redstone Torch",
            "Repeater",
            "Respawn Anchor",
            "Rooted Dirt",
            "Rose Bush",
            "Rotten Flesh",
            "Saddle",
            "Salmon",
            "Salmon Bucket",
            "Sand",
            "Sandstone",
            "Sandstone Slab",
            "Sandstone Stairs",
            "Sandstone Wall",
            "Scaffolding",
            "Scute",
            "Sea Lantern",
            "Sea Pickle",
            "Seagrass",
            "Shears",
            "Shield",
            "Shroomlight",
            "Shulker Box",
            "Shulker Shell",
            "Skeleton Skull",
            "Skull Banner Pattern",
            "Slime Ball",
            "Slime Block",
            "Small Amethyst Bud",
            "Small Dripleaf",
            "Smithing Table",
            "Smoker",
            "Smooth Basalt",
            "Smooth Quartz",
            "Smooth Quartz Slab",
            "Smooth Quartz Stairs",
            "Smooth Red Sandstone",
            "Smooth Red Sandstone Slab",
            "Smooth Red Sandstone Stairs",
            "Smooth Sandstone",
            "Smooth Sandstone Slab",
            "Smooth Sandstone Stairs",
            "Smooth Stone",
            "Smooth Stone Slab",
            "Snow",
            "Snow Block",
            "Snowball",
            "Soul Campfire",
            "Soul Lantern",
            "Soul Sand",
            "Soul Soil",
            "Soul Torch",
            "Spawner",
            "Spectral Arrow",
            "Spider Eye",
            "Splash Potion",
            "Sponge",
            "Spore Blossom",
            "Spruce Boat",
            "Spruce Button",
            "Spruce Door",
            "Spruce Fence",
            "Spruce Fence Gate",
            "Spruce Leaves",
            "Spruce Log",
            "Spruce Planks",
            "Spruce Pressure Plate",
            "Spruce Sapling",
            "Spruce Sign",
            "Spruce Slab",
            "Spruce Stairs",
            "Spruce Trapdoor",
            "Spruce Wood",
            "Spyglass",
            "Stick",
            "Sticky Piston",
            "Stone",
            "Stone Axe",
            "Stone Brick Slab",
            "Stone Brick Stairs",
            "Stone Brick Wall",
            "Stone Bricks",
            "Stone Button",
            "Stone Hoe",
            "Stone Pickaxe",
            "Stone Pressure Plate",
            "Stone Shovel",
            "Stone Slab",
            "Stone Stairs",
            "Stone Sword",
            "Stonecutter",
            "String",
            "Stripped Acacia Log",
            "Stripped Acacia Wood",
            "Stripped Birch Log",
            "Stripped Birch Wood",
            "Stripped Crimson Hyphae",
            "Stripped Crimson Stem",
            "Stripped Dark Oak Log",
            "Stripped Dark Oak Wood",
            "Stripped Jungle Log",
            "Stripped Jungle Wood",
            "Stripped Oak Log",
            "Stripped Oak Wood",
            "Stripped Spruce Log",
            "Stripped Spruce Wood",
            "Stripped Warped Hyphae",
            "Stripped Warped Stem",
            "Structure Block",
            "Structure Void",
            "Sugar",
            "Sugar Cane",
            "Sunflower",
            "Suspicious Stew",
            "Sweet Berries",
            "Tall Grass",
            "Target",
            "Terracotta",
            "Tinted Glass",
            "Tipped Arrow",
            "Tnt",
            "Tnt Minecart",
            "Torch",
            "Totem of Undying",
            "Trapped Chest",
            "Trident",
            "Tripwire Hook",
            "Tropical Fish",
            "Tropical Fish Bucket",
            "Tube Coral",
            "Tube Coral Block",
            "Tube Coral Fan",
            "Tuff",
            "Turtle Egg",
            "Turtle Helmet",
            "Twisting Vines",
            "Vine",
            "Warped Button",
            "Warped Door",
            "Warped Fence",
            "Warped Fence Gate",
            "Warped Fungus",
            "Warped Fungus on a Stick",
            "Warped Hyphae",
            "Warped Nylium",
            "Warped Planks",
            "Warped Pressure Plate",
            "Warped Roots",
            "Warped Sign",
            "Warped Slab",
            "Warped Stairs",
            "Warped Stem",
            "Warped Trapdoor",
            "Warped Wart Block",
            "Water Bucket",
            "Waxed Copper Block",
            "Waxed Cut Copper",
            "Waxed Cut Copper Slab",
            "Waxed Cut Copper Stairs",
            "Waxed Exposed Copper",
            "Waxed Exposed Cut Copper",
            "Waxed Exposed Cut Copper Slab",
            "Waxed Exposed Cut Copper Stairs",
            "Waxed Oxidized Copper",
            "Waxed Oxidized Cut Copper",
            "Waxed Oxidized Cut Copper Slab",
            "Waxed Oxidized Cut Copper Stairs",
            "Waxed Weathered Copper",
            "Waxed Weathered Cut Copper",
            "Waxed Weathered Cut Copper Slab",
            "Waxed Weathered Cut Copper Stairs",
            "Weathered Copper",
            "Weathered Cut Copper",
            "Weathered Cut Copper Slab",
            "Weathered Cut Copper Stairs",
            "Weeping Vines",
            "Wet Sponge",
            "Wheat",
            "Wheat Seeds",
            "White Banner",
            "White Bed",
            "White Candle",
            "White Carpet",
            "White Concrete",
            "White Concrete Powder",
            "White Dye",
            "White Glazed Terracotta",
            "White Shulker Box",
            "White Stained Glass",
            "White Stained Glass Pane",
            "White Terracotta",
            "White Tulip",
            "White Wool",
            "Wither Rose",
            "Wither Skeleton Skull",
            "Wooden Axe",
            "Wooden Hoe",
            "Wooden Pickaxe",
            "Wooden Shovel",
            "Wooden Sword",
            "Writable Book",
            "Written Book",
            "Yellow Banner",
            "Yellow Bed",
            "Yellow Candle",
            "Yellow Carpet",
            "Yellow Concrete",
            "Yellow Concrete Powder",
            "Yellow Dye",
            "Yellow Glazed Terracotta",
            "Yellow Shulker Box",
            "Yellow Stained Glass",
            "Yellow Stained Glass Pane",
            "Yellow Terracotta",
            "Yellow Wool",
            "Zombie Head"
        ];
        var players = ["<?=$userlist; ?>"];
        var shops = ["<?=$shoplist; ?>"];
        var doSubmit = false;

        var doAutocomplete = true;
        var autocompleteArr = items;
        autocompleteArr.forEach(element => {
            $('#searchInput-autocomplete').append('<p class="autocomplete-el" style="display:none;" onclick="autofill(this)">'+element+"</p>");
        });

        function autofill(query){
            console.log(query.textContent);
            $('#searchInput').val(query.textContent);
            if (autocompleteArr.includes($('#searchInput').val())){
                $('#searchSubmitButton').css({
                    "background-color": "#fde047",
                    "cursor": "pointer"
                });
                doSubmit = true;
            }
            else {
                $('#searchSubmitButton').css({
                    "background-color": "#6f6f6f",
                    "cursor": "not-allowed"
                });
                doSubmit = false;
            }
        }
            var oldInput = "";
        function autocomplete(){
            var input = $('#searchInput').val().toLowerCase();

            var visibleEls = $('.autocomplete-el').is(':visible');
            if (!visibleEls || input.length < oldInput.length){
                $('.autocomplete-el').each(function(){
                    var match = false;
                    if (input.includes(" ")){
                            if ($(this).text().toLowerCase().includes(input)){
                                match = true;
                            }
                    }
                    else {
                        $(this).text().toLowerCase().split(" ").forEach(word => {
                            if (!match){
                                if (word.startsWith(input)){
                                    match = true;
                                }
                            }
                        });
                    }
                    if (match){
                        $(this).show(0);
                    } 
                });
            }
            else {
                $('.autocomplete-el').each(function(){
                    if($(this).is(':visible')){
                        var match = false;
                        if (input.includes(" ")){
                            if ($(this).text().toLowerCase().includes(input)){
                                match = true;
                            }
                        }
                        else {
                            $(this).text().toLowerCase().split(" ").forEach(word => {
                                if (!match){
                                    if (word.startsWith(input)){
                                        match = true;
                                    }
                                }
                            });
                        }
                        if (!match){
                            $(this).hide(0);
                        }
                    }    
                });
            }
            oldInput = input;
        }
            

        $('#searchtype').on('change', function() {
            console.log(this.value);
            switch (this.value) {
                case "i":
                    doAutocomplete = true;
                    autocompleteArr = items;
                    $('#searchInput-autocomplete').empty();
                    autocompleteArr.forEach(element => {
                        $('#searchInput-autocomplete').append('<p class="autocomplete-el" style="display:none;" onclick="autofill(this)">'+element+"</p>");
                    });
                    autocomplete();
                    break;
                case "p":
                    doAutocomplete = true;
                    autocompleteArr = players;
                    $('#searchInput-autocomplete').empty();
                    autocompleteArr.forEach(element => {
                        $('#searchInput-autocomplete').append('<p class="autocomplete-el" style="display:none;" onclick="autofill(this)">'+element+"</p>");
                    });
                    autocomplete();
                    break;
                case "s":
                    doAutocomplete = true;
                    autocompleteArr = shops;
                    $('#searchInput-autocomplete').empty();
                    autocompleteArr.forEach(element => {
                        $('#searchInput-autocomplete').append('<p class="autocomplete-el" style="display:none;" onclick="autofill(this)">'+element+"</p>");
                    });
                    autocomplete();
                    break;
                default:
                    doAutocomplete = false;
                    $('#searchInput-autocomplete').empty();
                    break;
            }
        });

        $('#searchInput').on('input', function(){
            if (!this.value.length){
                $('#searchInput-autocomplete').hide(0);
            }
            else {
                if (!$('#searchInput-autocomplete').is(":visible")){
                    $('#searchInput-autocomplete').show(0);
                }
                if (doAutocomplete){
                    autocomplete();
                }
            }
            if($('#searchtype').val() !== 'd'){
                if (autocompleteArr.map(element => {return element.toLowerCase()}).includes($('#searchInput').val().toLowerCase())){
                    $('#searchSubmitButton').css({
                        "background-color": "#fde047",
                        "cursor": "pointer"
                    });
                    doSubmit = true;
                }
                else {
                    $('#searchSubmitButton').css({
                        "background-color": "#6f6f6f",
                        "cursor": "not-allowed"
                    });
                    doSubmit = false;
                }
            }
            else {
                if ($('#searchInput').val()){
                    $('#searchSubmitButton').css({
                        "background-color": "#fde047",
                        "cursor": "pointer"
                    });
                    doSubmit = true;
                }
            }
        });
        
        $('#searchInput').on('keypress', function(key){
            if(key.which == 13) {
                if (doSubmit){
                    var query = $('#searchInput').val().replaceAll(" ", "+");
                    var type = $('#searchtype').val();
                    window.location.href = "/shoplist/"+type+":"+query;  
                }
            }
        });

        $('#searchSubmitButton').click(function(){
            if (doSubmit){
                var query = $('#searchInput').val().replaceAll(" ", "+");
                var type = $('#searchtype').val();
                window.location.href = "/shoplist/"+type+":"+query;
            }
        });
    </script>
</html>