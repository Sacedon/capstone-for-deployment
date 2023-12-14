<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Leave Request Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-6 py-4">
                <h2 class="mb-4 text-2xl font-semibold">Leave Request Details</h2>

                <!-- Leave Request Details -->
                <form>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1 font-semibold text-gray-600">Full Name:</label>
                            <input type="text" value="{{ $leaveRequest->user->surname }}, {{$leaveRequest->user->first_name}} " readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold text-gray-600">Department:</label>
                            <input type="text" value="{{ $leaveRequest->user->department->name }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold text-gray-600">Start Date:</label>
                            <input type="text" value="{{ $leaveRequest->start_date }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold text-gray-600">End Date:</label>
                            <input type="text" value="{{ $leaveRequest->end_date }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold text-gray-600">Leave Type:</label>
                            <input type="text" value="{{ $leaveRequest->leave_type }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                            @if ($leaveRequest->leave_type === 'sick' && !empty($leaveRequest->other_reason))
                                <label class="block mt-4 mb-1 font-semibold text-gray-600">Reason for leaving:</label>
                                <input type="text" value="{{ $leaveRequest->other_reason }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                            @endif
                            @if ($leaveRequest->leave_type === 'educational' && !empty($leaveRequest->other_reason))
                                <label class="block mt-4 mb-1 font-semibold text-gray-600">Explanation of your leave:</label>
                                <input type="text" value="{{ $leaveRequest->other_reason }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                            @endif
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold text-gray-600">Specific {{ $leaveRequest->leave_type }} type:</label>

                            @if ($leaveRequest->leave_type === 'sick' )
                                <input type="text" value="{{ $leaveRequest->reason }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                            @elseif ($leaveRequest->leave_type === 'educational')
                                <input type="text" value="{{ $leaveRequest->educational_reason }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                            @else
                                @if (!empty($leaveRequest->other_reason))
                                    <input type="text" value="{{ $leaveRequest->other_reason }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                                @endif
                            @endif

                            <label class="block mt-4 font-semibold text-gray-600">Days:</label>
                            <input type="text" value="{{ $leaveRequest->number_of_days }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                        </div>
                    </div>
                    <div>
                        <label class="block mt-4 mb-1 font-semibold text-gray-600">Status:</label>
                        <input type="text" value="{{ $leaveRequest->status }}" readonly class="w-full px-3 py-2 bg-gray-100 rounded-md" />
                    </div>
                </form>

                @if ($leaveRequest->status === 'rejected' && $leaveRequest->rejection_reason)
                    <div class="p-4 mt-4 bg-red-100 rounded-md">
                        <strong class="text-red-600">Rejection Reason:</strong>
                        <p>{{ $leaveRequest->rejection_reason }}</p>
                    </div>
                @endif

                <!-- Actions Buttons (if pending) -->
                @if ($leaveRequest->status === 'pending_supervisor' && auth()->user()->role === 'supervisor')
                    @if (auth()->user()->department_id === $leaveRequest->user->department_id)
                        <div class="flex justify-center mt-6 space-x-4">
                            <form method="POST" action="{{ route('leave-requests.accept', ['leaveRequest' => $leaveRequest->id]) }}" class="flex-shrink-0">
                                @csrf
                                <input type="hidden" name="approval_type" value="supervisor">
                                <button type="submit" class="btn btn-accept">
                                    Accept Leave Request
                                </button>
                            </form>

                            <button type="button" class="btn btn-reject" data-bs-toggle="modal" data-bs-target="#rejectionModal">
                                Reject Leave Request
                            </button>

                            <div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectionModalLabel">Provide Rejection Reason</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('leave-requests.reject', $leaveRequest) }}">
                                                @csrf
                                                <input type="hidden" name="rejection_type" value="supervisor">
                                                <div class="mb-3">
                                                    <label for="rejectionReason" class="form-label">Rejection Reason:</label>
                                                    <textarea class="form-control" id="rejectionReason" name="rejected_reason" rows="3" placeholder="Provide the reason"></textarea>
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="submit" class="btn btn-modal_reject">Reject Leave Request</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

                @elseif ($leaveRequest->status === 'recommend_for_approval' && auth()->user()->role === 'admin')
                    @if (auth()->user())
                        <div class="flex justify-center mt-6 space-x-4">
                            <form method="POST" action="{{ route('leave-requests.accept', $leaveRequest) }}" class="flex-shrink-0">
                                @csrf
                                <input type="hidden" name="approval_type" value="admin">
                                <button type="submit" class="btn btn-accept">
                                    Accept Leave Request
                                </button>
                            </form>

                            <button type="button" class="btn btn-reject" data-bs-toggle="modal" data-bs-target="#adminRejectionModal">
                                Reject Leave Request
                            </button>

                            <!-- Admin Rejection Reason Modal -->
                            <div class="modal fade" id="adminRejectionModal" tabindex="-1" aria-labelledby="adminRejectionModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="adminRejectionModalLabel">Provide Rejection Reason</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('leave-requests.reject', ['leaveRequest' => $leaveRequest->id]) }}">
                                                @csrf
                                                <input type="hidden" name="rejection_type" value="admin">
                                                <div class="mb-3">
                                                    <label for="adminRejectionReason" class="form-label">Rejection Reason:</label>
                                                    <textarea class="form-control" id="adminRejectionReason" name="rejected_reason" rows="3" placeholder="Enter rejection reason"></textarea>
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="submit" class="btn btn-modal_reject">Reject Leave Request</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('leave-requests.index') }}" class="text-indigo-600 hover:underline">Back to Leave Requests</a>
        </div>
    </div>
</x-app-layout>

<style scoped>
    .form-input {
        /* Style for read-only input */
        border: none;
        padding: 0.500rem 0.200rem;
        font-size: 1rem;
        line-height: 3.0;
        background-color: #edf2f7;
        cursor: not-allowed;
    }

    .btn {
        /* Style for buttons */
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-accept {
        /* Style for Accept button */
        background-color: #28a745;
        color: white;
    }

    .btn-accept:hover {
        /* Hover effect for Accept button */
        background-color: #218838;
    }

    .btn-reject {
        /* Style for Reject button */
        background-color: #dc3545;
        color: white;
    }

    .btn-reject:hover {
        /* Hover effect for Reject button */
        background-color: #c82333;
    }

    .btn-modal_reject {
        /* Style for Reject button */
        background-color: #dc3545;
        color: white;
    }

    .btn-modal_reject:hover {
        /* Hover effect for Reject button */
        background-color: #c82333;
    }
</style>
