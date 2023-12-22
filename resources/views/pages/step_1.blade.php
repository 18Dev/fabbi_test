<!-- Step 1 -->
<div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 tab" id="tab-1">
    <div class="sm:col-span-4">
        <label for="meal" class="block mb-2 text-sm font-medium text-gray-900">Please Select a meal</label>
        <select id="meal" name="meal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2">
            <option value="BREAKFAST">Breakfast</option>
            <option value="LUNCH">Lunch</option>
            <option value="DINNER">Dinner</option>
        </select>
    </div>
    <div class="sm:col-span-4">
        <label for="number-people" class="block text-sm font-medium text-gray-900">Please Enter Number of people</label>
        <div class="mt-2">
            <input type="number" name="number_people" id="number-input" aria-describedby="helper-text-explanation"
                   class="border border-gray-300 text-gray-900 text-sm rounded-lg block p-2 placeholder:text-gray-400"
                   value="{{ old('name') ?? 1 }}">
        </div>
    </div>
</div>
