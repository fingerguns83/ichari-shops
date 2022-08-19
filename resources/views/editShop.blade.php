<?php
use App\Models\Shop;
use App\Models\User;

    $user = Auth::user();
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    if ($shop->type == "Retail"){
        if ($shop->inventory){
            $inventory = json_decode($shop->inventory, true);
            sort($inventory);
            $inventoryJson = trim($shop->inventory);
        }

    }
    $coowners = $shop->owners(false);
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
            <div id="backButton" class="w-1/6 flex text-gray-100 items-center content-center justify-start ml-4 hover:cursor-pointer hover:text-[#155cb3] group" onclick="backButton()">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M16.62 2.99a1.25 1.25 0 0 0-1.77 0L6.54 11.3a.996.996 0 0 0 0 1.41l8.31 8.31c.49.49 1.28.49 1.77 0s.49-1.28 0-1.77L9.38 12l7.25-7.25c.48-.48.48-1.28-.01-1.76z"/></svg>
                <span class="text-xl ml-2 hidden lg:inline">Back</span>
            </div>
            <div id="title" class="flex w-1/2 text-gray-100 text-xl md:text-2xl lg:text-3xl justify-center content-center items-center">
                Edit Shop
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
                    <div class="flex justify-end mb-8 hover:cursor-pointer hover:text-[#155cb3] onclick="newShopRedirect()">
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
        <div class="w-screen fixed -z-10 top-20 bottom-0 pb-4 overflow-scroll scrollbar-none">
            {!! Form::open(['url' => '/shop/edit/' . $shop->id, 'id' => 'formShop']) !!}
            <main class="mx-6 xl:mx-32 pt-4 grid gap-2 xl:gap-4 grid-cols-1 md:grid-cols-6 2xl:grid-cols-12 content-center justify-center">
                    <div id="detailsPane" class="md:col-start-1 md:col-span-3 2xl:col-start-3 2xl:col-span-3 bg-[#98cdab] px-4 py-2 xl:px-6 rounded-xl text-xl lg:text-2xl text-black">
                        <p class="underline text-center mb-2 sm:text-2xl">Shop Details</p>
                        {!! Form::label('formShopName', 'Shop Name:', []) !!}
                        {!! Form::text('formShopName', $shop->name , ['class' => 'w-full form-input py-0 mb-4', 'maxlength' => '64', 'pattern' => '[A-Za-z0-9!:/&?()]']) !!}
                        {!! Form::label('formShopArea', 'Shop Area:', []) !!}
                        <?php
                            $areasRaw = DB::table('areas')
                            ->get()
                            ->pluck('area_name')
                            ->toArray();
                            $areas = [];
                            foreach ($areasRaw as $key => $area){
                                $areas[$area] = $area;
                            }

                            $shopLocation = explode(", ", trim($shop->location));
                            $shopLocationX = $shopLocation[0];
                            $shopLocationY = $shopLocation[1];
                            $shopLocationZ = $shopLocation[2];
                        ?>
                        {!! Form::select('formShopArea', $areas, $shop->area, ['id' => 'formShopArea', 'class' => 'w-full form-select py-0 mb-4']) !!}<br>
                        {!! Form::label('formShopLocation', 'Location:', []) !!}
                        <div id="formLocationCoordinates">
                            <div class="flex w-full flex-wrap items-center mb-4">
                                <div class="flex items-center">
                                {!! Form::label('formLocationX', 'X:', []) !!}
                                {!! Form::number('formLocationX', $shopLocation[0], ['id' => 'formLocationX', 'class' => 'w-20 h-fit form-input py-0 ml-2 mr-4']) !!}
                                </div>
                                <div class="flex items-center">
                                {!! Form::label('formLocationY', 'Y:', []) !!}
                                {!! Form::number('formLocationY', $shopLocation[1], ['id' => 'formLocationY', 'class' => 'w-20 h-fit form-input py-0 ml-2 mr-4']) !!}
                                </div>
                                <div class="flex items-center">
                                {!! Form::label('formLocationZ', 'Z:', []) !!}
                                {!! Form::number('formLocationZ', $shopLocation[2], ['id' => 'formLocationZ', 'class' => 'w-20 h-fit form-input py-0 ml-2']) !!}
                                </div>
                            </div>
                        </div>
                        <?php
                            $allUsers = User::where('id', '!=', Auth::id())->orderBy('name')->get();
                            $availableUsers = ['' => ''];
                            foreach ($allUsers as $user){
                                $availableUsers[$user->id] = $user->name;
                            }
                        ?>
                        {!! Form::label('formShopOwnersTemp', 'Additional Owner(s):', []) !!}
                        {!! Form::select('formShopOwnersTemp', $availableUsers, '', ['id' => 'formShopOwnersTemp', 'class' => 'w-full form-select py-0 mb-4']) !!}
                        <div id="additionalOwnerDiv" class="mb-4 lg:mb-2 flex flex-wrap justify-start">
                        </div>
                        
                    </div>
                    <div id="descriptionPane" class="md:col-start-4 md:col-span-3 2xl:col-start-6 2xl:col-span-4 bg-fuchsia-200 px-2 py-2 xl:px-6 rounded-xl text-xl lg:text-2xl text-black">
                        <p class="underline text-center text-2xl">Shop Description</p>
                        <p class="text-sm text-center">This area is for a text description of your shop. It supports basic HTML formatting with the following tags:</p>
                        <p class="text-xs text-center italic mb-2 py-0 px-1.5 text-blue-500">
                            <?php
                            $tags = array(
                                "&lt;b&gt;",
                                "&lt;br&gt;",
                                "&lt;dd&gt;",
                                "&lt;del&gt;",
                                "&lt;div&gt;",
                                "&lt;dl&gt;",
                                "&lt;dt&gt;",
                                "&lt;em&gt;",
                                "&lt;h1&gt;",
                                "&lt;h2&gt;",
                                "&lt;h3&gt;",
                                "&lt;h4&gt;",
                                "&lt;h5&gt;",
                                "&lt;h6&gt;",
                                "&lt;i&gt;",
                                "&lt;li&gt;",
                                "&lt;ol&gt;",
                                "&lt;p&gt;",
                                "&lt;small&gt;",
                                "&lt;span&gt;",
                                "&lt;strong&gt;",
                                "&lt;sub&gt;",
                                "&lt;sup&gt;",
                                "&lt;u&gt;",
                                "&lt;ul&gt;"
                            );
                            echo implode(", ", $tags);
                            ?>
                        </p>
                        {!! Form::textarea('formShopDescription', $shop->description, ['class' => 'w-full form-textarea p-0 mb-4', 'maxlength' => '1000']) !!}
                    </div>
                    <div id="inventoryPane" class="md:row-start-3 md:col-span-4 md:col-start-1 md:row-span-8 lg:col-span-3 2xl:row-start-2 2xl:col-span-3 2xl:col-start-3 bg-gray-300 px-2 py-2 xl:px-6 rounded-xl text-xl lg:text-2xl text-black">
                        <p class="underline text-center text-2xl">Shop Inventory</p>
                        <p class="text-center mb-2 text-sm">If your shop is non-retail, leave this blank.</p>
                        {!! Form::label('formShopInventoryItem', 'Item:', []) !!}
                        <?php
                            $items = array(
                                '' => '',
                                "Acacia-Boat" => "Acacia Boat",
                                "Acacia-Button" => "Acacia Button",
                                "Acacia-Door" => "Acacia Door",
                                "Acacia-Fence" => "Acacia Fence",
                                "Acacia-Fence-Gate" => "Acacia Fence Gate",
                                "Acacia-Leaves" => "Acacia Leaves",
                                "Acacia-Log" => "Acacia Log",
                                "Acacia-Planks" => "Acacia Planks",
                                "Acacia-Pressure-Plate" => "Acacia Pressure Plate",
                                "Acacia-Sapling" => "Acacia Sapling",
                                "Acacia-Sign" => "Acacia Sign",
                                "Acacia-Slab" => "Acacia Slab",
                                "Acacia-Stairs" => "Acacia Stairs",
                                "Acacia-Trapdoor" => "Acacia Trapdoor",
                                "Acacia-Wood" => "Acacia Wood",
                                "Activator-Rail" => "Activator Rail",
                                "Allium" => "Allium",
                                "Amethyst-Block" => "Amethyst Block",
                                "Amethyst-Cluster" => "Amethyst Cluster",
                                "Amethyst-Shard" => "Amethyst Shard",
                                "Ancient-Debris" => "Ancient Debris",
                                "Andesite" => "Andesite",
                                "Andesite-Slab" => "Andesite Slab",
                                "Andesite-Stairs" => "Andesite Stairs",
                                "Andesite-Wall" => "Andesite Wall",
                                "Anvil" => "Anvil",
                                "Apple" => "Apple",
                                "Armor-Stand" => "Armor Stand",
                                "Arrow" => "Arrow",
                                "Axolotl-Bucket" => "Axolotl Bucket",
                                "Azalea" => "Azalea",
                                "Azalea-Leaves" => "Azalea Leaves",
                                "Azure-Bluet" => "Azure Bluet",
                                "Baked-Potato" => "Baked Potato",
                                "Bamboo" => "Bamboo",
                                "Barrel" => "Barrel",
                                "Basalt" => "Basalt",
                                "Beacon" => "Beacon",
                                "Bee-Nest" => "Bee Nest",
                                "Beef" => "Beef",
                                "Beehive" => "Beehive",
                                "Beetroot" => "Beetroot",
                                "Beetroot-Seeds" => "Beetroot Seeds",
                                "Beetroot-Soup" => "Beetroot Soup",
                                "Bell" => "Bell",
                                "Big-Dripleaf" => "Big Dripleaf",
                                "Birch-Boat" => "Birch Boat",
                                "Birch-Button" => "Birch Button",
                                "Birch-Door" => "Birch Door",
                                "Birch-Fence" => "Birch Fence",
                                "Birch-Fence-Gate" => "Birch Fence Gate",
                                "Birch-Leaves" => "Birch Leaves",
                                "Birch-Log" => "Birch Log",
                                "Birch-Planks" => "Birch Planks",
                                "Birch-Pressure-Plate" => "Birch Pressure Plate",
                                "Birch-Sapling" => "Birch Sapling",
                                "Birch-Sign" => "Birch Sign",
                                "Birch-Slab" => "Birch Slab",
                                "Birch-Stairs" => "Birch Stairs",
                                "Birch-Trapdoor" => "Birch Trapdoor",
                                "Birch-Wood" => "Birch Wood",
                                "Black-Banner" => "Black Banner",
                                "Black-Bed" => "Black Bed",
                                "Black-Candle" => "Black Candle",
                                "Black-Carpet" => "Black Carpet",
                                "Black-Concrete" => "Black Concrete",
                                "Black-Concrete-Powder" => "Black Concrete Powder",
                                "Black-Dye" => "Black Dye",
                                "Black-Glazed-Terracotta" => "Black Glazed Terracotta",
                                "Black-Shulker-Box" => "Black Shulker Box",
                                "Black-Stained-Glass" => "Black Stained Glass",
                                "Black-Stained-Glass-Pane" => "Black Stained Glass Pane",
                                "Black-Terracotta" => "Black Terracotta",
                                "Black-Wool" => "Black Wool",
                                "Blackstone" => "Blackstone",
                                "Blackstone-Slab" => "Blackstone Slab",
                                "Blackstone-Stairs" => "Blackstone Stairs",
                                "Blackstone-Wall" => "Blackstone Wall",
                                "Blast-Furnace" => "Blast Furnace",
                                "Blaze-Powder" => "Blaze Powder",
                                "Blaze-Rod" => "Blaze Rod",
                                "Blue-Banner" => "Blue Banner",
                                "Blue-Bed" => "Blue Bed",
                                "Blue-Candle" => "Blue Candle",
                                "Blue-Carpet" => "Blue Carpet",
                                "Blue-Concrete" => "Blue Concrete",
                                "Blue-Concrete-Powder" => "Blue Concrete Powder",
                                "Blue-Dye" => "Blue Dye",
                                "Blue-Glazed-Terracotta" => "Blue Glazed Terracotta",
                                "Blue-Ice" => "Blue Ice",
                                "Blue-Orchid" => "Blue Orchid",
                                "Blue-Shulker-Box" => "Blue Shulker Box",
                                "Blue-Stained-Glass" => "Blue Stained Glass",
                                "Blue-Stained-Glass-Pane" => "Blue Stained Glass Pane",
                                "Blue-Terracotta" => "Blue Terracotta",
                                "Blue-Wool" => "Blue Wool",
                                "Bone" => "Bone",
                                "Bone-Block" => "Bone Block",
                                "Bone-Meal" => "Bone Meal",
                                "Book" => "Book",
                                "Bookshelf" => "Bookshelf",
                                "Bow" => "Bow",
                                "Bowl" => "Bowl",
                                "Brain-Coral" => "Brain Coral",
                                "Brain-Coral-Block" => "Brain Coral Block",
                                "Brain-Coral-Fan" => "Brain Coral Fan",
                                "Bread" => "Bread",
                                "Brewing-Stand" => "Brewing Stand",
                                "Brick" => "Brick",
                                "Brick-Slab" => "Brick Slab",
                                "Brick-Stairs" => "Brick Stairs",
                                "Brick-Wall" => "Brick Wall",
                                "Bricks" => "Bricks",
                                "Brown-Banner" => "Brown Banner",
                                "Brown-Bed" => "Brown Bed",
                                "Brown-Candle" => "Brown Candle",
                                "Brown-Carpet" => "Brown Carpet",
                                "Brown-Concrete" => "Brown Concrete",
                                "Brown-Concrete-Powder" => "Brown Concrete Powder",
                                "Brown-Dye" => "Brown Dye",
                                "Brown-Glazed-Terracotta" => "Brown Glazed Terracotta",
                                "Brown-Mushroom" => "Brown Mushroom",
                                "Brown-Mushroom-Block" => "Brown Mushroom Block",
                                "Brown-Shulker-Box" => "Brown Shulker Box",
                                "Brown-Stained-Glass" => "Brown Stained Glass",
                                "Brown-Stained-Glass-Pane" => "Brown Stained Glass Pane",
                                "Brown-Terracotta" => "Brown Terracotta",
                                "Brown-Wool" => "Brown Wool",
                                "Bubble-Coral" => "Bubble Coral",
                                "Bubble-Coral-Block" => "Bubble Coral Block",
                                "Bubble-Coral-Fan" => "Bubble Coral Fan",
                                "Bucket" => "Bucket",
                                "Bundle" => "Bundle",
                                "Cactus" => "Cactus",
                                "Cake" => "Cake",
                                "Calcite" => "Calcite",
                                "Campfire" => "Campfire",
                                "Candle" => "Candle",
                                "Carrot" => "Carrot",
                                "Carrot-On-A-Stick" => "Carrot On A Stick",
                                "Cartography-Table" => "Cartography Table",
                                "Carved-Pumpkin" => "Carved Pumpkin",
                                "Cauldron" => "Cauldron",
                                "Chain" => "Chain",
                                "Chainmail-Boots" => "Chainmail Boots",
                                "Chainmail-Chestplate" => "Chainmail Chestplate",
                                "Chainmail-Helmet" => "Chainmail Helmet",
                                "Chainmail-Leggings" => "Chainmail Leggings",
                                "Charcoal" => "Charcoal",
                                "Chest" => "Chest",
                                "Chest-Minecart" => "Chest Minecart",
                                "Chicken" => "Chicken",
                                "Chipped-Anvil" => "Chipped Anvil",
                                "Chiseled-Deepslate" => "Chiseled Deepslate",
                                "Chiseled-Nether-Bricks" => "Chiseled Nether Bricks",
                                "Chiseled-Polished-Blackstone" => "Chiseled Polished Blackstone",
                                "Chiseled-Quartz-Block" => "Chiseled Quartz Block",
                                "Chiseled-Red-Sandstone" => "Chiseled Red Sandstone",
                                "Chiseled-Sandstone" => "Chiseled Sandstone",
                                "Chiseled-Stone-Bricks" => "Chiseled Stone Bricks",
                                "Chorus-Flower" => "Chorus Flower",
                                "Chorus-Fruit" => "Chorus Fruit",
                                "Chorus-Plant" => "Chorus Plant",
                                "Clay" => "Clay",
                                "Clay-Ball" => "Clay Ball",
                                "Clock" => "Clock",
                                "Coal" => "Coal",
                                "Coal-Block" => "Coal Block",
                                "Coal-Ore" => "Coal Ore",
                                "Coarse-Dirt" => "Coarse Dirt",
                                "Cobbled-Deepslate" => "Cobbled Deepslate",
                                "Cobbled-Deepslate-Slab" => "Cobbled Deepslate Slab",
                                "Cobbled-Deepslate-Stairs" => "Cobbled Deepslate Stairs",
                                "Cobbled-Deepslate-Wall" => "Cobbled Deepslate Wall",
                                "Cobblestone" => "Cobblestone",
                                "Cobblestone-Slab" => "Cobblestone Slab",
                                "Cobblestone-Stairs" => "Cobblestone Stairs",
                                "Cobblestone-Wall" => "Cobblestone Wall",
                                "Cobweb" => "Cobweb",
                                "Cocoa-Beans" => "Cocoa Beans",
                                "Cod" => "Cod",
                                "Cod-Bucket" => "Cod Bucket",
                                "Comparator" => "Comparator",
                                "Compass" => "Compass",
                                "Composter" => "Composter",
                                "Conduit" => "Conduit",
                                "Cooked-Beef" => "Cooked Beef",
                                "Cooked-Chicken" => "Cooked Chicken",
                                "Cooked-Cod" => "Cooked Cod",
                                "Cooked-Mutton" => "Cooked Mutton",
                                "Cooked-Porkchop" => "Cooked Porkchop",
                                "Cooked-Rabbit" => "Cooked Rabbit",
                                "Cooked-Salmon" => "Cooked Salmon",
                                "Cookie" => "Cookie",
                                "Copper-Block" => "Copper Block",
                                "Copper-Ingot" => "Copper Ingot",
                                "Copper-Ore" => "Copper Ore",
                                "Cornflower" => "Cornflower",
                                "Cracked-Deepslate-Bricks" => "Cracked Deepslate Bricks",
                                "Cracked-Deepslate-Tiles" => "Cracked Deepslate Tiles",
                                "Cracked-Nether-Bricks" => "Cracked Nether Bricks",
                                "Cracked-Polished-Blackstone-Bricks" => "Cracked Polished Blackstone Bricks",
                                "Cracked-Stone-Bricks" => "Cracked Stone Bricks",
                                "Crafting-Table" => "Crafting Table",
                                "Creeper-Banner-Pattern" => "Creeper Banner Pattern",
                                "Creeper-Head" => "Creeper Head",
                                "Crimson-Button" => "Crimson Button",
                                "Crimson-Door" => "Crimson Door",
                                "Crimson-Fence" => "Crimson Fence",
                                "Crimson-Fence-Gate" => "Crimson Fence Gate",
                                "Crimson-Fungus" => "Crimson Fungus",
                                "Crimson-Hyphae" => "Crimson Hyphae",
                                "Crimson-Nylium" => "Crimson Nylium",
                                "Crimson-Planks" => "Crimson Planks",
                                "Crimson-Pressure-Plate" => "Crimson Pressure Plate",
                                "Crimson-Roots" => "Crimson Roots",
                                "Crimson-Sign" => "Crimson Sign",
                                "Crimson-Slab" => "Crimson Slab",
                                "Crimson-Stairs" => "Crimson Stairs",
                                "Crimson-Stem" => "Crimson Stem",
                                "Crimson-Trapdoor" => "Crimson Trapdoor",
                                "Crossbow" => "Crossbow",
                                "Crying-Obsidian" => "Crying Obsidian",
                                "Cut-Copper" => "Cut Copper",
                                "Cut-Copper-Slab" => "Cut Copper Slab",
                                "Cut-Copper-Stairs" => "Cut Copper Stairs",
                                "Cut-Red-Sandstone" => "Cut Red Sandstone",
                                "Cut-Red-Sandstone-Slab" => "Cut Red Sandstone Slab",
                                "Cut-Sandstone" => "Cut Sandstone",
                                "Cut-Sandstone-Slab" => "Cut Sandstone Slab",
                                "Cyan-Banner" => "Cyan Banner",
                                "Cyan-Bed" => "Cyan Bed",
                                "Cyan-Candle" => "Cyan Candle",
                                "Cyan-Carpet" => "Cyan Carpet",
                                "Cyan-Concrete" => "Cyan Concrete",
                                "Cyan-Concrete-Powder" => "Cyan Concrete Powder",
                                "Cyan-Dye" => "Cyan Dye",
                                "Cyan-Glazed-Terracotta" => "Cyan Glazed Terracotta",
                                "Cyan-Shulker-Box" => "Cyan Shulker Box",
                                "Cyan-Stained-Glass" => "Cyan Stained Glass",
                                "Cyan-Stained-Glass-Pane" => "Cyan Stained Glass Pane",
                                "Cyan-Terracotta" => "Cyan Terracotta",
                                "Cyan-Wool" => "Cyan Wool",
                                "Damaged-Anvil" => "Damaged Anvil",
                                "Dandelion" => "Dandelion",
                                "Dark-Oak-Boat" => "Dark Oak Boat",
                                "Dark-Oak-Button" => "Dark Oak Button",
                                "Dark-Oak-Door" => "Dark Oak Door",
                                "Dark-Oak-Fence" => "Dark Oak Fence",
                                "Dark-Oak-Fence-Gate" => "Dark Oak Fence Gate",
                                "Dark-Oak-Leaves" => "Dark Oak Leaves",
                                "Dark-Oak-Log" => "Dark Oak Log",
                                "Dark-Oak-Planks" => "Dark Oak Planks",
                                "Dark-Oak-Pressure-Plate" => "Dark Oak Pressure Plate",
                                "Dark-Oak-Sapling" => "Dark Oak Sapling",
                                "Dark-Oak-Sign" => "Dark Oak Sign",
                                "Dark-Oak-Slab" => "Dark Oak Slab",
                                "Dark-Oak-Stairs" => "Dark Oak Stairs",
                                "Dark-Oak-Trapdoor" => "Dark Oak Trapdoor",
                                "Dark-Oak-Wood" => "Dark Oak Wood",
                                "Dark-Prismarine" => "Dark Prismarine",
                                "Dark-Prismarine-Slab" => "Dark Prismarine Slab",
                                "Dark-Prismarine-Stairs" => "Dark Prismarine Stairs",
                                "Daylight-Detector" => "Daylight Detector",
                                "Dead-Brain-Coral" => "Dead Brain Coral",
                                "Dead-Brain-Coral-Block" => "Dead Brain Coral Block",
                                "Dead-Brain-Coral-Fan" => "Dead Brain Coral Fan",
                                "Dead-Bubble-Coral" => "Dead Bubble Coral",
                                "Dead-Bubble-Coral-Block" => "Dead Bubble Coral Block",
                                "Dead-Bubble-Coral-Fan" => "Dead Bubble Coral Fan",
                                "Dead-Bush" => "Dead Bush",
                                "Dead-Fire-Coral" => "Dead Fire Coral",
                                "Dead-Fire-Coral-Block" => "Dead Fire Coral Block",
                                "Dead-Fire-Coral-Fan" => "Dead Fire Coral Fan",
                                "Dead-Horn-Coral" => "Dead Horn Coral",
                                "Dead-Horn-Coral-Block" => "Dead Horn Coral Block",
                                "Dead-Horn-Coral-Fan" => "Dead Horn Coral Fan",
                                "Dead-Tube-Coral" => "Dead Tube Coral",
                                "Dead-Tube-Coral-Block" => "Dead Tube Coral Block",
                                "Dead-Tube-Coral-Fan" => "Dead Tube Coral Fan",
                                "Debug-Stick" => "Debug Stick",
                                "Deepslate" => "Deepslate",
                                "Deepslate-Brick-Slab" => "Deepslate Brick Slab",
                                "Deepslate-Brick-Stairs" => "Deepslate Brick Stairs",
                                "Deepslate-Brick-Wall" => "Deepslate Brick Wall",
                                "Deepslate-Bricks" => "Deepslate Bricks",
                                "Deepslate-Copper-Ore" => "Deepslate Copper Ore",
                                "Deepslate-Diamond-Ore" => "Deepslate Diamond Ore",
                                "Deepslate-Gold-Ore" => "Deepslate Gold Ore",
                                "Deepslate-Iron-Ore" => "Deepslate Iron Ore",
                                "Deepslate-Lapis-Ore" => "Deepslate Lapis Ore",
                                "Deepslate-Redstone-Ore" => "Deepslate Redstone Ore",
                                "Deepslate-Tile-Slab" => "Deepslate Tile Slab",
                                "Deepslate-Tile-Stairs" => "Deepslate Tile Stairs",
                                "Deepslate-Tile-Wall" => "Deepslate Tile Wall",
                                "Deepslate-Tiles" => "Deepslate Tiles",
                                "Detector-Rail" => "Detector Rail",
                                "Diamond" => "Diamond",
                                "Diamond-Axe" => "Diamond Axe",
                                "Diamond-Block" => "Diamond Block",
                                "Diamond-Boots" => "Diamond Boots",
                                "Diamond-Chestplate" => "Diamond Chestplate",
                                "Diamond-Helmet" => "Diamond Helmet",
                                "Diamond-Hoe" => "Diamond Hoe",
                                "Diamond-Horse-Armor" => "Diamond Horse Armor",
                                "Diamond-Leggings" => "Diamond Leggings",
                                "Diamond-Ore" => "Diamond Ore",
                                "Diamond-Pickaxe" => "Diamond Pickaxe",
                                "Diamond-Shovel" => "Diamond Shovel",
                                "Diamond-Sword" => "Diamond Sword",
                                "Diorite" => "Diorite",
                                "Diorite-Slab" => "Diorite Slab",
                                "Diorite-Stairs" => "Diorite Stairs",
                                "Diorite-Wall" => "Diorite Wall",
                                "Dirt" => "Dirt",
                                "Dispenser" => "Dispenser",
                                "Dragon-Breath" => "Dragon Breath",
                                "Dragon-Egg" => "Dragon Egg",
                                "Dragon-Head" => "Dragon Head",
                                "Dried-Kelp" => "Dried Kelp",
                                "Dried-Kelp-Block" => "Dried Kelp Block",
                                "Dripstone-Block" => "Dripstone Block",
                                "Dropper" => "Dropper",
                                "Egg" => "Egg",
                                "Elytra" => "Elytra",
                                "Emerald" => "Emerald",
                                "Emerald-Block" => "Emerald Block",
                                "Emerald-Ore" => "Emerald Ore",
                                "Enchanted-Book" => "Enchanted Book",
                                "Enchanted-Golden-Apple" => "Enchanted Golden Apple",
                                "Enchanting-Table" => "Enchanting Table",
                                "End-Crystal" => "End Crystal",
                                "End-Portal-Frame" => "End Portal Frame",
                                "End-Rod" => "End Rod",
                                "End-Stone" => "End Stone",
                                "End-Stone-Brick-Slab" => "End Stone Brick Slab",
                                "End-Stone-Brick-Stairs" => "End Stone Brick Stairs",
                                "End-Stone-Brick-Wall" => "End Stone Brick Wall",
                                "End-Stone-Bricks" => "End Stone Bricks",
                                "Ender-Chest" => "Ender Chest",
                                "Ender-Eye" => "Ender Eye",
                                "Ender-Pearl" => "Ender Pearl",
                                "Experience-Bottle" => "Experience Bottle",
                                "Exposed-Copper" => "Exposed Copper",
                                "Exposed-Cut-Copper" => "Exposed Cut Copper",
                                "Exposed-Cut-Copper-Slab" => "Exposed Cut Copper Slab",
                                "Exposed-Cut-Copper-Stairs" => "Exposed Cut Copper Stairs",
                                "Farmland" => "Farmland",
                                "Feather" => "Feather",
                                "Fermented-Spider-Eye" => "Fermented Spider Eye",
                                "Fern" => "Fern",
                                "Filled-Map" => "Filled Map",
                                "Fire-Charge" => "Fire Charge",
                                "Fire-Coral" => "Fire Coral",
                                "Fire-Coral-Block" => "Fire Coral Block",
                                "Fire-Coral-Fan" => "Fire Coral Fan",
                                "Firework-Rocket" => "Firework Rocket",
                                "Firework-Star" => "Firework Star",
                                "Fishing-Rod" => "Fishing Rod",
                                "Fletching-Table" => "Fletching Table",
                                "Flint" => "Flint",
                                "Flint-And-Steel" => "Flint And Steel",
                                "Flower-Banner-Pattern" => "Flower Banner Pattern",
                                "Flower-Pot" => "Flower Pot",
                                "Flowering-Azalea" => "Flowering Azalea",
                                "Flowering-Azalea-Leaves" => "Flowering Azalea Leaves",
                                "Furnace" => "Furnace",
                                "Furnace-Minecart" => "Furnace Minecart",
                                "Ghast-Tear" => "Ghast Tear",
                                "Gilded-Blackstone" => "Gilded Blackstone",
                                "Glass" => "Glass",
                                "Glass-Bottle" => "Glass Bottle",
                                "Glass-Pane" => "Glass Pane",
                                "Glistering-Melon-Slice" => "Glistering Melon Slice",
                                "Globe-Banner-Pattern" => "Globe Banner Pattern",
                                "Glow-Berries" => "Glow Berries",
                                "Glow-Ink-Sac" => "Glow Ink Sac",
                                "Glow-Item-Frame" => "Glow Item Frame",
                                "Glowstone" => "Glowstone",
                                "Glowstone-Dust" => "Glowstone Dust",
                                "Gold-Block" => "Gold Block",
                                "Gold-Ingot" => "Gold Ingot",
                                "Gold-Nugget" => "Gold Nugget",
                                "Gold-Ore" => "Gold Ore",
                                "Golden-Apple" => "Golden Apple",
                                "Golden-Axe" => "Golden Axe",
                                "Golden-Boots" => "Golden Boots",
                                "Golden-Carrot" => "Golden Carrot",
                                "Golden-Chestplate" => "Golden Chestplate",
                                "Golden-Helmet" => "Golden Helmet",
                                "Golden-Hoe" => "Golden Hoe",
                                "Golden-Horse-Armor" => "Golden Horse Armor",
                                "Golden-Leggings" => "Golden Leggings",
                                "Golden-Pickaxe" => "Golden Pickaxe",
                                "Golden-Shovel" => "Golden Shovel",
                                "Golden-Sword" => "Golden Sword",
                                "Granite" => "Granite",
                                "Granite-Slab" => "Granite Slab",
                                "Granite-Stairs" => "Granite Stairs",
                                "Granite-Wall" => "Granite Wall",
                                "Grass" => "Grass",
                                "Grass-Block" => "Grass Block",
                                "Grass-Path" => "Grass Path",
                                "Gravel" => "Gravel",
                                "Gray-Banner" => "Gray Banner",
                                "Gray-Bed" => "Gray Bed",
                                "Gray-Candle" => "Gray Candle",
                                "Gray-Carpet" => "Gray Carpet",
                                "Gray-Concrete" => "Gray Concrete",
                                "Gray-Concrete-Powder" => "Gray Concrete Powder",
                                "Gray-Dye" => "Gray Dye",
                                "Gray-Glazed-Terracotta" => "Gray Glazed Terracotta",
                                "Gray-Shulker-Box" => "Gray Shulker Box",
                                "Gray-Stained-Glass" => "Gray Stained Glass",
                                "Gray-Stained-Glass-Pane" => "Gray Stained Glass Pane",
                                "Gray-Terracotta" => "Gray Terracotta",
                                "Gray-Wool" => "Gray Wool",
                                "Green-Banner" => "Green Banner",
                                "Green-Bed" => "Green Bed",
                                "Green-Candle" => "Green Candle",
                                "Green-Carpet" => "Green Carpet",
                                "Green-Concrete" => "Green Concrete",
                                "Green-Concrete-Powder" => "Green Concrete Powder",
                                "Green-Dye" => "Green Dye",
                                "Green-Glazed-Terracotta" => "Green Glazed Terracotta",
                                "Green-Shulker-Box" => "Green Shulker Box",
                                "Green-Stained-Glass" => "Green Stained Glass",
                                "Green-Stained-Glass-Pane" => "Green Stained Glass Pane",
                                "Green-Terracotta" => "Green Terracotta",
                                "Green-Wool" => "Green Wool",
                                "Grindstone" => "Grindstone",
                                "Gunpowder" => "Gunpowder",
                                "Hay-Block" => "Hay Block",
                                "Heart-of-the-Sea" => "Heart of the Sea",
                                "Heavy-Weighted-Pressure-Plate" => "Heavy Weighted Pressure Plate",
                                "Honey-Block" => "Honey Block",
                                "Honey-Bottle" => "Honey Bottle",
                                "Honeycomb" => "Honeycomb",
                                "Honeycomb-Block" => "Honeycomb Block",
                                "Hopper" => "Hopper",
                                "Hopper-Minecart" => "Hopper Minecart",
                                "Horn-Coral" => "Horn Coral",
                                "Horn-Coral-Block" => "Horn Coral Block",
                                "Horn-Coral-Fan" => "Horn Coral Fan",
                                "Ice" => "Ice",
                                "Infested-Chiseled-Stone-Bricks" => "Infested Chiseled Stone Bricks",
                                "Infested-Cobblestone" => "Infested Cobblestone",
                                "Infested-Cracked-Stone-Bricks" => "Infested Cracked Stone Bricks",
                                "Infested-Mossy-Stone-Bricks" => "Infested Mossy Stone Bricks",
                                "Infested-Stone" => "Infested Stone",
                                "Infested-Stone-Bricks" => "Infested Stone Bricks",
                                "Ink-Sac" => "Ink Sac",
                                "Iron-Axe" => "Iron Axe",
                                "Iron-Bars" => "Iron Bars",
                                "Iron-Block" => "Iron Block",
                                "Iron-Boots" => "Iron Boots",
                                "Iron-Chestplate" => "Iron Chestplate",
                                "Iron-Door" => "Iron Door",
                                "Iron-Helmet" => "Iron Helmet",
                                "Iron-Hoe" => "Iron Hoe",
                                "Iron-Horse-Armor" => "Iron Horse Armor",
                                "Iron-Ingot" => "Iron Ingot",
                                "Iron-Leggings" => "Iron Leggings",
                                "Iron-Nugget" => "Iron Nugget",
                                "Iron-Ore" => "Iron Ore",
                                "Iron-Pickaxe" => "Iron Pickaxe",
                                "Iron-Shovel" => "Iron Shovel",
                                "Iron-Sword" => "Iron Sword",
                                "Iron-Trapdoor" => "Iron Trapdoor",
                                "Item-Frame" => "Item Frame",
                                "Jack-O-Lantern" => "Jack O Lantern",
                                "Jigsaw" => "Jigsaw",
                                "Jukebox" => "Jukebox",
                                "Jungle-Boat" => "Jungle Boat",
                                "Jungle-Button" => "Jungle Button",
                                "Jungle-Door" => "Jungle Door",
                                "Jungle-Fence" => "Jungle Fence",
                                "Jungle-Fence-Gate" => "Jungle Fence Gate",
                                "Jungle-Leaves" => "Jungle Leaves",
                                "Jungle-Log" => "Jungle Log",
                                "Jungle-Planks" => "Jungle Planks",
                                "Jungle-Pressure-Plate" => "Jungle Pressure Plate",
                                "Jungle-Sapling" => "Jungle Sapling",
                                "Jungle-Sign" => "Jungle Sign",
                                "Jungle-Slab" => "Jungle Slab",
                                "Jungle-Stairs" => "Jungle Stairs",
                                "Jungle-Trapdoor" => "Jungle Trapdoor",
                                "Jungle-Wood" => "Jungle Wood",
                                "Kelp" => "Kelp",
                                "Knowledge-Book" => "Knowledge Book",
                                "Ladder" => "Ladder",
                                "Lantern" => "Lantern",
                                "Lapis-Block" => "Lapis Block",
                                "Lapis-Lazuli" => "Lapis Lazuli",
                                "Lapis-Ore" => "Lapis Ore",
                                "Large-Amethyst-Bud" => "Large Amethyst Bud",
                                "Large-Fern" => "Large Fern",
                                "Lava" => "Lava",
                                "Lava-Bucket" => "Lava Bucket",
                                "Lead" => "Lead",
                                "Leather" => "Leather",
                                "Leather-Boots" => "Leather Boots",
                                "Leather-Chestplate" => "Leather Chestplate",
                                "Leather-Helmet" => "Leather Helmet",
                                "Leather-Horse-Armor" => "Leather Horse Armor",
                                "Leather-Leggings" => "Leather Leggings",
                                "Lectern" => "Lectern",
                                "Lever" => "Lever",
                                "Light-Blue-Banner" => "Light Blue Banner",
                                "Light-Blue-Bed" => "Light Blue Bed",
                                "Light-Blue-Candle" => "Light Blue Candle",
                                "Light-Blue-Carpet" => "Light Blue Carpet",
                                "Light-Blue-Concrete" => "Light Blue Concrete",
                                "Light-Blue-Concrete-Powder" => "Light Blue Concrete Powder",
                                "Light-Blue-Dye" => "Light Blue Dye",
                                "Light-Blue-Glazed-Terracotta" => "Light Blue Glazed Terracotta",
                                "Light-Blue-Shulker-Box" => "Light Blue Shulker Box",
                                "Light-Blue-Stained-Glass" => "Light Blue Stained Glass",
                                "Light-Blue-Stained-Glass-Pane" => "Light Blue Stained Glass Pane",
                                "Light-Blue-Terracotta" => "Light Blue Terracotta",
                                "Light-Blue-Wool" => "Light Blue Wool",
                                "Light-Gray-Banner" => "Light Gray Banner",
                                "Light-Gray-Bed" => "Light Gray Bed",
                                "Light-Gray-Candle" => "Light Gray Candle",
                                "Light-Gray-Carpet" => "Light Gray Carpet",
                                "Light-Gray-Concrete" => "Light Gray Concrete",
                                "Light-Gray-Concrete-Powder" => "Light Gray Concrete Powder",
                                "Light-Gray-Dye" => "Light Gray Dye",
                                "Light-Gray-Glazed-Terracotta" => "Light Gray Glazed Terracotta",
                                "Light-Gray-Shulker-Box" => "Light Gray Shulker Box",
                                "Light-Gray-Stained-Glass" => "Light Gray Stained Glass",
                                "Light-Gray-Stained-Glass-Pane" => "Light Gray Stained Glass Pane",
                                "Light-Gray-Terracotta" => "Light Gray Terracotta",
                                "Light-Gray-Wool" => "Light Gray Wool",
                                "Light-Weighted-Pressure-Plate" => "Light Weighted Pressure Plate",
                                "Lilac" => "Lilac",
                                "Lily-of-the-Valley" => "Lily of the Valley",
                                "Lily-Pad" => "Lily Pad",
                                "Lime-Banner" => "Lime Banner",
                                "Lime-Bed" => "Lime Bed",
                                "Lime-Candle" => "Lime Candle",
                                "Lime-Carpet" => "Lime Carpet",
                                "Lime-Concrete" => "Lime Concrete",
                                "Lime-Concrete-Powder" => "Lime Concrete Powder",
                                "Lime-Dye" => "Lime Dye",
                                "Lime-Glazed-Terracotta" => "Lime Glazed Terracotta",
                                "Lime-Shulker-Box" => "Lime Shulker Box",
                                "Lime-Stained-Glass" => "Lime Stained Glass",
                                "Lime-Stained-Glass-Pane" => "Lime Stained Glass Pane",
                                "Lime-Terracotta" => "Lime Terracotta",
                                "Lime-Wool" => "Lime Wool",
                                "Lingering-Potion" => "Lingering Potion",
                                "Lodestone" => "Lodestone",
                                "Loom" => "Loom",
                                "Magenta-Banner" => "Magenta Banner",
                                "Magenta-Bed" => "Magenta Bed",
                                "Magenta-Candle" => "Magenta Candle",
                                "Magenta-Carpet" => "Magenta Carpet",
                                "Magenta-Concrete" => "Magenta Concrete",
                                "Magenta-Concrete-Powder" => "Magenta Concrete Powder",
                                "Magenta-Dye" => "Magenta Dye",
                                "Magenta-Glazed-Terracotta" => "Magenta Glazed Terracotta",
                                "Magenta-Shulker-Box" => "Magenta Shulker Box",
                                "Magenta-Stained-Glass" => "Magenta Stained Glass",
                                "Magenta-Stained-Glass-Pane" => "Magenta Stained Glass Pane",
                                "Magenta-Terracotta" => "Magenta Terracotta",
                                "Magenta-Wool" => "Magenta Wool",
                                "Magma-Block" => "Magma Block",
                                "Magma-Cream" => "Magma Cream",
                                "Map" => "Map",
                                "Medium-Amethyst-Bud" => "Medium Amethyst Bud",
                                "Melon" => "Melon",
                                "Melon-Seeds" => "Melon Seeds",
                                "Melon-Slice" => "Melon Slice",
                                "Milk-Bucket" => "Milk Bucket",
                                "Minecart" => "Minecart",
                                "Mojang-Banner-Pattern" => "Mojang Banner Pattern",
                                "Mossy-Cobblestone" => "Mossy Cobblestone",
                                "Mossy-Cobblestone-Slab" => "Mossy Cobblestone Slab",
                                "Mossy-Cobblestone-Stairs" => "Mossy Cobblestone Stairs",
                                "Mossy-Cobblestone-Wall" => "Mossy Cobblestone Wall",
                                "Mossy-Stone-Brick-Slab" => "Mossy Stone Brick Slab",
                                "Mossy-Stone-Brick-Stairs" => "Mossy Stone Brick Stairs",
                                "Mossy-Stone-Brick-Wall" => "Mossy Stone Brick Wall",
                                "Mossy-Stone-Bricks" => "Mossy Stone Bricks",
                                "Mushroom-Stem" => "Mushroom Stem",
                                "Mushroom-Stew" => "Mushroom Stew",
                                "Music-Disc-11" => "Music Disc 11",
                                "Music-Disc-13" => "Music Disc 13",
                                "Music-Disc-Blocks" => "Music Disc Blocks",
                                "Music-Disc-Cat" => "Music Disc Cat",
                                "Music-Disc-Chirp" => "Music Disc Chirp",
                                "Music-Disc-Far" => "Music Disc Far",
                                "Music-Disc-Mall" => "Music Disc Mall",
                                "Music-Disc-Mellohi" => "Music Disc Mellohi",
                                "Music-Disc-Pigstep" => "Music Disc Pigstep",
                                "Music-Disc-Stal" => "Music Disc Stal",
                                "Music-Disc-Strad" => "Music Disc Strad",
                                "Music-Disc-Wait" => "Music Disc Wait",
                                "Music-Disc-Ward" => "Music Disc Ward",
                                "Mutton" => "Mutton",
                                "Mycelium" => "Mycelium",
                                "Name-Tag" => "Name Tag",
                                "Nautilus-Shell" => "Nautilus Shell",
                                "Nether-Brick" => "Nether Brick",
                                "Nether-Brick-Fence" => "Nether Brick Fence",
                                "Nether-Brick-Slab" => "Nether Brick Slab",
                                "Nether-Brick-Stairs" => "Nether Brick Stairs",
                                "Nether-Brick-Wall" => "Nether Brick Wall",
                                "Nether-Bricks" => "Nether Bricks",
                                "Nether-Gold-Ore" => "Nether Gold Ore",
                                "Nether-Quartz-Ore" => "Nether Quartz Ore",
                                "Nether-Sprouts" => "Nether Sprouts",
                                "Nether-Star" => "Nether Star",
                                "Nether-Wart" => "Nether Wart",
                                "Nether-Wart-Block" => "Nether Wart Block",
                                "Netherite-Axe" => "Netherite Axe",
                                "Netherite-Block" => "Netherite Block",
                                "Netherite-Boots" => "Netherite Boots",
                                "Netherite-Chestplate" => "Netherite Chestplate",
                                "Netherite-Helmet" => "Netherite Helmet",
                                "Netherite-Hoe" => "Netherite Hoe",
                                "Netherite-Ingot" => "Netherite Ingot",
                                "Netherite-Leggings" => "Netherite Leggings",
                                "Netherite-Pickaxe" => "Netherite Pickaxe",
                                "Netherite-Scrap" => "Netherite Scrap",
                                "Netherite-Shovel" => "Netherite Shovel",
                                "Netherite-Sword" => "Netherite Sword",
                                "Netherrack" => "Netherrack",
                                "Note-Block" => "Note Block",
                                "Oak-Boat" => "Oak Boat",
                                "Oak-Button" => "Oak Button",
                                "Oak-Door" => "Oak Door",
                                "Oak-Fence" => "Oak Fence",
                                "Oak-Fence-Gate" => "Oak Fence Gate",
                                "Oak-Leaves" => "Oak Leaves",
                                "Oak-Log" => "Oak Log",
                                "Oak-Planks" => "Oak Planks",
                                "Oak-Pressure-Plate" => "Oak Pressure Plate",
                                "Oak-Sapling" => "Oak Sapling",
                                "Oak-Sign" => "Oak Sign",
                                "Oak-Slab" => "Oak Slab",
                                "Oak-Stairs" => "Oak Stairs",
                                "Oak-Trapdoor" => "Oak Trapdoor",
                                "Oak-Wood" => "Oak Wood",
                                "Observer" => "Observer",
                                "Obsidian" => "Obsidian",
                                "Orange-Banner" => "Orange Banner",
                                "Orange-Bed" => "Orange Bed",
                                "Orange-Candle" => "Orange Candle",
                                "Orange-Carpet" => "Orange Carpet",
                                "Orange-Concrete" => "Orange Concrete",
                                "Orange-Concrete-Powder" => "Orange Concrete Powder",
                                "Orange-Dye" => "Orange Dye",
                                "Orange-Glazed-Terracotta" => "Orange Glazed Terracotta",
                                "Orange-Shulker-Box" => "Orange Shulker Box",
                                "Orange-Stained-Glass" => "Orange Stained Glass",
                                "Orange-Stained-Glass-Pane" => "Orange Stained Glass Pane",
                                "Orange-Terracotta" => "Orange Terracotta",
                                "Orange-Tulip" => "Orange Tulip",
                                "Orange-Wool" => "Orange Wool",
                                "Oxeye-Daisy" => "Oxeye Daisy",
                                "Oxidized-Copper" => "Oxidized Copper",
                                "Oxidized-Cut-Copper" => "Oxidized Cut Copper",
                                "Oxidized-Cut-Copper-Slab" => "Oxidized Cut Copper Slab",
                                "Oxidized-Cut-Copper-Stairs" => "Oxidized Cut Copper Stairs",
                                "Packed-Ice" => "Packed Ice",
                                "Painting" => "Painting",
                                "Paper" => "Paper",
                                "Peony" => "Peony",
                                "Petrified-Oak-Slab" => "Petrified Oak Slab",
                                "Phantom-Membrane" => "Phantom Membrane",
                                "Piglin-Banner-Pattern" => "Piglin Banner Pattern",
                                "Pink-Banner" => "Pink Banner",
                                "Pink-Bed" => "Pink Bed",
                                "Pink-Candle" => "Pink Candle",
                                "Pink-Carpet" => "Pink Carpet",
                                "Pink-Concrete" => "Pink Concrete",
                                "Pink-Concrete-Powder" => "Pink Concrete Powder",
                                "Pink-Dye" => "Pink Dye",
                                "Pink-Glazed-Terracotta" => "Pink Glazed Terracotta",
                                "Pink-Shulker-Box" => "Pink Shulker Box",
                                "Pink-Stained-Glass" => "Pink Stained Glass",
                                "Pink-Stained-Glass-Pane" => "Pink Stained Glass Pane",
                                "Pink-Terracotta" => "Pink Terracotta",
                                "Pink-Tulip" => "Pink Tulip",
                                "Pink-Wool" => "Pink Wool",
                                "Piston" => "Piston",
                                "Player-Head" => "Player Head",
                                "Podzol" => "Podzol",
                                "Pointed-Dripstone" => "Pointed Dripstone",
                                "Poisonous-Potato" => "Poisonous Potato",
                                "Polished-Andesite" => "Polished Andesite",
                                "Polished-Andesite-Slab" => "Polished Andesite Slab",
                                "Polished-Andesite-Stairs" => "Polished Andesite Stairs",
                                "Polished-Basalt" => "Polished Basalt",
                                "Polished-Blackstone" => "Polished Blackstone",
                                "Polished-Blackstone-Brick-Slab" => "Polished Blackstone Brick Slab",
                                "Polished-Blackstone-Brick-Stairs" => "Polished Blackstone Brick Stairs",
                                "Polished-Blackstone-Brick-Wall" => "Polished Blackstone Brick Wall",
                                "Polished-Blackstone-Bricks" => "Polished Blackstone Bricks",
                                "Polished-Blackstone-Button" => "Polished Blackstone Button",
                                "Polished-Blackstone-Pressure-Plate" => "Polished Blackstone Pressure Plate",
                                "Polished-Blackstone-Slab" => "Polished Blackstone Slab",
                                "Polished-Blackstone-Stairs" => "Polished Blackstone Stairs",
                                "Polished-Blackstone-Wall" => "Polished Blackstone Wall",
                                "Polished-Deepslate" => "Polished Deepslate",
                                "Polished-Deepslate-Slab" => "Polished Deepslate Slab",
                                "Polished-Deepslate-Stairs" => "Polished Deepslate Stairs",
                                "Polished-Deepslate-Wall" => "Polished Deepslate Wall",
                                "Polished-Diorite" => "Polished Diorite",
                                "Polished-Diorite-Slab" => "Polished Diorite Slab",
                                "Polished-Diorite-Stairs" => "Polished Diorite Stairs",
                                "Polished-Granite" => "Polished Granite",
                                "Polished-Granite-Slab" => "Polished Granite Slab",
                                "Polished-Granite-Stairs" => "Polished Granite Stairs",
                                "Popped-Chorus-Fruit" => "Popped Chorus Fruit",
                                "Poppy" => "Poppy",
                                "Porkchop" => "Porkchop",
                                "Potato" => "Potato",
                                "Potion" => "Potion",
                                "Powder-Snow" => "Powder Snow",
                                "Powder-Snow-Bucket" => "Powder Snow Bucket",
                                "Powered-Rail" => "Powered Rail",
                                "Prismarine" => "Prismarine",
                                "Prismarine-Brick-Slab" => "Prismarine Brick Slab",
                                "Prismarine-Brick-Stairs" => "Prismarine Brick Stairs",
                                "Prismarine-Bricks" => "Prismarine Bricks",
                                "Prismarine-Crystals" => "Prismarine Crystals",
                                "Prismarine-Shard" => "Prismarine Shard",
                                "Prismarine-Slab" => "Prismarine Slab",
                                "Prismarine-Stairs" => "Prismarine Stairs",
                                "Prismarine-Wall" => "Prismarine Wall",
                                "Pufferfish" => "Pufferfish",
                                "Pufferfish-Bucket" => "Pufferfish Bucket",
                                "Pumpkin" => "Pumpkin",
                                "Pumpkin-Pie" => "Pumpkin Pie",
                                "Pumpkin-Seeds" => "Pumpkin Seeds",
                                "Purple-Banner" => "Purple Banner",
                                "Purple-Bed" => "Purple Bed",
                                "Purple-Candle" => "Purple Candle",
                                "Purple-Carpet" => "Purple Carpet",
                                "Purple-Concrete" => "Purple Concrete",
                                "Purple-Concrete-Powder" => "Purple Concrete Powder",
                                "Purple-Dye" => "Purple Dye",
                                "Purple-Glazed-Terracotta" => "Purple Glazed Terracotta",
                                "Purple-Shulker-Box" => "Purple Shulker Box",
                                "Purple-Stained-Glass" => "Purple Stained Glass",
                                "Purple-Stained-Glass-Pane" => "Purple Stained Glass Pane",
                                "Purple-Terracotta" => "Purple Terracotta",
                                "Purple-Wool" => "Purple Wool",
                                "Purpur-Block" => "Purpur Block",
                                "Purpur-Pillar" => "Purpur Pillar",
                                "Purpur-Slab" => "Purpur Slab",
                                "Purpur-Stairs" => "Purpur Stairs",
                                "Quartz" => "Quartz",
                                "Quartz-Block" => "Quartz Block",
                                "Quartz-Bricks" => "Quartz Bricks",
                                "Quartz-Pillar" => "Quartz Pillar",
                                "Quartz-Slab" => "Quartz Slab",
                                "Quartz-Stairs" => "Quartz Stairs",
                                "Rabbit" => "Rabbit",
                                "Rabbit-Foot" => "Rabbit Foot",
                                "Rabbit-Hide" => "Rabbit Hide",
                                "Rabbit-Stew" => "Rabbit Stew",
                                "Rail" => "Rail",
                                "Raw-Copper" => "Raw Copper",
                                "Raw-Copper-Block" => "Raw Copper Block",
                                "Raw-Gold" => "Raw Gold",
                                "Raw-Gold-Block" => "Raw Gold Block",
                                "Raw-Iron" => "Raw Iron",
                                "Raw-Iron-Block" => "Raw Iron Block",
                                "Red-Banner" => "Red Banner",
                                "Red-Bed" => "Red Bed",
                                "Red-Candle" => "Red Candle",
                                "Red-Carpet" => "Red Carpet",
                                "Red-Concrete" => "Red Concrete",
                                "Red-Concrete-Powder" => "Red Concrete Powder",
                                "Red-Dye" => "Red Dye",
                                "Red-Glazed-Terracotta" => "Red Glazed Terracotta",
                                "Red-Mushroom" => "Red Mushroom",
                                "Red-Mushroom-Block" => "Red Mushroom Block",
                                "Red-Nether-Brick-Slab" => "Red Nether Brick Slab",
                                "Red-Nether-Brick-Stairs" => "Red Nether Brick Stairs",
                                "Red-Nether-Brick-Wall" => "Red Nether Brick Wall",
                                "Red-Nether-Bricks" => "Red Nether Bricks",
                                "Red-Sand" => "Red Sand",
                                "Red-Sandstone" => "Red Sandstone",
                                "Red-Sandstone-Slab" => "Red Sandstone Slab",
                                "Red-Sandstone-Stairs" => "Red Sandstone Stairs",
                                "Red-Sandstone-Wall" => "Red Sandstone Wall",
                                "Red-Shulker-Box" => "Red Shulker Box",
                                "Red-Stained-Glass" => "Red Stained Glass",
                                "Red-Stained-Glass-Pane" => "Red Stained Glass Pane",
                                "Red-Terracotta" => "Red Terracotta",
                                "Red-Tulip" => "Red Tulip",
                                "Red-Wool" => "Red Wool",
                                "Redstone" => "Redstone",
                                "Redstone-Block" => "Redstone Block",
                                "Redstone-Lamp" => "Redstone Lamp",
                                "Redstone-Ore" => "Redstone Ore",
                                "Redstone-Torch" => "Redstone Torch",
                                "Repeater" => "Repeater",
                                "Respawn-Anchor" => "Respawn Anchor",
                                "Rooted-Dirt" => "Rooted Dirt",
                                "Rose-Bush" => "Rose Bush",
                                "Rotten-Flesh" => "Rotten Flesh",
                                "Saddle" => "Saddle",
                                "Salmon" => "Salmon",
                                "Salmon-Bucket" => "Salmon Bucket",
                                "Sand" => "Sand",
                                "Sandstone" => "Sandstone",
                                "Sandstone-Slab" => "Sandstone Slab",
                                "Sandstone-Stairs" => "Sandstone Stairs",
                                "Sandstone-Wall" => "Sandstone Wall",
                                "Scaffolding" => "Scaffolding",
                                "Scute" => "Scute",
                                "Sea-Lantern" => "Sea Lantern",
                                "Sea-Pickle" => "Sea Pickle",
                                "Seagrass" => "Seagrass",
                                "Shears" => "Shears",
                                "Shield" => "Shield",
                                "Shroomlight" => "Shroomlight",
                                "Shulker-Box" => "Shulker Box",
                                "Shulker-Shell" => "Shulker Shell",
                                "Skeleton-Skull" => "Skeleton Skull",
                                "Skull-Banner-Pattern" => "Skull Banner Pattern",
                                "Slime-Ball" => "Slime Ball",
                                "Slime-Block" => "Slime Block",
                                "Small-Amethyst-Bud" => "Small Amethyst Bud",
                                "Small-Dripleaf" => "Small Dripleaf",
                                "Smithing-Table" => "Smithing Table",
                                "Smoker" => "Smoker",
                                "Smooth-Basalt" => "Smooth Basalt",
                                "Smooth-Quartz" => "Smooth Quartz",
                                "Smooth-Quartz-Slab" => "Smooth Quartz Slab",
                                "Smooth-Quartz-Stairs" => "Smooth Quartz Stairs",
                                "Smooth-Red-Sandstone" => "Smooth Red Sandstone",
                                "Smooth-Red-Sandstone-Slab" => "Smooth Red Sandstone Slab",
                                "Smooth-Red-Sandstone-Stairs" => "Smooth Red Sandstone Stairs",
                                "Smooth-Sandstone" => "Smooth Sandstone",
                                "Smooth-Sandstone-Slab" => "Smooth Sandstone Slab",
                                "Smooth-Sandstone-Stairs" => "Smooth Sandstone Stairs",
                                "Smooth-Stone" => "Smooth Stone",
                                "Smooth-Stone-Slab" => "Smooth Stone Slab",
                                "Snow" => "Snow",
                                "Snow-Block" => "Snow Block",
                                "Snowball" => "Snowball",
                                "Soul-Campfire" => "Soul Campfire",
                                "Soul-Lantern" => "Soul Lantern",
                                "Soul-Sand" => "Soul Sand",
                                "Soul-Soil" => "Soul Soil",
                                "Soul-Torch" => "Soul Torch",
                                "Spawner" => "Spawner",
                                "Spectral-Arrow" => "Spectral Arrow",
                                "Spider-Eye" => "Spider Eye",
                                "Splash-Potion" => "Splash Potion",
                                "Sponge" => "Sponge",
                                "Spore-Blossom" => "Spore Blossom",
                                "Spruce-Boat" => "Spruce Boat",
                                "Spruce-Button" => "Spruce Button",
                                "Spruce-Door" => "Spruce Door",
                                "Spruce-Fence" => "Spruce Fence",
                                "Spruce-Fence-Gate" => "Spruce Fence Gate",
                                "Spruce-Leaves" => "Spruce Leaves",
                                "Spruce-Log" => "Spruce Log",
                                "Spruce-Planks" => "Spruce Planks",
                                "Spruce-Pressure-Plate" => "Spruce Pressure Plate",
                                "Spruce-Sapling" => "Spruce Sapling",
                                "Spruce-Sign" => "Spruce Sign",
                                "Spruce-Slab" => "Spruce Slab",
                                "Spruce-Stairs" => "Spruce Stairs",
                                "Spruce-Trapdoor" => "Spruce Trapdoor",
                                "Spruce-Wood" => "Spruce Wood",
                                "Spyglass" => "Spyglass",
                                "Stick" => "Stick",
                                "Sticky-Piston" => "Sticky Piston",
                                "Stone" => "Stone",
                                "Stone-Axe" => "Stone Axe",
                                "Stone-Brick-Slab" => "Stone Brick Slab",
                                "Stone-Brick-Stairs" => "Stone Brick Stairs",
                                "Stone-Brick-Wall" => "Stone Brick Wall",
                                "Stone-Bricks" => "Stone Bricks",
                                "Stone-Button" => "Stone Button",
                                "Stone-Hoe" => "Stone Hoe",
                                "Stone-Pickaxe" => "Stone Pickaxe",
                                "Stone-Pressure-Plate" => "Stone Pressure Plate",
                                "Stone-Shovel" => "Stone Shovel",
                                "Stone-Slab" => "Stone Slab",
                                "Stone-Stairs" => "Stone Stairs",
                                "Stone-Sword" => "Stone Sword",
                                "Stonecutter" => "Stonecutter",
                                "String" => "String",
                                "Stripped-Acacia-Log" => "Stripped Acacia Log",
                                "Stripped-Acacia-Wood" => "Stripped Acacia Wood",
                                "Stripped-Birch-Log" => "Stripped Birch Log",
                                "Stripped-Birch-Wood" => "Stripped Birch Wood",
                                "Stripped-Crimson-Hyphae" => "Stripped Crimson Hyphae",
                                "Stripped-Crimson-Stem" => "Stripped Crimson Stem",
                                "Stripped-Dark-Oak-Log" => "Stripped Dark Oak Log",
                                "Stripped-Dark-Oak-Wood" => "Stripped Dark Oak Wood",
                                "Stripped-Jungle-Log" => "Stripped Jungle Log",
                                "Stripped-Jungle-Wood" => "Stripped Jungle Wood",
                                "Stripped-Oak-Log" => "Stripped Oak Log",
                                "Stripped-Oak-Wood" => "Stripped Oak Wood",
                                "Stripped-Spruce-Log" => "Stripped Spruce Log",
                                "Stripped-Spruce-Wood" => "Stripped Spruce Wood",
                                "Stripped-Warped-Hyphae" => "Stripped Warped Hyphae",
                                "Stripped-Warped-Stem" => "Stripped Warped Stem",
                                "Structure-Block" => "Structure Block",
                                "Structure-Void" => "Structure Void",
                                "Sugar" => "Sugar",
                                "Sugar-Cane" => "Sugar Cane",
                                "Sunflower" => "Sunflower",
                                "Suspicious-Stew" => "Suspicious Stew",
                                "Sweet-Berries" => "Sweet Berries",
                                "Tall-Grass" => "Tall Grass",
                                "Target" => "Target",
                                "Terracotta" => "Terracotta",
                                "Tinted-Glass" => "Tinted Glass",
                                "Tipped-Arrow" => "Tipped Arrow",
                                "Tnt" => "Tnt",
                                "Tnt-Minecart" => "Tnt Minecart",
                                "Torch" => "Torch",
                                "Totem-of-Undying" => "Totem of Undying",
                                "Trapped-Chest" => "Trapped Chest",
                                "Trident" => "Trident",
                                "Tripwire-Hook" => "Tripwire Hook",
                                "Tropical-Fish" => "Tropical Fish",
                                "Tropical-Fish-Bucket" => "Tropical Fish Bucket",
                                "Tube-Coral" => "Tube Coral",
                                "Tube-Coral-Block" => "Tube Coral Block",
                                "Tube-Coral-Fan" => "Tube Coral Fan",
                                "Tuff" => "Tuff",
                                "Turtle-Egg" => "Turtle Egg",
                                "Turtle-Helmet" => "Turtle Helmet",
                                "Twisting-Vines" => "Twisting Vines",
                                "Vine" => "Vine",
                                "Warped-Button" => "Warped Button",
                                "Warped-Door" => "Warped Door",
                                "Warped-Fence" => "Warped Fence",
                                "Warped-Fence-Gate" => "Warped Fence Gate",
                                "Warped-Fungus" => "Warped Fungus",
                                "Warped-Fungus-On-A-Stick" => "Warped Fungus On A Stick",
                                "Warped-Hyphae" => "Warped Hyphae",
                                "Warped-Nylium" => "Warped Nylium",
                                "Warped-Planks" => "Warped Planks",
                                "Warped-Pressure-Plate" => "Warped Pressure Plate",
                                "Warped-Roots" => "Warped Roots",
                                "Warped-Sign" => "Warped Sign",
                                "Warped-Slab" => "Warped Slab",
                                "Warped-Stairs" => "Warped Stairs",
                                "Warped-Stem" => "Warped Stem",
                                "Warped-Trapdoor" => "Warped Trapdoor",
                                "Warped-Wart-Block" => "Warped Wart Block",
                                "Water-Bucket" => "Water Bucket",
                                "Waxed-Copper-Block" => "Waxed Copper Block",
                                "Waxed-Cut-Copper" => "Waxed Cut Copper",
                                "Waxed-Cut-Copper-Slab" => "Waxed Cut Copper Slab",
                                "Waxed-Cut-Copper-Stairs" => "Waxed Cut Copper Stairs",
                                "Waxed-Exposed-Copper" => "Waxed Exposed Copper",
                                "Waxed-Exposed-Cut-Copper" => "Waxed Exposed Cut Copper",
                                "Waxed-Exposed-Cut-Copper-Slab" => "Waxed Exposed Cut Copper Slab",
                                "Waxed-Exposed-Cut-Copper-Stairs" => "Waxed Exposed Cut Copper Stairs",
                                "Waxed-Oxidized-Copper" => "Waxed Oxidized Copper",
                                "Waxed-Oxidized-Cut-Copper" => "Waxed Oxidized Cut Copper",
                                "Waxed-Oxidized-Cut-Copper-Slab" => "Waxed Oxidized Cut Copper Slab",
                                "Waxed-Oxidized-Cut-Copper-Stairs" => "Waxed Oxidized Cut Copper Stairs",
                                "Waxed-Weathered-Copper" => "Waxed Weathered Copper",
                                "Waxed-Weathered-Cut-Copper" => "Waxed Weathered Cut Copper",
                                "Waxed-Weathered-Cut-Copper-Slab" => "Waxed Weathered Cut Copper Slab",
                                "Waxed-Weathered-Cut-Copper-Stairs" => "Waxed Weathered Cut Copper Stairs",
                                "Weathered-Copper" => "Weathered Copper",
                                "Weathered-Cut-Copper" => "Weathered Cut Copper",
                                "Weathered-Cut-Copper-Slab" => "Weathered Cut Copper Slab",
                                "Weathered-Cut-Copper-Stairs" => "Weathered Cut Copper Stairs",
                                "Weeping-Vines" => "Weeping Vines",
                                "Wet-Sponge" => "Wet Sponge",
                                "Wheat" => "Wheat",
                                "Wheat-Seeds" => "Wheat Seeds",
                                "White-Banner" => "White Banner",
                                "White-Bed" => "White Bed",
                                "White-Candle" => "White Candle",
                                "White-Carpet" => "White Carpet",
                                "White-Concrete" => "White Concrete",
                                "White-Concrete-Powder" => "White Concrete Powder",
                                "White-Dye" => "White Dye",
                                "White-Glazed-Terracotta" => "White Glazed Terracotta",
                                "White-Shulker-Box" => "White Shulker Box",
                                "White-Stained-Glass" => "White Stained Glass",
                                "White-Stained-Glass-Pane" => "White Stained Glass Pane",
                                "White-Terracotta" => "White Terracotta",
                                "White-Tulip" => "White Tulip",
                                "White-Wool" => "White Wool",
                                "Wither-Rose" => "Wither Rose",
                                "Wither-Skeleton-Skull" => "Wither Skeleton Skull",
                                "Wooden-Axe" => "Wooden Axe",
                                "Wooden-Hoe" => "Wooden Hoe",
                                "Wooden-Pickaxe" => "Wooden Pickaxe",
                                "Wooden-Shovel" => "Wooden Shovel",
                                "Wooden-Sword" => "Wooden Sword",
                                "Writable-Book" => "Writable Book",
                                "Written-Book" => "Written Book",
                                "Yellow-Banner" => "Yellow Banner",
                                "Yellow-Bed" => "Yellow Bed",
                                "Yellow-Candle" => "Yellow Candle",
                                "Yellow-Carpet" => "Yellow Carpet",
                                "Yellow-Concrete" => "Yellow Concrete",
                                "Yellow-Concrete-Powder" => "Yellow Concrete Powder",
                                "Yellow-Dye" => "Yellow Dye",
                                "Yellow-Glazed-Terracotta" => "Yellow Glazed Terracotta",
                                "Yellow-Shulker-Box" => "Yellow Shulker Box",
                                "Yellow-Stained-Glass" => "Yellow Stained Glass",
                                "Yellow-Stained-Glass-Pane" => "Yellow Stained Glass Pane",
                                "Yellow-Terracotta" => "Yellow Terracotta",
                                "Yellow-Wool" => "Yellow Wool",
                                "Zombie-Head" => "Zombie Head"
                            );
                        ?>
                        {!! Form::select('formShopInventoryItem', $items, '', ['id' => 'formShopInventoryItem', 'class' => 'w-full form-select py-1 mb-2 md:text-lg']) !!}
                        <?php
                            for ($i = 1; $i < 65; $i++){
                                $amountArr[strval($i)] = strval($i);
                            }
                            ?>
                        {!! Form::label('formShopInventoryPriceAmount', 'Price:', []) !!}
                        <div class="w-full flex mb-4">
                            {!! Form::select('formShopInventoryPriceAmount', $amountArr, '1', ['class' => 'w-fit form-select py-0']) !!}
                            {!! Form::select('formShopInventoryPriceUnit', ['diamond' => 'Diamond', 'diamond-block' => 'Diamond Block'], 'diamond', ['id' => 'formShopInventoryPriceUnit', 'class' => 'w-full form-select py-1']) !!}
                        </div>
                        {!! Form::label('formShopInventoryItemAmount', 'Quantity:', []) !!}
                        <div class="w-full flex mb-2">
                            {!! Form::select('formShopInventoryItemAmount', $amountArr, '1', ['class' => 'w-fit form-select py-0']) !!}
                            {!! Form::select('formShopInventoryItemUnit', ['item' => 'Item', 'stack' => 'Stack', 'shulker' => 'Shulker'], 'item', ['id' => 'formShopInventoryItemUnit', 'class' => 'w-full form-select py-1']) !!}
                        </div>
                        <div class="w-full flex justify-end">
                            <div id="formShopInventoryAdd" class="bg-blue-400 px-3 py-1 rounded-xl mb-4 hover:cursor-pointer">Add</div>
                        </div>
                        <div>
                            <div id="addedStockDiv" class="2xl:hidden ">
                                @if(isset($inventory))
                                    @foreach($inventory as $item)
                                    <div id="<?=str_replace(' ', '-',$item['item']);?>">
                                        <p class="flex items-center text-xl">
                                            <svg onclick="removeItem('<?=str_replace(' ', '-',$item['item']);?>')" class="mr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                                <path d="M17 13H7v-2h10m-5-9A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2z" fill="currentColor"/>
                                            </svg>{{$item['item']}}</p>
                                        <p class="text-sm italic" style="margin-left: 3em;"><?=$item['pricing']['amount']." ".$item['pricing']['unit']." = ".$item['product']['amount']." ".$item['product']['unit']; ?></p>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div id="extStockPane" class="hidden 2xl:inline-block 2xl:col-start-6 2xl:col-span-5 2xl:row-start-2 bg-gray-300 px-6 py-2 rounded-xl text-xl lg:text-2xl text-black">
                        <p class="underline text-center mb-2 text-2xl">Added Stock</p>
                        <div id="extStockDiv" class="flex text-lg items-center justify-start align-center px-6 lg:px-6 flex-wrap">
                            @if(isset($inventory))
                                @foreach ($inventory as $item)
                                <div id="ext<?=str_replace(' ', '-',$item['item']);?>" class="items-center mx-2 w-[178px] inline-block">
                                    <div class="flex justify-left items-center">
                                        <svg onclick="removeItem('<?=str_replace(' ', '-',$item['item']);?>')" class="mr-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M17 13H7v-2h10m-5-9A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2z" fill="currentColor"/></svg>
                                        <span class="lg:text-xl flex-wrap truncate">{{$item['item']}}</span>
                                    </div>
                                    <div class="italic text-[16px] -mt-2 items-center"><?=$item['pricing']['amount']." ".$item['pricing']['unit']." = ".$item['product']['amount']." ".$item['product']['unit']; ?></div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    
                    <div id="submitPane" class="md:row-start-3 md:col-span-2 md:col-start-5 md:row-span-1 2xl:row-start-1 2xl:col-span-2 2xl:col-start-10 max-h-40 bg-sky-400 px-2 py-2 xl:px-6 rounded-xl text-xl lg:text-2xl text-black">
                        <p class="underline text-center mb-2 text-2xl">Finishing Up</p>
                        <p class="text-sm text-center mb-4">Check your work and then save your shop!</p>
                        <div class="w-full text-center content-center mb-2">
                            <span class="bg-green-300 text-black px-2 rounded-lg hover:cursor-pointer text-2xl" onclick="submitShop()">Update</span>
                        </div>
                    </div>
                {!! Form::close() !!}
            </main>
        </div>
    </body>
    <script>
        function shoplistRedirect(){
            window.location.href = "/shop/view/{{$shop->id}}";
        }
        function backButton(){
                window.location.href="/shop/view/{{$shop->id}}";
        }
        function manageShopsRedirect(){
            window.location.href = "/shoplist/p:{{Auth::user()->name}}";
        }
        function newShopRedirect(){
            window.location.href = "/shop/create";
        }
        function logout(){
            window.location.href = "/logout";
        }
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
    <script>
        var coowners = [];
        <?php
            $ownerlist = $shop->owners(false, Auth::id());
            if ($ownerlist){
                foreach($ownerlist as $i){
                    echo "coowners.push(". str_replace(" ", "-", json_encode($item)). ");";
                }
            }
        ?>
        if (coowners.length > 0){
            coowners.forEach(element => {
                $("#formShopOwnersTemp > option[value="+element+"]").prop('disabled', true);
                var elementName =  $("#formShopOwnersTemp > option[value="+element+"]").text();
                $('#additionalOwnerDiv').append('<p id="'+element+'"class="flex items-center text-xl ml-2"><svg class="mr-2 hover:cursor-not-allowed" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M17 13H7v-2h10m-5-9A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2z" fill="currentColor"/></svg>'+elementName+'</p>');
            });
        }
        $('#formShopOwnersTemp').change(function(){
            var newOwner = $(this).val();
            var newOwnerName =  $("#formShopOwnersTemp > option[value="+newOwner+"]").text();
            if (newOwner){
                if (coowners.length < 4){
                    coowners.push(newOwner);
                    $("#formShopOwnersTemp > option[value="+newOwner+"]").prop('disabled', true);
                    $('#formShopOwnersTemp > option[value=""').prop('selected', true);
                    $('#additionalOwnerDiv').append('<p id="'+newOwner+'"class="flex items-center text-xl ml-2"><svg onclick="removeOwner('+"'"+newOwner+"'"+')" class="mr-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M17 13H7v-2h10m-5-9A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2z" fill="currentColor"/></svg>'+newOwnerName+'</p>');
                }
            }
        });

        function removeOwner(owner){
            var index = coowners.indexOf(owner);
            coowners.splice(index, 1);
            $('#' + owner).remove();
            $("#formShopOwnersTemp > option[value="+owner+"]").prop('disabled', false);
        }

        var inventory = [];
        <?php
            if (isset($inventory)){
                foreach($inventory as $item){
                    echo "inventory.push(". str_replace(" ", "-", json_encode($item)). ");";
                }
            }
        ?>
        $('#formShopInventoryAdd').click(function(){
            var newItem = {
                'item': $('#formShopInventoryItem').val(),
                'product': {
                    'amount': $('#formShopInventoryItemAmount').val(),
                    'unit': $('#formShopInventoryItemUnit').val()
                },
                'pricing': {
                    'amount': $('#formShopInventoryPriceAmount').val(),
                    'unit': $('#formShopInventoryPriceUnit').val()
                }
            };
            if (newItem.item){
                inventory.push(newItem);
                $("#formShopInventoryItem > option[value="+newItem.item+"]").prop('disabled', true);
                $('#formShopInventoryItem > option[value=""').prop('selected', true);
                $('#formShopInventoryItemAmount > option[value="1"').prop('selected', true);
                $('#formShopInventoryItemUnit > option[value="item"').prop('selected', true);
                $('#formShopInventoryPriceAmount > option[value="1"').prop('selected', true);
                $('#formShopInventoryPriceUnit > option[value="diamond"').prop('selected', true);
                $('#addedStockDiv').append('<div id="'+newItem.item+'"><p class="flex items-center text-xl"><svg onclick="removeItem('+"'"+newItem.item+"'"+')" class="mr-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M17 13H7v-2h10m-5-9A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2z" fill="currentColor"/></svg>'+newItem.item.replace("-", " ")+'</p></div>');
                $('#'+newItem.item).append('<p class="text-sm italic" style="margin-left: 3em;">'+newItem.pricing.amount+" "+newItem.pricing.unit.replace("-", " ")+" = "+newItem.product.amount+" "+newItem.product.unit+'</p>');
                $('#extStockDiv').append('<div id="ext'+newItem.item+'" class="items-center mx-2 min-w-[128px] max-w-[200px] inline-block"><div class="flex justify-left items-center"><svg onclick="removeItem('+"'"+newItem.item+"'"+')" class="mr-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M17 13H7v-2h10m-5-9A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2z" fill="currentColor"/></svg><span class="lg:text-xl flex-wrap truncate">'+newItem.item.replace("-", " ")+'</span></div><div class="italic text-[16px] -mt-2 items-center">'+newItem.pricing.amount+" "+newItem.pricing.unit.replace("-", " ")+" = "+newItem.product.amount+" "+newItem.product.unit+'</div></div>');
                
            }
        });

        function removeItem(item){
            var count = 0;
            var index = 0;
            inventory.forEach(element => {
                if (element.item == item){
                    index = count;
                }
                count++;
            });
            inventory.splice(index, 1);
            $('#' + item).remove();
            $('#ext' + item).remove();
            $("#formShopInventoryItem > option[value="+item+"]").prop('disabled', false);
        }

        function submitShop(){
            coowners.push("<?=Auth::id(); ?>");
            var count = 0;
            coowners.forEach(function(owner){
                $('#submitPane').after('<input type="text" name="coowners['+count+']" value="'+owner+'" style="display:none;">');
                count++;
            });

            var invString = "";
            console.log(inventory);
            if (inventory.length > 0){
                invString += "[";
                inventory.forEach(function(item){
                    invString += "," + JSON.stringify(item);
                });
                invString += "]";
                invString = invString.replace(",", "");
            }
            
            $('#submitPane').after('<input type="text" name="stock" value="'+invString.replaceAll('"', "'")+'" style="display:none;">');
            if ($('#formShopArea').val() == 'Mall'){
                
                $('#formLocationX').prop('disabled', true);
                $('#formLocationZ').prop('disabled', true);
            }
            else {
                $('#formMallFloor').prop('disabled', true);
                $('#formMallDir').prop('disabled', true);
            }

            $('#formShopInventoryItem').prop('disabled', true);
            $('#formShopInventoryItemUnit').prop('disabled', true);
            $('#formShopInventoryItemAmount').prop('disabled', true);
            $('#formShopInventoryPriceAmount').prop('disabled', true);
            $('#formShopInventoryPriceUnit').prop('disabled', true);
            $('#formShopOwnersTemp').prop('disabled', true);

            $('#formShop').submit();
        }
    </script>
</html>