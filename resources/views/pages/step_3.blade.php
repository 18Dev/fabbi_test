<!-- Step 3 -->
<div class="hidden tab" id="tab-3">
    <div id="block-tab-3">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="dish" class="block mb-2 text-sm font-medium text-gray-900">Please Select a Dish</label>
                <select id="dish_1" name="dish_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2"></select>
            </div>
            <div>
                <label for="number_servings" class="block text-sm font-medium text-gray-900">Please enter no, of servings</label>
                <div class="mt-2">
                    <input type="number" name="number_servings_1" aria-describedby="helper-text-explanation"
                           class="border border-gray-300 text-gray-900 text-sm rounded-lg block p-2 placeholder:text-gray-400"
                           value="{{ old('number_servings') ??  1 }}">
                </div>
            </div>
        </div>
    </div>

    <button type="button" id="add-tab-3"
            class="border border-black hover:bg-gray-300 rounded-full text-sm p-2.5 text-center inline-flex items-center">
        <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             width="30px" height="30px" viewBox="0 0 45.402 45.402"
             xml:space="preserve">
                            <g>
                                <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141
                                    c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27
                                    c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435
                                    c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"/>
                            </g>
                        </svg>
    </button>
</div>
