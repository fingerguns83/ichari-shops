<?php
use App\Models\Shop;

    $user = Auth::user();
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    $isOwner = $shop->isOwner($user->id);
    $inventory = null;
    if ($shop->type == "Retail"){
        $inventory = json_decode($shop->inventory, true);
        sort($inventory);
    }
    if ($shop->description){
        $sanitizer = HtmlSanitizer\Sanitizer::create([
            'extensions' => ['basic', 'list'], 
            'tags' => [
                'div' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h1' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h2' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h3' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h4' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h5' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h6' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'span' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'p' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'ul' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'li' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ]
            ]
        ]);
        $description = $sanitizer->sanitize($shop->description);
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
        </style>
    </head>
    <body class="w-screen bg-[#131314]">
        <nav class="w-full fixed flex bg-[#303032] border-[#155cb3] border-b-2 justify-between items-center content-center py-4">
            <div id="backButton" class="w-1/6 flex text-gray-100 items-center content-center justify-start ml-4 hover:cursor-pointer hover:text-[#155cb3] group" onclick="backButton({{$back ?? ''}})">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M16.62 2.99a1.25 1.25 0 0 0-1.77 0L6.54 11.3a.996.996 0 0 0 0 1.41l8.31 8.31c.49.49 1.28.49 1.77 0s.49-1.28 0-1.77L9.38 12l7.25-7.25c.48-.48.48-1.28-.01-1.76z"/></svg>
                <span class="text-xl ml-2 hidden lg:inline">Back</span>
            </div>
            <div id="title" class="flex w-1/2 text-gray-100 text-xl md:text-2xl lg:text-3xl justify-center content-center items-center">
                getenv('APP_NAME')
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
            <main class="mx-6 xl:mx-32 pt-8 grid gap-2 lg:gap-4 grid-cols-1 md:grid-cols-6 lg:grid-cols-12 content-center justify-center">
                <?php
                    switch($shop->status){
                        case('closed'):
                            $shopStatusStyle = "background-color:hsl(0, 35%, 70%);";
                            $nextStatusStyle = "background-color:rgb(234, 179, 8);";
                            break;
                        case('pending'):
                            $shopStatusStyle = "background-color:hsl(50, 35%, 70%);";
                            $nextStatusStyle = "background-color:rgb(34, 197, 94);";
                            break;
                        case('open'):
                            $shopStatusStyle = "background-color:hsl(142, 35%, 70%);";
                            $nextStatusStyle = "background-color:rgb(239, 68, 68);";
                            break;
                        default:
                            $shopStatusStyle = "background-color:hsl(216, 12%, 84%);";
                            $nextStatusStyle = "background-color:rgb(234, 179, 8);";
                            break;
                    }
                ?>
                <div id="infoPane" class="relative md:col-start-2 md:col-span-2 lg:col-start-4 lg:col-span-3 px-4 py-2 lg:px-6 rounded-xl" style="{{$shopStatusStyle}}">
                    <p class="font-bold block text-xl lg:text-2xl xl:text-3xl text-center underline">{{$shop->name}}</p>
                    <p class="text-center text-lg">({{$shop->area}}: {{$shop->location}})</p>
                    <p class="text-center text-sm">Updated: {{$shop->last_update()}}</p>
                    <div class="flex items-center justify-evenly flex-wrap">
                    @foreach($shop->owners() as $owner)
                        <div class="flex items-center mt-2">
                            <img src="{{$owner->avatar}}" class="rounded-full" style="heigh:2em; width:2em;">
                            <p class="text-lg ml-2 mr-1">{{$owner->name}}</p>
                        </div>
                    @endforeach
                    </div>
                </div>
                @if (($shop->blurb) || ($isOwner))
                <div id="blurbPane" class="md:col-start-4 md:col-span-2 lg:col-start-7 lg:col-span-3 bg-indigo-600 px-4 py-2 lg:px-6 rounded-xl text-xl lg:text-2xl xl:text-3xl text-white">
                    <!--<p class="flex justify-center items-center mb-2 underline">Announcement</p>-->
                    <div id="staticBlurb" class="h-full flex items-center content-center">
                        <p  class="w-full italic break-all font-extralight text-center text-[1rem] lg:text-2xl leading-none">{{$shop->blurb}}</p>
                    </div>
                @if ($isOwner)
                    <div id="formBlurbContainer" class="w-full" style="display:none;">
                        {!! Form::open(['url' => '/shop/edit/blurb/' . $shop->id, 'id' => 'formBlurb']) !!}
                        <div class="flex justify-center content-center w-5/6 mb-2 mx-auto">
                            {!! Form::textarea('formBlurbInput', $shop->blurb, ['class' => 'form-input text-black italic text-center lg:text-lg py-0 h-[3.75rem]', 'maxlength' => '140', 'placeholder' => "Add an announcement, tagline, promotion, etc..."]) !!}
                        </div>
                        <div class="flex justify-center mb-2">
                            {!! Form::submit('Update', ['class' => 'bg-sky-400 p-2 rounded-xl hover:cursor-pointer']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                @endif
                </div>
                @endif
               @if ($shop->description)
                <div id="descriptionPane" class="md:row-start-2 md:col-span-4 md:col-start-2 lg:col-start-5 lg:col-span-4 bg-fuchsia-200 px-4 py-2 lg:px-8 rounded-xl text-xl lg:text-2xl xl:text-3xl text-black">
                    <p class="underline text-center mb-2">Description</p>
                    <div class="text-[1rem] lg:text-xl leading-none"><?=$description ?? ''; ?></div>
                </div>
                @endif
               
            @if ($shop->type == 'Retail')
                <div id="inventoryPane" class="md:row-start-3 md:col-span-4 md:col-start-2 lg:col-start-4 lg:col-span-6 bg-gray-300 px-4 py-4 lg:px-6 rounded-xl text-xl lg:text-2xl xl:text-3xl text-black justify-center">
                    <p class="underline text-center mb-2">Shop Stock</p>
                    <div class="flex text-lg items-center justify-around align-center px-6 lg:px-6 flex-wrap">
                    @foreach ($inventory as $item)
                        <div class="items-center mx-2 min-w-[128px] inline-block">
                            <div class="flex justify-center">
                                <span class="lg:text-xl">{{$item['item']}}</span>
                            </div>
                            <div class="italic text-[16px] -mt-2">
                                <?php
                                    $output = "(" . $item['pricing']['amount'] . " ";
                                    if (intval($item['pricing']['amount'] > 1)){
                                        $output .= $item['pricing']['unit'] . "s = ";
                                    }
                                    else {
                                        $output .= $item['pricing']['unit'] . " = ";
                                    }
                                    $output .= $item['product']['amount'] . " ";
                                    if (intval($item['product']['amount'] > 1)){
                                        $output .= $item['product']['unit'] . "s";
                                    }
                                    else {
                                        $output .= $item['product']['unit'];
                                    }
                                    echo $output . ")";
                                ?>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            @endif
            </main>
        </div>
        @if ($isOwner)
            <div class="w-14 h-64 fixed bottom-0 right-0 mr-2 mb-2 content-evenly">
                <div id="leavebutton" onclick="leaveRedirect()" class="w-14 h-14 flex bg-red-500 items-center content-center justify-center p-1 mb-2 rounded-xl hover:text-gray-300 hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12l1.41 1.41L13.41 14l2.12 2.12l-1.41 1.41L12 15.41l-2.12 2.12l-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                </div>
                <div id="statusbutton" onclick="statusRedirect()" class="w-14 h-14 flex items-center content-center justify-center mb-2 p-1 rounded-xl hover:text-gray-300 hover:cursor-pointer" style="{{$nextStatusStyle}}">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm6 13h-5l-1-2H9.5v5H8V7h6l1 2h3v6"/></svg>
                </div>
                <div id="blurbbutton" class="w-14 h-14 flex bg-indigo-600 items-center content-center justify-center mb-2 p-1 rounded-xl hover:text-gray-300 hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.58 6.25l1.77 1.77l-4.84 4.84a.5.5 0 0 1-.35.14H13.1c-.28 0-.5-.22-.5-.5v-1.06c0-.13.05-.26.15-.35l4.83-4.84zm3.27-.44l-1.06-1.06c-.2-.2-.51-.2-.71 0l-.85.85L20 7.37l.85-.85c.2-.2.2-.52 0-.71zM20 18c0 .55-.45 1-1 1H5c-.55 0-1-.45-1-1s.45-1 1-1h1v-7c0-2.79 1.91-5.14 4.5-5.8v-.7c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v.7c.82.21 1.57.59 2.21 1.09l-4.52 4.52c-.38.38-.59.88-.59 1.41V13c0 1.1.9 2 2 2h1.77c.53 0 1.04-.21 1.41-.59L18 12.2V17h1c.55 0 1 .45 1 1zm-10 2h4c0 1.1-.9 2-2 2s-2-.9-2-2z"/></svg>
                </div>
                <div id="editbutton" onclick="editRedirect()" class="w-14 h-14 flex bg-sky-400 items-center content-center justify-center mb-2 p-1 rounded-xl hover:text-gray-300 hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>
                </div>
            <div>
        @endif
    @if ((!$isOwner) && (Auth::user()->isMod))
        <div class="w-14 h-32 fixed bottom-0 right-0 mr-2 mb-2 lg:mr-4 lg:mb-4 content-evenly">
            <div id="deletebutton" class="w-14 h-14 mb-4 flex items-center content-center bg-gray-500 justify-center p-1 rounded-xl hover:cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path id="deleteicon" fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12l1.41 1.41L13.41 14l2.12 2.12l-1.41 1.41L12 15.41l-2.12 2.12l-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/></svg>
            </div>
            <div id="inactivebutton" class="w-14 h-14 flex items-center content-center bg-gray-500 justify-center p-1 rounded-xl hover:cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="3em" height="3em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path id="inactiveicon" fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm6 13h-5l-1-2H9.5v5H8V7h6l1 2h3v6"/></svg>
            </div> 
        </div>
        <script>
            var inactiveTimeout;
            var deleteTimeout;
            var doDeleteRedirect = false;
            var doInactiveRedirect = false;

            $('#deletebutton').click( function() {
                if (doDeleteRedirect){
                    window.location.href = "/shop/edit/delete/{{$shop->id}}";
                }
                else {
                    $('#deleteicon').attr('d', 'M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12s4.48 10 10 10s10-4.48 10-10zm-10 1H8v-2h4V8l4 4l-4 4v-3z');
                    $('#deleteicon').css("color", "yellow");
                    doDeleteRedirect = true;
                    deleteTimeout = setTimeout(function(){
                        $('#deleteicon').css("color", "black");
                        $('#deleteicon').attr('d', 'M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12l1.41 1.41L13.41 14l2.12 2.12l-1.41 1.41L12 15.41l-2.12 2.12l-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z');
                        doDeleteRedirect = false;
                    }, 1500);
                }
            });

            

            $('#inactivebutton').click( function() {
                if (doInactiveRedirect){
                    window.location.href = "/shop/edit/inactive/{{$shop->id}}";
                }
                else {
                    $('#inactiveicon').attr('d', 'M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12s4.48 10 10 10s10-4.48 10-10zm-10 1H8v-2h4V8l4 4l-4 4v-3z');
                    $('#inactiveicon').css("color", "yellow");
                    doInactiveRedirect = true;
                    inactiveTimeout = setTimeout(function(){
                        $('#inactiveicon').css("color", "black");
                        $('#inactiveicon').attr('d', 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm6 13h-5l-1-2H9.5v5H8V7h6l1 2h3v6');
                        doInactiveRedirect = false;
                    }, 1500);
                }
            });
        </script>
    @endif

    </body>
    <script>
        function backButton(){
            window.location.href = "/shoplist";
        }
        function newShopRedirect(){
            window.location.href = "/shop/create";
        }
        function editRedirect(){
            window.location.href = "/shop/edit/{{$shop->id}}";
        }
        function statusRedirect(){
            window.location.href = "/shop/edit/status/{{$shop->id}}";
        }
        function leaveRedirect(){
            window.location.href = "/shop/leave/{{$shop->id}}"
        }
        function manageShopsRedirect(){
            window.location.href = "/shoplist/p:{{Auth::user()->name}}";
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
        $('#blurbbutton').click(function(){
            $('#staticBlurb').hide(0);
            $('#formBlurbContainer').show(0);
        });
    </script>
</html>