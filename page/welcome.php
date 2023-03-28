 <!-- <div id="indicators-carousel" class="relative mt-16" data-carousel="static">
     Carousel wrapper 
    <div class="relative h-96 overflow-hidden rounded-lg md:h-96">
          Item 1 
        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
            <img src="assets/portesouvertes.jpeg" class="absolute block  -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
 Item 2 
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/joyeuxnoel.jpg" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
         Item 3 
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/messedenoel.jpg" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        Item 4 
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/btssio.jpg" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        Item 5
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="assets/btsalternance.jpg" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    Slider indicators 
    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    Slider controls 
    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div> -->
<div class="flex justify-center mt-16 gap-1.5">

    <!--Présentation -->
<div class=" block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Groupe Pasteur Mont-Roland</h5>
    <p class="font-normal text-gray-700 dark:text-gray-400 mb-2">M.Courbez et M.Pernelle vous propose une séance de sport collectif tous les mardi soir</p> 
    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        S'inscrire
        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </a>    
</div>

<!--Laisse ton com ! -->
<div>
<form method="post">
   <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 ">
       <div class="flex items-center justify-between px-3 py-2 border-b ">
           <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x">
               <div class="flex items-center space-x-1 sm:pr-4">Laisse ton commentaire juste ici !</div>
           </div>
       </div>
       <div class="px-4 py-2 bg-white rounded-b-lg">
           <label for="editor" class="sr-only">Publish post</label>
           <textarea id="editor" rows="8" class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0" placeholder="Ecris ton plus beau roman..." required></textarea>
       </div>
   </div>
   <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200">
       Publier
   </button>
</form>

</div>
</div>
