<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<!-- component -->
<header class="2xl:container 2xl:mx-auto">
    <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
    <div class="bg-white rounded shadow-lg py-5 px-7">
        <nav class="flex justify-between">
            <ul class="hidden md:flex flex-auto space-x-2">
                <li onclick="selected()" class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="/home">Home</a></li>
                <li onclick="selected()" class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="/profile">Profile</a>
                </li>
                <li onclick="selected()" class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="{{ route('post') }}">Create Post</a>
                </li>
            </ul>
            <x-search_card>
            </x-search_card>
        
            <div>
                <a href=""><img class="w-[60px]" src="/images/user.svg" alt=""></a>
            </div>
        </nav>
        <!-- for smaller devcies -->

        <div class="block md:hidden w-full mt-5 ">
            <div onclick="selectNew()"
                 class="cursor-pointer px-4 py-3 text-white bg-indigo-600 rounded flex justify-between items-center w-full">
                <div class="flex space-x-2">
                    <span id="s1" class="font-semibold text-sm leading-3 hidden">Selected: </span>
                    <p id="textClicked"
                       class="font-normal text-sm leading-3 focus:outline-none hover:bg-gray-800 duration-100 cursor-pointer ">
                        Pages</p>
                </div>
                <svg id="ArrowSVG" class=" transform" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 9L12 15L18 9" stroke="white" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </div>
            <div class=" relative">
                <ul id="list" class=" hidden font-normal text-base leading-4 absolute top-2  w-full rounded shadow-md">
                    <li onclick="selected()" class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="">Home</a>
                    </li>
                    <li onclick="selected()" class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="/profile">Profile</a>
                    </li>
                    <li class="text-white bg-indigo-600 px-3 py-2.5 rounded"><a href="">Create
                            Post</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
@yield('content')
</body>
<script>function selected() {
        var targeted = event.target;
        var clicked = targeted.parentElement;

        var child = clicked.children;
        console.log(child);

        for (let i = 0; i < child.length; i++) {
            if (child[i].classList.contains("text-white")) {
                console.log(child[i]);
                child[i].classList.remove("text-white", "bg-indigo-600");
                child[i].classList.add(
                    "text-gray-600",
                    "bg-gray-50",
                    "border",
                    "border-white"
                );
            }
        }

        targeted.classList.remove(
            "text-gray-600",
            "bg-gray-50",
            "border",
            "border-white"
        );
        targeted.classList.add("text-white", "bg-indigo-600");
    }

    function selectNew() {
        var newL = document.getElementById("list");
        newL.classList.toggle("hidden");

        document.getElementById("ArrowSVG").classList.toggle("rotate-180");
    }

    function selectedSmall() {
        var text = event.target.innerText;
        var newL = document.getElementById("list");
        var newText = document.getElementById("textClicked");
        newL.classList.add("hidden");
        document.getElementById("ArrowSVG").classList.toggle("rotate-180");
        newText.innerText = text;

        document.getElementById("s1").classList.remove("hidden");
    }
</script>

</html>