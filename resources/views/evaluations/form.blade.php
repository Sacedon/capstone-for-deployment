<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Evaluate Employee') }}
            </h2>
        </x-slot>

        <div class="grid grid-cols-2 gap-4">
            <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg m-2">
                <h1 class="text-3xl font-semibold mb-4 text-center text-black-500">Rating Instructions</h1>

                <div style="background-color: #9ecadf; padding: 15px; border-radius: 8px;">
                    <p><strong>Excellent (5):</strong> Outstanding performance, exceeded expectations.</p>
                    <p><strong>Very Good (4):</strong> Above average, met expectations well.</p>
                    <p><strong>Good (3):</strong> Met basic expectations, room for improvement.</p>
                    <p><strong>Fair (2):</strong> Below expectations, significant improvements needed.</p>
                    <p><strong>Poor (1):</strong> Unacceptable, major changes required.</p>
                </div>
            </div>

            <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg m-2">
                <h1 class="text-3xl font-semibold mb-4 text-center text-black-500">Evaluate Employee</h1>

                <div class="border border-gray-300 p-4">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            @if ($user->profile_picture)
                                <img class="h-16 w-16 rounded-full object-cover border-2 border-blue-500" src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }} Profile Picture">
                            @else
                                <img class="h-16 w-16 rounded-full object-cover border-2 border-blue-500" src="{{ asset('images/default-profile.jpeg') }}" alt="{{ $user->name }} Profile Picture">
                            @endif
                        </div>

                        <div>
                            <div class="text-xl font-semibold text-gray-900">{{ $user->first_name }} {{$user->middle_name}} {{ $user->surname }}</div>
                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            <div class="text-sm text-gray-500">
                                @if ($user->department)
                                    {{ $user->department->name }}
                                @else
                                    Department Not Assigned
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg m-2 mt-3">
            @if(session('success'))
                <div class="bg-green-200 text-green-800 border-l-4 border-green-500 p-3 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-green-200 text-green-800 border-l-4 border-green-500 p-3 mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form id="form1" action="{{ route('evaluations.submit') }}" method="POST">
                @csrf
                <h2 class="text-2xl font-semibold mb-4 text-center">A. TEACHER'S PERSONALITY </h2>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <table class="w-full mb-4">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 text-center border text-lg">{{ $user->first_name }} {{ $user->middle_name }} {{$user->surname}}</th>
                            <th class="py-2 px-4 text-center border">Excellent (5)</th>
                            <th class="py-2 px-4 text-center border">Very Good (4)</th>
                            <th class="py-2 px-4 text-center border">Good (3)</th>
                            <th class="py-2 px-4 text-center border">Fair (2)</th>
                            <th class="py-2 px-4 text-center border">Poor (1)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border">1. Is neat and well-groomed and manifests decency in his/her <br>
                                attire.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_1a" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_1a" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_1a" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_1a" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_1a" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">2. Is free from distracting mannerisms.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_2a" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_2a" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_2a" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_2a" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_2a" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">3. Can command respect and attention in the class.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_3a" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_3a" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_3a" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_3a" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_3a" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">4. Shows dynamism and enthusiasm in teaching.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_4a" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_4a" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_4a" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_4a" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_4a" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">5. delivers the lesson with a well-modulated voice.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_5a" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_5a" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_5a" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_5a" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_5a" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">6. establishes eye contact in delivering the lesson.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_6a" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_6a" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_6a" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_6a" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_6a" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">7. Manifests a non-threatening personality which enhances <br>
                                student-teacher relationship.</td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_7a" value="5">
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_7a" value="4">
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_7a" value="3">
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_7a" value="2">
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_7a" value="1">
                                </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">8. Shows a sense of humor that makes the class alive.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_8a" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_8a" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_8a" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_8a" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_8a" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">9. Displays a self-confidence in delivering the lesson.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_9a" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_9a" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_9a" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_9a" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_9a" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">10. Exercises tact and show respect and fairness in dealing <br>
                                with the students.</td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_10a" value="5">
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_10a" value="4">
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_10a" value="3">
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_10a" value="2">
                                </td>
                                <td class="py-2 px-4 border text-center">
                                    <input type="radio" name="rating_10a" value="1">
                                </td>
                        </tr>
                    </tbody>
                </table>
                    <div class="w-3/4 mr-4">
                        <label for="comments_a" class="block text-gray-700 font-semibold">Comments:</label>
                        <textarea name="comments_a" id="comments_a" class="form-textarea mt-1 block w-full rounded-md border-gray-300" style="resize: vertical; max-height: 150px;"></textarea>
                    </div>

        @csrf
        <h2 class="text-2xl font-semibold mb-4 mt-5 text-center">B. TEACHER'S KNOWLEDGE OF THE SUBJECT MATTER </h2>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <table class="w-full mb-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-center border text-lg">{{ $user->first_name }} {{ $user->middle_name }} {{$user->surname}}</th>
                        <th class="py-2 px-4 text-center border">Excellent (5)</th>
                        <th class="py-2 px-4 text-center border">Very Good (4)</th>
                        <th class="py-2 px-4 text-center border">Good (3)</th>
                        <th class="py-2 px-4 text-center border">Fair (2)</th>
                        <th class="py-2 px-4 text-center border">Poor (1)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border">1. Manifests mastery of the topic being discussed.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1b" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1b" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1b" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1b" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1b" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">2. Presents the lesson in an interesting and organized matter.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2b" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2b" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2b" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2b" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2b" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">3. Aligns the parts of the lesson with the course learning <br>
                            outcomes.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3b" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3b" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3b" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3b" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3b" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">4. Sets clear expectations of student's performance.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4b" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4b" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4b" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4b" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4b" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">5. Explains the subject matter without completely <br>
                            relying on the references.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5b" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5b" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5b" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5b" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5b" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">6. Relates the subject matter to real life situations.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6b" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6b" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6b" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6b" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6b" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">7. Clarifies ideas in answer to students' questions <br>
                            regarding the lesson.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7b" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7b" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7b" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7b" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7b" value="1">
                            </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">8. Elaborates lessons with current developments <br>
                            or up-to-date information on the subject matter.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8b" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8b" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8b" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8b" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8b" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">9. Integrates values in the lesson.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9b" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9b" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9b" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9b" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9b" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">10. Maximizes the use of instructional time <br>
                            for students' participation.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10b" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10b" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10b" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10b" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10b" value="1">
                            </td>
                    </tr>
                </tbody>
            </table>
                <div class="w-3/4 mr-4">
                    <label for="comments_b" class="block text-gray-700 font-semibold">Comments:</label>
                    <textarea name="comments_b" id="comments_b" class="form-textarea mt-1 block w-full rounded-md border-gray-300" style="resize: vertical; max-height: 150px;"></textarea>
                </div>

            @csrf
            <h2 class="text-2xl font-semibold mb-4 mt-5 text-center">C. CLASSROOM MANAGEMENT </h2>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <table class="w-full mb-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-center border text-lg">{{ $user->first_name }} {{ $user->middle_name }} {{$user->surname}}</th>
                        <th class="py-2 px-4 text-center border">Excellent (5)</th>
                        <th class="py-2 px-4 text-center border">Very Good (4)</th>
                        <th class="py-2 px-4 text-center border">Good (3)</th>
                        <th class="py-2 px-4 text-center border">Fair (2)</th>
                        <th class="py-2 px-4 text-center border">Poor (1)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border">1. Starts and ends the class on time.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1c" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1c" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1c" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1c" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1c" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">2. Checks attendance systematically.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2c" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2c" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2c" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2c" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2c" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">3. Establishes a conductive learning environment.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3c" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3c" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3c" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3c" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3c" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">4. Make sure that order and discipline are being <br>
                            observed in the class.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4c" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4c" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4c" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4c" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4c" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">5. Spends time efficiently by refraining from discussing <br>
                            topics not related to the lesson.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5c" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5c" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5c" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5c" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5c" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">6. Uses varied teaching strategies to achieve <br>
                            the learning outcomes.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6c" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6c" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6c" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6c" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6c" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">7. Motivates the students by giving praises and words <br>
                            of affirmation.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7c" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7c" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7c" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7c" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7c" value="1">
                            </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">8. Utilizes varied instructional materials and integrates <br>
                            technology in teaching.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8c" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8c" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8c" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8c" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8c" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">9. Prescribes reasonable course requirements within <br>
                            reasonable time.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9c" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9c" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9c" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9c" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9c" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">10. Evaluates students' performance and informs them <br>
                            of the outcomes.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10c" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10c" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10c" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10c" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10c" value="1">
                            </td>
                    </tr>
                </tbody>
            </table>
                <div class="w-3/4 mr-4">
                    <label for="comments_c" class="block text-gray-700 font-semibold">Comments:</label>
                    <textarea name="comments_c" id="comments_c" class="form-textarea mt-1 block w-full rounded-md border-gray-300" style="resize: vertical; max-height: 150px;"></textarea>
                </div>

            @csrf
            <h2 class="text-2xl font-semibold mb-4 mt-5 text-center">D. TEACHER'S TECHNIQUES FOR INDEPENDENT LEARNING </h2>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <table class="w-full mb-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-center border text-lg">{{ $user->first_name }} {{ $user->middle_name }} {{$user->surname}}</th>
                        <th class="py-2 px-4 text-center border">Excellent (5)</th>
                        <th class="py-2 px-4 text-center border">Very Good (4)</th>
                        <th class="py-2 px-4 text-center border">Good (3)</th>
                        <th class="py-2 px-4 text-center border">Fair (2)</th>
                        <th class="py-2 px-4 text-center border">Poor (1)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border">1. Incorporates independent study through library work <br>
                            and research activities.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1d" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1d" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1d" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1d" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_1d" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">2. Promotes teacher-student and student-student interactions.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2d" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2d" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2d" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2d" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_2d" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">3. Gives interesting and imaginative, stimulating <br>
                            or challenging activities.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3d" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3d" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3d" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3d" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_3d" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">4. Encourages the students to ask questions, raise problems, <br>
                            and present solutions.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4d" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4d" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4d" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4d" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_4d" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">5. Asks different types of questions to stimulate analytical <br>
                            and critical thinking.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5d" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5d" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5d" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5d" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_5d" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">6. Provides appropriate worksheets, exercises, activities, <br>
                            and handouts to students.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6d" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6d" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6d" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6d" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_6d" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">7. Employs cooperative learning activities to encourage <br>
                            interaction and deepen discussion.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7d" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7d" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7d" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7d" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_7d" value="1">
                            </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">8. Motivates students to do reflective thinking and relate <br>
                            learning to daily life.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8d" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8d" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8d" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8d" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_8d" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">9. Provides an atmosphere that stimulates learning by <br>
                            encouraging students to ask questions, raise problems, <br>
                            and propose solutions.</td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9d" value="5">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9d" value="4">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9d" value="3">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9d" value="2">
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <input type="radio" name="rating_9d" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border">10. Encourages students' participation in formulating class <br>
                            rules and leatning activities.</td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10d" value="5">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10d" value="4">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10d" value="3">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10d" value="2">
                            </td>
                            <td class="py-2 px-4 border text-center">
                                <input type="radio" name="rating_10d" value="1">
                            </td>
                    </tr>
                </tbody>
            </table>
            <div class="mb-4 flex">
                <div class="w-3/4 mr-4">
                    <label for="comments_d" class="block text-gray-700 font-semibold">Comments:</label>
                    <textarea name="comments_d" id="comments_d" class="form-textarea mt-1 block w-full rounded-md border-gray-300" style="resize: vertical; max-height: 150px;"></textarea>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-md text-sm ml-20 mt-5">Submit Evaluation</button>
                </div>

        </form>
    </div>

    <div class="flex justify-end mt-8">

        <div class="bg-gray-200 p-4 rounded-lg ml-4">
            <p class="text-lg font-semibold mb-2">Overall Rating:</p>
            <p id="overallRating" class="text-3xl font-bold text-blue-600 text-center">0.00</p>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
    function calculateTotalRating(formId) {
        var ratingInputs = document.querySelectorAll('form#' + formId + ' input[name^="rating_"]:checked');

        // Calculate the total based on the sum of checked radio buttons' values
        var totalRating = Array.from(ratingInputs).reduce((total, input) => total + parseFloat(input.value), 0);

        updateOverallRating(totalRating);
    }

    function updateOverallRating(totalRating) {
        // Display the overall rating
        document.getElementById('overallRating').textContent = totalRating.toFixed(2);
    }

    // Attach event listeners for each radio button
    var ratingInputs = document.querySelectorAll('form input[name^="rating_"]');
    ratingInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            // Dynamically get the form ID based on the changed input
            var formId = input.closest('form').id;
            calculateTotalRating(formId);
        });
    });
});

    </script>
</x-app-layout>
