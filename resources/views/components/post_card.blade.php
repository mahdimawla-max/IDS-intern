@props(['post' ,'user'])
<?php
$timeAgo = \Illuminate\Support\Carbon::parse($post->created_at)->diffForHumans();
?>

<article
    class="mx-auto max-md:mx-2.5 max-w-[900px] my-4 break-inside rounded-xl bg-white dark:bg-slate-800 flex flex-col bg-clip-border">
    <div class="flex p-6 items-center justify-between">
        <div class="flex w-full justify-between relative items-center">
            <div>
                <a class="inline-block mr-4" href="#">
                    <img class="rounded-full max-w-none w-14 h-14"
                         src="{{($post->profilepicture)?$post->profilepicture:'/images/user-placeholder.png'}}"/>
                </a>
                <div class="flex flex-col">
                    <div class="flex items-center">
                        <p class="inline-block text-lg font-bold mr-2">{{$post->fullname}}</p>
                        <span class="text-slate-500 dark:text-slate-300">{{ $timeAgo }}</span>
                    </div>
                </div>
            </div>
            @if (Request::is('profile'))
            <form action="/delete-post/{{$post->post_id}}" method="post" class="bg-white h-fit">
                @csrf
                <button><img src="/images/trash.svg" alt="" class="w-[40px]"></button>
            </form>
            @endif
        </div>
    </div>
    <p class="pr-6 pl-6 pb-6 text-white">
        {{$post->description}}
    </p>
    <div class="p-6">
        <img src="{{$post->content}}" alt="">
    </div>
    <div class="p-6">

        <div class="mt-6 mb-6 h-px bg-slate-200"></div>
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2 text-white text-[23px]">
                <svg onclick="toggleToLike('heart-icon-{{$post->id}}' , 'number-of-likes-{{$post->id}}')"
                     class="w-[40px] heart-icon cursor-pointer" id="heart-icon-{{$post->id}}"
                     width="106"
                     height="97"
                     viewBox="0 0 106 97"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        class="fill-color-shape"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M73.0406 3.04949C65.7359 2.94379 58.3559 5.38824 53.2483 12.3801C48.1271 5.39042 40.631 3.04941 33.4677 3.04941C18.2587 3.04941 3.04622 15.7081 3.04622 33.4698C3.04622 51.0995 14.3683 66.123 26.1679 76.6801C32.0812 81.9708 38.1493 86.1719 43.0557 89.0533C45.5086 90.4938 47.6791 91.6092 49.402 92.3672C50.2628 92.7459 51.0206 93.0393 51.6517 93.2395C52.2639 93.4336 52.8188 93.5607 53.2487 93.5607C53.6786 93.5607 54.2336 93.4336 54.8458 93.2395C55.4769 93.0393 56.2347 92.7459 57.0955 92.3672C58.8183 91.6092 60.9889 90.4938 63.4418 89.0533C68.3481 86.1719 74.4162 81.9708 80.3295 76.6801C92.1292 66.1229 103.451 51.0995 103.451 33.4698C103.451 15.6993 88.2313 3.26928 73.0406 3.04949Z"
                    />
                    <path
                        d="M53.2483 12.3801L51.2316 13.8577C51.7029 14.5009 52.4527 14.8807 53.25 14.8801C54.0474 14.8796 54.7966 14.4987 55.267 13.8548L53.2483 12.3801ZM73.0406 3.04949L73.0767 0.549748L73.0406 3.04949ZM26.1679 76.6801L24.501 78.5433L24.501 78.5433L26.1679 76.6801ZM43.0557 89.0533L44.3217 86.8975L44.3217 86.8975L43.0557 89.0533ZM49.402 92.3672L50.4088 90.0789L50.4088 90.0789L49.402 92.3672ZM51.6517 93.2395L52.4075 90.8565L52.4074 90.8565L51.6517 93.2395ZM54.8458 93.2395L54.09 90.8565L54.09 90.8565L54.8458 93.2395ZM57.0955 92.3672L58.1023 94.6555L58.1023 94.6555L57.0955 92.3672ZM63.4418 89.0533L62.1757 86.8975L62.1757 86.8975L63.4418 89.0533ZM80.3295 76.6801L81.9965 78.5433L81.9965 78.5433L80.3295 76.6801ZM55.267 13.8548C59.7836 7.67202 66.2981 5.45219 73.0044 5.54923L73.0767 0.549748C65.1736 0.435397 56.9283 3.10445 51.2295 10.9054L55.267 13.8548ZM33.4677 5.54941C40.0922 5.54941 46.7154 7.69369 51.2316 13.8577L55.2649 10.9026C49.5387 3.08715 41.1697 0.549414 33.4677 0.549414V5.54941ZM5.54622 33.4698C5.54622 17.2225 19.5018 5.54941 33.4677 5.54941V0.549414C17.0157 0.549414 0.546219 14.1936 0.546219 33.4698H5.54622ZM27.8349 74.817C16.2174 64.4228 5.54622 50.0268 5.54622 33.4698H0.546219C0.546219 52.1722 12.5192 67.8231 24.501 78.5433L27.8349 74.817ZM44.3217 86.8975C39.5433 84.0912 33.6121 79.9859 27.8349 74.817L24.501 78.5433C30.5503 83.9556 36.7554 88.2525 41.7897 91.209L44.3217 86.8975ZM50.4088 90.0789C48.7945 89.3686 46.7116 88.3011 44.3217 86.8975L41.7897 91.209C44.3055 92.6865 46.5638 93.8497 48.3951 94.6555L50.4088 90.0789ZM52.4074 90.8565C51.8878 90.6917 51.2173 90.4346 50.4088 90.0789L48.3951 94.6555C49.3082 95.0572 50.1534 95.387 50.8959 95.6225L52.4074 90.8565ZM53.2487 91.0607C53.2633 91.0607 53.1984 91.0609 53.0284 91.0254C52.867 90.9918 52.6608 90.9368 52.4075 90.8565L50.8959 95.6225C51.5581 95.8325 52.417 96.0607 53.2487 96.0607V91.0607ZM54.09 90.8565C53.8367 90.9368 53.6305 90.9918 53.4691 91.0254C53.299 91.0609 53.2341 91.0607 53.2487 91.0607V96.0607C54.0805 96.0607 54.9393 95.8325 55.6016 95.6225L54.09 90.8565ZM56.0887 90.0789C55.2801 90.4346 54.6096 90.6917 54.09 90.8565L55.6016 95.6225C56.3441 95.387 57.1893 95.0572 58.1023 94.6555L56.0887 90.0789ZM62.1757 86.8975C59.7858 88.3011 57.703 89.3686 56.0887 90.0789L58.1023 94.6555C59.9337 93.8497 62.1919 92.6865 64.7078 91.209L62.1757 86.8975ZM78.6626 74.817C72.8853 79.9859 66.9542 84.0913 62.1757 86.8975L64.7078 91.209C69.742 88.2525 75.9471 83.9556 81.9965 78.5433L78.6626 74.817ZM100.951 33.4698C100.951 50.0268 90.2801 64.4228 78.6626 74.817L81.9965 78.5433C93.9783 67.8231 105.951 52.1722 105.951 33.4698H100.951ZM73.0044 5.54923C87.0131 5.75192 100.951 17.2432 100.951 33.4698H105.951C105.951 14.1555 89.4496 0.78665 73.0767 0.549748L73.0044 5.54923Z"
                        fill="#e74c3c"
                    />
                </svg>
                <span id="number-of-likes-{{$post->id}}">6</span>
            </div>
            <button class="py-2 px-4 text-white font-medium hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg">
                Comments
            </button>
            <button class="py-2 px-4 text-white font-medium hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg">
                Share
            </button>
        </div>
        <form class="relative">
            @csrf
            <input
                class="pt-2 pb-2 pl-3 w-full h-11 bg-slate-100 dark:bg-slate-600 rounded-lg placeholder:text-slate-600 dark:placeholder:text-slate-300 font-medium pr-20"
                type="text" placeholder="Write a comment"/>
            <span class="flex absolute right-3 top-2/4 -mt-3 items-center">
          <svg class="mr-2" style="width: 26px; height: 26px;" viewBox="0 0 24 24">
            <path fill="currentColor"
                  d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z">
            </path>
          </svg>
          <svg class="fill-blue-500 dark:fill-slate-50" style="width: 24px; height: 24px;" viewBox="0 0 24 24">
            <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path>
          </svg>
        </span>
        </form>
    </div>
</article>


<script src="assets/js/script.js"></script>
