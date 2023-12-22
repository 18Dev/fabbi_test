<!doctype html>
<html>
<head>
    @include('layouts.head')
</head>
<body>
<div class="flex justify-center mt-32">
    <div class="w-1/2">
        <!-- Top bar -->
        @include('layouts.top-step')

        <div class="mt-10" id="view-render">
            <form id="handle-dishes" action="{{ route('step-1') }}" method="POST">
                @csrf
                <!-- Step 1 -->
                @include('pages.step_1')

                <!-- Step 2 -->
                @include('pages.step_2')

                <!-- Step 3 -->
                @include('pages.step_3')

                <!-- Step 4 -->
                @include('pages.step_4')
            </form>

            <div class="flex justify-end mt-10">
                <button type="submit" id="submit_form" class="px-2.5 border-solid border-2 border-black shadow-md shadow-black">Next</button>
            </div>
        </div>
    </div>
</div>

</body>
@include('layouts.script')
</html>
