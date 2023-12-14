<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Educational Background') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-9xl mx-auto bg-white p-8 shadow-md rounded-md">
            <form action="{{ route('submit_educational_background') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <table class="w-full text-sm text-gray-500 border border-gray-300">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-6 border-b">LEVEL</th>
                            <th scope="col" class="py-3 px-6 border-b">NAME OF SCHOOL (Write in full)</th>
                            <th scope="col" class="py-3 px-6 border-b">BASIC EDUCATION/DEGREE/COURSE (Write in full)</th>
                            <th scope="col" class="py-3 px-6 border-b">PERIOD OF ATTENDANCE</th>
                            <th scope="col" class="py-3 px-6 border-b">HIGHEST LEVEL/UNITS EARNED (if not graduated)</th>
                            <th scope="col" class="py-3 px-6 border-b">YEAR GRADUATED</th>
                            <th scope="col" class="py-3 px-6 border-b">SCHOLARSHIP/ACADEMIC HONORS RECEIVED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(['elementary', 'secondary', 'vocational', 'college', 'graduate'] as $level)
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">{{ strtoupper($level) }}</th>
                                <td class="py-4 px-2">
                                    <input type="text" name="{{ $level }}_school" class="form-input border border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old($level . '_school', $user->{$level . '_school'}) }}">
                                </td>
                                <td class="py-4 px-6">
                                    <input type="text" name="{{ $level }}_degree" class="form-input border border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old($level . '_degree', $user->{$level . '_degree'}) }}">
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex">
                                        <input type="date" name="{{ $level }}_attendance_from" class="form-input border border-gray-300 rounded-md shadow-sm mt-1 block w-full" placeholder="from" value="{{ old($level . '_attendance_from', $user->{$level . '_attendance_from'}) }}">
                                        <span class="mx-2">-</span>
                                        <input type="date" name="{{ $level }}_attendance_to" class="form-input border border-gray-300 rounded-md shadow-sm mt-1 block w-full" placeholder="to" value="{{ old($level . '_attendance_to', $user->{$level . '_attendance_to'}) }}">
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <input type="text" name="{{ $level }}_highest_level" class="form-input border border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old($level . '_highest_level', $user->{$level . '_highest_level'}) }}">
                                </td>
                                <td class="py-4 px-6">
                                    <input type="date" name="{{ $level }}_year_graduated" class="form-input border border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old($level . '_year_graduated', $user->{$level . '_year_graduated'}) }}">
                                </td>
                                <td class="py-4 px-6">
                                    <input type="text" name="{{ $level }}_honors" class="form-input border border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old($level . '_honors', $user->{$level . '_honors'}) }}">
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-white">
                            <td colspan="7" class="text-right italic py-4 px-6 border-t">
                                <div class="mt-4 flex justify-between items-center">

                                    <div>
                                        <label for="signature" class="block text-sm font-medium text-gray-600">Signature:</label>
                                        <div id="signature-pad" class="signature-pad border border-gray-300 p-4">
                                            <canvas class="border border-gray-300 rounded-md" style="width: 100%; height: 150px;"></canvas>
                                            <input type="hidden" name="signature" id="signature-input">
                                            <button type="button" id="clear-button" class="mt-2 px-4 py-2 bg-red-500 text-white rounded-md">Clear</button>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-600">Date</label>
                                        <input type="date" name="date" id="date" class="form-input border border-gray-300 rounded-md shadow-sm mt-1 block w-full" value="{{ old('date', $user->date) }}">
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">Submit</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <script>
                var canvas = document.querySelector("canvas");
                var signaturePad = new SignaturePad(canvas);

                signaturePad.onEnd = function() {
                    document.getElementById('signature-input').value = signaturePad.toDataURL();
                };

                document.getElementById('clear-button').addEventListener('click', function () {
                    signaturePad.clear();
                 document.getElementById('signature-input').value = '';
                });
            </script>
        </div>
    </div>
</x-app-layout>
