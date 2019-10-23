<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo</title>
        <!-- Styles -->
        <style>
            html, body {
                background-image: -webkit-linear-gradient(top left, #FEC163 10%, #DE4313 100%);
                background-image: -o-linear-gradient(top left, #FEC163 10%, #DE4313 100%);
                background-image: linear-gradient(to bottom right, #FEC163 10%, #DE4313 100%);
            } 
            @media (min-width: 1024px){
                .scroll-bg {
                    -webkit-animation-name: scrollLarge;
                    animation-name: scrollLarge;
                    -webkit-animation-duration: 35s;
                    animation-duration: 35s;
                    -webkit-animation-timing-function: linear;
                    animation-timing-function: linear;
                    -webkit-animation-iteration-count: infinite;
                    animation-iteration-count: infinite;
                }
            }
            .scroll-bg {
                -webkit-animation-name: scrollSmall;
                animation-name: scrollSmall;
                -webkit-animation-duration: 30s;
                animation-duration: 30s;
                -webkit-animation-timing-function: linear;
                animation-timing-function: linear;
                -webkit-animation-iteration-count: infinite;
                animation-iteration-count: infinite;
            }
            @keyframes scrollLarge {
                0% {
                    transform: rotate(-13deg) translateY(0);
                }
                100% {
                    transform: rotate(-13deg) translateY(-833px);
                }
            } 
            @keyframes scrollSmall {
                0% {
                    transform: rotate(-13deg) translateY(0);
                }
                100% {
                    transform: rotate(-13deg) translateY(-833px);
                }
            }           
        </style>
    <!-- Styles -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="min-h-screen flex items-center justify-center">
        <div class="h-screen w-screen relative overflow-hidden" style="background:#DE4313;">
          <div class="hidden lg:block absolute scroll-bg" style="height: 400%; width: 400%; top: -25%; left: -100%; background-size: 800px auto; background-image: url('/img/scroll.png');"></div>
          <div class="h-screen w-screen relative lg:min-w-3xl xl:min-w-4xl lg:flex lg:items-center lg:justify-center lg:w-3/5 lg:py-16 lg:pl-8 lg:pr-8 bg-no-repeat" style="background-image: url('/img/angled-background.svg'); background-size: 100% auto; background-position: -5px -5px;">
            <div class="lg:pb-0">
              <div class="px-6 pt-16 pb-12 md:max-w-3xl md:mx-auto lg:max-w-full lg:pt-0">
                <p class="flex items-center text-white text-5xl font-semibold">    
                    <svg class="mr-3 h-12 w-12 fill-current" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="inherit" stroke-width="1" fill="inherit" fill-rule="evenodd">
                        <g id="icon-shape">
                            <path d="M2,4 L2,18 L16,18 L16,12 L18,10 L18,20 L17,20 L0,20 L0,19 L0,3 L0,2 L10,2 L8,4 L2,4 Z M12.2928932,3.70710678 L4,12 L4,16 L8,16 L16.2928932,7.70710678 L12.2928932,3.70710678 Z M13.7071068,2.29289322 L16,0 L20,4 L17.7071068,6.29289322 L13.7071068,2.29289322 Z" id="Combined-Shape"></path>
                        </g>
                    </g>
                    </svg>
                    ToDo
                </p>
                <div class="mt-8 lg:mt-16">
                  <h1 class="mt-2 text-4xl leading-tight xl:text-5xl font-semibold font-display text-white">Remember what you need to do.</h1>
                  <p class="mt-3 text-lg max-w-xl lg:max-w-3xl text-gray-400 xl:text-2xl">
                    A simple todo app built with Laravel and React.
                  </p>
                </div>
                    <div class="mt-10">
                     <a href="/login" class="text-center mt-4 relative h-12 sm:mt-0 sm:h-auto block w-full sm:w-1/6 px-6 py-3 font-semibold leading-snug bg-red-900 text-white uppercase tracking-wide rounded-lg shadow-md focus:outline-none focus:shadow-outline hover:bg-red-600"><span class="">Login</span></a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>
